<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
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
    public function home()
    {
       
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();

		$data = array('setts' => $setts);
            return view('index')->with($data);
    }
}
