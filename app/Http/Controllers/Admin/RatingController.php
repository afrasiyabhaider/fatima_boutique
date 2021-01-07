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

class RatingController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $rating = DB::table('product_rating')
		                ->orderBy('rate_id','desc')
					   ->get();

        return view('admin.rating', ['rating' => $rating]);
    }
	
	
	
	
	public function destroy($id)
	 {
		
		
      DB::delete('delete from product_rating where rate_id = ?',[$id]);
	   
      return back();
      
   }
	
}