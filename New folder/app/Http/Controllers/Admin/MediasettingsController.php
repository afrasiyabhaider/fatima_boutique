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


class MediasettingsController extends Controller
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
	  $currency=array("USD","CZK","DKK","HKD","HUF","ILS","JPY","MXN","NZD","NOK","PHP","PLN","SGD","SEK","CHF","THB","AUD","CAD","EUR","GBP","AFN","DZD",
							"AOA","XCD","ARS","AMD","AWG","SHP","AZN","BSD","BHD","BDT","INR");
		
		$withdraw=array("paypal","instamojo");
		
	  $data=array('msettings'=>$msettings, 'currency' => $currency, 'withdraw' => $withdraw);
      return view('admin.media-settings')->with($data);
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
	 
	  protected $fillable = ['name', 'email','password','phone'];
	 
    protected function editsettings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		
		
		
		 $rules = array(
               
		'site_logo' => 'max:1024|mimes:jpg,jpeg,png',
		'site_favicon' => 'max:1024|mimes:jpg,jpeg,png',
		'site_banner' => 'max:1024|mimes:jpg,jpeg,png'
		
		
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
		
		
		
		
		
		
		
		if($data['image_type']!="")
		{
			$imagetype=$data['image_type'];
		}
		else
		{
			$imagetype=$data['save_image_type'];
		}
		
		
		if($data['image_size']!="")
		{
			$imagesize=$data['image_size'];
		}
		else
		{
			$imagesize=$data['save_image'];
		}
		
		
		
		if($data['video_size']!="")
		{
			$videosize = $data['video_size'];
		}
		else
		{
			 $videosize = $data['save_video_size'];
		}
		
		
		
		if($data['mp3_size']!="")
		{
			$mp3size = $data['mp3_size'];
		}
		else
		{
			 $mp3size = $data['save_mp3'];
		}
		
		
		
		if($data['zip_size']!="")
		{
		   $zip_size = $data['zip_size'];
		}
		else
		{
		  $zip_size = "";
		}
		
		
		
		
		
		
		
		DB::update('update settings set video_size="'.$videosize.'",image_size="'.$imagesize.'",image_type="'.$imagetype.'",mp3_size="'.$mp3size.'",zip_size="'.$zip_size.'" where id = ?', [1]);
		
			return back()->with('success', 'Media Settings has been updated');
        
		
		}
		
		
    }
}
