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
use URL;
use Session;

use Razorpay\Api\Api;


class PaymentController extends Controller
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
    
	
	public function avigher_checkout_details(Request $request)
	{
	
	 
	 $url = URL::to("/");
	
	 $data = $request->all();
	 $log_id = Auth::user()->id;
	 
	 if(!empty($data['bill_firstname'])){ $bill_firstname = $data['bill_firstname']; } else { $bill_firstname = ""; }
	 if(!empty($data['bill_lastname'])){ $bill_lastname = $data['bill_lastname']; } else { $bill_lastname = ""; }
	 if(!empty($data['bill_companyname'])){ $bill_companyname = $data['bill_companyname']; } else { $bill_companyname = ""; }
	 if(!empty($data['bill_email'])){ $bill_email = $data['bill_email']; } else { $bill_email = ""; }
	 if(!empty($data['bill_phone'])){ $bill_phone = $data['bill_phone']; } else { $bill_phone = ""; }
	 if(!empty($data['bill_country'])){ $bill_country = $data['bill_country']; } else { $bill_country = ""; }
	  if(!empty($data['bill_address'])){ $bill_address = $data['bill_address']; } else { $bill_address = ""; }
	  if(!empty($data['bill_city'])){ $bill_city = $data['bill_city']; } else { $bill_city = ""; }
	  if(!empty($data['bill_state'])){ $bill_state = $data['bill_state']; } else { $bill_state = ""; }
	  if(!empty($data['bill_postcode'])){ $bill_postcode = $data['bill_postcode']; } else { $bill_postcode = ""; }
	  if(!empty($data['enable_ship'])){ $enable_ship = $data['enable_ship']; } else { $enable_ship = ""; }
	  if(!empty($data['ship_firstname'])){ $ship_firstname = $data['ship_firstname']; } else { $ship_firstname = ""; }
	   if(!empty($data['ship_lastname'])){ $ship_lastname = $data['ship_lastname']; } else { $ship_lastname = ""; }
	   if(!empty($data['ship_companyname'])){ $ship_companyname = $data['ship_companyname']; } else { $ship_companyname = ""; }
	   if(!empty($data['ship_email'])){ $ship_email = $data['ship_email']; } else { $ship_email = ""; }
	   if(!empty($data['ship_phone'])){ $ship_phone = $data['ship_phone']; } else { $ship_phone = ""; }
	   if(!empty($data['ship_country'])){ $ship_country = $data['ship_country']; } else { $ship_country = ""; }
	   if(!empty($data['ship_address'])){ $ship_address = $data['ship_address']; } else { $ship_address = ""; }
	   if(!empty($data['ship_city'])){ $ship_city = $data['ship_city']; } else { $ship_city = ""; }
	   if(!empty($data['ship_state'])){ $ship_state = $data['ship_state']; } else { $ship_state = ""; }
	   if(!empty($data['ship_postcode'])){ $ship_postcode = $data['ship_postcode']; } else { $ship_postcode = ""; }
	   if(!empty($data['order_comments'])){ $order_comments = $data['order_comments']; } else { $order_comments = ""; }
	   if(!empty($data['payment_type'])){ $payment_type = $data['payment_type']; } else { $payment_type = ""; }
	   
	  
	   
	   $viewcount = DB::table('product_billing_shipping')
					  ->where('user_id','=',$log_id)
					  ->count();
	   
	   /*if(empty($viewcount))
	   {
	   
	      DB::insert('insert into product_billing_shipping (user_id,bill_firstname,bill_lastname,bill_companyname,bill_email,bill_phone,bill_country,bill_address,bill_city,bill_state,	bill_postcode,	enable_ship,ship_firstname,ship_lastname,ship_companyname,ship_email,ship_phone,ship_country,ship_address,ship_city,ship_state,ship_postcode,other_notes) values (?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?, ?)', [$log_id,$bill_firstname,$bill_lastname,$bill_companyname,$bill_email,$bill_phone,$bill_country,$bill_address,$bill_city,$bill_state,$bill_postcode,$enable_ship,$ship_firstname,$ship_lastname,$ship_companyname,$ship_email,$ship_phone,$ship_country,$ship_address,$ship_city,$ship_state,$ship_postcode,$order_comments]);

	   }
	   else
	   {
	   
	    DB::update('update product_billing_shipping set 
		bill_firstname="'.$bill_firstname.'",
		bill_lastname="'.$bill_lastname.'",
		bill_companyname="'.$bill_companyname.'",
		bill_email="'.$bill_email.'",
		bill_phone="'.$bill_phone.'",
		bill_country="'.$bill_country.'",
		bill_address="'.$bill_address.'",
		bill_city="'.$bill_city.'",
		bill_state="'.$bill_state.'",
		bill_postcode="'.$bill_postcode.'",
		enable_ship="'.$enable_ship.'",
		ship_firstname="'.$ship_firstname.'",
		ship_lastname="'.$ship_lastname.'",
		ship_companyname="'.$ship_companyname.'",
		ship_email="'.$ship_email.'",
		ship_phone="'.$ship_phone.'",
		ship_country="'.$ship_country.'",
		ship_address="'.$ship_address.'",
		ship_city="'.$ship_city.'",
		ship_state="'.$ship_state.'",
		ship_postcode="'.$ship_postcode.'",
		other_notes="'.$order_comments.'"
		
		 where user_id = ?', [$log_id]);
			   
	   
	   }*/
	   
	   $purchase_token = rand(1111111,9999999);
	   $token = csrf_token();
	   $payment_date =  date("Y-m-d");
	   
	   $order_id = $data['order_id'];
	   $shipping_fee_separate = $data['shipping_fee_separate'];
	   
	   $sub_total = $data['sub_total'];
	   $shipping_fee = $data['shipping_fee'];
	   $processing_fee = $data['processing_fee'];
	   $total = $data['total'];
	   
	   
	   
	   
	   $check_checkout = DB::table('product_checkout')
	                  ->where('token','=',$token)
					  ->where('payment_status','=','pending')
		              ->count();
					  
					  
	$codes = explode(",",$order_id);
	$names = explode(",",$shipping_fee_separate);
	$weldone = "";
	foreach( $codes as $index => $code ) 
	{
	   $weldone .=$code.'_'.$names[$index].',';
	   
	   
	   DB::update('update product_orders set shipping_price="'.$names[$index].'" where status="pending" and ord_id = ?', [$code]);
	   
	   
	}
	$trimer = rtrim($weldone,',');				  
					  
					  
					  
					  
	
	if(empty($check_checkout))
	{
		DB::insert('insert into product_checkout (purchase_token,token,ord_id,shipping_separate,order_id_shipping,user_id,shipping_price,processing_fee,subtotal,total,payment_type,payment_date,bill_firstname,bill_lastname,bill_companyname,bill_email,bill_phone,bill_country,bill_address,bill_city,bill_state,	bill_postcode,	enable_ship,ship_firstname,ship_lastname,ship_companyname,ship_email,ship_phone,ship_country,ship_address,ship_city,ship_state,ship_postcode,other_notes,payment_status) values (?,?,?,?,?,?, ?,?,?,?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?)', [$purchase_token,$token,$order_id,$shipping_fee_separate,$trimer,$log_id,$shipping_fee,$processing_fee,$sub_total,$total,$payment_type,$payment_date,$bill_firstname,$bill_lastname,$bill_companyname,$bill_email,$bill_phone,$bill_country,$bill_address,$bill_city,$bill_state,$bill_postcode,$enable_ship,$ship_firstname,$ship_lastname,$ship_companyname,$ship_email,$ship_phone,$ship_country,$ship_address,$ship_city,$ship_state,$ship_postcode,$order_comments,'pending']);
	}
	else
	{
	
	
	
	DB::update('update product_checkout set purchase_token="'.$purchase_token.'",
	ord_id="'.$order_id.'",
	shipping_separate ="'.$shipping_fee_separate.'",
	order_id_shipping ="'.$trimer.'",
	subtotal="'.$sub_total.'",
	total="'.$total.'",
	shipping_price="'.$shipping_fee.'",
	payment_type="'.$payment_type.'",
	payment_date="'.$payment_date.'",
	bill_firstname="'.$bill_firstname.'",
		bill_lastname="'.$bill_lastname.'",
		bill_companyname="'.$bill_companyname.'",
		bill_email="'.$bill_email.'",
		bill_phone="'.$bill_phone.'",
		bill_country="'.$bill_country.'",
		bill_address="'.$bill_address.'",
		bill_city="'.$bill_city.'",
		bill_state="'.$bill_state.'",
		bill_postcode="'.$bill_postcode.'",
		enable_ship="'.$enable_ship.'",
		ship_firstname="'.$ship_firstname.'",
		ship_lastname="'.$ship_lastname.'",
		ship_companyname="'.$ship_companyname.'",
		ship_email="'.$ship_email.'",
		ship_phone="'.$ship_phone.'",
		ship_country="'.$ship_country.'",
		ship_address="'.$ship_address.'",
		ship_city="'.$ship_city.'",
		ship_state="'.$ship_state.'",
		ship_postcode="'.$ship_postcode.'",
		other_notes="'.$order_comments.'"
	where payment_status="pending" and token = ?', [$token]);
	
	}
	
	
	DB::update('update product_orders set purchase_token="'.$purchase_token.'" where status="pending" and user_id = ?', [$log_id]);
	
	
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	
	 $currency  = $setts[0]->site_currency;
	$paypal_url = $setts[0]->paypal_url;
	$paypal_id = $setts[0]->paypal_id;
	$order_no = $purchase_token;
	
	$amount = $total;
	
	$product_names = $data['product_names'];
	
	
	
	
	
	/* Razorpay */
	
	$log_detailer = DB::table('users')
		->where('id', '=', $log_id)
		->get();
	 
	 
	 include(app_path() . '/razorpay-php/Razorpay.php');
	 
	 $api = new Api($setts[0]->razorpay_key_id, $setts[0]->razorpay_key_secret);
	 
	 $razor_amount = $amount;
    
	 $receipt = rand(11111,99999);

		$orderData = [
			'receipt'         => $receipt,
			'amount'          => $razor_amount * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture
		];
	 
    $razorpayOrder = $api->order->create($orderData);
	
	$razorpayOrderId = $razorpayOrder['id'];
	
	Session::put('razorpay_order_id', $razorpayOrderId);
	
	$displayAmount = $razor_amount = $orderData['amount'];
	
	$displayCurrency = $setts[0]->site_currency;
	
	$details_namer = $bill_firstname.' '.$bill_lastname;
	
	$razordata = [
			"key"               => $setts[0]->razorpay_key_id,
			"amount"            => $razor_amount,
			"name"              => $bill_firstname,
			"description"       => $bill_companyname,
			"image"             => $url.'/local/images/media/'.$setts[0]->site_logo,
			"prefill"           => [
			"name"              => $details_namer,
			"email"             => $log_detailer[0]->email,
			"contact"           => $log_detailer[0]->phone,
			],
			"notes"             => [
			"address"           => $bill_address,
			"merchant_order_id" => $purchase_token,
			],
			"theme"             => [
			"color"             => "#F37254"
			],
			"order_id"          => $razorpayOrderId,
		];
		
		
			/*$razordata['display_currency']  = 'INR';*/
			$razordata['display_amount']    = $razor_amount;
		    
		
		   $json_value = json_encode($razordata);


	 
	 
	 
	 
	 
	 /* Razorpay */
	
	
	
	
	
	
	
	
	
	
	
	
	
	   $ddata = array('amount' => $amount, 'currency' => $currency, 'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'order_no' => $order_no, 'payment_type' => $payment_type, 'product_names' => $product_names, 'json_value' => $json_value);
            return view('payment-details')->with($ddata);
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	
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
