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


class EditslideshowController extends Controller
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
      $slideshow = DB::select('select * from slideshow where id = ?',[$id]);
      return view('admin.edit-slideshow',['slideshow'=>$slideshow]);
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
        			
		$input['name'] = Input::get('name');
       
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
		
		
		$image = Input::file('photo');
        if($image!="")
		{	
            $testimonialphoto="/media/";
			$delpath = base_path('images'.$testimonialphoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$testimonialphoto.$filename);
			$destinationPath=base_path('images'.$testimonialphoto);
      
                 Image::make($image->getRealPath())->resize(1600, 300)->save($path);
				/*Input::file('photo')->move($destinationPath, $filename);*/
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentphoto;
		}			
		
		
		if(!empty($data['slide_title']))
		{
		$slide_title=$data['slide_title'];
		}
		else
		{
		 $slide_title = "";
		}
		
		if(!empty($data['slide_sub_title']))
		{
		$slide_sub_title=$data['slide_sub_title'];
		}
		else
		{
		 $slide_sub_title = "";
		}
		
		
		if(!empty($data['slide_btn_text']))
		{
		$slide_btn_text=$data['slide_btn_text'];
		}
		else
		{
		 $slide_btn_text = "";
		}
		
		
		if(!empty($data['slide_btn_link']))
		{
		$slide_btn_link=$data['slide_btn_link'];
		}
		else
		{
		 $slide_btn_link = "";
		}
		
		
		
		DB::update('update slideshow set slide_title="'.$slide_title.'",slide_sub_title="'.$slide_sub_title.'",	slide_btn_text="'.$slide_btn_text.'",slide_btn_link="'.$slide_btn_link.'",slide_image="'.$savefname.'" where id = ?', [$id]);
		
			return back()->with('success', 'Record has been updated');
        }
		
		
		
		
    }
}
