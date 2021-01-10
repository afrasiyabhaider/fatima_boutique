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
use Excel;
use Responsive\Product;

class ImportExportController extends Controller
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
    
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
	
	$userid = Auth::user()->id;
	
	
         $data = Product::where(['user_id' => $userid])->get()->toArray(); 
		$tempname = "products_".uniqid();
        return Excel::create($tempname, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
	
	
	
	
	
	
	
	
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
			
			
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
				
			
				
                foreach ($reader->toArray() as $key => $row) 
				{
				if(!empty($row['prod_tags'])){ $prod_tags = $row['prod_tags']; } else { $prod_tags = ""; }
				if(!empty($data['prod_offer_price'])) { $prod_offer_price = $data['prod_offer_price']; } else { $prod_offer_price = 0; }
				if(!empty($data['prod_featured'])) { $prod_featured = $data['prod_featured']; } else { $prod_featured = ""; }
				if(!empty($row['prod_zipfile'])) { $prod_zipfile = $row['prod_zipfile']; } else { $prod_zipfile = ""; }
				if(!empty($row['prod_external_url'])) { $prod_external_url = $row['prod_external_url']; } else { $prod_external_url = ""; }
				if(!empty($row['delete_status'])){ $delete_status = $row['delete_status']; } else { $delete_status = ""; }
				if(!empty($row['prod_available_qty'])) { $prod_available_qty = $row['prod_available_qty']; } else { $prod_available_qty = 0; }
				if(!empty($row['prod_attribute'])) { $prod_attribute = $row['prod_attribute']; } else { $prod_attribute = ""; } 
				
                    $data['user_id'] = $row['user_id'];
                    $data['prod_token'] = $row['prod_token'];
                    $data['prod_slug'] = $row['prod_slug'];
					$data['prod_category'] = $row['prod_category'];
					$data['prod_cat_type'] = $row['prod_cat_type'];
					$data['prod_name'] = $row['prod_name'];
					$data['prod_desc'] = $row['prod_desc'];
					$data['prod_tags'] = $prod_tags;
					$data['prod_price'] = $row['prod_price'];
					$data['prod_offer_price'] = $prod_offer_price;
					$data['prod_featured'] = $prod_featured;
					$data['prod_type'] = $row['prod_type'];
					$data['prod_zipfile'] = $prod_zipfile;
					$data['prod_external_url'] = $prod_external_url;
					$data['prod_attribute'] = $prod_attribute;
					$data['prod_available_qty'] = $prod_available_qty;
					$data['delete_status'] = $delete_status;
					$data['prod_status'] = $row['prod_status'];
					
					
					
                    if(!empty($data)) {
                        DB::table('product')->insert($data);
						
                    }
                 }
				
			
            });
			
			return back()->with('success', 'Insert Record successfully');
			
			
        }

        
		
		
		

        
    }

	
	
	 
	
	
}
