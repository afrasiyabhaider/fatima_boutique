<?php

namespace Responsive\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use File;
use Image;
use URL;
use Mail;
use Carbon\Carbon;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	
	public function avigher_gallery()
    {
	
	
	$query = DB::table('gallery_images')
		       ->orderBy('imgid', 'desc')
			   ->get();
		$query_cnt = DB::table('gallery_images')
		      ->orderBy('imgid', 'desc')
			   ->count();
			   
			   
			 		   
			   
	
	
	 $data = array('query' => $query, 'query_cnt' => $query_cnt);
	 return view('gallery')->with($data);
	
	
	}
	
	
	 
	
	
}
