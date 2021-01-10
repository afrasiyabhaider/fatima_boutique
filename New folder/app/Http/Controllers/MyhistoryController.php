<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Auth;
use File;
use Image;
use URL;
use Mail;

class MyhistoryController extends Controller
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
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	public function avigher_balance_data(Request $request) 
	{
	
	$data = $request->all();
	$withdraw_amount = $data['withdraw_amount'];
	$withdraw_type = $data['withdraw_type'];
	if(!empty($data['paypal_id'])){ $paypal_id = $data['paypal_id']; } else { $paypal_id = ""; }
	if(!empty($data['stripe_id'])) { $stripe_id = $data['stripe_id']; } else { $stripe_id = ""; }
	if(!empty($data['bank_acc_no'])) { $bank_acc_no = $data['bank_acc_no']; } else { $bank_acc_no = ""; }
	if(!empty($data['bank_name'])) { $bank_name = $data['bank_name']; } else { $bank_name = ""; }
	if(!empty($data['ifsc_code'])) { $ifsc_code = $data['ifsc_code']; } else  { $ifsc_code = ""; }
	$withdraw_status = "pending";
	$logged = Auth::user()->id;
	$get_shop = DB::table('shop')
		          ->where('user_id','=', $logged)
				  ->get();
	$shop_id = $get_shop[0]->shop_id;
	$set_id=1;
	$setting = DB::table('settings')->where('id', $set_id)->get();
		if($setting[0]->withdraw_amt > $withdraw_amount)
		{
			return back()->with('error', 'Please check minimum withdraw amount and available balance');
		}
		else
		{
		
		
		
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setting[0]->site_logo;
		
		$site_name = $setting[0]->site_name;
		
		$currency = $setting[0]->site_currency;
		
		$user_email = Auth::user()->email;
		$username = Auth::user()->name;
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->get();
		
		$admin_email = $admindetails[0]->email;
	   
		
		
		
		
			if($data['available_amount'] >= $withdraw_amount)
			{
			
			DB::insert('insert into withdraw (shop_id,user_id,withdraw_amount,withdraw_payment_type,paypal_id,stripe_id,bank_account_no,bank_info,bank_ifsc,withdraw_status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$shop_id,$logged,$withdraw_amount,$withdraw_type,$paypal_id,$stripe_id,$bank_acc_no,$bank_name,$ifsc_code,$withdraw_status]);
			
			
			$datas = [
            'withdraw_amount' => $withdraw_amount, 'withdraw_type' => $withdraw_type, 'paypal_id' => $paypal_id, 'stripe_id' => $stripe_id,
			'bank_acc_no' => $bank_acc_no, 'bank_name' => $bank_name, 'ifsc_code' => $ifsc_code, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
			
			
			Mail::send('withdraw_email', $datas , function ($message) use ($admin_email,$user_email,$username)
        {
            $message->subject('Withdrawal Request');
			
            $message->from($admin_email,'Admin');

            $message->to($admin_email);
			

        }); 
			
			
			
			
			
			
			return back()->with('success', 'Your withdraw request has been sent');
			
			}
			else
			{
			   return back()->with('error', 'Your withdraw amount is high. Please check available balance');
			}
			 
		}
	
	
	
		return back();		  
	
	
	}
	
	
	
	
	
	
	public function avigher_review_data(Request $request) 
	{
		 $data = $request->all();
	     $rating = $data['rating'];
		 $review = $data['review'];
		 
		 $user_id = $data['user_id'];
		 $prod_id = $data['prod_id'];
		
		
		
		
		 
		 $check = DB::table('product_rating')
		          ->where('user_id','=', $user_id)
				  ->where('prod_id','=', $prod_id)
				  ->count();
				  
		if(empty($check))
		{
		    DB::insert('insert into product_rating (user_id,prod_id,rating,review) values (?, ?, ?, ?)', [$user_id,$prod_id,$rating,$review]);
		
		}
		else
		{
		   DB::update('update product_rating set rating="'.$rating.'",review="'.$review.'" where user_id="'.$user_id.'" and prod_id = ?', [$prod_id]);
		}
				  
		
		 
		 return back()->with('success', 'Your rating & review has been updated');
		 
		 
		 
	
	}
	
	
	
	
	public function avigher_view_orderdetails($ord_id,$user_id)
	{
	
	    $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
		$viewcount = DB::table('product_orders')
		                 ->where('ord_id', '=', $ord_id)
						 ->count();
		
        $viewproduct = DB::table('product_orders')
		                 ->where('ord_id', '=', $ord_id)
						 ->get();
						 
		$data=array('viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'setting' => $setting);				 
		
	    return view('view-orders')->with($data);
	
	}
	
	
	
	
	
	public function avigher_view_myorders() {
		
		 $logged = Auth::user()->id;
		 
		 
		 $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
      
		$viewcount = DB::table('product_orders')
		                 ->where('prod_user_id', '=', $logged)
						 ->count();
		
        $viewproduct = DB::table('product_orders')
		                 ->where('prod_user_id', '=', $logged)
						 ->orderBy('ord_id','desc')
						 ->get();
				 
		
			
	   $data=array('viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'setting' => $setting, 'logged' => $logged);
	   		 
		
      return view('my-orders')->with($data);
   }
   
   
   public function avigher_view_mybalance()
   {
   
      $logged = Auth::user()->id;
		 
		 
		 $set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();
		
		$commission_mode = $site_setting[0]->commission_mode;
		$commission_amt = $site_setting[0]->commission_amt;
		
        	/************* FIRST STEP ************/	
				 
				$balance_count = DB::table('booking')
		           ->leftJoin('shop', 'shop.shop_id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 1)
				   ->where('booking.payment_approval', '=', 0)
				    ->where('booking.payment_status', '=', 'paid')
				   ->where('shop.user_id', '=', $logged)
				   ->orderBy('booking.book_id', 'desc')
				 ->count();
				 
				 
		if(!empty($balance_count))
		{
			$balance = DB::table('booking')
		           ->leftJoin('shop', 'shop.shop_id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 1)
				   ->where('booking.payment_approval', '=', 0)
				    ->where('booking.payment_status', '=', 'paid')
				   ->where('shop.user_id', '=', $logged)
				   ->orderBy('booking.book_id', 'desc')
				 ->get();
				 
				 
				 $shopping_id = $balance[0]->shop_id;
				 
			   $sum="";
				   foreach($balance as $sumvalue){ 
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumvalue->total_amount) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumvalue->total_amount < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   $sum +=$sumvalue->total_amount - $commission_amount; }
				   
				   $sumvalue = $sum;
				   
		}
		else
		{
			$sumvalue = 0;
			$shopping_id = "";
		}
		
		
		
		/******************* SECOND STEP *************/
		
		$balance_count_two = DB::table('booking')
		           ->leftJoin('shop', 'shop.shop_id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 1)
				   ->where('booking.payment_approval', '=', 2)
				    ->where('booking.payment_status', '=', 'paid')
				   ->where('shop.user_id', '=', $logged)
				   ->orderBy('booking.book_id', 'desc')
				 ->count();
				 
				 
		if(!empty($balance_count_two))
		{
			$balance_two = DB::table('booking')
		           ->leftJoin('shop', 'shop.shop_id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 1)
				   ->where('booking.payment_approval', '=', 2)
				    ->where('booking.payment_status', '=', 'paid')
				   ->where('shop.user_id', '=', $logged)
				   ->orderBy('booking.book_id', 'desc')
				 ->get();
				 
				 $shopping_id = $balance_two[0]->shop_id;
				 
			   $sum="";
				   foreach($balance_two as $sumvalue_two){ 
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumvalue_two->total_amount) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumvalue_two->total_amount < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   $sum +=$sumvalue_two->total_amount - $commission_amount; }
				   
				   $sumvalue_two = $sum;
				   
		}
		else
		{
			$sumvalue_two = 0;
			$shopping_id = "";
		}
		
		
		
		/********************* THIRD STEP ****************/
		
		
		$balance_count_third = DB::table('booking')
		           ->leftJoin('shop', 'shop.shop_id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 1)
				   ->where('booking.payment_approval', '=', 1)
				    ->where('booking.payment_status', '=', 'paid')
				   ->where('shop.user_id', '=', $logged)
				   ->orderBy('booking.book_id', 'desc')
				 ->count();
				 
				 
		if(!empty($balance_count_third))
		{
			$balance_third = DB::table('booking')
		           ->leftJoin('shop', 'shop.shop_id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 1)
				   ->where('booking.payment_approval', '=', 1)
				    ->where('booking.payment_status', '=', 'paid')
				   ->where('shop.user_id', '=', $logged)
				   ->orderBy('booking.book_id', 'desc')
				 ->get();
				 
				 $shopping_id = $balance_third[0]->shop_id;
				 
				 
			   $sum="";
				   foreach($balance_third as $sumvalue_third){ 
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumvalue_third->total_amount) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumvalue_third->total_amount < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   $sum +=$sumvalue_third->total_amount - $commission_amount; }
				   
				   $sumvalue_third = $sum;
				   
		}
		else
		{
			$sumvalue_third = 0;
			$shopping_id = "";
		}
		
		
		
		
		
		
		$withdraw_count = DB::table('withdraw')
		                 ->where('shop_id', '=', $shopping_id)
				         ->where('user_id', '=', $logged)
				         /*->where('withdraw_status', '=', 'completed')*/
				         ->count(); 
		
		if(!empty($withdraw_count))
		{
				$withdraw = DB::table('withdraw')
								 ->where('shop_id', '=', $shopping_id)
								 ->where('user_id', '=', $logged)
								/* ->where('withdraw_status', '=', 'completed')*/
								 ->get();
				$amount = "";
				foreach($withdraw as $draw)
				{
				   $amount += $draw->withdraw_amount;
				}
		
		}
		else
		{
		    $amount = 0;
			$withdraw = "";
		}
		
		
		
		$pending_withdraw_cnt = DB::table('withdraw')
		                 ->where('shop_id', '=', $shopping_id)
				         ->where('user_id', '=', $logged)
				         ->where('withdraw_status', '=', 'pending')
				         ->count(); 
				 
		$pending_withdraw = DB::table('withdraw')
		                 ->where('shop_id', '=', $shopping_id)
				         ->where('user_id', '=', $logged)
				         ->where('withdraw_status', '=', 'pending')
				         ->get(); 		 
		
		
		
		$complete_withdraw_cnt = DB::table('withdraw')
		                 ->where('shop_id', '=', $shopping_id)
				         ->where('user_id', '=', $logged)
				         ->where('withdraw_status', '=', 'completed')
				         ->count(); 
				 
		$complete_withdraw = DB::table('withdraw')
		                 ->where('shop_id', '=', $shopping_id)
				         ->where('user_id', '=', $logged)
				         ->where('withdraw_status', '=', 'completed')
				         ->get(); 		 		  
				 
		
		$data=array('site_setting' => $site_setting, 'sumvalue' => $sumvalue, 'balance_count' => $balance_count, 'sumvalue_two' => $sumvalue_two, 'balance_count_two' => $balance_count_two, 'sumvalue_third' => $sumvalue_third, 'balance_count_third' => $balance_count_third, 'amount' => $amount, 'withdraw_count' => $withdraw_count, 'withdraw' => $withdraw, 'pending_withdraw_cnt' => $pending_withdraw_cnt, 'pending_withdraw'=> $pending_withdraw, 'complete_withdraw_cnt' => $complete_withdraw_cnt, 'complete_withdraw' => $complete_withdraw);
		 
		
      return view('my-balance')->with($data);
   
   
   }
   
   
   
   
   public function avigher_myshopping($token)
   {
   
      $logged = Auth::user()->id;
		 
		 
		 $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
		
		$viewcount = DB::table('product_orders')
		                 ->where('user_id', '=', $logged)
						 ->where('purchase_token', '=', $token)
						 
						 ->count();
		
        $viewproduct = DB::table('product_orders')
		                 ->where('user_id', '=', $logged)
						 ->where('purchase_token', '=', $token)
						 
						 ->get();
				 
   $data=array('viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'setting' => $setting, 'logged' => $logged);
	   
	   return view('view-shopping')->with($data);
   
   }
   
   
   
   
   
   public function avigher_view_myshopping()
   {
       
	   $logged = Auth::user()->id;
		 
		 
		 $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
		
		$viewcount = DB::table('product_checkout')
		                 ->where('user_id', '=', $logged)
						 ->orderBy('cid','desc')
						 ->count();
		
        $viewproduct = DB::table('product_checkout')
		                 ->where('user_id', '=', $logged)
						 ->orderBy('cid','desc')
						 ->get();
				 
		
			
	   $data=array('viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'setting' => $setting, 'logged' => $logged);
	   
	   return view('my-shopping')->with($data);
   }
   
   
   
   
  public function avigher_destroy($id) {
		
		
	  
      DB::delete('delete from booking where book_id = ?',[$id]);
	   
      return back();
      
   }
	
	
	
	
	
	
	
	
	
	
}
