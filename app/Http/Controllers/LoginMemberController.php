<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use Validator; 
use Redirect;
class LoginMemberController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = meezzaa_prefix.'/dashboard';
    
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectBack = meezzaa_prefix; 
 
     
    
    /**
     * Display   Import form of the resource.
     * @return Response
     */
    public function index()
    {
        if(Auth::guard(meezzaa_guard)->user()):
            return Redirect::to(route('import_index')); 
        else:
              return view('member.login'); 
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
                    if (Auth::guard(meezzaa_guard)->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) 
                    { 
                        $to =route('import_index');
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
        Auth::guard(meezzaa_guard)->logout();
        \Session::flush();
        return redirect($this->redirectBack);
    }
   
    

     
}
