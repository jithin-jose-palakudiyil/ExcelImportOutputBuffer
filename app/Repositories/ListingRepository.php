<?php

namespace App\Repositories;
 


use \Rap2hpoutre\FastExcel\FastExcel;

use Ixudra\Curl\Facades\Curl;
//use \Exception; 

class ListingRepository implements CommonInterface
{
  
    /**
     * curl url for post method.
     *
     * @var string
     */
    protected static $url = 'https://admin.meezzaa.com/excel/add-listing';
     
    /**
     * Get all rows of Series Sheet
     * @param string $file
     * @param string $production
     * @param int $key
     * @param object $excel
     * @return 
     */ 
    public static function import($file,$key,object $excel,$production)
    {  
        $result =false;
        $listing =(new FastExcel)->configureCsv(';', '#', '\n', 'gbk')->sheet($key)->import($file); // get all row and coloum of Series sheet 
        
        if($listing->isNotEmpty()):
            $listing_array =[];
            foreach ($listing as $key => $value):
                $i=0;
                foreach ($value as $key_n => $value_n): 
                    $key_name = strtolower(trim($key_n));
                    if($i != count($value)-1 && $value_n!=''): $listing_array[$key][$key_name] = trim($value_n); endif; 
                    $i++;
                endforeach; 
            endforeach;  
           
            if(!empty($listing_array)):
            $result = static::importProcess($listing_array,$excel,$production);
            endif;
        endif;
        return  $result; 
    }
    
    /**
     * Import Process start
     * @param array $series 
     * @param object $excel
     * @return 
     */ 
    public static function importProcess(array $listings,object $excel,$production)
    { 
        $result =false; $i=0; 
        foreach ($listings as $L_key => $L_value) : 
                $listing_arr                        =   []; 
                $product = isset($L_value['meezza_number']) ? $L_value['meezza_number'] : 'null';
                $seller =isset($L_value['seller_id']) ? $L_value['seller_id'] : 'null';
                $product_seller = $product.'_'.$seller;
                $listing_arr['product']             =   $product;
                $listing_arr['seller']              =  $seller;
                $listing_arr['partner-SKU-unique']  =   isset($L_value['partner_sku_unique']) ?  $L_value['partner_sku_unique'] : 'null';
                $listing_arr['price']               =   isset($L_value['price']) ? $L_value['price'] : 'null';
                $listing_arr['mrp']                 =   isset($L_value['mrp']) ? $L_value['mrp'] :'0';
                $listing_arr['stock']               =   isset($L_value['stock']) ? $L_value['stock'] : 'null';
                $listing_arr['whats-in-the-box']    =   isset($L_value["what's_in_the_box"]) ? $L_value["what's_in_the_box"] :'null';
                $listing_arr['warranty-period']     =   isset($L_value['warranty_period']) ? $L_value['warranty_period'] : 'null';
                $listing_arr =  json_encode($listing_arr,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
               
                if($product !='' && $seller !='' && isset( $L_value['price'] ) && $L_value['price'] !='' && isset( $L_value['stock'] ) && $L_value['stock'] !=''  ):
                    $response = static::SeriesCurl($listing_arr,$excel,$product_seller,$production); 
                else:
                    $response = ['queue_id'=>$excel->id,'sheet'=>'listing','sheet_code'=>$product_seller,'response'=>'some data is missing. validation error','response_code'=>  null,'response_data'=>   null];   
                endif;
                
                if(is_array($response) && !empty($response)):  \App\PivotQueue::create($response); endif;   $i++;
            endforeach;
            return  true;
    }
        
    /**
     * cURL command lines or scripts to transfer data
     * @param json $series
     * @param object $excel
     * @return 
     */ 
    public static function SeriesCurl(string $listing,object $excel,string $product,$production)
    { 
        $return = [];
        if($listing):
            $array = array  (  
                                'production' =>  $production,
                                'excel-api-access-token'=> token ,
                                'listing'=> $listing, 
                            ); 
            $responses = Curl::to(static::$url)->withData($array)->post();
            $response = json_decode( json_encode($responses), true); 
            $return = ['queue_id'=>$excel->id,'sheet'=>'listing','sheet_code'=>$product,'response'=>$responses,'response_code'=> isset($response->response) ? $response->response : null,'response_data'=> isset($response->data) ? $response->data : null];
        endif;
        return $return;
    }
}