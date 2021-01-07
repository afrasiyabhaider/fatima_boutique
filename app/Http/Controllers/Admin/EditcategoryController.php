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


class EditcategoryController extends Controller
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
    
	
	public function showform($id) {
      $category = DB::select('select * from category where id = ?',[$id]);
      return view('admin.editcategory',['category'=>$category]);
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
	 
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}   
	 
    protected function editcategorydata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		$input['name'] = Input::get('name');
       $settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
		
		$rules = array(
		
		'name'=>'required',
		
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
            $servicephoto="/media/";
			$delpath = base_path('images'.$servicephoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$servicephoto.$filename);
			$destinationPath=base_path('images'.$servicephoto);
      
                 Image::make($image->getRealPath())->resize(400, 290)->save($path);
				/*Input::file('photo')->move($destinationPath, $filename);*/
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentphoto;
		}
		
		
		
		if(!empty($data['display_menu']))
		{
		   $display_menu = $data['display_menu'];
		}
		else
		{
		 $display_menu = "";
		}			
		
		
		$status = 1;
		/* DB::insert('insert into users (name, email,password,phone,admin) values (?, ?,?, ?,?)', [$name,$email,$password,$phone,$admin]);*/
		DB::update('update category set cat_name="'.$name.'",post_slug="'.$this->clean($name).'",image="'.$savefname.'",display_menu="'.$display_menu.'",status="'.$status.'" where id = ?', [$id]);
		
			return back()->with('success', 'Category has been updated');
        }
		
		
		
		
    }
}
