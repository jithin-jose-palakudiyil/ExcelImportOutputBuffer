<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(['password'=>   "required|min:5",'name'=>   "required",'email'=>   "required|max:255|unique:front_users,email",]);
        $array = [];
        $array['name'] = $request->name;
        $array['email'] = $request->email;
        $array['password'] = bcrypt($request->password); 
        $create =\App\FrontUser::create($array);
        if($create):
            $request->session()->flash('flash-success-message','User created successfully'); 
        else: 
            $request->session()->flash('flash-error-message','User not created successfully'); 
        endif; 
        return \Redirect::back();
    }

    

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, \App\FrontUser $id)
    {
         ;
        $request->validate(['password'=>   "required|min:5",'name'=>   "required",'email'=>   "required|max:255|unique:front_users,email,$id->id,id",]);
        $array = [];
        $array['name'] = $request->name;
        $array['email'] = $request->email;
        $array['password'] = bcrypt($request->password); 
        $create = $id->update($array);
        if($create):
            $request->session()->flash('flash-success-message','User updated successfully'); 
        else: 
            $request->session()->flash('flash-error-message','User not updated successfully'); 
        endif; 
        return \Redirect::to(route('meezzaa_admin_dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,\App\FrontUser $id)
    {
        $delete =false;
        if($id):
            $delete = $id->delete();
        endif;
        if($delete):
            $request->session()->flash('flash-success-message','User deleted successfully'); 
        else: 
            $request->session()->flash('flash-error-message','User not deleted successfully'); 
        endif; 
        return \Redirect::back();
    }
}
