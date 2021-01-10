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


class EditblogController extends Controller
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
      $blog = DB::select('select * from post where post_id = ?',[$id]);
      return view('admin.edit-blog',['blog'=>$blog]);
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
            'post_title' => 'required|string|max:255'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	 
	 
	 public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	  
	 
    protected function blogdata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'post_title' => 'required'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $post_id=$data['post_id'];
		 $id=$data['post_id'];
        			
		$input['post_title'] = Input::get('post_title');
       $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imagetype = $settings[0]->image_type;
		  $mp3size = $settings[0]->mp3_size;
       
		
		$rules = array(
		
		
		'post_title'=>'required',
		'photo' => 'max:'.$imgsize.'|mimes:'.$imagetype,
		'audio_file' => 'max:'.$mp3size.'|mimes:mpga',
		
		
		);

		
		
		
		$messages = array(
            
            
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		

		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			/*return back()->withErrors($validator);*/
			return back()->with('error', 'Invalid file type OR File size is big');
		}
		else
		{  
		  

		
		$currentphoto=$data['currentphoto'];
		 $save_audio=$data['save_audio'];
		
		$image = DB::table('post')->where('post_id', $post_id)->first();
		$orginalfile=$image->post_image;
		
		$audiofile=$image->post_audio;
		
		
		
       $path = base_path('images/media/'.$currentphoto);
	   
	   $mp3path = base_path('images/media/'.$save_audio);
		
		
		if($image->post_media_type=="image"){DB::update('update post set post_audio="",post_video="" where post_id = ?', [$post_id]);}
		if($image->post_media_type=="mp3"){DB::update('update post set post_image="",post_video="" where post_id = ?', [$post_id]);}
		if($image->post_media_type=="video"){ DB::update('update post set post_image="",post_audio="" where post_id = ?', [$post_id]);}
		
		
		
		
		
		
		$image = Input::file('photo');
         if($image!="")
		 {
            
			 
	         File::delete($path);
	         File::delete($mp3path);
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            $testimonialphoto="/media/";
            $path = base_path('images'.$testimonialphoto.$filename);
			$destinationPath=base_path('images'.$testimonialphoto);
 
        
               Image::make($image->getRealPath())->resize(800, 533)->save($path);
				
				$namef=$filename;
				
		 }
		 else
		 {
			 $namef=$currentphoto;
		 }
		 
		 
		
		 $music_file = Input::file('audio_file'); 
		 if(isset($music_file))
		 {
		 File::delete($path);
	         File::delete($mp3path);
	     
		 $filename = time() . '.' . $music_file->getClientOriginalName();
		
		 $sermonmp3 = base_path('images/media/'); 
		 $music_file->move($sermonmp3,$filename); 
		 $mp3name = $filename; 
		 
		 
		 }
		 else
		 {
		    $mp3name = $save_audio;
		 }
		 
		 $post_title=$data['post_title'];
		
		$post_desc=$data['post_desc'];
		$post_type = $data['post_type'];
		$media_type = $data['media_type'];
		
		$video_url=$data['video_url'];
		
		
		$save_video=$data['save_video'];
		if(!empty($video_url))
		{
		   
		   
			 $videourl = $video_url;
			
		}
		else
		{
		   $videourl = $save_video;
		}
		$post_status = 1;
		
		 
		 if(!empty($data['tags']))
		{
		$post_tags=$data['tags'];
		}
		else
		{
		  $post_tags=$data['save_tags'];
		}
		 			
		
		$post_date = date("Y-m-d H:i:s");
		
		
		
		
		
		
		
		DB::update('update post set post_title="'.$post_title.'",post_slug="'.$this->clean($post_title).'",post_desc="'.$post_desc.'",post_tags="'.$post_tags.'",post_type="'.$post_type.'",post_media_type="'.$media_type.'",post_image="'.$namef.'",post_audio="'.$mp3name.'",post_video="'.$videourl.'",post_date="'.$post_date.'" where post_id = ?', [$post_id]);
		
			return back()->with('success', 'Post has been updated');
        }
		
		
		
		
    }
}
