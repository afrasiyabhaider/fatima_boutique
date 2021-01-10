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

class PagesController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $pages = DB::table('pages')->get();

        return view('admin.pages', ['pages' => $pages]);
    }
	
	
	public function showform($id) {
      $pages = DB::select('select * from pages where page_id = ?',[$id]);
      return view('admin.edit-page',['pages'=>$pages]);
   }
   
   public function formview()

    {

        return view('admin.add-page');

    }
	
	
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	
	
	
	
	
	protected function addpagedata(Request $request)
    {
       
		
		
		$this->validate($request, [

        		'page_title' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['page_title'] = Input::get('page_title');
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
       
		
		$rules = array(
		'page_title' => 'required|unique:pages,page_title', 
		
		
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
            $userphoto="/media/";
            $path = base_path('images'.$userphoto.$filename);
			$destinationPath=base_path('images'.$userphoto);
 
        
                Image::make($image->getRealPath())->resize(1140, 450)->save($path);
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

			
		$page_title=$data['page_title'];
		if(!empty($data['page_desc']))
		{
		   $page_desc = $data['page_desc'];
		}
		else
		{
		   $page_desc = "";
		}
		
		
		if(!empty($data['show_photo']))
		{
		   $show_photo = $data['show_photo'];
		}
		else
		{
		  $show_photo = 0;
		}
		
		
		
		
		DB::insert('insert into pages (page_title, post_slug,  page_desc, photo, show_photo) values (?, ?, ?, ?, ?)', [$page_title,$this->clean($page_title),$page_desc,$namef,$show_photo]);
		
		
			return back()->with('success', 'Page has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	
   
   
   protected function pagedata(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'page_title' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['page_title'] = Input::get('page_title');
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
       
		
		$rules = array(
		'page_title' => 'required', 
		
		
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
		
		
		
		 
		    $currentphoto=$data['currentphoto'];
			
			 $image = Input::file('photo');
		 
		
		 
		 
		 if($image!="")
		{	
            $servicephoto="/media/";
			$delpath = base_path('images'.$servicephoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$servicephoto.$filename);
			$destinationPath=base_path('images'.$servicephoto);
      
                
				
				Image::make($image->getRealPath())->resize(1140, 450)->save($path);
				$namef=$filename;
		}
        else
		{
			$namef=$currentphoto;
		}		
		 
		 
		 
		
		
		
		  

			
		$page_title=$data['page_title'];
		if(!empty($data['page_desc']))
		{
		   $page_desc = $data['page_desc'];
		}
		else
		{
		   $page_desc = "";
		}
		
		$page_id=$data['page_id'];
		
		
		
		
		if(!empty($data['show_photo']))
		{
		   $show_photo = $data['show_photo'];
		}
		else
		{
		  $show_photo = 0;
		}
		
		
		
		DB::update('update pages set page_title="'.$page_title.'",post_slug="'.$this->clean($page_title).'",page_desc="'.$page_desc.'",photo="'.$namef.'",show_photo="'.$show_photo.'" where page_id = ?', [$page_id]);
		
		
		
		
			return back()->with('success', 'Page has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
   
   
   
   public function deleted($id) {
	
	    
		
		$image = DB::table('pages')->where('page_id', $id)->first();
		$orginalfile=$image->photo;
		$userphoto="/media/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);
	  
	  
	  
      DB::delete('delete from pages where page_id!=4 and page_id = ?',[$id]);
	   
      return back();
      
   }
   
   
   
   
   
   protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $pageid = $data['pageid'];
	   
	   foreach($pageid as $pid)
	   {
   
   
		  $image = DB::table('pages')->where('page_id', $pid)->get();
			$orginalfile=$image[0]->photo;
			$userphoto="/media/";
		   $path = base_path('images'.$userphoto.$orginalfile);
		  File::delete($path);
		  
		  
		  
		  DB::delete('delete from pages where page_id!=4 and page_id = ?',[$pid]);
		   
		  
      
        }
   return back();
   }
   
   
   
   
   
   
   
	
	public function destroy($id) {
		
		$image = DB::table('testimonials')->where('id', $id)->first();
		$orginalfile=$image->image;
		$testimonialphoto="/testimonialphoto/";
       $path = base_path('images'.$testimonialphoto.$orginalfile);
	  File::delete($path);
      DB::delete('delete from testimonials where id = ?',[$id]);
	   
      return back();
      
   }
	
}