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
use Session;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	 public function avigher_view_compare($id)
	 {
	 
	 $loger_id = Auth::user()->id;
	 $token = $id;
	 
	 
	 
	 
	 
	 $check_compare = DB::table('product_compare')
							->where('user_id','=',$loger_id)
							->where('prod_token','=',$token)
							
							
							->count();
							
		if(empty($check_compare))
		{
		   DB::insert('insert into product_compare (prod_token,user_id) values (?, ?)', [$token,$loger_id]);
		
		
		$again_compare = DB::table('product_compare')
							->where('user_id','=',$loger_id)
							
							
							
							->count();
		
		
		if($again_compare > 3)
		{
		   
		   $viewas = DB::table('product_compare')
					->where('user_id','=',$loger_id)
					 ->orderBy('pc_id','asc')
					 ->get();
		$pcid = $viewas[0]->pc_id;
					
		DB::delete('delete from product_compare where user_id="'.$loger_id.'" and pc_id = ?',[$pcid]);			
		   
		   
		}
		
		
		
			return back()->with('success', 'Product added!');
		   
		}			
	 
	 else
		{
		   
		
		
		    return back()->with('error', 'Already added this product!');
		}
		
		
		
	 
	 
	 
	 /*if(empty($check_compare))
		{
		
		   DB::insert('insert into product_compare (prod_token,user_id) values (?, ?)', [$token,$loger_id]);
		
		
			return back()->with('success', 'Product added!');
		   
		}
		else
		{
		    return back()->with('error', 'Already added this product!');
		}*/
	 
	 
	 
	 
	 
	 
	 
	  
	 
	 
	 
	 }
	 
	 
	 
	 public function avigher_compare()
	 {
	 
	 
	 $viewcount = DB::table('product_compare')
					->where('user_id','=',Auth::user()->id)
					->orderBy('pc_id','desc')
					 ->take(3)
					->count();
					
	    $viewproduct = DB::table('product_compare')
					 ->where('user_id','=',Auth::user()->id)
					 ->orderBy('pc_id','desc')
					 ->take(3)
					 ->get();
	 
	 
	 
	 return view('compare', ['viewcount' => $viewcount, 'viewproduct' => $viewproduct]);
	 
	 }
	 
	 
	 
	 
	 public function avigher_cart(Request $request)
	{
	
	  $data = $request->all();
	
		$prod_id = $data['prod_id'];
		$quantity = $data['quantity'];
		$price = $data['price'];
		$log_id = Auth::user()->id;
		$prod_token = $data['prod_token'];
		$prod_user_id = $data['prod_user_id'];
		
		
		$checker_count= DB::table('product')
	                 ->where('prod_id','=',$prod_id)
		             ->count();
		if(!empty($checker_count))
		{			 
					 
		   $checker_get= DB::table('product')
						 ->where('prod_id','=',$prod_id)
						 ->get();
		
		
			if($checker_get[0]->prod_available_qty >= $quantity && $quantity > 0)
			{
			    
				
				$keys = Session::getId();
				
				$attr_id = "";
				foreach($data['attribute'] as $attri)
				{
				   $attr_id .=$attri.',';
				}
				$nattri = rtrim($attr_id,',');
				
				
				 
				 $check = DB::table('product_orders')
						  ->where('user_id','=',$log_id)
						   ->where('prod_id','=',$prod_id)
						   ->where('status','=','pending')
						   ->whereIn('prod_attribute', [$nattri])
						   
						   ->count();
						   
					   
						   
				 
				 if(empty($check))
				 {
				 DB::insert('insert into product_orders (user_id,prod_id,prod_user_id,prod_token,token,quantity,prod_attribute,price,status) values (?, ?, ?, ?, ?,?,?,?,?)', [$log_id,$prod_id,$prod_user_id,$prod_token,$keys,$quantity,$nattri,$price,'pending']);
				 }
				 else
				 {
				   DB::update('update product_orders set quantity="'.$quantity.'" where user_id="'.$log_id.'" and status="pending" and prod_attribute="'.$nattri.'" and prod_id = ?', [$prod_id]);
				 }
				return redirect('/cart');
			
			}
			
			else
			{
			
				return back()->with('error', 'Please check available stock');
				
			}
		   
		
	
	    }
		else
		{
		
			return back()->with('error', 'Please check available stock');
			
		}
		
		
		
	
	
	}
	
	
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 public function avigher_view_wishlist()
	{
	
	
	   $viewcount = DB::table('wishlist')
					->where('user_id','=',Auth::user()->id)
					->count();
					
	    $viewproduct = DB::table('wishlist')
					 ->where('user_id','=',Auth::user()->id)
					 ->get();			
					
	     return view('my-wishlist', ['viewcount' => $viewcount, 'viewproduct' => $viewproduct]);
	
	
	} 
	
	
	
	
	
	public function avigher_wishlist_delete($prod_token)
	{
	
	   $loger_id = Auth::user()->id;
	
	   DB::delete('delete from wishlist where prod_token="'.$prod_token.'" and 	user_id = ?',[$loger_id]);
	
	   return back()->with('success', 'Product has been removed!');
	   
	
	}
	 
	 
	 
	 
	 
	 
	 
	 
	public function avigher_wishlist($log_id,$prod_token)
	{
	
	     $check_wishlist = DB::table('wishlist')
							->where('user_id','=',$log_id)
							->where('prod_token','=',$prod_token)
							->count();
							
		if(empty($check_wishlist))
		{
		
		   DB::insert('insert into wishlist (user_id,prod_token) values (?, ?)', [$log_id,$prod_token]);
		
		
			return back()->with('success', 'Product added!');
		   
		}
		else
		{
		    return back()->with('error', 'Already added this product!');
		}					
	
	
	
	} 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
    
	
	public function avigher_edit_product($token)
	{
	
	
	
	   $userid = Auth::user()->id;
	$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
			
	$product_type = array("physical","digital","external");	
		
		
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
	
	
	public function avigher_delete_photo($delete,$id,$photo) 
	{
	   $orginalfile1 = base64_decode($photo);
	   $userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	   File::delete($path1);
	   DB::delete('delete from product_images where prod_img_id = ?',[$id]);
	   return back();
	
	}
	
	
	
	
	public function avigher_product()
    {
	
	$userid = Auth::user()->id;
	$viewcount = DB::table('product')
		          ->where('user_id', '=' , $userid)
				  ->where('delete_status','=','')
				  ->orderBy('prod_id','desc')
		          ->count();
	
	$viewproduct = DB::table('product')
		          ->where('user_id', '=' , $userid)
				   ->where('delete_status','=','')
				    ->orderBy('prod_id','desc')
		          ->get();
				
	 $data = array('viewcount' => $viewcount, 'viewproduct' => $viewproduct);
	 return view('my-product')->with($data);
	
	
	}
	
	
	
	public function avigher_add_form()
	{
	$userid = Auth::user()->id;
	$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
			
	$product_type = array("physical","digital","external");	
		
		
		$typer_admin_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->count();
		
		 $typer_admin = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->get();		
		
	
	   return view('add-product', ['category' => $category, 'product_type' => $product_type, 'typer_admin' => $typer_admin, 'typer_admin_count' => $typer_admin_count]);
	}
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	
	
	
	public function avigher_product_delete($token)
	{
	
	 DB::update('update product set delete_status="deleted",prod_status="0" where prod_token = ?',[$token]);
	   
      return back()->with('success', 'Product has been deleted.');
	
	
	}
	
	
	
	
	public function avigher_edit_data (Request $request)
	{
	
	$userid = Auth::user()->id;
	
	$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
			
	$product_type = array("physical","digital","external");	
	
	$typer_admin_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->count();
		
		 $typer_admin = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->get();		
		
	
	
	   $data = $request->all();
	    $token = $data['prod_token'];
		
		
	   
	   
	   $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		
		
		$rules = array(
		
		
		'image.*' => 'image|mimes:jpeg,png,jpg|max:'.$imgsize
		
		
		);
		
		
		$messages = array(
            
            'image' => 'The :attribute field must only be image'
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
	   
		   $product_name = $data['product_name'];
		   $url_slug = $data['url_slug'];
		   $cat_id = $data['cat_id'];
		   $pieces = explode("_", $cat_id);
		   $category_id = $pieces[0];
		   $category_type = $pieces[1];
		   
		   $prod_desc = $data['prod_desc'];
		   $prod_type = $data['prod_type'];
		   $prod_price = $data['prod_price'];
		   
		   if($prod_type=="digital")
		   {
		     $prod_available_qty = 1;
		   }
		   else
		   {
		     $prod_available_qty = $data['prod_available_qty'];
		   }
		   
		   $prod_offer_price = $data['prod_offer_price'];
		   
		   
		   
		  
		   
		   if(!empty($data['prod_external_url']))
		   {
		   $prod_external_url = $data['prod_external_url'];
		   }
		   else
		   {
		   $prod_external_url = "";
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
		   }
		   else
		   {
			 $name = "";
		   }
		   
		   
		   
		   if(!empty($data['prod_tags']))
	   {
	   
	   $prod_tags = $data['prod_tags'];
	   
	   }
	   else
	   {
	    $prod_tags = "";
	   }
	   
	   
	   
	   if(!empty($data['prod_featured']))
	   {
	     $prod_featured = $data['prod_featured'];
	   }
	   else
	   {
	     $prod_featured = "";
	   }
	   
	   
	   
	   
	     $zipfile = Input::file('zipfile'); 
		 if(isset($zipfile))
		 { 
		 $filename = time() . '.' . $zipfile->getClientOriginalName();
		
		 $zipformat = base_path('images/media/'); 
		 $zipfile->move($zipformat,$filename); 
		 $zipname = $filename; 
		 }
		 else
		 {
		    $zipname = $data['save_zipfile'];
		 }
	   
	   
	   
	   
	   if($settings[0]->with_submit_product==1)
	   {
	     $status_approval = 0;
		 $submit_msg = 'Product has been updated. Once product has been approved. You will received the confirmation.';
		 
	   }
	   else
	   {
	     $status_approval = 1;
		 $submit_msg = 'Product has been updated.';
	   }
		   
		   
		  
		   
	   DB::update('update product set prod_slug="'.$url_slug.'",prod_category="'.$category_id.'",prod_cat_type="'.$category_type.'",prod_name="'.$product_name.'",prod_desc="'.$prod_desc.'",prod_tags="'.$prod_tags.'",prod_price="'.$prod_price.'",prod_offer_price="'.$prod_offer_price.'",prod_featured="'.$prod_featured.'",prod_type="'.$prod_type.'",prod_zipfile="'.$zipname.'",prod_external_url="'.$prod_external_url.'",prod_attribute="'.$name.'",prod_available_qty="'.$prod_available_qty.'",prod_status="'.$status_approval.'" where prod_token = ?', [$token]);
	   
	   
	   
	   $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$picture = time().$filename;
					$destinationPath = base_path('images/media/');
					$file->move($destinationPath, $picture);
					
					
					DB::insert('insert into product_images (prod_token,image) values (?, ?)', [$token,$picture]);
					
				}
			}
		
	   
	   
	   
	   }
	   
	   
	   
	   
	   
	   
	   
			return back()->with('success', $submit_msg);
	   
	   
	   
	   }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function avigher_add_product(Request $request)
	{
	
	$userid = Auth::user()->id;
	
	$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
			
	$product_type = array("physical","digital","external");	
	
	$typer_admin_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->count();
		
		 $typer_admin = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					
					->orderBy('attr_name', 'asc')->get();		
		
	
	
	   $data = $request->all();
	   
	   
	   
	   
	   
	   $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		 $zipsize = $settings[0]->zip_size;
		
		$rules = array(
		
		'image' => 'required',
		'image.*' => 'image|mimes:jpeg,png,jpg|max:'.$imgsize,
		'zipfile' => 'max:'.$zipsize.'|mimes:zip'
		
		
		);
		
		
		$messages = array(
            
            'image' => 'The :attribute field must only be image'
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
	   
	   
	   $product_name = $data['product_name'];
	   $url_slug = $data['url_slug'];
	   $cat_id = $data['cat_id'];
	   $pieces = explode("_", $cat_id);
	   $category_id = $pieces[0];
	   $category_type = $pieces[1];
	   
	   $prod_desc = $data['prod_desc'];
	   $prod_type = $data['prod_type'];
	   $prod_price = $data['prod_price'];
	   $prod_offer_price = $data['prod_offer_price'];
	   
	   if(!empty($data['prod_available_qty']))
	   {
	   $prod_available_qty = $data['prod_available_qty'];
	   }
	   else
	   {
	     $prod_available_qty = 1;
	   }
	   
	   $token = $data['prod_token'];
	   
	   if(!empty($data['prod_external_url']))
	   {
	   $prod_external_url = $data['prod_external_url'];
	   }
	   else
	   {
	   $prod_external_url = "";
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
	   }
	   else
	   {
	     $name = "";
	   }
	   
	   
	   if(!empty($data['prod_tags']))
	   {
	   
	   $prod_tags = $data['prod_tags'];
	   
	   }
	   else
	   {
	    $prod_tags = "";
	   }
	   
	   
	   
	   if(!empty($data['prod_featured']))
	   {
	     $prod_featured = $data['prod_featured'];
	   }
	   else
	   {
	     $prod_featured = "";
	   }
	   
	   
	   
	   
	   
	   
	   
	   
	    $zipfile = Input::file('zipfile'); 
		 if(isset($zipfile))
		 { 
		 $filename = time() . '.' . $zipfile->getClientOriginalName();
		
		 $zipformat = base_path('images/media/'); 
		 $zipfile->move($zipformat,$filename); 
		 $zipname = $filename; 
		 }
		 else
		 {
		    $zipname = "";
		 }
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   if($settings[0]->with_submit_product==1)
	   {
	     $status_approval = 0;
		 $submit_msg = 'Product has been created. Once product has been approved. You will received the confirmation.';
		 
	   }
	   else
	   {
	     $status_approval = 1;
		 $submit_msg = 'Product has been created.';
	   }
	   
	   
	   
	   $idd = DB::table('product')-> insertGetId(array(
		'user_id' => $userid,
		'prod_token' => $token,
        'prod_slug' => $this->clean($url_slug),
		'prod_category' => $category_id,
		'prod_cat_type' => $category_type,
		'prod_name' => $product_name,
		'prod_desc' => $prod_desc,
		'prod_tags' => $prod_tags,
		'prod_price' => $prod_price,
		'prod_offer_price' => $prod_offer_price,
		'prod_featured' => $prod_featured,
		'prod_zipfile' => $zipname, 
		'prod_type' => $prod_type,
		'prod_external_url' => $prod_external_url,
		'prod_attribute' => $name,
		'prod_available_qty' => $prod_available_qty,
		'prod_status' => $status_approval,
		
		
			));
	   
	  } 
	   
	   $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$picture = time().$filename;
					$destinationPath = base_path('images/media/');
					$file->move($destinationPath, $picture);
					
					
					DB::insert('insert into product_images (prod_token,image) values (?, ?)', [$token,$picture]);
					
				}
			}
		
	   
	   
	  
	   
	   
	   return back()->with('success', $submit_msg);
	   
	}   
	
	
	
	 
	
	
}
