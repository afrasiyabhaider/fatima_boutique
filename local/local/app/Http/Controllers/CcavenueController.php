<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use URL;


class CcavenueController extends Controller
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
    
	
	
	
	public function avigher_shop_ccavenue(Request $request) 
	{
	
	
	include(app_path() . '/Ccavenue/Crypto.php');
	
	$data = $request->all();
		$tid = $data['tid'];
		$order_id = $data['order_id'];
		$merchant_id = $data['merchant_id'];
		$amount = $data['amount'];
		$currency = $data['currency'];
		$redirect_url = $data['redirect_url'];
		$cancel_url = $data['cancel_url'];
		$language = $data['language'];
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		$working_key=$setts[0]->ccavenue_working_key;
		$access_code=$setts[0]->ccavenue_access_code;
		$merchant_data='';
		
		foreach ($data as $key => $value){
			$merchant_data.=$key.'='.$value.'&';
		}
		
		
		$encrypted_data=eencrypt($merchant_data,$working_key);
		
		$production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
		
		
		
		
				
				
		
		
		$dada = array('tid' => $tid, 'order_id' => $order_id, 'merchant_id' => $merchant_id, 'amount' => $amount, 'currency' => $currency, 'redirect_url' => $redirect_url, 'cancel_url' => $cancel_url, 'language' => $language, 'production_url' => $production_url);
		return view('ccavRequestHandler')->with($dada);
		
	
	
	
	
	
	
	
	
	
	
	
	}
   
   
   
  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function avigher_ccavenue_success(Request $request) 
	{
	
	
	include(app_path() . '/Ccavenue/Crypto.php');
	  $data = $request->all();
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		$workingKey=$setts[0]->ccavenue_working_key;		
	$encResponse=$_POST["encResp"];			
	$rcvdString=ddecrypt($encResponse,$workingKey);		
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	
		
	$cid = "";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3) {	$order_status=$information[1]; }
		if($i==1) {	$cid =$information[1]; }
		
	}	
		
		
		
		
		
	if($order_status==="Success")
	{
		
		 $orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed']);
		 $checkoutupdate = DB::table('product_checkout')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed']);
		
			
			
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
					
				
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
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
		 
				
		}
		
				
		
		
		$datta = array('order_status' => $order_status);
		return view('ccavResponseHandler')->with($datta);
		
	
	
	
	
	
	
	
	
	
	
	
	}
   
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
