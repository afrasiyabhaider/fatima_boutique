<?php namespace Responsive\Http\Controllers\Admin;

use Responsive\Http\Controllers\Admin\AdminController;
/*use App\Article;
use App\ArticleCategory;
use App\User;
use App\Photo;
use App\PhotoAlbum;*/
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function index()
	{
        $title = "Dashboard";
		
		$total_customer = DB::table('users')
		              ->where('admin','=','0')
					  ->where('delete_status','=','')
			           ->count();
					   
				   		   
       $total_vendor = DB::table('users')
		              ->where('admin','=','2')
					  ->where('delete_status','=','')
			           ->count();
        
		
         $total_product = DB::table('product')
		              
					  ->where('delete_status','=','')
			           ->count();
					   
					   
		$total_orders = DB::table('product_checkout')
		                ->count();
						
						
		$pending_orders = DB::table('product_checkout')
		                ->where('payment_status','=','pending')
		                ->count();
													   
		$completed_orders = DB::table('product_checkout')
		                ->where('payment_status','=','completed')
		                ->count();
						
						
		$pending_withdraw = DB::table('product_withdraw')
		                ->where('withdraw_status','=','pending')
		                ->count();	
						
		$completed_withdraw = DB::table('product_withdraw')
		                ->where('withdraw_status','=','completed')
		                ->count();											   
		
		
        $blog_cnt = DB::table('post')
		        ->where('post_type', '=' , 'blog')
				->where('post_status', '=' , '1')
		        ->orderBy('post_id','desc')
				->limit(3)->offset(0)
				->count();

		
         $blog = DB::table('post')
		        ->where('post_type', '=' , 'blog')
				->where('post_status', '=' , '1')
		        ->orderBy('post_id','desc')
				->limit(3)->offset(0)
				->get();
		
		
        $total_blog = DB::table('post')
			           ->where('post_type','=', 'blog')
					   ->count();
					   
					   
		$total_comment = DB::table('post')
			           ->where('post_type','=', 'comment')
					   ->count();

         
					  
				$set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();	   
		
		$users = DB::table('users')
		         ->where('id','!=','1')
		         ->orderBy('id','desc')
				 ->limit(4)->offset(0)
				 ->get();
				 
			
				 
				 
				


       $pages = DB::table('pages')
		         
				 ->count();	

      
				 
		
		$data = array('total_customer' => $total_customer, 'total_vendor' => $total_vendor, 'total_blog' => $total_blog, 'setting' => $setting, 'users' => $users,
		'pages' => $pages,  'total_comment' => $total_comment, 'blog' => $blog, 'blog_cnt' => $blog_cnt, 'total_product' => $total_product, 'total_orders' => $total_orders, 'pending_orders' => $pending_orders, 'completed_orders' => $completed_orders, 'pending_withdraw' => $pending_withdraw, 'completed_withdraw' => $completed_withdraw);
		
		return view('admin.index')->with($data);
		
		
		
		
	}
}