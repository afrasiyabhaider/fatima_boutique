<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class HomeBannersController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $slideshow = DB::table('home_banners')
		                ->orderBy('id','desc')
					   ->get();

        return view('admin.home-banners', ['slideshow' => $slideshow]);
    }
	
	
	public function box_index()
	{
	
	$slideshow = DB::table('home_box_content')
		                ->orderBy('id','desc')
					   ->get();

        return view('admin.home-box-content', ['slideshow' => $slideshow]);
	
	}
	
	
	
	
	
	
	public function showform($id) {
      $slideshow = DB::select('select * from home_banners where id = ?',[$id]);
      return view('admin.edit-home-banner',['slideshow'=>$slideshow]);
   }
   
   
   public function box_form($id)
   {
      $slideshow = DB::select('select * from home_box_content where id = ?',[$id]);
      return view('admin.edit-home-box-content',['slideshow'=>$slideshow]);
   }
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $slide_id = $data['slide_id'];
	   
	   foreach($slide_id as $postt)
	   {
	      
		$image = DB::table('slideshow')->where('id', $postt)->first();
		$orginalfile=$image->slide_image;
		$testimonialphoto="/media/";
       $path = base_path('images'.$testimonialphoto.$orginalfile);
	  File::delete($path);
      DB::delete('delete from slideshow where id = ?',[$postt]);
	   
	   }
	
	return back();
	
	
	}
	
	
	public function destroy($id) {
		
		$image = DB::table('slideshow')->where('id', $id)->first();
		$orginalfile=$image->slide_image;
		$testimonialphoto="/media/";
       $path = base_path('images'.$testimonialphoto.$orginalfile);
	  File::delete($path);
      DB::delete('delete from slideshow where id = ?',[$id]);
	   
      return back();
      
   }
   
   
   
   
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
      
                 Image::make($image->getRealPath())->resize(555, 180)->save($path);
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
		
		
		if(!empty($data['slider_sub_title']))
		{
		  $slider_sub_title = $data['slider_sub_title'];
		}
		else
		{
		  $slider_sub_title = "";
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
		
		
		
		if(!empty($data['slide_status']))
		{
		  $slide_status = $data['slide_status'];
		}
		else
		{
		  $slide_status = 0;
		}
		
		
		
		DB::update('update home_banners set slide_title="'.$slide_title.'",slider_sub_title="'.$slider_sub_title.'",slide_btn_text="'.$slide_btn_text.'",slide_btn_link="'.$slide_btn_link.'",slide_image="'.$savefname.'",slide_status="'.$slide_status.'" where id = ?', [$id]);
		
			return back()->with('success', 'Record has been updated');
        }
		
		
		
		
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	protected function edit_slideshowdata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		
       
		
		  
		  
		$rules = array(
		
		
		
		
		
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
		
		
		
		
		
		if(!empty($data['home_box_icon']))
		{
		$home_box_icon=$data['home_box_icon'];
		}
		else
		{
		 $home_box_icon = "";
		}
		
		
		if(!empty($data['heading']))
		{
		  $heading = $data['heading'];
		}
		else
		{
		  $heading = "";
		}
		
		
		
		
		if(!empty($data['subheading']))
		{
		$subheading=$data['subheading'];
		}
		else
		{
		 $subheading = "";
		}
		
		
		
		
		
		
		if(!empty($data['status']))
		{
		  $status = $data['status'];
		}
		else
		{
		  $status = 0;
		}
		
		
		
		DB::update('update home_box_content set heading="'.$heading.'",subheading="'.$subheading.'",icon="'.$home_box_icon.'",status="'.$status.'" where id = ?', [$id]);
		
			return back()->with('success', 'Record has been updated');
        }
		
		
		
		
    }
   
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
   
   
   
   
   
   
   
   
   
   
   
   
	
}