<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use URL;
use Stripe;
use Stripe_Charge;

class StripeController extends Controller
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
    
	
	public function avigher_shop_stripe(Request $request) 
	{
	
	
	
	$data = $request->all();
		$cid = $data['cid'];
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		if($setts[0]->stripe_mode=="test") 
		{
			$secretkey = $setts[0]->test_secret_key;
		}
		else if($setts[0]->stripe_mode=="live")
		{
			$secretkey = $setts[0]->live_secret_key;
		}
		
		try {	
		
		include(app_path() . '/Stripe/lib/Stripe.php');
		Stripe::setApiKey($secretkey); //Replace with your Secret Key
		
		$charge = Stripe_Charge::create(array(
			"amount" => $_POST['amount'],
			"currency" => $_POST['currency_code'],
			"card" => $_POST['stripeToken'],
			"description" => $_POST['item_name']
		));
		
		
		
		$stripe_token = $_POST['stripeToken'];
		}

		catch(Stripe_CardError $e) {
			
		}



		catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API

		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)

		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		} catch (Stripe_Error $e) {

		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		} catch (Exception $e) {

		  // Something else happened, completely unrelated to Stripe
		}
		
		
		
		
		
		 $orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed', 'stripe_token' => $stripe_token]);
		 $checkoutupdate = DB::table('product_checkout')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed', 'stripe_token' => $stripe_token]);
		
			
			
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
		
						
						
		
	  
	  /*if(!empty($get_viewr))
	  {
	  
	  $get_stock = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		
		->get();
		
		foreach($get_stock as $stocker)
		{
		   
		    $checker_get= DB::table('product')
	               ->where('prod_id','=',$stocker->prod_id)
				  
		           ->get();
				   
				 $stock_value = $stocker->quantity;  
		         $count_qty = $checker_get[0]->prod_available_qty - $stock_value;
				 
		DB::update('update product set prod_available_qty="'.$count_qty.'" where prod_status="1" and prod_id = ?', [$stocker->prod_id]);				
		DB::update('update product set prod_available_qty="'.$count_qty.'" where prod_status="1" and parent = ?', [$stocker->prod_id]); 
		
		}
		
	  
	  }*/
	  
	  	
		
					
		
		
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
		 
				
				
		
		
		$data = array('stripe_token' => $stripe_token);
		return view('stripe_shop_success')->with($data);
		
	
	
	
	
	
	
	
	
	
	
	
	}
   
   
   
  
	
	public function avigher_stripe(Request $request) 
	{
		$data = $request->all();
		$cid = $data['cid'];
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		if($setts[0]->stripe_mode=="test") 
		{
			$secretkey = $setts[0]->test_secret_key;
		}
		else if($setts[0]->stripe_mode=="live")
		{
			$secretkey = $setts[0]->live_secret_key;
		}
		
		try {	
		
		include(app_path() . '/Stripe/lib/Stripe.php');
		Stripe::setApiKey($secretkey); //Replace with your Secret Key
		
		$charge = Stripe_Charge::create(array(
			"amount" => $_POST['amount'],
			"currency" => $_POST['currency_code'],
			"card" => $_POST['stripeToken'],
			"description" => $_POST['item_name']
		));
		
		
		
		$stripe_token = $_POST['stripeToken'];
		}

		catch(Stripe_CardError $e) {
			
		}



		catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API

		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)

		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		} catch (Stripe_Error $e) {

		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		} catch (Exception $e) {

		  // Something else happened, completely unrelated to Stripe
		}
		
		
		
		
		
		$booking = DB::table('donatenow')
              
			   ->where('orderno', '=', $cid)
			   
                ->get();
				
		
		
		
		
		 $bookingupdate = DB::table('donatenow')
						->where('orderno', '=', $cid)
						->update(['payment_status' => 'Confirmed', 'stripe_token' => $stripe_token]);
						
		 $getdonate = DB::table('donatenow')
              
			       ->where('orderno', '=', $cid)
			   
                   ->get();				
						
				$name = $getdonate[0]->name;
				$email = $getdonate[0]->email;
				$phone = $getdonate[0]->phone;			
				$amount = $getdonate[0]->amount;
				$msg = $getdonate[0]->message;		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'msg' => $msg, 'phone' => $phone, 'amount' => $amount, 'url' => $url
        ];
		
		Mail::send('donate_email', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Donation Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($admin_email);

        }); 
		
		
		 
				
				
		
		
		$data = array('stripe_token' => $stripe_token);
		return view('stripe-success')->with($data);
		
	}
	
	
	
	
	
	
	
	
}
