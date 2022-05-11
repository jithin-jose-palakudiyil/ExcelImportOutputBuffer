<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use Validator; 
use Redirect;
class ChangePasswordController extends Controller
{
    
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function index()
    {
        return view('member.ChangePassword'); 
     
    }
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate(['password'=>'required|min:5']);
        $array['password'] = bcrypt($request->password); 
        $update=\App\FrontUser::where('id',\Auth::guard(meezzaa_guard)->user()->id)->update($array);
        session_start();
        if($update): $_SESSION['flash-success-message'] = 'updated sucessfully';
        else: $_SESSION['flash-error-message'] = 'updated not sucessfully completed';  endif;
        return Redirect::to(route('import_index'));
        
    }
     
    

     
}
