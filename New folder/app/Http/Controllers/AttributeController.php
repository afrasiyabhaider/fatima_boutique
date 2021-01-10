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

class AttributeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	public function attribute_type_index()
    {
	
	    $user_id = Auth::user()->id;
		
		$attribute_type_cnt = DB::table('product_attribute_type')
		                  ->where('user_id','=',$user_id)
						  ->where('delete_status','=','')
					      ->count();
		
        $attribute_type = DB::table('product_attribute_type')
		                  ->where('user_id','=',$user_id)
						  ->where('delete_status','=','')
					      ->get();

        return view('attribute-type', ['attribute_type_cnt' => $attribute_type_cnt, 'attribute_type' => $attribute_type]);
    }
	
	
	public function attribute_value_index()
	{
	
	$user_id = Auth::user()->id;
	$attribute_value_cnt = DB::table('product_attribute_value')
		              ->where('delete_status','=','')
					  ->where('user_id','=',$user_id)
					  ->count();
	
        $attribute_value = DB::table('product_attribute_value')
		              ->where('delete_status','=','')
					  ->where('user_id','=',$user_id)
					  ->get();

        return view('attribute-value', ['attribute_value' => $attribute_value, 'attribute_value_cnt' => $attribute_value_cnt]);
    }
	
	
	
	
	
	
	
	
	
	public function formview_value()
	{
	
	$type_count = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->where('status','=',1)
					  ->count();
	
	$attribute_type = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->where('status','=',1)
					  ->get();
	return view('add-attribute-value' , ['attribute_type' => $attribute_type, 'type_count' => $type_count]);
	
	}
	
	
	
	public function formview()

    {

        return view('add-attribute-type');

    }
	
	
	
	
	
	protected function attribute_value_data(Request $request)
    {
	
	
	
	
	
	$this->validate($request, [

        		'attribute_name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['attribute_name'] = Input::get('attribute_name');
		
       
		
		$rules = array(
		'attribute_name' => 'required' 
		
		
		
		
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

		
		if(!empty($data['attribute_type']))
		{	
		$attribute_type=$data['attribute_type'];
		}
		else
		{
		$attribute_type = "";
		}
		
		
		
		
		if(!empty($data['attribute_name']))
		{	
		$attribute_name=$data['attribute_name'];
		}
		else
		{
		$attribute_name = "";
		}
		
		
		
		
		
		$status = 1;
		
		
		$user_id = Auth::user()->id;
		
		DB::insert('insert into product_attribute_value (attr_id,attr_value,user_id,status) values (?, ?, ?, ?)', [$attribute_type,$attribute_name,$user_id,$status]);
		
		
			return back()->with('success', 'Value has been created');
        
		
		
		}
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
	protected function attribute_type_data(Request $request)
    {
       
		
		
		$this->validate($request, [

        		'attribute_name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['attribute_name'] = Input::get('attribute_name');
		
       
		
		$rules = array(
		'attribute_name' => 'required' 
		
		
		
		
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

		
		if(!empty($data['attribute_name']))
		{	
		$attribute_name=$data['attribute_name'];
		}
		else
		{
		$attribute_name = "";
		}
		
		
		
		$user_id = Auth::user()->id;
		
		$status = 1;
		
		
		
		
		DB::insert('insert into product_attribute_type (user_id,attr_name,status) values (?, ?, ?)', [$user_id,$attribute_name,$status]);
		
		
			return back()->with('success', 'Type has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	
	
	public function showform($id) {
	$user_id = Auth::user()->id;
	
      $attribute = DB::select('select * from product_attribute_type where user_id="'.$user_id.'" and attr_id = ?',[$id]);
      return view('edit-attribute-type',['attribute'=>$attribute]);
   }
	
	
	public function deleted($id) {
	
	  $user_id = Auth::user()->id;
	
	  DB::update('update product_attribute_value set delete_status="deleted",status="0" where user_id="'.$user_id.'" and attr_id = ?',[$id]);
	  
	  DB::update('update product_attribute_type set delete_status="deleted",status="0" where user_id="'.$user_id.'" and attr_id = ?',[$id]);
	  
	  
	   
      return back();
      
   }
   
   
   public function value_deleted($id) {
	
	  $user_id = Auth::user()->id;
	  DB::update('update product_attribute_value set delete_status="deleted",status="0" where user_id="'.$user_id.'" and value_id = ?',[$id]);
	  
	  
	   
      return back();
      
   }
   
   
   
   public function edit_showform($id) {
	$user_id = Auth::user()->id;
	$type_count = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->where('status','=',1)
					  
					  ->count();
	
	$attribute_type = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->where('status','=',1)
					  
					  ->get();
      $attribute = DB::select('select * from product_attribute_value where value_id = ?',[$id]);
      return view('edit-attribute-value',['attribute'=>$attribute, 'attribute_type' => $attribute_type, 'type_count' => $type_count]);
   }
   
   
   
   
   
   
   
   
   
   protected function edit_attribute_value(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'attribute_name' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['attribute_name'] = Input::get('attribute_name');
		
		
		$rules = array(
		'attribute_name' => 'required'
		
		
		
		
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
		
		
		
		
		if(!empty($data['attribute_type']))
		{	
		$attribute_type=$data['attribute_type'];
		}
		else
		{
		$attribute_type = "";
		}
		
		
		 
		   
		if(!empty($data['attribute_name']))
		{	
		$attribute_name=$data['attribute_name'];
		}
		else
		{
		$attribute_name = "";
		}
		
		
		
		$user_id = Auth::user()->id;
		
				
		$value_id=$data['value_id'];
		
		
		DB::update('update product_attribute_value set attr_id="'.$attribute_type.'",user_id="'.$user_id.'",attr_value="'.$attribute_name.'" where value_id = ?', [$value_id]);
		
		
		
		
			return back()->with('success', 'Value has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
	
	
	
   
   
   
   
   
   
   
   
   
	
   
   
   
   
   
   
   protected function edit_attribute_type(Request $request)
    {
       
		
		$user_id = Auth::user()->id;
		
		$this->validate($request, [

        		'attribute_name' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['attribute_name'] = Input::get('attribute_name');
		
		
		$rules = array(
		'attribute_name' => 'required'
		
		
		
		
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
		
		
		
		 
		   
		if(!empty($data['attribute_name']))
		{	
		$attribute_name=$data['attribute_name'];
		}
		else
		{
		$attribute_name = "";
		}
		
		
		
		
		
				
		$attr_id=$data['attr_id'];
		
		
		DB::update('update product_attribute_type set attr_name="'.$attribute_name.'" where user_id="'.$user_id.'" and attr_id = ?', [$attr_id]);
		
		
		
		
			return back()->with('success', 'Type has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
	
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
	
	
	
	
	
	




}