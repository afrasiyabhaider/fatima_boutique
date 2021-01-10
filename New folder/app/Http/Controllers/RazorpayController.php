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
use Session;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class RazorpayController extends Controller
{
    
	
	
	
	public function avigher_view_razorpay($razor_id)
	{
	
	   
	   $data = array('razor_id' => $razor_id);
     return view('razorpay-success')->with($data);
	   
	}
	
	 
	 
	 public function avigher_razorpay(Request $request)
	{
	 
	    $data = $request->all();
		
		include(app_path() . '/razorpay-php/Razorpay.php');
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$success = true;

		$error = "Payment Failed";
		
		if (empty($data['razorpay_payment_id']) === false)
		{
		
			$api = new Api($setts[0]->razorpay_key_id, $setts[0]->razorpay_key_secret);
		
			try
			{
				
				$attributes = array(
					'razorpay_order_id' => Session::get('razorpay_order_id'),
					'razorpay_payment_id' => $data['razorpay_payment_id'],
					'razorpay_signature' => $data['razorpay_signature'],
					'order_id' => $data['order_id']
				);
		
				$api->utility->verifyPaymentSignature($attributes);
				
			}
			catch(SignatureVerificationError $e)
			{
				$success = false;
				$error = 'Razorpay Error : ' . $e->getMessage();
			}
		}
		
		if ($success === true)
		{
		    $razor_id = $data['razorpay_payment_id'];
			$cid = $data['order_id'];
			
			
			
			
			$orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed', 'razor_token' => $razor_id]);
		 $checkoutupdate = DB::table('product_checkout')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed', 'razor_token' => $razor_id]);
		
			
			
			$get_viewr = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		->count();
		
		
		
		
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'completed')
						->get();
		
		foreach($view_orders as $views)
		{
		
		$ord_id = $views->ord_id;
		
		$subtotal = $views->quantity * $views->price;
		
		$total = $subtotal + $views->shipping_price;
		
		
		DB::update('update product_orders set subtotal="'.$subtotal.'",total="'.$total.'" where status="completed" and ord_id = ?', [$ord_id]);
		
		
		
		}				
		
		
		
		 $get_details = DB::table('product_checkout')
              
			       ->where('purchase_token', '=', $cid)
			   
                   ->get();
				   
				   
		$user_details = DB::table('users')
              
			       ->where('id', '=', $get_details[0]->user_id)
			   
                   ->get();		   
				   
				   				
						
				$order_id = $cid;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $get_details[0]->total;
					
				
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id
        ];
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Payment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($admin_email);

        }); 
		

		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Payment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($email);

        }); 
		 
			
			
		
			
			
			return redirect('/razorpay-success/'.$razor_id);
			
		}
		else
		{
			return redirect('/cancel');
		}
		
		
		
		

		
  
	}
	
	
	
	
	
}
