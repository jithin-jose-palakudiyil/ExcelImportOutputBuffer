<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Importer;
//use App\Parsers\ExampleParser;
use \Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
use Ixudra\Curl\Facades\Curl;
use \Exception; use \File;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
     
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function index()
    {
       return view('member.form'); 
    }
    
     /**
     * Display a listing of the resource.
     * @return Response
     */
//    public function allQueue()
//    { 
//        $collect= collect([]);
//        $DataTables =\App\Queue::with('PivotQueue')->where('is_completed',1)->where('front_user_id',\Auth::guard(meezzaa_guard)->user()->id)->orderBy('id','desc')->get();
////        dd($DataTables);
//        if($DataTables->isNotEmpty()):
//            foreach ($DataTables as $key => $value):
//                $new_collect= collect($value);
//                $new_collect->put('encrypt_id', \Crypt::encryptString($value->id));
//                $PivotQueue =$value->PivotQueue;
//                if($PivotQueue->isNotEmpty()):
//                    
//                    $new_collect->put('response_total', $PivotQueue->count());
//                
//                    $response_code_success =$PivotQueue->where('response_code','200');
//                    $new_collect->put('response_success', $response_code_success->count());
//                    
//                    $response_code_error =$PivotQueue->where('response_code','!=','200');
//                    $new_collect->put('response_error', $response_code_error->count());
//                     
//                endif;
//               
//                $collect->push($new_collect);
//            endforeach;
////             dd($collect);
//        endif;
//       return \DataTables::of($collect)->make(true); 
//    }
//    
    
    /**
     * Store a newly uploaded resource in storage.
     * @param Request $request
     * @return Response 
     */
    public function import(Request $request)
    {
//        dd($request->all());
        // Initialization
        $path = null; $redirect = route('import_index');  
        
        // Excel file validation
        $request->validate(['file'=>'required|mimes:xlsx,csv,xls','images'=>'required','production'=>'required','WriteTitle'=>'required']);  
        // Upload the file to server
        $excel = $this->upload_excel($request->file); $RequestImages = $request->images;  $production =$request->production; $WriteTitle =$request->WriteTitle;
        if(isset($excel['file_name'])):  $path = $excel['file_name']; endif; 
        session_start();
        if($path): $_SESSION['flash-success-message'] = 'process started sucessfully';
        else: $_SESSION['flash-error-message'] = 'process not started sucessfully';  endif;
        
//        define("production", $request->production);
//        Redirect to another file that shows that mail queued
       
        header("Location: $redirect");

        //Erase the output buffer
        ob_end_clean();

        //Tell the browser that the connection's closed
        header("Connection: close");

        //Ignore the user's abort (which we caused with the redirect).
        ignore_user_abort(true);
        //Extend time limit to 60 minutes
        set_time_limit(3600);
        //Extend memory limit to 1024MB
        ini_set("memory_limit","1024MBM");
        //Start output buffering again
        ob_start();

        //Tell the browser we're serious... there's really
        //nothing else to receive from this page.
        header("Content-Length: 0");

        //Send the output buffer and turn output buffering off.
        ob_end_flush();
        flush();
        //Close the session.
        session_write_close();
//  
    
        //Do some of your work, like the queue can be ran here, 
        if($path): $this->QueueCreate($path,$RequestImages,$production,$WriteTitle);  endif;
      
         
    }
    
    /**
     * Store the specified resource.
     * @param string $path
     * @return null
     */
    public function QueueCreate($path,$RequestImages,$production,$WriteTitle) 
    {
       $excel  = \App\Queue::create(['excel_path'=>$path,'is_completed'=>0,'front_user_id'=>\Auth::guard(meezzaa_guard)->user()->id]);
       if($excel): $this->sheetImport($excel,$RequestImages,$production,$WriteTitle); endif;
    }
    
      /**
     * Store the specified resource.
     * @param string $path
     * @return null
     */
    public function sheetImport($excel,$RequestImages,$production,$WriteTitle) 
    {
        
        // get uploded file
        $file = $excel->excel_path; 
         
//        // reader the file
        $reader = ReaderFactory::create(Type::XLSX);
        $reader->open($file);
        foreach($reader->getSheetIterator() as $key => $sheet) :
            if($key == 1): $excel->update(['is_completed'=>1]);  endif; 
            $sheet_name = strtolower(trim($sheet->getName()));
             
//            echo $sheet_name.'<br/>';
            if($sheet_name =='series'): 
                \App\Repositories\SeriesRepository::import($file,$key,$excel,$production);
            elseif($sheet_name =='product'): 
                \App\Repositories\ProductsRepository::import($file,$key,$excel,$RequestImages,$production,$WriteTitle);
            elseif($sheet_name =='listing'): 
                \App\Repositories\ListingRepository::import($file,$key,$excel,$production);
            endif; 
//            echo $key.'<br/>';
            
        endforeach;
        $excel->update(['is_completed'=>2]); 
    }
    
    
     /**
     * Show the specified resource.
     * @param file $file
     * @return file name
     */
    public function upload_excel($file)
    {
        $response = [];
        $path = public_path().'/uploads/excel/'.\Auth::guard(meezzaa_guard)->user()->id.'/';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        $allowedfileExtension = ['xlsx',',csv','xls'];  
        $extension = $file->getClientOriginalExtension(); 
        if(in_array($extension,$allowedfileExtension)): 
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);  
              $fileNameToStore = $filename.'_'.date("Ymdhisa").'_'.rand().'.'.$extension; 
            if($file->move($path,$fileNameToStore)): $response['file_name'] = 'public/uploads/excel/'.\Auth::guard(meezzaa_guard)->user()->id.'/'.$fileNameToStore; endif;
        endif;  
        return $response;
    }
    
     /**
     * Show the specified resource.
     * @param file $file
     * @return file name
     */
    public function download_export($queue_id)
    {
        $decrypted = \Crypt::decryptString($queue_id);
        $queue =\App\Queue::with('PivotQueue')->where('id',$decrypted)->where('front_user_id',\Auth::guard(meezzaa_guard)->user()->id)->first();
        if($queue):
             
//            return Excel::download(new \App\Exports\LogExport($queue), 'download_log_'.date("Ymdhisa").'.csv');
            return (new \App\Exports\LogExport($queue))->download('download_log_'.date("Ymdhisa").'.xlsx');
            
        else: abort(404); endif;
  
    }
      
}
