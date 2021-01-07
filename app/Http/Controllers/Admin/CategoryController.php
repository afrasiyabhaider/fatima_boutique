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

class CategoryController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $category = DB::table('category')
		            ->where('delete_status','=','')
		             ->orderBy('id','desc')
					->get();

        return view('admin.category', ['category' => $category]);
    }
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $cat_id = $data['cat_id'];
	   
	   foreach($cat_id as $sid)
	   {
		   
		
		
		/*$image1 = DB::table('subcategory')->where('cat_id', $sid)->first();
		$image1_cnt = DB::table('subcategory')->where('cat_id', $sid)->count();
		if(!empty($image1_cnt))
		{
		$orginalfile1=$image1->subimage;
		$userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	  File::delete($path1);
	  DB::delete('delete from subcategory where cat_id = ?',[$sid]);
		  }
		  
		  $image = DB::table('category')->where('id', $sid)->first();
		$orginalfile=$image->image;
		$userphoto="/media/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);*/
	  
	   DB::update('update subcategory set delete_status="deleted",status="0" where cat_id = ?',[$sid]);
	  DB::update('update category set delete_status="deleted",status="0" where id = ?',[$sid]);
	  
	  
	  
		  
		   
	   }
	   
      return back();
		
	}
	
	
	
	public function destroy($id) {
	
	    /*$image1 = DB::table('subservices')->where('service', $id)->first();
		$image1_cnt = DB::table('subservices')->where('service', $id)->count();
		if(!empty($image1_cnt)){
		$orginalfile1=$image1->subimage;
		$userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	  File::delete($path1);
	  DB::delete('delete from subservices where service = ?',[$id]);
	  }
		
		$image = DB::table('services')->where('id', $id)->first();
		$orginalfile=$image->image;
		$userphoto="/media/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);*/
	  
	  
	  
      
	  DB::update('update subcategory set delete_status="deleted",status="0" where cat_id = ?',[$id]);
	  DB::update('update category set delete_status="deleted",status="0" where id = ?',[$id]);
	   
      return back();
      
   }
	
}