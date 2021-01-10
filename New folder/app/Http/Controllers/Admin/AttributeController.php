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
use Auth;

class AttributeController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function attribute_type_index()
    {
        $attribute_type = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->get();

        return view('admin.attribute_type', ['attribute_type' => $attribute_type]);
    }
	
	
	
	public function attribute_value_index()
	{
        $attribute_value = DB::table('product_attribute_value')
		              ->where('delete_status','=','')
					  
					  ->get();

        return view('admin.attribute_value', ['attribute_value' => $attribute_value]);
    }
	
	
	public function edit_showform($id) {
	
	$type_count = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->where('status','=',1)
					  ->count();
	
	$attribute_type = DB::table('product_attribute_type')
		              ->where('delete_status','=','')
					  ->where('status','=',1)
					  ->get();
      $attribute = DB::select('select * from product_attribute_value where value_id = ?',[$id]);
      return view('admin.edit_attribute_value',['attribute'=>$attribute, 'attribute_type' => $attribute_type, 'type_count' => $type_count]);
   }
	
	
	public function showform($id) {
      $attribute = DB::select('select * from product_attribute_type where attr_id = ?',[$id]);
      return view('admin.edit_attribute_type',['attribute'=>$attribute]);
   }
   
   public function formview()

    {

        return view('admin.add_attribute_type');

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
	return view('admin.add_attribute_value' , ['attribute_type' => $attribute_type, 'type_count' => $type_count]);
	
	}
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	
	
	
	protected function attribute_value_data(Request $request)
    {
	
	
	
	
	
	$this->validate($request, [

        		'attribute_value' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['attribute_value'] = Input::get('attribute_value');
		
       
		
		$rules = array(
		'attribute_value' => 'required' 
		
		
		
		
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
		
		
		
		
		if(!empty($data['attribute_value']))
		{	
		$attribute_value=$data['attribute_value'];
		}
		else
		{
		$attribute_value = "";
		}
		
		
		
		
		
		$status = 1;
		
		
		
		
		DB::insert('insert into product_attribute_value (attr_id,attr_value,status) values (?, ?, ?)', [$attribute_type,$attribute_value,$status]);
		
		
			return back()->with('success', 'Value has been created');
        
		
		
		}
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	protected function attribute_type_data(Request $request)
    {
       
		$user_id = Auth::user()->id;
		
		$this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['name'] = Input::get('name');
		
       
		
		$rules = array(
		'name' => 'required' 
		
		
		
		
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

		
		if(!empty($data['name']))
		{	
		$name=$data['name'];
		}
		else
		{
		$name = "";
		}
		
		if(!empty($data['enable_search']))
		{
		  $enable_search = $data['enable_search'];
		}
		else
		{
		  $enable_search = "";
		}
		
		
		
		$status = 1;
		
		
		
		
		DB::insert('insert into product_attribute_type (attr_name,search,user_id,status) values (?, ?, ?, ?)', [$name,$enable_search,$user_id,$status]);
		
		
			return back()->with('success', 'Type has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	 public function status($action,$id,$status) {
	 
	 DB::update('update product_attribute_type set 	status="'.$status.'" where attr_id = ?',[$id]);
	 return back();
	 }
   
   
   public function value_status($action,$id,$status) {
	 
	 DB::update('update product_attribute_value set status="'.$status.'" where value_id = ?',[$id]);
	 return back();
	 }
   
   
   
   protected function edit_attribute_type(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['name'] = Input::get('name');
		
		
		$rules = array(
		'name' => 'required'
		
		
		
		
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
		
		
		
		 
		   
		if(!empty($data['name']))
		{	
		$name=$data['name'];
		}
		else
		{
		$name = "";
		}
		
		if(!empty($data['enable_search']))
		{
		  $enable_search = $data['enable_search'];
		}
		else
		{
		  $enable_search = "";
		}
		
		
		
				
		$attr_id=$data['attr_id'];
		
		
		DB::update('update product_attribute_type set attr_name="'.$name.'",search="'.$enable_search.'" where attr_id = ?', [$attr_id]);
		
		
		
		
			return back()->with('success', 'Type has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
	
	
	
	
	
	
	
	
	
	
	protected function edit_attribute_value(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'attribute_value' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['attribute_value'] = Input::get('attribute_value');
		
		
		$rules = array(
		'attribute_value' => 'required'
		
		
		
		
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
		
		
		 
		   
		if(!empty($data['attribute_value']))
		{	
		$attribute_value=$data['attribute_value'];
		}
		else
		{
		$attribute_value = "";
		}
		
		
		
		
		
				
		$value_id=$data['value_id'];
		
		
		DB::update('update product_attribute_value set attr_id="'.$attribute_type.'",attr_value="'.$attribute_value.'" where value_id = ?', [$value_id]);
		
		
		
		
			return back()->with('success', 'Value has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
	
	
	
	
	
	
	
	
	
	
   
   
   
   public function deleted($id) {
	
	
	
	  DB::update('update product_attribute_value set delete_status="deleted",status="0" where attr_id = ?',[$id]);
	  
	  DB::update('update product_attribute_type set delete_status="deleted",status="0" where attr_id = ?',[$id]);
	  
	  
	   
      return back();
      
   }
   
   
   
    public function value_deleted($id) {
	
	  
	  DB::update('update product_attribute_value set delete_status="deleted",status="0" where value_id = ?',[$id]);
	  
	  
	   
      return back();
      
   }
   
   
   
   
   
   
   
   
   
	
	
	
}