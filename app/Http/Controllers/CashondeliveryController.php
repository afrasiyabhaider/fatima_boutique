<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use File;
use Image;
use URL;
use Mail;
use Carbon\Carbon;

class CashondeliveryController extends Controller
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
    
	
	
	public function avigher_showpage() {

      return view('cash-on-delivery');
   }
   
   
   
  
	public function avigher_success(Request $request)
	{
	
	    $data = $request->all();
		
		$cid = $data['cid'];
		
		
		
		$view_cnt = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->count();
		
		if(!empty($view_cnt))
		{
				$view_orders = DB::table('product_orders')
								->where('purchase_token', '=', $cid)
								->where('status', '=', 'pending')
								->get();
				
				foreach($view_orders as $views)
				{
				
				$ord_id = $views->ord_id;
				
				$subtotal = $views->quantity * $views->price;
				
				$total = $subtotal + $views->shipping_price;
				
				
				DB::update('update product_orders set subtotal="'.$subtotal.'",total="'.$total.'" where status="pending" and ord_id = ?', [$ord_id]);
				
				
				
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
		
		Mail::send('cashon_email', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Order Details Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($admin_email);

        }); 
		
		
		
		
		Mail::send('cashon_email', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Order Details Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($email);

        }); 
		
				
				
				
				
						
		
		}
		
		
		
		
		$datas = array('cid' => $cid);
      return view('cash-on-delivery')->with($datas);
	
	
	}
	
	
	
	
	
	
}
