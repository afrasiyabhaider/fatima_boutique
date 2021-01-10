<?php

namespace Responsive\Http\Controllers\Admin;


use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class EditsubcategoryController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	
	public function edit($id)

    {
		
		
	 $subcategory = DB::select('select * from subcategory where delete_status="" and subid = ?',[$id]);
     

       $category = DB::table('category')
	               ->where('delete_status','=','')
				   ->orderBy('cat_name', 'asc')->get();

        
		
		$data = array('subcategory'=>$subcategory, 'category'=>$category);
            return view('admin.editsubcategory')->with($data);

    }
	
   
  
   
   
   
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  
	 
    protected function editsubcategorydata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $subid=$data['subid'];
        			
		$input['name'] = Input::get('name');
       
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
		
		
		
		 
		
		/*$rules = array('name' => 'unique:subservices,subname,'.$data['subid'].',subid'); */
		
		
		$rules = array(
		
		
		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype
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
		  

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		$name=$data['name'];
		
		
		$currentphoto=$data['currentphoto'];
		
		
		$image = Input::file('photo');
        if($image!="")
		{	
            $subservicephoto="/media/";
			$delpath = base_path('images'.$subservicephoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$subservicephoto.$filename);
			$destinationPath=base_path('images'.$subservicephoto);
      
                /* Image::make($image->getRealPath())->resize(200, 200)->save($path);*/
				/*Input::file('photo')->move($destinationPath, $filename);*/
				 Image::make($image->getRealPath())->resize(400, 290)->save($path);
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentphoto;
		}			
		
		
		$cat_id=$data['cat_id'];
		
		$status = 1;
		
		/* DB::insert('insert into users (name, email,password,phone,admin) values (?, ?,?, ?,?)', [$name,$email,$password,$phone,$admin]);*/
		DB::update('update subcategory set subcat_name="'.$name.'", post_slug="'.$this->clean($name).'", cat_id="'.$cat_id.'",subimage="'.$savefname.'",status="'.$status.'" where subid = ?', [$subid]);
		
			return back()->with('success', 'Sub category has been updated');
        }
		
		
		
		
    }
}
