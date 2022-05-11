<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use Validator; 
use Redirect;
class LogController extends Controller
{
    
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function index()
    {
        return view('member.log'); 
    }
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function get_log()
    {
        $collect= collect([]);
        $DataTables =\App\Queue::with('PivotQueue')->where('front_user_id',\Auth::guard(meezzaa_guard)->user()->id)->orderBy('id','desc')->get();
        if($DataTables->isNotEmpty()):
            foreach ($DataTables as $key => $value):
                $new_collect= collect($value);
                $new_collect->put('encrypt_id', \Crypt::encryptString($value->id));
                $PivotQueue =$value->PivotQueue;
                if($PivotQueue->isNotEmpty()):
                    
                    $new_collect->put('response_total', $PivotQueue->count());
                
                    $response_code_success =$PivotQueue->where('response_code','200');
                    $new_collect->put('response_success', $response_code_success->count());
                    
                    $response_code_error =$PivotQueue->where('response_code','!=','200');
                    $new_collect->put('response_error', $response_code_error->count());
                endif;
                $collect->push($new_collect);
            endforeach;
        endif;
        $html =  \View::make('member.log_template', compact('collect'))->render();
        return response()->json(['html' => $html], 200); 
        
    }

     
}
