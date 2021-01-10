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


class EditbannerController extends Controller
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
    
	
	public function showform($id) {
      $slideshow = DB::select('select * from banners where id = ?',[$id]);
      return view('admin.edit-banner',['slideshow'=>$slideshow]);
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
            'name' => 'required|string|max:255'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  
	 
    protected function slideshowdata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		
       
		$settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;	
		  
		  
		$rules = array(
		
		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype
		
		
		);

		
		
		
		$messages = array(
            
            
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		

		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{  
		  

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		
		
		
		$currentphoto=$data['currentphoto'];
		
			
		$zipfile = Input::file('photo'); 
		 if(isset($zipfile))
		 { 
		 $filename = time() . '.' . $zipfile->getClientOriginalName();
		
		 $zipformat = base_path('images/media/'); 
		 $zipfile->move($zipformat,$filename); 
		 $savefname = $filename; 
		 }
		 else
		 {
		    $savefname = $currentphoto;
		 }
		
		
		
		
		
		
		
		
		
		
					
		
		
		
		
		
		if(!empty($data['slide_btn_link']))
		{
		$slide_btn_link=$data['slide_btn_link'];
		}
		else
		{
		 $slide_btn_link = "";
		}
		
		
		if(!empty($data['slide_status']))
		{
		  $slide_status = $data['slide_status'];
		}
		else
		{
		  $slide_status = 0;
		}
		
		
		
		
		
		
		
		
		DB::update('update banners set slide_btn_link="'.$slide_btn_link.'",slide_image="'.$savefname.'",slide_status="'.$slide_status.'" where id = ?', [$id]);
		
			return back()->with('success', 'Record has been updated');
        }
		
		
		
		
    }
}
