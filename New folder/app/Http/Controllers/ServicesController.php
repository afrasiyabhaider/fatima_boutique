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

class ServicesController extends Controller
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
    
	
	public function avigher_services()
    {
	
	$query_cnt = "";
	$data = array('query_cnt' => $query_cnt);
	 return view('services')->with($data);
	
	
	}
	
	
	public function avigher_view_services($id,$slug)
    {
	
	
	$title = DB::table('services')
		       ->where('id','=',$id)
			   ->get();
			   
	$title_cnt = DB::table('services')
		       ->where('id','=',$id)
			   ->count();		   
			   
	
	$query = DB::table('subservices')
		       ->where('service','=',$id)
			   ->get();
		$query_cnt = DB::table('subservices')
		       ->where('service','=',$id)
			   ->count();
			   
		if(!empty($title_cnt))
		{	   
		$service_title = $title[0]->name;	 		   
		}
		else
		{
		$service_title = "";
		}	   
	
	
	 $data = array('query' => $query, 'query_cnt' => $query_cnt, 'service_title' => $service_title);
	 return view('services')->with($data);
	
	
	}
	
	
	
	 
	
	
}
