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
use Mail;
use Auth;
use Crypt;
use URL;


class OrdersController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
	 
	 
	 public function view_orders_change($purchase_token,$status)
	 {
	 
	    $productt_count = DB::table('product_orders')
	                  ->where('purchase_token','=',$purchase_token)
		              ->count();
	   
	    $productt = DB::table('product_orders')
		->where('purchase_token','=',$purchase_token)
		              ->get();
	 
	 $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		$orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $purchase_token)
						->where('status', '=', 'pending')
						->update(['status' => 'completed']);
						
		$checkoutupdate = DB::table('product_checkout')
						->where('purchase_token', '=', $purchase_token)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed']);				
		
		
		
		$product_check = DB::table('product_checkout')
		                 ->where('purchase_token','=',$purchase_token)
		                 ->count();
		
		
		       $product_wn = DB::table('product_checkout')
		                   ->where('purchase_token','=',$purchase_token)
		                   ->get();
						   
	 /*return view('admin.view_orders', ['productt' => $productt, 'setts' => $setts, 'productt_count' => $productt_count, 'product_check' => $product_check, 'product_wn' => $product_wn, 'purchase_token' => $purchase_token]);*/
	 return back();
	 
	 
	 }
	 
	 
	 
	 
	 
	 
	 public function view_orders_index($purchase_token)
	 {
	 
	 
	 $productt_count = DB::table('product_orders')
	                  ->where('purchase_token','=',$purchase_token)
		              ->count();
	   
	    $productt = DB::table('product_orders')
		->where('purchase_token','=',$purchase_token)
		              ->get();
	 
	 $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		$product_check = DB::table('product_checkout')
		                 ->where('purchase_token','=',$purchase_token)
		                 ->count();
		
		
		       $product_wn = DB::table('product_checkout')
		                   ->where('purchase_token','=',$purchase_token)
		                   ->get();
				   
						   
		
		
		return view('admin.view_orders', ['productt' => $productt, 'setts' => $setts, 'productt_count' => $productt_count, 'product_check' => $product_check, 'product_wn' => $product_wn, 'purchase_token' => $purchase_token]);
	 
	 
	 }
	 
	 
	 
	 
	 
    public function orders_index()
    {
        $productt_count = DB::table('product_checkout')
		              ->count();
	   
	    $productt = DB::table('product_checkout')
		              ->get();
					  
					  
					  
					 $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
						
		$commission_mode = $setts[0]->commission_mode;
		$commission_amt = $setts[0]->commission_amt;
					  
					  

        return view('admin.orders', ['productt' => $productt, 'setts' => $setts, 'productt_count' => $productt_count, 'commission_mode' => $commission_mode, 'commission_amt' => $commission_amt]);
    }
	
	
	
	
	
	public function orders_approval($purchase_token,$admin_commission,$vendor_commission)
	{
	
	
	    $product_count = 	DB::table('product_checkout')
						->where('purchase_token', '=', $purchase_token)
						->where('payment_approval', '=', 0)
						->count();
						
		$set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();
						
					
						
						
		if(!empty($product_count))
		{				
	    $product = 	DB::table('product_checkout')
						->where('purchase_token', '=', $purchase_token)
						->get();
						
						
						
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $purchase_token)
						->where('status', '=', 'completed')
						->get();				
		
		
		
		$admin_final_amount = 0;				
		foreach($view_orders as $views)
		{
		
		$prod_user_id = $views->prod_user_id;
		$vendor_amount = $views->total;
		
		$commission_amt = $site_setting[0]->commission_amt;
		$commission_mode = $site_setting[0]->commission_mode;
		
		
		if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $vendor_amount) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($views->total < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
		
		$vendor_final_amt = $vendor_amount - $commission_amount;		   
		$admin_final_amount += $commission_amount;
		
		
		$user_check = 	DB::table('users')
						->where('id', '=', $prod_user_id)
						->get();
						
		$wallet_balance = $user_check[0]->earning;
		
			$credit_amt = 	$wallet_balance + $vendor_final_amt;
			
			
			
			
			
			DB::update('update users set earning="'.$credit_amt.'" where id = ?', [$prod_user_id]); 		
		    
		
		
		
		}	
		
		
		$admin_check = 	DB::table('users')
						->where('id', '=', 1)
						->get();
			$admin_wallet = $admin_check[0]->earning;
			$admin_amount = $admin_final_amount + $product[0]->processing_fee;
			
			$admin_credit = $admin_wallet + $admin_amount;
					
			DB::update('update users set earning="'.$admin_credit.'" where id = ?', [1]);			
						
						
		$user = DB::table('users')
						->where('id', '=', $product[0]->user_id)
						->get();
						
						
		$user_email = $user[0]->email;
		$shipping_charge = $product[0]->shipping_price;
		$processing_fee = $product[0]->processing_fee;
		$subtotal = $product[0]->subtotal;
		$total = $product[0]->total;
		$payment_type = $product[0]->payment_type;
		$payment_date = $product[0]->payment_date;
		
		
		
		
		
		
				   
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$currency = $setts[0]->site_currency;
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		DB::update('update product_checkout set payment_approval="1",vendor_amount="'.$vendor_commission.'",admin_amount="'.$admin_commission.'" where purchase_token = ?', [$purchase_token]);
		
		
		$datas = [
            'user_email' => $user_email, 'url' => $url, 'purchase_token' => $purchase_token, 'vendor_commission' => $vendor_commission, 'admin_commission' => $admin_commission, 'total' => $total, 'payment_type' => $payment_type, 'payment_date' => $payment_date, 'site_logo' => $site_logo, 'site_name' => $site_name, 'currency' => $currency
        ];
		
		Mail::send('admin.order_approval_mail', $datas , function ($message) use ($admin_email,$user_email)
        {
            $message->subject('Your payment is approved');
			
            $message->from($admin_email, 'Admin');

            $message->to($user_email);

        }); 
		
		
		
		
		
		
						
										
	
	
	    }
		
		
		return back();
	
	}
	
	
	
   
   
   
   
	
	
	
}