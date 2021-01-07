<?php

namespace Responsive\Http\Controllers\Admin;


use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class PermissionController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
	
	public function showform() {
      $msettings = DB::select('select * from settings where id = ?',[1]);
	  
		
	  $data=array('msettings'=>$msettings);
      return view('admin.permissions')->with($data);
   }
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  
	 
    protected function avigher_technologies_editsettings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		
		
		
		
		if(!empty($data['with_submit_product']))
		{
			$with_submit_product = $data['with_submit_product'];
		}
		else
		{
			 $with_submit_product = 0;
		}
		
		
		
		
		
		
		
		
		DB::update('update settings set with_submit_product="'.$with_submit_product.'" where id = ?', [1]);
		
			return back()->with('success', 'Permission has been updated');
        
		
		
		
		
    }
}
