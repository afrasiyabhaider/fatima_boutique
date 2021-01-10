<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use URL;
use Mail;

class BlogController extends Controller
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
    public function avigher_index()
    {
       
		


		
		
		
		
		
        
		$blogs = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->orderBy('post_id', 'desc')->get();
		
		$blog_count = DB::table('post')
		         	  ->where('post_status', '=', '1')
				 	  ->where('post_type', '=', 'blog')
					  ->count();
		
		$popular_blog = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->orderBy('post_id', 'desc')
				 ->take(5)
				 ->get();
				 
		$popular_blog_cnt = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->orderBy('post_id', 'desc')
				 ->take(5)
				 ->count();		 
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();		 
      
		
		$data = array('blogs' => $blogs, 'blog_count' => $blog_count, 'popular_blog' => $popular_blog, 'popular_blog_cnt' => $popular_blog_cnt, 'setts' => $setts);
            return view('blog')->with($data);
    }
	
	
	
	
	public function avigher_blog_comment(Request $request)
	{
	
	   $data = $request->all();
		
		$name = $data['name'];
		$email = $data['email'];
		
		$msg = $data['msg'];
		$post_comment_type = $data['post_comment_type'];
		
		
		$post_parent = $data['post_parent'];
		
		$post_type = $data['post_type'];
		
		$post_user_id = $data['post_user_id'];
		
		
		$comment_date = date("Y-m-d H:i:s");
		
		$status = 0;
		
		
		/*$count = DB::table('post')
		         ->where('post_title', '=', $name)
				 ->where('post_comment_type', '=', $post_comment_type)
				 ->where('post_type', '=', $post_type)
				 ->where('post_status', '=', $status)
				 ->count();
		if($count==0)
		{*/
		
		
		/* slug */
		$str_one = strtolower($name);
		$str_two = preg_replace("/[^a-z0-9_\s-]/", "", $str_one);
		$str_three = preg_replace("/[\s-]+/", " ", $str_two);
		$post_slug = preg_replace("/[\s_]/", "-", $str_three);
		/* end slug */
		
		
		DB::insert('insert into post (	post_title,post_slug,post_desc,post_comment_type,post_type,post_parent,post_email,post_user_id,post_date,post_status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name,$post_slug,$msg,$post_comment_type,$post_type,$post_parent,$email,$post_user_id,$comment_date,$status]);
		/*}*/
		
		
		
		
		$getevents = DB::table('post')
						   ->where('post_id', '=', $post_parent)
						   ->where('post_type', '=', 'blog')
						   ->where('post_status', '=', '1')
						   ->get();
		
		$blog_title = $getevents[0]->post_title;
		$blog_slug = $getevents[0]->post_slug;
			
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
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'msg' => $msg, 'blog_title' => $blog_title, 'blog_slug' => $blog_slug, 'url' => $url
        ];
		
		Mail::send('commentemail', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Comment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($admin_email);

        }); 
		
		
		
		
		
		
		
		return redirect()->back()->with('message', 'Thanks for your comment! It has been approved. To view the post');
		
		
		
	
	}
	
	
	
	
	
	
	
	public function avigher_singlepost($id)
    {
	
	$post = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				  ->where('post_slug', '=', $id)
				  ->get();
				  
				  
	$post_count = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				  ->where('post_slug', '=', $id)
				  ->count();
				  
	$previous =  DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('post_title', '<', $post[0]->post_title)
	             ->max('post_title');
				 
				 
	$previous_link = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				  ->where('post_title', '=', $previous)
				  ->get();
				  			 
				 
	$next =  DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('post_title', '>', $post[0]->post_title)
	             ->min('post_title');	
				 
				 
	$next_link = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				  ->where('post_title', '=', $next)
				  ->get();			 
				 		 

    $popular_blog = DB::table('post')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->orderBy('post_date', 'desc')
				 ->take(5)
				 ->get();
   		  
				  		  
				  
	$data = array('post' => $post, 'post_count' => $post_count, 'previous' => $previous, 'previous_link' => $previous_link, 'next_link' => $next_link, 'next' => $next, 'popular_blog' => $popular_blog);
	 return view('blog')->with($data);
	
	
	}
	
	
	
	
	
	
}
