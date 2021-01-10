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

class SubcategoryController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $subcategory = DB::table('subcategory')
		->leftJoin('category', 'category.id', '=', 'subcategory.cat_id')
		->where('subcategory.delete_status','=','')
		 ->orderBy('subcategory.subid','desc')
		->get();
		
		
		

        return view('admin.subcategory', compact('subcategory','category'));
    }
	
	public function getservice()
	{
		 /* $getservice = DB::table('services')->where('id', '?')->first();
		 return view('admin.subservices',$getservice);*/
	}
	
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $subid = $data['subid'];
	   
	   foreach($subid as $sid)
	   {
		   
		  
		  
		  /*$image = DB::table('subservices')->where('subid', $sid)->first();
		$orginalfile=$image->subimage;
		$userphoto="/media/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);
		 
		  DB::delete('delete from subservices where subid = ?',[$sid]);*/
		  
		  
		   DB::update('update subcategory set delete_status="deleted",status="0" where subid = ?',[$sid]);
		  
		   
	   }
	   
      return back();
		
	}
	
	
	public function destroy($id) {
		
		/*$image = DB::table('subservices')->where('subid', $id)->first();
		$orginalfile=$image->subimage;
		$userphoto="/subservicephoto/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);
      DB::delete('delete from subservices where subid = ?',[$id]);*/
	  
	   DB::update('update subcategory set delete_status="deleted",status="0" where subid = ?',[$id]);
	   
      return back();
      
   }
	
}