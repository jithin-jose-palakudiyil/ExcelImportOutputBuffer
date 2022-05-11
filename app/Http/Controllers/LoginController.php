<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use Validator; 
use Redirect;
class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = meezzaa_admin_prefix.'/meezzaa_admin_dashboard';
    
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectBack = meezzaa_admin_prefix; 
 
     
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function index()
    {
        if(Auth::guard(meezzaa_admin_guard)->user()):
           
            return Redirect::to( $this->redirectTo); 
        else:
            return view('admin.login'); 
        endif;
       
    }
    
     
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login(Request $request)
    {
        
        if ($request->isMethod('post')) 
        {
            $validator = Validator::make($request->all(), [  'email' => 'required',  'password' => 'required', ]);
            if($validator->fails()) {  return Redirect::back()->withErrors($validator);  }
            else
            {
                if (!$request->ajax()) 
                { 
                    // set the remember me cookie if the user check the box
                    $remember = ($request->exists('remember')) ? true : false;  
                    if (Auth::guard(meezzaa_admin_guard)->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) 
                    { $to =route('meezzaa_admin_dashboard');
                        return Redirect::to($to); 
                    }
                    else { return Redirect::back()->withInput()->withErrors(['message' => 'Invalid email or password. Try again!']);}
                } else { return response()->json(['message' => 'Page not found!'], 404);  }
            }
        }
        else{ return Redirect::to($this->redirectBack);  }
    }
    
      /**
     * logout Admin
     * @return redirect
     */
    public function logout()
    { 
        Auth::guard(meezzaa_admin_guard)->logout();
        \Session::flush();
        return redirect($this->redirectBack);
    }
      /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard(Request $request)
    {
        $FrontUser = null;
        if($request->has('mem_id')):
           $FrontUser = \App\FrontUser::find($request->mem_id);
        endif; 
        return view('admin.dashboard', compact('FrontUser')); 
    }
    

     
}
