<?php 





namespace Responsive\Http\Controllers\Admin;

use Responsive\Http\Controllers\Controller;
use Responsive\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('admin');
    }

    /**
     * Show the Admin Login Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/index');
    }


}