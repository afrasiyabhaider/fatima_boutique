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

class AddblogController extends Controller
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

        return view('admin.add-blog');

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
	 
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	 
	 
	 
	 
    protected function addblogdata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'post_title' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['post_title'] = Input::get('post_title');
       $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		 $imagetype = $settings[0]->image_type;
		  $mp3size = $settings[0]->mp3_size;
		
		$rules = array(
		
		'post_title' => 'unique:post,post_title',
		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imagetype,
		'audio_file' => 'max:'.$mp3size.'|mimes:mpga',
		
		
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
 
        
               Image::make($image->getRealPath())->resize(800, 533)->save($path);
				 /*Input::file('photo')->move($destinationPath, $filename);*/
               /* $user->image = $filename;
                $user->save();*/
				$namef=$filename;
		 }
		 else
		 {
			 $namef="";
		 }
	
	      $music_file = Input::file('audio_file'); 
		 if(isset($music_file))
		 { 
		 $filename = time() . '.' . $music_file->getClientOriginalName();
		
		 $sermonmp3 = base_path('images/media/'); 
		 $music_file->move($sermonmp3,$filename); 
		 $mp3name = $filename; 
		 }
		 else
		 {
		    $mp3name = "";
		 }
	
	
	
	
	
		  $data = $request->all();

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		$post_title=$data['post_title'];
		
		$post_desc=$data['post_desc'];
		$post_type = $data['post_type'];
		$media_type = $data['media_type'];
		
		$video_url=$data['video_url'];
		if(!empty($video_url))
		{
		   $videourl = $video_url;
		}
		else
		{
		   $videourl = "";
		}
		$post_status = 1;
		
		$post_date = date("Y-m-d H:i:s");
		
		if(!empty($data['tags']))
		{
		$post_tags=$data['tags'];
		}
		else
		{
		  $post_tags="";
		}
		
		
		
		
		DB::insert('insert into post (post_title,post_slug,post_desc,post_tags,post_type,post_media_type,post_image,post_audio,post_video,post_date,post_status) values (?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?)', [$post_title,$this->clean($post_title),$post_desc,$post_tags,$post_type,$media_type,$namef,$mp3name,$videourl,$post_date,$post_status]);
		
		
			return back()->with('success', 'Post has been created');
        }
		
		
		
		
    }
}
