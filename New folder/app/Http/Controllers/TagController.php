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

class TagController extends Controller
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
    
	
	
	
	public function avigher_tag($type,$id)
    {
	    
		$tag_txt = str_replace("-"," ",$id);
	
	   if($type=="sermons")
	   {
	
	      
		  
		  
		  $query = DB::table('sermons')
					
					 ->whereRaw("find_in_set('".$tag_txt."',post_tags)")
					 ->get();
		  			 			 
				  
		}		  
		if($type=="blog")
	   {		  
				
			 $query = DB::table('post')
					
					 ->whereRaw("find_in_set('".$tag_txt."',post_tags)")
					 ->where("post_status", "=", "1")
					 ->where("post_type","=","blog")
					 ->get();	  
	
	   }
	   
	   
	   
	   if($type=="product")
	   {		  
				
			 $query = DB::table('product')
					
					 ->whereRaw("find_in_set('".$tag_txt."',prod_tags)")
					 
					 ->where("prod_status", "=", "1")
					 ->get();	  
	
	   }
	   
	   
	   
	   
	   
	   
	   
	   if($type=="events")
	   {
	   
	     $query = DB::table('post')
					
					 ->whereRaw("find_in_set('".$tag_txt."',post_tags)")
					 ->where("post_status", "=", "1")
					 ->where("post_type","=","event")
					 ->get();
	   
	   }
     
		
		
		
				  		  
				  
	$data = array('query' => $query, 'type' => $type, 'tag_txt' => $tag_txt);
	 return view('tag')->with($data);
	
	
	}
	
	 
	
	
}
