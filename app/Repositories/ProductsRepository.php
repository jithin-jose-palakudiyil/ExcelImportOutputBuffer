<?php

namespace App\Repositories;
 


use \Rap2hpoutre\FastExcel\FastExcel;

use Ixudra\Curl\Facades\Curl;
//use \Exception; 

class ProductsRepository implements CommonInterface
{
  
    /**
     * curl url for post method.
     *
     * @var string
     */
    protected static $url = 'https://admin.meezzaa.com/excel/add-product';
     
    /**
     * Get all rows of Series Sheet
     * @param string $file
     * @param string $production
     * @param int $key
     * @param object $excel
     * @return 
     */ 
    public static function import($file,$key,object $excel,$RequestImages,$production,$WriteTitle)
    {  
        $result =false;
        $product =(new FastExcel)->configureCsv(';', '#', '\n', 'gbk')->sheet($key)->import($file); // get all row and coloum of Series sheet 
        if($product->isNotEmpty()):
            $product_array =[];
            foreach ($product as $key => $value):
                $i=0;
                foreach ($value as $key_n => $value_n): 
                    $key_name = strtolower(trim($key_n));
                    if($i != count($value)-1 && $value_n !=''): $product_array[$key][$key_name] = trim($value_n); endif; 
                    $i++;
                endforeach; 
            endforeach; 
            if(!empty($product_array)):
            $result = static::importProcess($product_array,$excel,$RequestImages,$production,$WriteTitle);
            endif;
        endif;
        return  $result; 
    }
    
