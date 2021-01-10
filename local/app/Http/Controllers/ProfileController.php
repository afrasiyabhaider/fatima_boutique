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

class ProfileController extends Controller
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
    public function avigher_shop_comment(Request $request)
	{
	   $datta = $request->all();
	   
	   $shop_user_id = $datta['shop_user_id'];
	   $log_user_id = $datta['log_user_id'];
	   $msg_text = $datta['msg_text'];
	   $submit_data = date('Y-m-d H:i:s');
	   
	   if(!empty($datta['msg_text']))
	   {
	      DB::insert('insert into shop_comments (shop_user_id,log_user_id,comments,submit_date) values (?, ?, ?, ?)', [$shop_user_id,$log_user_id,$msg_text,$submit_data]);
	   }
	   
	   return back();
	}
	
	public function avigher_view_shop()
	{
	   $id="";
	   $slug="";
	   $data = array('id' => $id, 'slug' => $slug);
	   return view('seller');
	} 
	 
	public function avigher_singleshop($id,$slug)
	{
	
	
	    $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		
		$shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->where('shop_id','=',$id)
		         ->get();
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				->where('shop_id','=',$id)
		         ->count();
				 
		
		
		
		
		
		
					 
				 if(!empty($shop_view_count))
				 {
		            $view_gallery =  DB::table('shop_gallery')
		         	 ->where('user_id', '=', $shop_view[0]->user_id)
					 ->where('token', '=', $shop_view[0]->token)
					 ->get();
					 
					 $view_gallery_count =  DB::table('shop_gallery')
		         	 ->where('user_id', '=', $shop_view[0]->user_id)
					 ->where('token', '=', $shop_view[0]->token)
					 ->count();
					}		 
				 
				 
		$data = array('shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'site_setting' => $site_setting ,'view_gallery' => $view_gallery, 'view_gallery_count' => $view_gallery_count);
	    return view('seller')->with($data);
	} 
	
	
	
	
	public function avigher_contact_seller(Request $request)
	{
	
	   $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	
	   $data = $request->all();
	   $name = $data['name'];
	   
	   $mesg = $data['message'];
	   
	   $url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$shop_user_id = $data['shop_user_id'];
		$seller_details = DB::table('users')
		 ->where('id', '=', $shop_user_id)
		 ->get();
		
		$shop_id = $data['shop_id'];
		$slug = $seller_details[0]->post_slug;
		
		$seller_email = $seller_details[0]->email;
		$user_email = $data['email'];
		
		$data = [
            'shop_id' => $shop_id, 'slug' => $slug, 'url' => $url, 'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name, 'user_email' => $user_email, 'mesg' => $mesg, 'seller_email' => $seller_email
        ];
		
		
		Mail::send('seller_contactmail', $data , function ($message) use ($user_email,$seller_email,$name)
        {
            $message->subject('Contact Seller');
			
            $message->from($user_email, $name);

            $message->to($seller_email);

        }); 
		
		
		
		return back()->with('success', 'Thanks for contact us');
		
		
	
	 }
	
	
}
