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
use Mail;
use Auth;
use Crypt;
use URL;


class ProductController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function product_index()
    {
        $productt = DB::table('product')
		              ->where('delete_status','=','')
					  ->get();
					  
			$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();		  

        return view('admin.product', ['productt' => $productt, 'setts' => $setts]);
    }
	
	
	public function showform($id) {
      $membership = DB::select('select * from membership where mid = ?',[$id]);
      return view('admin.edit_membership',['membership'=>$membership]);
   }
   
   
   public function view_product_data($token)
   {
   
   $product = DB::table('product')
		              ->where('prod_token','=',$token)
					  ->get();
					  
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();				  
					  
   return view('admin.view_product', ['product' => $product, 'setts' => $setts]);
   }
   
   
   public function formview()

    {
        
		
		 $category = DB::table('category')
		            ->where('delete_status','=','')
					->orderBy('cat_name', 'asc')->get();
					
		$product_type = array("normal","external");	
		
		
		$typer_count = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('attr_name', 'asc')->count();
		
		 $typer = DB::table('product_attribute_type')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('attr_name', 'asc')->get();		
					
        return view('admin.add_product', ['category' => $category, 'product_type' => $product_type, 'typer' => $typer, 'typer_count' => $typer_count]);

    }
	
	
	public function product_status($action,$id,$status,$user_id)
	{
	
	   DB::update('update product set prod_status="'.$status.'" where prod_id = ?',[$id]);
	   if($status==1)
	   {
	   $user = DB::table('users')
						->where('id', '=', $user_id)
						->get();
						
						
		$product = 	DB::table('product')
						->where('prod_id', '=', $id)
						->get();
						
		$product_name = $product[0]->prod_name;
		$slug = $product[0]->prod_slug;						
						
						
	   $user_email = $user[0]->email;
	   
	   
	   
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
            'user_email' => $user_email, 'url' => $url, 'product_name' => $product_name, 'id' => $id, 'slug' => $slug, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		Mail::send('admin.product_approval_mail', $datas , function ($message) use ($admin_email,$user_email)
        {
            $message->subject('Your product is approved');
			
            $message->from($admin_email, 'Admin');

            $message->to($user_email);

        }); 
		
		}
		 
		
	   
	   
	   return back();
	   
	   
	   
	
	}
	
	
	
	
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	
	
	
	
	
	protected function addproductdata(Request $request)
    {
       
		
		
		$this->validate($request, [

        		'membership_name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['membership_name'] = Input::get('membership_name');
		
       
		
		$rules = array(
		'membership_name' => 'required|unique:membership,membership_name' 
		
		
		
		
		);
		
		$messages = array(
            
            
			
        );
		

		
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
		
		
		 
		
		
		  $data = $request->all();

		
		if(!empty($data['membership_name']))
		{	
		$membership_name=$data['membership_name'];
		}
		else
		{
		$membership_name = "";
		}
		
		
		
		if(!empty($data['membership_price']))
		{
		   $membership_price = $data['membership_price'];
		}
		else
		{
		   $membership_price = "";
		}
		
		if(!empty($data['product_limit']))
		{
		 $product_limit = $data['product_limit'];
		}
		else
		{
		$product_limit = "";
		}
		
		
		if(!empty($data['membership_days']))
		{
		   $membership_days = $data['membership_days'];
		}
		else
		{
		  $membership_days = "";
		}
		
		$status = 1;
		
		if(!empty($data['membership_flash']))
		{
		   $membership_flash = $data['membership_flash'];
		}
		else
		{
		  $membership_flash = "";
		}
		
		
		DB::insert('insert into membership (membership_name,membership_price,membership_days,product_limit,membership_flash,membership_status) values (?, ?, ? ,?, ?, ?)', [$membership_name,$membership_price,$membership_days,$product_limit,$membership_flash,$status]);
		
		
			return back()->with('success', 'Plan has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	 public function status($status,$id,$sid) {
	 
	 DB::update('update membership set 	membership_status="'.$sid.'" where mid = ?',[$id]);
	 return back();
	 }
   
   
   protected function pagedata(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'membership_name' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['membership_name'] = Input::get('membership_name');
		
		
		$rules = array(
		'membership_name' => 'required'
		
		
		
		
		);
		
		$messages = array(
            
            
			
        );
		

		
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
		
		
		
		 
		   
		if(!empty($data['membership_name']))
		{	
		$membership_name=$data['membership_name'];
		}
		else
		{
		$membership_name = "";
		}
		
		
		
		if(!empty($data['membership_price']))
		{
		   $membership_price = $data['membership_price'];
		}
		else
		{
		   $membership_price = "";
		}
		
		if(!empty($data['product_limit']))
		{
		 $product_limit = $data['product_limit'];
		}
		else
		{
		$product_limit = "";
		}
		
		
		
		if(!empty($data['membership_days']))
		{
		   $membership_days = $data['membership_days'];
		}
		else
		{
		  $membership_days = "";
		}
		
		$status = 1;
		
		
		
		if(!empty($data['membership_flash']))
		{
		   $membership_flash = $data['membership_flash'];
		}
		else
		{
		  $membership_flash = "";
		}
		
		
				
		$plan_id=$data['plan_id'];
		
		
		DB::update('update membership set membership_name="'.$membership_name.'",membership_price="'.$membership_price.'",membership_days="'.$membership_days.'",product_limit="'.$product_limit.'",membership_flash="'.$membership_flash.'" where mid = ?', [$plan_id]);
		
		
		
		
			return back()->with('success', 'Plan has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
	
	
	
	public function prod_deleted($token) 
	{
   
     DB::update('update product set delete_status="deleted",prod_status="0" where prod_token = ?',[$token]);
	  
	  
	   
      return back();
   
   
     }
	 
	 
	 
   
   public function deleted($id) {
	
	  
	  DB::update('update membership set delete_status="deleted",membership_status="0" where mid = ?',[$id]);
	  
	  
	   
      return back();
      
   }
   
   
   
   
   
   
   
   
   
   
   
   
   
	
	
	
}