<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use URL;
use Mail;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
	 
	public function avigher_completed_withdraw()
	{
	
	     $completed_count = DB::table('product_withdraw')
		               ->where('withdraw_status','=','completed')
		                ->orderBy('wid','desc')
					   ->count();
	   
	   
	    $completed_view = DB::table('product_withdraw')
		               ->where('withdraw_status','=','completed')
		                ->orderBy('wid','desc')
					   ->get();
					   
		$set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();			   

        return view('admin.completed_withdraw', ['completed_count' => $completed_count, 'completed_view' => $completed_view, 'site_setting' => $site_setting]);
	
	
	
	} 
	 
	 
    public function avigher_pending_withdraw()
    {
       $pending_count = DB::table('product_withdraw')
		               ->where('withdraw_status','=','pending')
		                ->orderBy('wid','desc')
					   ->count();
	   
	   
	    $pending_view = DB::table('product_withdraw')
		               ->where('withdraw_status','=','pending')
		                ->orderBy('wid','desc')
					   ->get();
					   
		$set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();			   

        return view('admin.pending_withdraw', ['pending_count' => $pending_count, 'pending_view' => $pending_view, 'site_setting' => $site_setting]);
    }
	
	
	
	public function avigher_pending_withdraw_data($id)
	{
	
	   $wid = base64_decode($id);
	    $pending_view_count = DB::table('product_withdraw')
		               ->where('withdraw_status','=','pending')
					   ->where('wid','=',$wid)
		               ->count();
					   
		if(!empty($pending_view_count))
		{
		
		 $pending_view = DB::table('product_withdraw')
		               ->where('withdraw_status','=','pending')
					   ->where('wid','=',$wid)
		               ->get();
					   
		$withdraw_amount = $pending_view[0]->withdraw_amount;
	    $withdraw_type = $pending_view[0]->withdraw_payment_type;
		$paypal_id = $pending_view[0]->paypal_id;			   
		$stripe_id = $pending_view[0]->stripe_id;
		$bank_acc_no = $pending_view[0]->bank_account_no;
		$bank_name = $pending_view[0]->bank_info;	
		$ifsc_code = $pending_view[0]->bank_ifsc;
		
		
		$user_detail = DB::table('users')
		               ->where('id','=',$pending_view[0]->user_id)
		               ->get();
		
		
		$set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setting[0]->site_logo;
		
		$site_name = $setting[0]->site_name;
		
		$currency = $setting[0]->site_currency;
		
		$user_email = $user_detail[0]->email;
		$username = $user_detail[0]->name;
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->get();
		
		$admin_email = $admindetails[0]->email;
		
		
		$datas = [
            'withdraw_amount' => $withdraw_amount, 'withdraw_type' => $withdraw_type, 'paypal_id' => $paypal_id, 'stripe_id' => $stripe_id,
			'bank_acc_no' => $bank_acc_no, 'bank_name' => $bank_name, 'ifsc_code' => $ifsc_code, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'username' => $username, 'user_email' => $user_email
        ];
		
		
		
		DB::update('update product_withdraw set withdraw_status="completed" where wid = ?', [$wid]);
			
			
			Mail::send('admin.withdraw_email', $datas , function ($message) use ($admin_email,$user_email,$username)
        {
            $message->subject('Withdrawal request is approved');
			
            $message->from($admin_email,'Admin');

            $message->to($user_email);
			

        }); 
			
		
		
					   
		
		
		
		}			   
					   
					   
					   
	
	
	}
	
	
	
	
	
}