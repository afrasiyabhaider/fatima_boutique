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

class CategoryController extends Controller
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
	 
	 
	 public function avigher_product_details($prod_id,$prod_slug)
	 {
	 
	     
		$viewcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_id','=',$prod_id)
					   ->count();
		
			$viewproduct = DB::table('product')
					  ->where('delete_status','=','')
					  ->where('prod_status','=',1)
					  ->where('prod_id','=',$prod_id)
					   ->get();	 
					   
					   
					   
			$latestcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->take(3)
					   ->orderBy('prod_id','desc')
					   ->count();		   
			
			$latest_product = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->take(3)
					   ->orderBy('prod_id','desc')
					   ->get();	
					   
					   
					   
			$relatedcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_id','!=',$prod_id)
					   ->take(10)
					   ->orderBy('prod_id','desc')
					   ->count();
		
			$relatedproduct = DB::table('product')
					  ->where('delete_status','=','')
					  ->where('prod_status','=',1)
					  ->where('prod_id','!=',$prod_id)
					  ->take(10)
					  ->orderBy('prod_id','desc')
					   ->get();	
					   
					   
			$viewcount_rating = DB::table('product_rating')
			              ->where('prod_id','=',$prod_id)
					      ->groupBy('user_id') 
					      ->orderBy('rate_id','desc')
						  ->count();
		$view_rating = DB::table('product_rating')
			              ->where('prod_id','=',$prod_id)
					      ->groupBy('user_id') 
					      ->orderBy('rate_id','desc')
						  ->get();		   
					   
					    		   
					   	   
					   
		 
	    return view('product',['viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'latestcount' => $latestcount, 'latest_product' => $latest_product, 'relatedcount' => $relatedcount, 'relatedproduct' => $relatedproduct, 'viewcount_rating' => $viewcount_rating, 'view_rating' => $view_rating]);
	 
	 
	 }
	
	 
	 
	public function avigher_search_data(Request $request)
	{
	
	$category_cnt = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
	
	
	     $category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
	
	$typers_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->count();
		
		 $typers = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->get();		  
				  
				  
				  		
					
		$pager = "";
		$type = "";
		$id = "";		
	
	$data = $request->all();
	
	
	
	if(!empty($data['category']))
	{
	
	$pieces = explode("_", $data['category']);
	$id = $pieces[0];
	$type = $pieces[1];
	$category_field = $data['category'];
	
	$viewcount = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
				       ->where('prod_category','=',$id)
				       ->where('prod_cat_type','=',$type)
			           ->orderBy('prod_id','desc')
		               ->count();
	
	$viewproduct = DB::table('product')
		          ->where('delete_status','=','')
				  ->where('prod_status','=',1)
				  ->where('prod_category','=',$id)
				   ->where('prod_cat_type','=',$type)
				   ->orderBy('prod_id','desc')
		          ->get();
	
	
	}
	else
	{
	   $category_field = "";
	}
	
	
	
	
	if(!empty($data['search_text']))
	{
	$search_txt = $data['search_text'];
	
	 $viewcount = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
	                   ->where("prod_name", "LIKE","%$search_txt%")
					   ->orderBy('prod_id','desc')
		               ->count();
	$viewproduct = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
	                   ->where("prod_name", "LIKE","%$search_txt%")
					   ->orderBy('prod_id','desc')
		               ->get();
	
	}
	else
	{
	   $search_txt = "";
	}
	
	
	
	if(!empty($data['category']) && !empty($data['search_text']))
	{
	 
	 $category_field = $data['category'];
	 $search_txt = $data['search_text'];
	 $pieces = explode("_", $data['category']);
	 $id = $pieces[0];
	 $type = $pieces[1];
	
	 $viewcount = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
	                   ->where("prod_name", "LIKE","%$search_txt%")
					   ->where('prod_category','=',$id)
				       ->where('prod_cat_type','=',$type)
					   ->orderBy('prod_id','desc')
		               ->count();
	 $viewproduct = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
	                   ->where("prod_name", "LIKE","%$search_txt%")
					   ->where('prod_category','=',$id)
				       ->where('prod_cat_type','=',$type)
					   ->orderBy('prod_id','desc')
		               ->get();
	
	
	
	}
	else
	{
	   $category_field = "";
	   $search_txt = "";
	}	
	
	
	
	
	
	
	
	if(!empty($data['attribute']))
		   {
		   
		   $array = $data['attribute'];
		   
		   $val = "";
		   foreach ($array as $key => $value)
		   {
			  $val .= $value.',';
		   }
		   $name = rtrim($val,',');
		   
		   
		   $viewcount = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
				       ->whereRaw('FIND_IN_SET(prod_attribute,"'.$name.'")')
			           ->orderBy('prod_id','desc')
		               ->count();
		   
		   $viewproduct = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
				       ->whereRaw('FIND_IN_SET(prod_attribute,"'.$name.'")')
			           ->orderBy('prod_id','desc')
		               ->get();
		   
		   }
		   else
		   {
			 $name = "";
		   }
	
	
	
		if(!empty($data['price']))
		{
		
		$prices = $data['price'];
	$price = explode("_", $prices);
	$price1 = $price[0];
	$price2 = $price[1];
		
			$viewcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_price','>',$price1)
					   ->where('prod_price','<',$price2)
					   ->count();
		
			$viewproduct = DB::table('product')
					  ->where('delete_status','=','')
					  ->where('prod_status','=',1)
					  ->where('prod_price','>',$price1)
					   ->where('prod_price','<',$price2)
					   ->get();	
		
		   
		}
		
		
		
		
		if(!empty($data['price']) && !empty($data['attribute']))
		{
		
			   
		   $array = $data['attribute'];
		   
		   $val = "";
		   foreach ($array as $key => $value)
		   {
			  $val .= $value.',';
		   }
		   $name = rtrim($val,',');
		   
		   
		   $prices = $data['price'];
			$price = explode("_", $prices);
			$price1 = $price[0];
			$price2 = $price[1];
		   
		   
		   $viewcount = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					    ->where('prod_price','>',$price1)
					   ->where('prod_price','<',$price2)
				       ->whereRaw('FIND_IN_SET(prod_attribute,"'.$name.'")')
			           ->orderBy('prod_id','desc')
		               ->count();
		   
		   $viewproduct = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					    ->where('prod_price','>',$price1)
					   ->where('prod_price','<',$price2)
				       ->whereRaw('FIND_IN_SET(prod_attribute,"'.$name.'")')
			           ->orderBy('prod_id','desc')
		               ->get();
		   
				
		}
		else if(empty($data['price']) && empty($data['attribute']) && empty($data['category']) && empty($data['search_text']))
		{
		
		$viewcount = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->orderBy('prod_id','desc')
		               ->count();
		   
		   $viewproduct = DB::table('product')
	               	   ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->orderBy('prod_id','desc')
		               ->get();
		
		
		}
		
		
	
	
	return view('shop',['category' => $category, 'category_cnt' => $category_cnt, 'id' => $id, 'viewproduct' => $viewproduct, 'viewcount' => $viewcount, 'pager' => $pager, 'type' => $type, 'typers' => $typers, 'typers_count' => $typers_count, 'name' => $name, 'category_field' => $category_field, 'search_txt' => $search_txt]);
	
	
	} 
	 
	 
	 
    
	public function avigher_category($type,$id,$slug)
	{
	
	     $category_cnt = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
	
	
	     $category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
					
					
		$viewcount = DB::table('product')
		          ->where('delete_status','=','')
				   ->where('prod_status','=',1)
				   ->where('prod_category','=',$id)
				   ->where('prod_cat_type','=',$type)
		          ->count();
	
	    $viewproduct = DB::table('product')
		          ->where('delete_status','=','')
				  ->where('prod_status','=',1)
				  ->where('prod_category','=',$id)
				   ->where('prod_cat_type','=',$type)
				   ->orderBy('prod_id','desc')
		          ->get();	
				  
				  
		$typers_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->count();
		
		 $typers = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->get();		  
				  
				  
				  		
					
		$pager = "";
		$type = "";	
		
		
		
		
		
		
		
		
		
		
		
		
				
		return view('shop',['category' => $category, 'category_cnt' => $category_cnt, 'id' => $id, 'viewproduct' => $viewproduct, 'viewcount' => $viewcount, 'pager' => $pager, 'type' => $type, 'typers' => $typers, 'typers_count' => $typers_count]);
	
	}
	
	
	public function avigher_all_category()
	{
	
	   $category_cnt = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
	
	
	     $category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
					
		$id = "";	
		
		$viewcount = DB::table('product')
		          ->where('delete_status','=','')
				   ->where('prod_status','=',1)
		          ->count();
	
	    $viewproduct = DB::table('product')
		          ->where('delete_status','=','')
				  ->where('prod_status','=',1)
				  ->orderBy('prod_id','desc')
		          ->get();
				  
				  
		$typers_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->count();
		
		 $typers = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->get();			  
				  
		
			$pager = "";
			$type = "";	
					
		return view('shop',['category' => $category, 'category_cnt' => $category_cnt, 'id' => $id, 'viewproduct' => $viewproduct, 'viewcount' => $viewcount, 'pager' => $pager, 'type' => $type, 'typers' => $typers, 'typers_count' => $typers_count]);
	
	
	}
	
	
	
	
	public function avigher_sort_category($sort,$type)
	{
	
	
	$category_cnt = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
	
	
	     $category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
					
		$id = "";
		
		if($type=="name")	
		{
		$viewcount = DB::table('product')
		          ->where('delete_status','=','')
				   ->where('prod_status','=',1)
				   ->orderBy('prod_name','asc')
		          ->count();
	
	    $viewproduct = DB::table('product')
		          ->where('delete_status','=','')
				  ->where('prod_status','=',1)
				  ->orderBy('prod_name','asc')
		          ->get();
		}
		else if($type=="price")	
		{
		$viewcount = DB::table('product')
		          ->where('delete_status','=','')
				   ->where('prod_status','=',1)
				   ->orderBy('prod_price','asc')
		          ->count();
	
	    $viewproduct = DB::table('product')
		          ->where('delete_status','=','')
				  ->where('prod_status','=',1)
				  ->orderBy('prod_price','asc')
		          ->get();
		}
		
		
		$typers_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->count();
		
		 $typers = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->get();
		
		
		
		$pager = "";		
					
		return view('shop',['category' => $category, 'category_cnt' => $category_cnt, 'id' => $id, 'viewproduct' => $viewproduct, 'viewcount' => $viewcount, 'pager' => $pager, 'type' => $type, 'typers' => $typers, 'typers_count' => $typers_count]);
	
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function avigher_pager_category($pager)
	{
	
	   $category_cnt = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
	
	
	     $category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
					
		$id = "";	
		
		$viewcount = DB::table('product')
		          ->where('delete_status','=','')
				   ->where('prod_status','=',1)
				   ->offset(0)
                ->limit($pager)
		          ->count();
	
	    $viewproduct = DB::table('product')
		          ->where('delete_status','=','')
				  ->where('prod_status','=',1)
				  ->offset(0)
                ->limit($pager)
		          ->get();
				  
				  
		$typers_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->count();
		
		 $typers = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('search','=',1)
					->orderBy('attr_name', 'asc')->get();		  
				  
		
			$type = "";	
					
		return view('shop',['category' => $category, 'category_cnt' => $category_cnt, 'id' => $id, 'viewproduct' => $viewproduct, 'viewcount' => $viewcount, 'pager' => $pager, 'type' => $type, 'typers' => $typers, 'typers_count' => $typers_count]);
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function avigher_edit_product($token)
	{
	
	
	
	   $userid = Auth::user()->id;
	$category = DB::table('category')
		            ->where('delete_status','=','')
					->orderBy('cat_name', 'asc')->get();
			
	$product_type = array("normal","external");	
		
		
		$typer_admin_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->count();
		
		 $typer_admin = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->get();
					
					
		
	$viewcount = DB::table('product')
		          ->where('prod_token', '=' , $token)
				  
		          ->count();
	
	$viewproduct = DB::table('product')
		          ->where('prod_token', '=' , $token)
		          ->get();					
		
	return view('edit-product', ['category' => $category, 'product_type' => $product_type, 'typer_admin' => $typer_admin, 'typer_admin_count' => $typer_admin_count, 'viewcount' => $viewcount, 'viewproduct' => $viewproduct]);
	
	
	}
	
	
	
	
	
	
	 
	
	
}
