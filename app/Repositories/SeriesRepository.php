<?php

namespace App\Repositories;
 


use \Rap2hpoutre\FastExcel\FastExcel;

use Ixudra\Curl\Facades\Curl;
//use \Exception; 

class SeriesRepository implements CommonInterface
{
  
    /**
     * curl url for post method.
     *
     * @var string
     */
    protected static $url = 'https://admin.meezzaa.com/excel/add-product-series';
     
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
        $series =(new FastExcel)->configureCsv(';', '#', '\n', 'gbk')->sheet($key)->import($file); // get all row and coloum of Series sheet 
        
        if($series->isNotEmpty()):
            $series_array =[];
            foreach ($series as $key => $value):
                $i=0;
                foreach ($value as $key_n => $value_n): 
                    
                    $key_name = strtolower(trim($key_n));
                    if($i != count($value)-1 && $value_n !=''): $series_array[$key][$key_name] = trim($value_n); endif; 
                    $i++;
                endforeach; 
            endforeach; 
            if(!empty($series_array)):
                $result = true;
            $result = static::importProcess($series_array,$excel,$production);
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
    public static function importProcess(array $series,object $excel,$production)
    { 
        $result =false; $i=0;  
        foreach ($series as $key => $value) : 
            $series_arr =  [];
//            if($i == 0): $excel->update(['is_completed'=>1]);  endif; 
            $meezzaa_series_no = isset($value['meezzaa_series_no']) ? $value['meezzaa_series_no'] : 'null'; 
            $series_arr['_id']                = $meezzaa_series_no; 
            $Product_Split                    = explode('>', $value['product']);
            $series_arr['category']           = isset( $Product_Split[0] ) ? $Product_Split[0] : null; 
            $series_arr['subCategory']        = isset( $Product_Split[1] ) ? $Product_Split[1] : null; 
            $series_arr['family']             = isset( $Product_Split[2] ) ? $Product_Split[2] : null; 
            $series_arr['product-type']       = isset( $Product_Split[3] ) ? $Product_Split[3] : null; 
            $series_arr['product-subtype']    = isset( $Product_Split[4] ) ? $Product_Split[4] : null;  
            $brand__en =  isset( $value['brand__en'] ) ? $value['brand__en']: 'null';
            $brand__ar =isset( $value['brand__ar'] ) ? $value['brand__ar']: 'null' ;
            if($brand__ar =='null'):
                $brand__ar = $brand__en;
            endif;
            $series_arr['brand']              = array( "en" =>$brand__en, "ar" =>$brand__ar );
            
            $product_series_title__en =isset( $value['product_series_title__en'] ) ? $value['product_series_title__en'] : 'null';
            $product_series_title__ar =isset( $value['product_series_title__ar'] ) ? $value['product_series_title__ar'] : 'null';
            if($product_series_title__ar =='null'):
                $product_series_title__ar = $product_series_title__en;
            endif;
            $series_arr['product-series']     = array( "en" => $product_series_title__en, "ar" => $product_series_title__ar );
            
            
            $series_arr['variant-specs']      = isset( $value['variant_specs'] ) ? explode(',', $value['variant_specs']): null;
                   
            $series_arr_ =  json_encode($series_arr,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
            
            if($meezzaa_series_no !='' && isset( $value['product'] ) && $value['product'] !='' && isset( $value['brand__en'] ) && $value['brand__en'] !='' && isset( $value['product_series_title__en'] ) && $value['product_series_title__en'] !=''):
                $response = static::SeriesCurl($series_arr_,$excel,$meezzaa_series_no,$production);
            else:
                $response = ['queue_id'=>$excel->id,'sheet'=>'series','sheet_code'=>$meezzaa_series_no,'response'=>'some data is missing. validation error','response_code'=>null,'response_data'=>  null];
            endif; 
            if(is_array($response) && !empty($response)):  \App\PivotQueue::create($response); endif;   $i++; 
        endforeach;
//        if($i == count($series)): $excel->update(['is_completed'=>2]); $result =true; endif;
        return  true;
    }
        
    /**
     * cURL command lines or scripts to transfer data
     * @param json $series
     * @param object $excel
     * @return 
     */ 
    public static function SeriesCurl(string $series,object $excel,$meezzaa_series_no,$production)
    { 
        $return = [];
        if($series):
            $array =array   ('production' =>  $production, 'excel-api-access-token'=> token , 'series'=>  $series );
         
            $responses = Curl::to(static::$url)->withData($array)->post();
            $response = json_decode($responses); 
            $return = ['queue_id'=>$excel->id,'sheet'=>'series','sheet_code'=>$meezzaa_series_no,'response'=>$responses,'response_code'=> isset($response->response) ? $response->response : null,'response_data'=> isset($response->data) ? $response->data : null];
        endif;
        return $return;
    }
}