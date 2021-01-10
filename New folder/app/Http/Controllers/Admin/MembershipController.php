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

class MembershipController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function membership_index()
    {
        $membership = DB::table('membership')
		              ->where('delete_status','=','')
					  ->get();

        return view('admin.membership', ['membership' => $membership]);
    }
	
	
	public function showform($id) {
      $membership = DB::select('select * from membership where mid = ?',[$id]);
      return view('admin.edit_membership',['membership'=>$membership]);
   }
   
   public function formview()

    {

        return view('admin.add_membership');

    }
	
	
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	
	
	
	
	
	protected function addplandata(Request $request)
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
   
   
   
   public function deleted($id) {
	
	  
	  DB::update('update membership set delete_status="deleted",membership_status="0" where mid = ?',[$id]);
	  
	  
	   
      return back();
      
   }
   
   
   
   
   
   
   
   
   
   
   
   
   
	
	
	
}