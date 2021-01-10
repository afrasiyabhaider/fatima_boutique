<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Mail;
use Session;
use Carbon\Carbon;
use Auth;
use URL;

class IndexController extends Controller
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
	 
	public function confirmation($it)
	{
		
		DB::update('update users set confirmation="1" where confirm_key="'.$it.'"');
		return view('confirmemail');
		
	}
	public function view_former()
	{
		return view('confirmemail');
	}
	
	
	
	public function resend_email($email_address)
	{
	
	$email_id = base64_decode($email_address);
	
	
	$confirm_count = DB::table('users')
		               ->where('email', '=', $email_id)
					   ->where('delete_status','=','')
					   ->where('confirmation','=',0)
					   ->where('provider','=','')
	                   ->count();
	if($confirm_count == 1)
	{
	
	    $get_data = DB::table('users')
		               ->where('email', '=', $email_id)
					   ->where('delete_status','=','')
					   ->where('confirmation','=',0)
					   ->where('provider','=','')
	                   ->get();
					   
					   
		$keyval = $get_data[0]->confirm_key;
		$name = $get_data[0]->name;
		$email = $email_id;
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		$admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = $admin_email[0]->email;
		
		$adminname = $admin_email[0]->name;
		
		$datas = [
            'name' => $name, 'email' => $email, 'keyval' => $keyval, 'site_logo' => $site_logo,
			'site_name' => $site_name, 'url' => $url
        ];
		
		Mail::send('confirm_mail', $datas , function ($message) use ($adminemail,$adminname,$email)
        {
		
		
		
		
            $message->subject('Email Confirmation for Registration');
			
            $message->from($adminemail, $adminname);

            $message->to($email);

        }); 
		
		
		
					   
		return redirect('login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');			   
					   
	
	
	
	}
	else
	{
        
        return redirect('login')->with('error', 'Invalid input fields. Please try again');
    }
	
	
	
	
	
	
	}
	
	
	
	 
	 
	public function avigher_all_vendors()
	{
	    $user_count = DB::table('users')
						->where('delete_status', '=', '')
						->where('admin', '=', 2)
						->orderBy('id','desc')
		                ->count();
		$user_view = DB::table('users')
						->where('delete_status', '=', '')
						->where('admin', '=', 2)
						->orderBy('id','desc')
		                ->get();
		$data = array('user_count' => $user_count,	'user_view' => $user_view);			
										
	    return view('vendors')->with($data);
	}
	
	 
    public function avigher_index()
    {
       
		

     
		
		
		
		
		
		
		$testimonials = DB::table('testimonials')->orderBy('id', 'desc')->get();
		$testimonials_cnt = DB::table('testimonials')->orderBy('id', 'desc')->count();
		
        $slideshow = DB::table('slideshow')->orderBy('id', 'asc')->get();
		$slideshow_cnt = DB::table('slideshow')->orderBy('id', 'asc')->count();
		
		$about = DB::table('pages')
		->where('page_id', '=', '1')
		->get();
		
		$testimonials = DB::table('testimonials')->orderBy('id', 'desc')->take(3)->get();
		$blogs = DB::table('post')
				->where('post_media_type', '=', 'image')
				->where('post_type', '=', 'blog')
				->orderBy('post_id', 'desc')->take(5)->get();
				
		$blogs_cnt = DB::table('post')
				->where('post_media_type', '=', 'image')
				->where('post_type', '=', 'blog')
				->orderBy('post_id', 'desc')->take(5)->count();		
				
			
			$banners_count = DB::table('banners')->orderBy('id','asc')->count();
			
			$banners = DB::table('banners')->where('slide_status','=',1)->orderBy('id','desc')->get();			
			
			$box_content_count = DB::table('home_box_content')->where('status','=',1)->orderBy('id','desc')->count();
			
			$box_content = DB::table('home_box_content')->where('status','=',1)->orderBy('id','desc')->get();
			
			
			$home_banner_one_count = DB::table('home_banners')->where('slide_status','=',1)->where('id', '=', '1')->count();	
			$home_banner_one = DB::table('home_banners')->where('slide_status','=',1)->where('id', '=', '1')->get();
			$home_banner_two_count = DB::table('home_banners')->where('slide_status','=',1)->where('id', '=', '2')->count();			
			$home_banner_two = DB::table('home_banners')->where('slide_status','=',1)->where('id', '=', '2')->get();
			
		
					 
					 
		
      $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		
		$viewcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_featured','=','yes')
					   ->orderBy('prod_id','desc')
					   ->count();
		
		 $viewproduct = DB::table('product')
					  ->where('delete_status','=','')
					  ->where('prod_status','=',1)
					  ->where('prod_featured','=','yes')
					  ->orderBy('prod_id','desc')
					   ->get();	
					   
		
		
		$latestcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->take(5)
					   ->orderBy('prod_id','desc')
					   ->count();		   
			
			$latest_product = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->take(5)
					   ->orderBy('prod_id','desc')
					   ->get();	
		
		
		
					   
					   
					   
		$viewcount_new = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->orderBy('prod_id','desc')
					   ->count();
		
		 $viewproduct_new = DB::table('product')
					  ->where('delete_status','=','')
					  ->where('prod_status','=',1)
					  ->orderBy('prod_id','desc')
					   ->get();				   
					   
					   
					   
					   
		$cate_cnt = DB::table('category')
             ->where('delete_status','=','')
			 ->where('status','=',1)
			 ->take(4)
		     ->orderBy('id','asc')
			 ->count();
		if(!empty($cate_cnt))
		{			 
		$cate_get = DB::table('category')
					 ->where('delete_status','=','')
					 ->where('status','=',1)
					 ->take(4)
					 ->orderBy('id','asc')
					 ->get();				 					
		}
			   
					   
		
		
		$viewcount_rating = DB::table('product_rating')
					      ->groupBy('user_id') 
					      ->orderBy('rate_id','desc')
						  ->take(5)
					      ->count();
		$view_rating = DB::table('product_rating')
					      ->groupBy('user_id') 
					      ->orderBy('rate_id','desc')
					      ->take(5)
						  ->get();
		
		
		$data = array('testimonials' => $testimonials, 'testimonials_cnt' => $testimonials_cnt, 'slideshow' => $slideshow, 'about' => $about,   'testimonials' => $testimonials, 'blogs' => $blogs, 'blogs_cnt' => $blogs_cnt, 'site_setting' => $site_setting, 'slideshow_cnt' => $slideshow_cnt, 'banners_count' => $banners_count, 'banners' => $banners, 'home_banner_one' => $home_banner_one, 'home_banner_two' => $home_banner_two, 'home_banner_one_count' => $home_banner_one_count, 'home_banner_two_count' => $home_banner_two_count, 'viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'cate_cnt' => $cate_cnt, 'cate_get' => $cate_get, 'viewcount_new' => $viewcount_new, 'viewproduct_new' => $viewproduct_new, 'viewcount_rating' => $viewcount_rating, 'view_rating' => $view_rating, 'latestcount' => $latestcount, 'latest_product' => $latest_product, 'box_content' => $box_content, 'box_content_count' => $box_content_count);
            return view('index')->with($data);
    }
	
	
	
	
	
	
	public function avigher_subscribe(Request $request) 
	{
        $data = $request->all();
		$email=$data['email'];
		 $site_logo=$data['site_logo'];
		 
		 $site_url=$data['site_url'];
		 
		 $activated = $data['activated'];
		
		$site_name=$data['site_name'];
		$count = DB::table('newsletter')
		 ->where('email', '=', $email)
		
		 ->count();
		 
	     if($count==0)
		 {
			 DB::insert('insert into newsletter (email,activated) values (?, ?)',[$email,$activated]);
			 $get = DB::table('newsletter')
               ->where('email', '=', $email)
			   ->where('activated', '=', $activated)
                ->get();
				$get_id = $get[0]->id;
			 
			 Mail::send('newsletter', ['email' => $email,
			 'site_logo' => $site_logo, 'site_name' => $site_name, 'activated' => $activated, 'site_url' => $site_url, 'get_id' => $get_id], function ($message)
         {
            $message->subject('Newsletter Subscribe');
			
            $message->from(Input::get('admin_email'), 'Admin');
			
			

            $message->to(Input::get('email'));

        });
			 
		 }
		 else
		 {
			 return redirect()->back()->with('message', 'This email address already subscribed');
		 }
		 
		 return redirect()->back()->with('message', 'You have successfully subscribed to the newsletter. You will receive a confirmation email in few minutes.');	 
		 
        
        
    }
	
	
	public function newsletter_activate($id)
	{
	   
	   $count = DB::table('newsletter')
		 ->where('id', '=', $id)
		 ->where('activated', '=', '0')
		 ->count();
		 
		 if($count == 1)
		 {
		    DB::update('update newsletter set activated="1" where id = ?', [$id]);
		Session::flash('message', 'Your subscription has been confirmed! Thank you!');
		return view('thankyou');
		 }
		 else
		 {
		    Session::flash('error', 'This email address already subscribed');
			return view('thankyou_error');
			
		 }
		 
	   /*return redirect()->back()->with('message', 'Your subscription has been confirmed! Thank you!');*/	
	   
	   
			
	}
	
	
	
}
