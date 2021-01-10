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

class BookingController extends Controller
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
    
	
	public function avigher_booking($shop_id,$service_id,$user_id)
    {
	
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				->where('shop_id','=',$shop_id)
		         ->count();
			 
				 
	$shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->where('shop_id','=',$shop_id)
		         ->get();
				 
	$subservice=DB::table('subservices')->where('subid', '=', $service_id)->get();
	$subservice_count=DB::table('subservices')->where('subid', '=', $service_id)->count();
				 
	$shop_services=DB::table('shop_services')
		 ->leftJoin('subservices', 'subservices.subid', '=', 'shop_services.service_id')
		 ->where('shop_services.user_id', '=', $user_id)->get();			 
			 
	$shop_services_count=DB::table('shop_services')
		 ->leftJoin('subservices', 'subservices.subid', '=', 'shop_services.service_id')
		 ->where('shop_services.user_id', '=', $user_id)->count();	
		 
	 $shop = DB::table('shop')
               ->where('shop_id', '=', $shop_id)
                ->get();	 
		 
	   
		
		$booking_days=$shop[0]->booking_upto;
		$cur_date=date("Y-m-d");
		$exp_date=date("Y-m-d",strtotime($cur_date.'+'.$booking_days.'days'));
		$open_time=$shop[0]->open_time;
		$close_time=$shop[0]->close_time;

		$working_days=$shop[0]->working_days;
		$days="";
		$select=explode("," , $working_days);
		$length=count($select);
		for($i=0;$i<$length;$i++)
		{
			$date_id=$select[$i];
			$days.="day==".$date_id;
			$days.="||";		
		}
		 $days=trim($days,"||");	 
		 	 
			 
	
	$data = array('shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'shop_services' => $shop_services, 'shop_services_count' => $shop_services_count, 'subservice' => $subservice, 'subservice_count' => $subservice_count, 'open_time' => $open_time, 'close_time' => $close_time, 'shop_id' => $shop_id, 'user_id' => $user_id, 'days' => $days, 'exp_date' => $exp_date, 'site_setting' => $site_setting);
	 return view('booking')->with($data);
	
	
	}
	
	
	
	
	public function avigher_checkout()
	{
	
	    $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	$token = csrf_token();
	$count =DB::table('booking')
		            ->where('payment_status', '=', 'pending')
					->where('token', '=', $token)
					->where('book_user_id', '=', Auth::user()->id)
					->orderBy('book_id','desc')
                    ->count();
		
	if(!empty($count))
	{
	
	$getdata = DB::table('booking')
		            ->where('payment_status', '=', 'pending')
					->where('token', '=', $token)
					->where('book_user_id', '=', Auth::user()->id)
					->orderBy('book_id','desc')
                    ->get();
	$newshop = $getdata[0]->shop_user_id;				
					
	$ser_id=$getdata[0]->services_id;
			$sel=explode("," , $ser_id);
			$length=count($sel);
			$ser_name="";
			$sum="";
			$price="";
			
		for($i=0;$i<$length;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$fet2 = DB::table('shop_services')
								 ->where('service_id', '=', $id)
								 ->where('user_id', '=', $newshop)
								 ->get();
				$price.=$fet2[0]->price.'<br>';
				$price.=",";	
				
								
				
				
				$ser_name=trim($ser_name,",");
				$price=trim($price,",");	
				$sum+=$fet2[0]->price;
				
				
			}
				
	
	
	
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();


		/*if($setts[0]->commission_mode=="fixed")
				{
					$sum=$sum+$setts[0]->commission_amt;
				}
				else if($setts[0]->commission_mode=="percentage")
				{
					$sum1=($setts[0]->commission_amt * $sum) / 100;
					$sum=$sum+$sum1;
				}
				else
				{
					$sum+=$fet2[0]->price;
				} */
				
				$commission_amt = $setts[0]->commission_amt;
				$commission_mode = $setts[0]->commission_mode;
				
				$currency = $setts[0]->site_currency;
				
				
		$shop = DB::table('shop')
               ->where('shop_id', '=', $getdata[0]->shop_id)
                ->get();		
				
		$booking_time=$getdata[0]->book_time;
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}



	 $admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
				
				$userid=Auth::user()->id;
				
		$user_email = DB::table('users')
		 ->where('id', '=', $userid)
		 
		 ->get();		
				
	   $useremail = $user_email[0]->email;
	   $usernamer = $user_email[0]->name;
	   $userphone = $user_email[0]->phone;
	   
	   $adminemail = $admin_email[0]->email;
	   
	   $shopid = $getdata[0]->shop_id;
	   
	   $payment_mode = $getdata[0]->payment_type;
	   
	   $shoptbl = DB::table('shop')
		->where('shop_id', '=', $shopid)
		->get();
	   $selleremail = $shoptbl[0]->email;
	
	
	$book_address = $getdata[0]->book_address;
	$book_city = $getdata[0]->book_city;
	$book_pincode = $getdata[0]->book_pincode;
	
					
	
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				->where('shop_id','=',$getdata[0]->shop_id)
		         ->count();
			 
				 
	$shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->where('shop_id','=',$getdata[0]->shop_id)
		         ->get();
				 
			 
				 
				 
	}
	else if(empty($count))
	{
	   $shop_view_count = "";
	   $shop_view="";
	}
	  
	  $data = array( 'shop_view_count' => $shop_view_count, 'shop_view' => $shop_view, 'getdata' => $getdata, 'final_time' => $final_time, 'shop' => $shop, 'ser_name' => $ser_name, 'price' => $price, 'commission_amt' => $commission_amt, 'commission_mode' => $commission_mode, 'currency' => $currency, 'sum' => $sum, 'adminemail' => $adminemail,
	   'useremail' => $useremail, 'usernamer' => $usernamer, 'userphone' => $userphone, 'selleremail' => $selleremail, 'payment_mode' => $payment_mode, 'setts' => $setts, 'book_address' => $book_address, 'book_city' => $book_city, 'book_pincode' => $book_pincode);
	
	 
	 
	 return view('checkout')->with($data);
	}
	
	
	
	
	
	public function avigher_submit_checkout(Request $request) {
		 $datas = $request->all();
		 
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		$prices = $datas['price'];
		
		
		$sum = $datas['price'];
		
		$admin_email = $datas['admin_email'];
		$user_email =$datas['user_email'];
		
		
			 
		 
		 $usernamer = $datas['usernamer'];
	$userphone = $datas['userphone'];
		
		$currency=$datas['currency'];
		
		 $seller_email =$datas['seller_email'];
		
		 $token =csrf_token();
		 $id = Auth::user()->id;
	   $userdetails = DB::table('users')
		 ->where('id', '=', $id)
		 ->get();
		
		$getbookid = DB::table('booking')
						->where([['book_user_id', '=', $id],['payment_status', '=', 'pending'],['token', '=', $token]])
						->orderBy('book_id','desc')
						->limit(1)->offset(0)
						->get();
				$bookid = $getbookid[0]->book_id;
				
		$bookingupdate = DB::table('booking')
						->where([['book_user_id', '=', $id],['token', '=', $token],['book_id', '=', $bookid] ])
						->update(['total_amount' => $sum]);

        
$booking = DB::table('booking')
               ->where('token', '=', $token)
			   ->where('book_user_id', '=', $id)
			    ->where('payment_status', '=', 'pending')
			   ->orderBy('book_id','desc')
                ->get();



		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";		
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$fet2 = DB::table('shop_services')
								 ->where('service_id', '=', $id)
								 ->get();
				$price.=$fet2[0]->price.'<br>';
				$price.=",";	
				
								
				
				
				$ser_name=trim($ser_name,",");
				$price=trim($price,",");	
				$sum+=$fet2[0]->price;
			}
            
			$booking_time=$booking[0]->book_time;
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}	
			
		/*  user email    */
		
		 
		 
				
		$booking_id=$booking[0]->book_id;		
		$booking_date=$booking[0]->book_date;
		$total_amt=$booking[0]->total_amount;
		$currency = $setts[0]->site_currency;
		
		$payment_mode=$booking[0]->payment_type;
		
		
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$paypal_id = $setts[0]->paypal_id;
		
		$paypal_url =$setts[0]->paypal_url;
		
		
		Mail::send('book_usermail', ['booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name], function ($message)
        {
            $message->subject('Booking Details');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('user_email'));

        }); 
		
		
		

      
	   
	   
	   
	   Mail::send('book_adminmail', ['booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone], function ($message)
        {
            $message->subject('New Order Received');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('admin_email'));

        }); 
		
		
	
	
	
	Mail::send('book_sellermail', ['booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name,  'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone], function ($message)
        {
            $message->subject('New Order Received');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('seller_email'));

        }); 
		
	
	
	    $admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		$admin_mail = $admin_email[0]->email;
		
		$service_name=str_replace("<br>",",",$datas['service_name']);
		$service_names = rtrim($service_name,",");
		$booking_date=$datas['booking_date'];
	 
	  $data = array('prices' => $prices, 'currency' => $currency, 'service_names' => $service_names, 'booking_date' => $booking_date, 'paypal_id' => $paypal_id,
	  'paypal_url' => $paypal_url, 'booking_id' => $booking_id, 'payment_mode' => $payment_mode, 'admin_mail' => $admin_mail);
	  
	  if($booking[0]->payment_type!="localbank")
	  {
      return view('payment')->with($data);
	  }
	  else if($booking[0]->payment_type=="localbank")
	  {
	  return redirect('bank_payment/'.$booking[0]->token.'/'.$booking[0]->book_id);
	  }
   }
   
	
	
	
	
	public function avigher_bank_details($token,$book_id)
	{
	
	
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();

	
	$id = Auth::user()->id;
	
	
				
				
	$booking_count = DB::table('booking')
               ->where('token', '=', $token)
			   ->where('book_user_id', '=', $id)
			   ->where('book_id', '=', $book_id)
			    ->where('payment_status', '=', 'pending')
				->where('payment_type','=','localbank')
			    ->count();
	if(!empty($booking_count))
	{			
		$booking = DB::table('booking')
               ->where('token', '=', $token)
			   ->where('book_user_id', '=', $id)
			   ->where('book_id', '=', $book_id)
			    ->where('payment_status', '=', 'pending')
				->where('payment_type','=','localbank')
			    ->get();

   

		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";		
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname;
				$ser_name.=",";				 
				
				
				
				$fet2 = DB::table('shop_services')
								 ->where('service_id', '=', $id)
								 ->get();
				$price.=$fet2[0]->price.'<br>';
				$price.=",";	
				
								
				
				
				
				$price=trim($price,",");	
				$sum+=$fet2[0]->price;
			}
            
			$booking_time=$booking[0]->book_time;
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}	
			
		
	
	
	$booking_id=$booking[0]->book_id;		
		$booking_date=$booking[0]->book_date;
		$prices = $booking[0]->total_amount;
		
		
		$service_names =rtrim($ser_name,",");
		
	
		
		}
   else
   {
     
	 $prices = "";
	 $service_names="";
	 $booking_date="";
	 $booking_count=0;
	 $booking_id="";
   }
   
   
   
		
		
		 $admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		$admin_mail = $admin_email[0]->email;
		 
				
		
		$currency = $setts[0]->site_currency;
		
		
		
      $data = array('prices' => $prices, 'currency' => $currency, 'service_names' => $service_names, 'booking_date' => $booking_date,'booking_id' => $booking_id, 'admin_mail' => $admin_mail, 'booking_count' => $booking_count);
	  
	   return view('bank_payment')->with($data);
	
	}
	
	
	
	public function avigher_bank_submit(Request $request) 
	{
	 $data = $request->all();
	 
	 $name = $data['name'];
	 $payment_date_sent = $data['payment_date_sent'];
	 $info = $data['info'];
	 $book_id = $data['book_id'];
	 
	 DB::update('update booking set bank_date_sent="'.$payment_date_sent.'",bank_additional_info="'.$info.'" where book_id="'.$book_id.'"');
	 
	 return back()->with('success', 'Thankyou! We received your information and will notify you once the order is created.');

	 
	 }
	
	
	
	
	
	
	
	public function avigher_bookingdata(Request $request) 
	{
       
        
       $data = $request->all();
	   
	   $services=$data['services'];
		$get_service="";
		foreach($services as $getservice)
		{
			$get_service .=$getservice.',';
		}
		$view_service=rtrim($get_service,",");
		$open_time=$data['open_time'];
		$close_time=$data['close_time'];
		$shop_id=$data['shop_id'];
		$services_id=$data['services_id'];
		$book_date=$data['datepicker'];
		$time=$data['time'];
		$book_address=$data['book_address'];
		$book_city=$data['book_city'];
		$book_pincode=$data['book_pincode'];
		$book_note = $data['book_note'];
		$shipping = $data['shipping'];
		$payment_type=$data['payment_type'];
		
		$status ='pending';
		
		
		$sumbit_date=date("Y-m-d");
		
	
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		$currency=$site_setting[0]->site_currency;
		$token=$data['_token'];
		$shop_user_id = $data['shop_user_id'];
		$user_id = $data['user_id'];
		$user_email = $data['user_email'];
		
		
		$count =DB::table('booking')
		            ->where('payment_status', '=', 'pending')
					->where('token', '=', $token)
					->where('book_user_id', '=', $user_id)
					->orderBy('book_id','desc')
                    ->count();
					
		if(empty($count))
		{
		
		
		
		DB::insert('insert into booking (token,services_id,shop_id,shop_user_id,book_user_id,book_date,book_time,book_email,book_address,book_city,book_pincode,book_note,shipping_fee,payment_type,payment_status,submit_date) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$token,$view_service,$shop_id,$shop_user_id,$user_id,$book_date,$time,$user_email,$book_address,$book_city,$book_pincode,$book_note,$shipping,$payment_type,$status,$sumbit_date]);

		
		}
		else
		{
				
				
		DB::update('update booking set services_id="'.$view_service.'",shop_id="'.$shop_id.'",shop_user_id="'.$shop_user_id.'",book_date="'.$book_date.'",book_time="'.$time.'",book_address="'.$book_address.'",book_city="'.$book_city.'",book_pincode="'.$book_pincode.'",book_note="'.$book_note.'",shipping_fee="'.$shipping.'",payment_type="'.$payment_type.'",submit_date="'.$sumbit_date.'" where book_user_id ="'.$user_id.'" and payment_status="pending" and token="'.$token.'"');		
				
				
			
			
		}			
		

	   
	   
	   return redirect('checkout');
	   
	   
	}
	
	 
	
	
}
