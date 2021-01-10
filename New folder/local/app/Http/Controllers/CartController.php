<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;
use File;
use Image;
use Mail;
use Illuminate\Support\Facades\Validator;
use Responsive\Http\Requests;

class CartController extends Controller
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
    
	
	
	
	
	
	public function avigher_remove_cart($token)
	{
	
	   DB::delete('delete from product_orders where ord_id = ?',[$token]);
	   return redirect('/cart');
	}
	
	
	
	public function avigher_view_cart()
	{
	   if(Auth::check()) {
	   $log_id = Auth::user()->id;
	   
	   $cart_views_count = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->count();
	   
	   
	   $cart_views = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->get();
		
		}
		else
		{
		$cart_views_count = 0;
		$cart_views = "";
		
		}
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$admin_details = DB::table('users')
						 ->where('id', '=', 1)
						 ->get();
		
		
		
	   
	    $data = array('cart_views_count' => $cart_views_count, 'cart_views' => $cart_views, 'setts' => $setts, 'admin_details' => $admin_details);
	   
	   return view('cart')->with($data);
	}
	
	
   
   
  
	
	
	
	
	
	
	
	
	
	
}
