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

class UsersController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::table('users')
		         ->where('admin','=',0)
				 ->where('admin','!=',1)
				 ->where('delete_status','=','')
		         ->orderBy('id','desc')
				 ->get();
				 
		$users_cnt = DB::table('users')
		          ->where('admin','=',0)
				 ->where('admin','!=',1)
				 ->where('delete_status','=','')
		         ->orderBy('id','desc')
				 ->get();	
				 
				 
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();		 	 
				 

        return view('admin.users', ['users' => $users, 'users_cnt' => $users_cnt, 'setts' => $setts]);
    }
	
	
	
	public function vendor_index()
    {
        $users = DB::table('users')
		         ->where('admin','=',2)
		         ->where('admin','!=',1)
				 ->where('delete_status','=','')
		         ->orderBy('id','desc')
				 ->get();
				 
		$users_cnt = DB::table('users')
		         ->where('admin','=',2)
		         ->where('admin','!=',1)
				 ->where('delete_status','=','')
		         ->orderBy('id','desc')
				 ->get();		 
				 
				 
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();		 
				 

        return view('admin.vendors', ['users' => $users, 'users_cnt' => $users_cnt, 'setts' => $setts]);
    }
	
	
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $userid = $data['userid'];
	   
	   foreach($userid as $uid)
	   {
		   
		  DB::delete('delete from post where post_type="comment" and post_user_id!=1 and post_user_id = ?',[$uid]);
		   
		   
		   DB::update('update users set delete_status="deleted" where id!=1 and id = ?',[$uid]);
		   
	   }
	   
      return back();
		
	}
	
	
	public function destroy($id) {
		
		
	   
	   DB::delete('delete from post where post_type="comment" and post_user_id = ?',[$id]);
      
	  
	  DB::update('update users set delete_status="deleted" where id!=1 and id = ?',[$id]);
	   
      return back();
      
   }
	
}