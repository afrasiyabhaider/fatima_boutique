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

class SlideshowController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $slideshow = DB::table('slideshow')
		                ->orderBy('id','desc')
					   ->get();

        return view('admin.slideshow', ['slideshow' => $slideshow]);
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
	
}