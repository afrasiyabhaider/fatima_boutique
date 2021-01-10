<?php

namespace Responsive\Http\Controllers\Admin;


use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use File;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AddslideshowController extends Controller
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
    public function formview()

    {

        return view('admin.add-slideshow');

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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	 /* protected $fillable = ['name', 'email','password','phone']; */
	 
    protected function addslideshowdata(Request $request)
    {
        
		
		
		 
         
		 
				
		
		
		
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
		 

		
	
	
	     $image = Input::file('photo');
		 if($image!="")
		 {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $testimonialphoto="/media/";
            $path = base_path('images'.$testimonialphoto.$filename);
			$destinationPath=base_path('images'.$testimonialphoto);
 
        
               Image::make($image->getRealPath())->resize(1600, 300)->save($path);
				 /*Input::file('photo')->move($destinationPath, $filename);*/
               /* $user->image = $filename;
                $user->save();*/
				$namef=$filename;
		 }
		 else
		 {
			 $namef="";
		 }
	
	
	
	
	
	
	
		  $data = $request->all();

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		
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
		
		
		
		
		DB::insert('insert into slideshow (slide_title,slide_sub_title,slide_btn_text,slide_btn_link,slide_image) values (?, ? ,?, ?, ?)', [$slide_title,$slide_sub_title,$slide_btn_text,$slide_btn_link,$namef]);
		
		
			return back()->with('success', 'Record has been added');
        }
		
		
		
		
    }
}
