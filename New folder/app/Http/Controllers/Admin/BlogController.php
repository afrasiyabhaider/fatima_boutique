<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use URL;
use Mail;

class BlogController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $blog = DB::table('post')
		        ->where('post_type', '=' , 'blog')
				->where('post_status', '=' , '1')
		        ->orderBy('post_id','desc')
				->get();

        return view('admin.blog', ['blog' => $blog]);
    }
	
	
	public function status_comment($pid,$sid) 
	{
	    DB::update('update post set post_status="'.$sid.'" where post_id = ?',[$pid]);
		
		if($sid==1)
		{
		
		$getblog = DB::table('post')
						   ->where('post_id', '=', $pid)
						   ->where('post_type', '=', 'comment')
						   ->where('post_status', '=', '1')
						   ->get();
		
		$blog_title = $getblog[0]->post_title;
		$blog_slug = $getblog[0]->post_slug;
		$email = $getblog[0]->post_email;
		$type = $getblog[0]->post_comment_type;
		
		
		$orginal = $getblog[0]->post_parent;
		      $viewer = DB::table('post')
						   ->where('post_id', '=', $orginal)
						   ->get();
						   
						   $poster_title = $viewer[0]->post_title;
						   $poster_slug = $viewer[0]->post_slug;
		
			
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
            'site_logo' => $site_logo, 'site_name' => $site_name, 'email' => $email,  'poster_title' => $poster_title, 'poster_slug' => $poster_slug, 'url' => $url, 'type' => $type
        ];
		
		Mail::send('admin.commentemail', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Your comment has been approved');
			
            $message->from($admin_email, 'Admin');

            $message->to($email);

        }); 
		
		
		}
		
		
		
	 return back();
	}
	
	
	
	public function view_comment($blog,$comment,$id) 
	{
	    			  
					  
		if($blog=='blog')
		{			  
		$view_title = DB::table('post')
		              ->where('post_id', '=', $id)
					  ->where('post_status', '=', '1')
					  ->where('post_type', '=', 'blog')
					  ->where('post_comment_type', '=', '')
					  ->get();
					  $urlcomment = "blog";			  
		}
		if($blog=='sermons')
		{			  
		$view_title = DB::table('sermons')
		              ->where('id', '=', $id)
					  ->get();
					  $urlcomment = "sermons";			  
		}
		if($blog=='event')
		{			  
		$view_title = DB::table('post')
		              ->where('post_id', '=', $id)
					  ->where('post_status', '=', '1')
					  ->where('post_type', '=', 'event')
					  ->where('post_comment_type', '=', '')
					  ->get();
					  $urlcomment = "event";			  
		}			  
					  
		
		$view_comment = DB::table('post')
							 ->where('post_parent', '=', $id)
							 ->where('post_comment_type', '=', $blog)
							 ->where('post_type', '=', $comment)
							 ->get();
	     return view('admin.comment', ['view_comment' => $view_comment, 'view_title' => $view_title, 'urlcomment' => $urlcomment ]);
	}
	
	
	
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $postid = $data['postid'];
	   
	   foreach($postid as $pid)
	   {
	   
	   $image = DB::table('post')->where('post_id', $pid)->first();
		$orginalfile=$image->post_image;
		
		$audiofile=$image->post_audio;
		
		
		
       $path = base_path('images/media/'.$orginalfile);
	   
	   $mp3path = base_path('images/media/'.$audiofile);
	   
	  File::delete($path);
	  
	  File::delete($mp3path);
      DB::delete('delete from post where post_id = ?',[$pid]);
	   
	   
       }
	   return back();
	   
	}   
	
	
	
	
	public function destroy($id) {
		
		$image = DB::table('post')->where('post_id', $id)->first();
		$orginalfile=$image->post_image;
		
		$audiofile=$image->post_audio;
		
		
		
       $path = base_path('images/media/'.$orginalfile);
	   
	   $mp3path = base_path('images/media/'.$audiofile);
	   
	  File::delete($path);
	  
	  File::delete($mp3path);
      DB::delete('delete from post where post_id = ?',[$id]);
	   
      return back();
      
   }
   
   
   public function comment_destroy($id) {
		
		
      DB::delete('delete from post where post_id = ?',[$id]);
	   
      return back();
      
   }
   
   
   
   
	
}