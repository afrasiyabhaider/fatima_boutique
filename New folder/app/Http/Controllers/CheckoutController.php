<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;
use File;
use Image;
use Mail;
use Illuminate\Support\Facades\Validator;
use Responsive\Http\Requests;

class CheckoutController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	public function avigher_update_cart(Request $request)
	{
	
	   $data = $request->all();
	   $log_id = Auth::user()->id;
	   
	   $shipping_charge = $data['shipping_charge'];
	   $prod_user_id = $data['prod_user_id'];
	   
	   $local_shipping_price = 0;
	   $world_shipping_price = 0;
	   
	   $local_shipping_separate = "";
	   $world_shipping_separate = "";
	   foreach($prod_user_id as $id)
	   {
	      $view_user = DB::table('users')
		               ->where('id', '=', $id)
                       ->get();
					   
		  $local_shipping_price += $view_user[0]->local_shipping_price;
		  $world_shipping_price += $view_user[0]->world_shipping_price;	
		  
		  
		  $local_shipping_separate .= $view_user[0]->local_shipping_price.',';
		  $world_shipping_separate .= $view_user[0]->world_shipping_price.',';			   
					   
					   
	   }
	   
	   
	   if($shipping_charge == "local_shipping")
	   {
	      $ship_price = $local_shipping_price;
		  $ship_separate = rtrim($local_shipping_separate,',');
	   }
	   else if($shipping_charge == "world_shipping")
	   {
	      $ship_price = $world_shipping_price;
		  $ship_separate = rtrim($world_shipping_separate,',');
	   }
	   
	   
	   
	   
	    
		
		/*
		 if($available > $quantity)
		   {
		      
			   DB::update('update product_orders set quantity="'.$quantity.'" where user_id="'.$log_id.'" and status="pending" and ord_id = ?', [$order_id]);
			  
		   }
		   else
		   {
		      return back()->with('error', 'Please check available stock!'); 
		   }
		*/
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		
		
		$countries = array(
	'Afghanistan',
	'Albania',
	'Algeria',
	'American Samoa',
	'Andorra',
	'Angola',
	'Anguilla',
	'Antarctica',
	'Antigua and Barbuda',
	'Argentina',
	'Armenia',
	'Aruba',
	'Australia',
	'Austria',
	'Azerbaijan',
	'Bahamas',
	'Bahrain',
	'Bangladesh',
	'Barbados',
	'Belarus',
	'Belgium',
	'Belize',
	'Benin',
	'Bermuda',
	'Bhutan',
	'Bolivia',
	'Bosnia and Herzegowina',
	'Botswana',
	'Bouvet Island',
	'Brazil',
	'British Indian Ocean Territory',
	'Brunei Darussalam',
	'Bulgaria',
	'Burkina Faso',
	'Burundi',
	'Cambodia',
	'Cameroon',
	'Canada',
	'Cape Verde',
	'Cayman Islands',
	'Central African Republic',
	'Chad',
	'Chile',
	'China',
	'Christmas Island',
	'Cocos (Keeling) Islands',
	'Colombia',
	'Comoros',
	'Congo',
	'Congo, the Democratic Republic of the',
	'Cook Islands',
	'Costa Rica',
	'Cote d\'Ivoire',
	'Croatia (Hrvatska)',
	'Cuba',
	'Cyprus',
	'Czech Republic',
	'Denmark',
	'Djibouti',
	'Dominica',
	'Dominican Republic',
	'East Timor',
	'Ecuador',
	'Egypt',
	'El Salvador',
	'Equatorial Guinea',
	'Eritrea',
	'Estonia',
	'Ethiopia',
	'Falkland Islands (Malvinas)',
	'Faroe Islands',
	'Fiji',
	'Finland',
	'France',
	'France Metropolitan',
	'French Guiana',
	'French Polynesia',
	'French Southern Territories',
	'Gabon',
	'Gambia',
	'Georgia',
	'Germany',
	'Ghana',
	'Gibraltar',
	'Greece',
	'Greenland',
	'Grenada',
	'Guadeloupe',
	'Guam',
	'Guatemala',
	'Guinea',
	'Guinea-Bissau',
	'Guyana',
	'Haiti',
	'Heard and Mc Donald Islands',
	'Holy See (Vatican City State)',
	'Honduras',
	'Hong Kong',
	'Hungary',
	'Iceland',
	'India',
	'Indonesia',
	'Iran (Islamic Republic of)',
	'Iraq',
	'Ireland',
	'Israel',
	'Italy',
	'Jamaica',
	'Japan',
	'Jordan',
	'Kazakhstan',
	'Kenya',
	'Kiribati',
	'Korea, Democratic People\'s Republic of',
	'Korea, Republic of',
	'Kuwait',
	'Kyrgyzstan',
	'Lao, People\'s Democratic Republic',
	'Latvia',
	'Lebanon',
	'Lesotho',
	'Liberia',
	'Libyan Arab Jamahiriya',
	'Liechtenstein',
	'Lithuania',
	'Luxembourg',
	'Macau',
	'Macedonia, The Former Yugoslav Republic of',
	'Madagascar',
	'Malawi',
	'Malaysia',
	'Maldives',
	'Mali',
	'Malta',
	'Marshall Islands',
	'Martinique',
	'Mauritania',
	'Mauritius',
	'Mayotte',
	'Mexico',
	'Micronesia, Federated States of',
	'Moldova, Republic of',
	'Monaco',
	'Mongolia',
	'Montserrat',
	'Morocco',
	'Mozambique',
	'Myanmar',
	'Namibia',
	'Nauru',
	'Nepal',
	'Netherlands',
	'Netherlands Antilles',
	'New Caledonia',
	'New Zealand',
	'Nicaragua',
	'Niger',
	'Nigeria',
	'Niue',
	'Norfolk Island',
	'Northern Mariana Islands',
	'Norway',
	'Oman',
	'Pakistan',
	'Palau',
	'Panama',
	'Papua New Guinea',
	'Paraguay',
	'Peru',
	'Philippines',
	'Pitcairn',
	'Poland',
	'Portugal',
	'Puerto Rico',
	'Qatar',
	'Reunion',
	'Romania',
	'Russian Federation',
	'Rwanda',
	'Saint Kitts and Nevis',
	'Saint Lucia',
	'Saint Vincent and the Grenadines',
	'Samoa',
	'San Marino',
	'Sao Tome and Principe',
	'Saudi Arabia',
	'Senegal',
	'Seychelles',
	'Sierra Leone',
	'Singapore',
	'Slovakia (Slovak Republic)',
	'Slovenia',
	'Solomon Islands',
	'Somalia',
	'South Africa',
	'South Georgia and the South Sandwich Islands',
	'Spain',
	'Sri Lanka',
	'St. Helena',
	'St. Pierre and Miquelon',
	'Sudan',
	'Suriname',
	'Svalbard and Jan Mayen Islands',
	'Swaziland',
	'Sweden',
	'Switzerland',
	'Syrian Arab Republic',
	'Taiwan, Province of China',
	'Tajikistan',
	'Tanzania, United Republic of',
	'Thailand',
	'Togo',
	'Tokelau',
	'Tonga',
	'Trinidad and Tobago',
	'Tunisia',
	'Turkey',
	'Turkmenistan',
	'Turks and Caicos Islands',
	'Tuvalu',
	'Uganda',
	'Ukraine',
	'United Arab Emirates',
	'United Kingdom',
	'United States',
	'United States Minor Outlying Islands',
	'Uruguay',
	'Uzbekistan',
	'Vanuatu',
	'Venezuela',
	'Vietnam',
	'Virgin Islands (British)',
	'Virgin Islands (U.S.)',
	'Wallis and Futuna Islands',
	'Western Sahara',
	'Yemen',
	'Yugoslavia',
	'Zambia',
	'Zimbabwe'
);

		
		$login_user_count = DB::table('product_checkout')
		               ->where('user_id', '=', $log_id)
                       ->count();
		
		
		$login_user = DB::table('product_checkout')
		               ->where('user_id', '=', $log_id)
                       ->get();
		
		
		
		
		$cart_total = $data['cart_total'];
		$processing_fee = $data['processing_fee'];
		$order_ids = $data['order_ids'];
		
		$product_names = $data['product_names'];
		
		
		   $data = array('ship_price' => $ship_price, 'ship_separate' => $ship_separate, 'setts' => $setts, 'login_user_count' => $login_user_count, 'login_user' => $login_user,  'countries' => $countries, 'processing_fee' => $processing_fee, 'cart_total' => $cart_total, 'order_ids' => $order_ids, 'product_names' => $product_names);
	   
	   return view('checkout')->with($data);
	   
	   /*return redirect()->back()->with(['data' => $data]);*/
		  
	   
	
	
	}
	
	
	
	
	
	
	public function avigher_remove_cart($token)
	{
	
	   DB::delete('delete from product_orders where ord_id = ?',[$token]);
	   return back();
	}
	
	
	
	public function avigher_view_checkout()
	{
	   if(Auth::check()) {
	   $log_id = Auth::user()->id;
	   
	   $cart_views_count = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->count();
	   
	   
	   $cart_views = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->get();
		
		}
		else
		{
		$cart_views_count = 0;
		$cart_views = "";
		
		}
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$admin_details = DB::table('users')
						 ->where('id', '=', 1)
						 ->get();
		
		
		
	   
	    $data = array('cart_views_count' => $cart_views_count, 'cart_views' => $cart_views, 'setts' => $setts, 'admin_details' => $admin_details);
	   
	   return view('checkout')->with($data);
	}
	
	
	
	
	public function avigher_view_no_checkout()
	{
	
	return redirect('/404');
	
	}
	
	
   
   
  
	
	
	
	
	
	
	
	
	
	
}
