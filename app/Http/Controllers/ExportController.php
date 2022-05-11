<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Rap2hpoutre\FastExcel\FastExcel; 
use Auth; 
use Validator; 
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
class ExportController extends Controller
{
    
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function index()
    {
        return view('member.export'); 
    }
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function save(Request $request)
    {
        // Excel file validation
        $request->validate(['file'=>'required|mimes:xlsx','row_numer'=>'required']);  
        $file = $request->file;
        $collection = (new FastExcel)->configureCsv(';', '#', '\n', 'gbk')->import($file);
        $chunks = $collection->chunk($request->row_numer);  
//          return back()->withSuccess('Export started!');
//        session_start();
        $cookie_name = "ExportStarted";
        $cookie_value = "1";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 
        return  Excel::download(new \App\Exports\ExcelExport($chunks), 'export_'.date("Ymdhisa").'.xlsx');
//        return (new \App\Exports\ExcelExport($chunks))->download('export_'.date("Ymdhisa").'.xlsx');
  
    }

     
}
