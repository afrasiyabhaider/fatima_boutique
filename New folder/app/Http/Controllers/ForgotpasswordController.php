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

class ForgotpasswordController extends Controller
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
    public function avigher_forgot_view()
    {
        
		return view('forgot-password');
    }
	
	
	
	
	
	
	 protected function avigher_forgot_password(Request $request)
    {
       
		
		
		
		 $this->validate($request, [

        		

        		'email' => 'required|email'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         
        			
		$input['email'] = Input::get('email');
       
		$id = $data['email'];
		
		
		$rules = array(
        
       
		
        'email'=>'required|email|unique:users,email,'.$id
		
		
		
        );
		
		
		$messages = array(
            
            'email' => "We can't find a user with that email address."
            
			
        );
		
		
		
		
		
		 $validator = Validator::make(Input::all(), $rules, $messages);

		

		if ($validator->fails())
		{
		
		    $email=$data['email'];
			
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
		
		$getpassword = DB::table('users')
		->where('email', '=', $email)
		->get();
		
		$password = $getpassword[0]->password;
		
		$token = $getpassword[0]->remember_token;
		
		
		$datas = [
             'email' => $email, 'token' => $token, 'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url
        ];
		
		Mail::send('forgotemail', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Forgot Password');
			
            $message->from($admin_email, 'Admin');

            $message->to($email);

        }); 
			
			
		
		
	   
	     return back()->with('success', 'We have e-mailed your password reset link!');
		
			 
		}
		else
		{ 
		  

		$failedRules = $validator->failed();
			 
			return back()->with('error', "We can't find a user with that email address.");
		
        }
		
		
		
		
    }
	
	
}