    /**
     * Import Process start
     * @param array $products 
     * @param object $excel
     * @return 
     */ 
    public static function importProcess(array $products,object $excel,$RequestImages,$production,$WriteTitle)
    {  
        $result =false; $i=0; 
        $images =[];
        foreach ($products as $p_key => $p_value):  
            $product_arr                    = [];
            $series                         = isset( $p_value['meezzaa_series_no'] )?  $p_value['meezzaa_series_no'] : 'null'; 
            $meezzaa_number = isset($p_value['meezzaa_number']) ? $p_value['meezzaa_number'] : 'null';
            $product_arr['sku']             =$meezzaa_number;
            $product_arr['title']           = array( "en" => isset( $p_value['title__en'] ) ? $p_value['title__en'] : 'null', "ar" => isset( $p_value['title__ar'] ) ? $p_value['title__ar'] : 'null', );
            $product_arr['description']     = array( "en" => isset( $p_value['description__en'] ) ? $p_value['description__en'] : 'null', "ar" => isset( $p_value['description__ar'] ) ? $p_value['description__ar'] : 'null', );
//                $images     = array (  
//                    1 => isset( $p_value['Thumbnail'] ) ? $p_value['thumbnail'] : 'null', 
//                    2 => isset( $p_value['image_1'] ) ? $p_value['image_1'] : 'null', 
//                    3 => isset( $p_value['image_2'] ) ? $p_value['image_2'] : 'null', 
////                    4 => isset( $p_value['image_3'] ) ? $p_value['image_3'] : 'null',  
////                    5 => isset( $p_value['image_4'] ) ? $p_value['image_4'] : 'null',  
////                    6 => isset( $p_value['image_5'] ) ? $p_value['image_5'] : 'null', 
//                    );
            
            if($RequestImages == 3):
               $images     = array (  1 => isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null',  2 => isset( $p_value['image_1'] ) ? $p_value['image_1'] : (isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null'), 3 => isset( $p_value['image_2'] ) ? $p_value['image_2'] : 'null',  ); 
            elseif($RequestImages == 4):
                $images     = array ( 1 => isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null', 2 => isset( $p_value['image_1'] ) ? $p_value['image_1'] : (isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null'),  3 => isset( $p_value['image_2'] ) ? $p_value['image_2'] : 'null', 4 => isset( $p_value['image_3'] ) ? $p_value['image_3'] : 'null',  ); 
            elseif($RequestImages == 5):
                $images     = array (  1 => isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null', 2 => isset( $p_value['image_1'] ) ? $p_value['image_1'] : (isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null'), 3 => isset( $p_value['image_2'] ) ? $p_value['image_2'] : 'null', 4 => isset( $p_value['image_3'] ) ? $p_value['image_3'] : 'null', 5 => isset( $p_value['image_4'] ) ? $p_value['image_4'] : 'null', ); 
            elseif($RequestImages == 6):
                $images     = array (  1 => isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null',   2 => isset( $p_value['image_1'] ) ? $p_value['image_1'] : (isset( $p_value['thumbnail'] ) ? $p_value['thumbnail'] : 'null'), 3 => isset( $p_value['image_2'] ) ? $p_value['image_2'] : 'null', 4 => isset( $p_value['image_3'] ) ? $p_value['image_3'] : 'null',  5 => isset( $p_value['image_4'] ) ? $p_value['image_4'] : 'null',  6 => isset( $p_value['image_5'] ) ? $p_value['image_5'] : 'null', );
            endif; 
            $spec = $p_value;
            $image_5 = array_search("image_5",array_keys($spec)); 
            $slice = null;
            if($image_5): 
                $slice =$image_5 ;
            else:
                $image_4 = array_search("image_4",array_keys($spec));
                if($image_4):
                    $slice =$image_4 ;
                else:
                    $image_3 = array_search("image_3",array_keys($spec));
                    if($image_3):
                        $slice =$image_3 ;
                    else:
                        $image_2 = array_search("image_2",array_keys($spec));
                        if($image_2):
                            $slice =$image_2 ;
                        else:
                            $image_1 = array_search("image_1",array_keys($spec));
                            if($image_1):
                                $slice =$image_1 ;
                            endif;
                        endif;
                    endif;
                endif;   
            endif; 
            $spec_array =[];
            if($slice): 
                $spec = array_slice($spec, $slice+1); 
                 $i=0;
                foreach ($spec as $s_key => $s_value) : 
                    if($i != count($spec)-1): $spec_array[$s_key] =$s_value; endif;
                    $i++;
                endforeach; 
                $spec_array_ = []; 
                foreach ($spec_array as $sp_key => $sp_value) :   
                    $spec_array_[$sp_key]     = array( "en" => $sp_value,  "ar" =>$sp_value ); 
                endforeach;
            endif; 
            if($series !='' && $meezzaa_number !='' && isset( $p_value['title__en'] ) && $p_value['title__en'] !='' && isset( $p_value['thumbnail'] ) && $p_value['thumbnail'] !='' && isset( $p_value['image_1'] ) && $p_value['image_1'] !=''  ):
                $response = static::SeriesCurl($series,$product_arr,$images,$spec_array_,$excel,$meezzaa_number,$production,$WriteTitle);
            else:
                $response = ['queue_id'=>$excel->id,'sheet'=>'product','sheet_code'=>$meezzaa_number,'response'=>'some data is missing. validation error','response_code'=>  null,'response_data'=> null];
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
    public static function SeriesCurl($series,$product_arr,$images,$spec_array_,$excel,$meezzaa_number,$production,$WriteTitle)
    { 
        $return = [];
        if($series):
            $array = array  (   
                                'production'                =>  $production,
                                'title'                     =>  $WriteTitle,
                                'excel-api-access-token'    =>  token ,
                                'series'                    =>  $series,
                                'product'                   =>  json_encode($product_arr,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                                'images'                    =>  json_encode($images,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                                'spec'                      =>  json_encode($spec_array_,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                            );
       
            $responses = Curl::to(static::$url)->withData($array)->post();
            $response = json_decode($responses); 
            $return = ['queue_id'=>$excel->id,'sheet'=>'product','sheet_code'=>$meezzaa_number,'response'=>$responses,'response_code'=> isset($response->response) ? $response->response : null,'response_data'=> isset($response->data) ? $response->data : null];
        endif;
        return $return;
    }
}