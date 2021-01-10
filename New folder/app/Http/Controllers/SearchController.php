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

class SearchController extends Controller
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
    
	
	
	
	public function avigher_get_search()
    {
	
	   $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	 $services = DB::table('services')
	             ->orderBy('name','asc')
		           ->get();
		$services_cnt = DB::table('services')
		                 ->orderBy('name','asc')
						->count();	
						
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
	
	$shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->get();
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->count();	
	$id="";
	$slug="";
	$searches="";	
	$searches_count=0;		 		 					   
	
	$data = array('services_cnt' => $services_cnt, 'services' => $services, 'id' => $id, 'slug' => $slug, 'countries' => $countries, 'shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'site_setting' => $site_setting,  'searches' => $searches, 'searches_count' => $searches_count);
	
	 return view('search')->with($data);
	
	
	
	}
	
	
	public function avigher_advanced_search(Request $request)
    {
	
	$datta = $request->all();
	 
	
	
	if(!empty($datta['select_services']))
	{ 
	$select_services = $datta['select_services']; 
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	if(!empty($datta['country']))
	{
	$country = $datta['country']; 
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.country','=', $country)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.country','=', $country)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	 
	}
	
	if(!empty($datta['city']))
	{
	$city = $datta['city']; 
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();
	}
	
	
	
	if(!empty($datta['rating']))
	{
	
	$rating = $datta['rating'];
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('avg_rating.rating','=',$rating)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('avg_rating.rating','=',$rating)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();
	
	
	}
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['rating']))
	{ 
	$select_services = $datta['select_services']; 
	$sell="";
	$views="";
	$rating = $datta['rating'];
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	
	
	
	if(!empty($datta['country']) && !empty($datta['rating']))
	{
	$country = $datta['country']; 
	$rating = $datta['rating'];
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('avg_rating.rating','=',$rating)
				   ->where('shop.country','=', $country)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('avg_rating.rating','=',$rating)
				   ->where('shop.country','=', $country)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	 
	}
	
	
	
	if(!empty($datta['city']) && !empty($datta['rating']))
	{
	$city = $datta['city']; 
	$rating = $datta['rating'];
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('avg_rating.rating','=',$rating)
				   ->where('shop.city','LIKE','%'.$city.'%')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('avg_rating.rating','=',$rating)
				   ->where('shop.city','LIKE','%'.$city.'%')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();
	}
	
	
	
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['city']) && !empty($datta['rating']))
	{ 
	$select_services = $datta['select_services']; 
	$city = $datta['city'];
	$rating = $datta['rating'];
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
				   ->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.city','LIKE','%'.$city.'%')
					 ->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	
	if(!empty($datta['city']) && !empty($datta['country']) && !empty($datta['rating']))
	{
	$city = $datta['city']; 
	$country = $datta['country'];
	$rating = $datta['rating'];
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
				    ->where('shop.country','=', $country)
					->where('avg_rating.rating','=',$rating)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
				    ->where('shop.country','=', $country)
					->where('avg_rating.rating','=',$rating)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();
	}
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['country']) && !empty($datta['rating']))
	{ 
	$select_services = $datta['select_services']; 
	$country = $datta['country'];
	$rating = $datta['rating'];
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
					->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
					->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['country']))
	{ 
	$select_services = $datta['select_services']; 
	$country = $datta['country'];
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['city']))
	{ 
	$select_services = $datta['select_services']; 
	$city = $datta['city'];
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.city','LIKE','%'.$city.'%')
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	
	
	
	if(!empty($datta['city']) && !empty($datta['country']))
	{
	$city = $datta['city']; 
	$country = $datta['country'];
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
				    ->where('shop.country','=', $country)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				   ->where('shop.city','LIKE','%'.$city.'%')
				    ->where('shop.country','=', $country)
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['country']) && !empty($datta['city']))
	{ 
	$city = $datta['city']; 
	$select_services = $datta['select_services']; 
	$country = $datta['country'];
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
					->where('shop.city','LIKE','%'.$city.'%')
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
					->where('shop.city','LIKE','%'.$city.'%')
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	
	
	
	
	
	
	
	
	if(!empty($datta['select_services']) && !empty($datta['country']) && !empty($datta['city']) && !empty($datta['rating']))
	{ 
	$city = $datta['city']; 
	$select_services = $datta['select_services']; 
	$country = $datta['country'];
	$rating = $datta['rating'];
	$sell="";
	$views="";
	foreach($select_services as $seller)
		 {
			 $view_name= DB::table('subservices')->where("subid", "=" , $seller)->get();
			 $views .=$view_name[0]->subname.",";
			 $sell .=$seller.",";
			 
		 }
	$sel_service =rtrim($sell,",");
	
	
	
	
	$searches = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
					->where('shop.city','LIKE','%'.$city.'%')
					->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
	               ->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
				   ->leftJoin('avg_rating', 'shop.user_id', '=', 'avg_rating.shop_user_id')
				   ->where('shop.status', '=', 1)
				    ->where('shop.country','=', $country)
					->where('shop.city','LIKE','%'.$city.'%')
					->where('avg_rating.rating','=',$rating)
				   ->whereRaw('FIND_IN_SET(shop_services.service_id,"'.$sel_service.'")')
			       ->groupBy('shop.shop_id')
				   ->orderBy('shop.shop_id','desc')
		           ->count();	
	
	
	
	
	
	} 
	if(empty($datta['select_services']) && empty($datta['country']) && empty($datta['city']) && empty($datta['rating']))
	
	{
	$searches = DB::table('shop')
		->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
		->where('shop_services.service_id', '!=', "")
		->where('shop.status', '=', 1)
		->groupBy('shop.shop_id')
		->get();
	$searches_count = DB::table('shop')
		->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
		->where('shop.status', '=', 1)
		->where('shop_services.service_id', '!=', "")
		->where('shop.status', '=', 1)
		->groupBy('shop.shop_id')
		->count();

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
			   
	
	   $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	 $services = DB::table('services')
	             ->orderBy('name','asc')
		           ->get();
		$services_cnt = DB::table('services')
		                 ->orderBy('name','asc')
						->count();	
						
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
	
	$shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->get();
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->count();	
	$id="";
	$slug="";	
	
			 		 					   
	
	$data = array('services_cnt' => $services_cnt, 'services' => $services, 'id' => $id, 'slug' => $slug, 'countries' => $countries, 'shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'site_setting' => $site_setting, 'searches' => $searches, 'searches_count' => $searches_count);
	
	 return view('search')->with($data);
	
	
	
	
	}
	
	
	
	
	public function avigher_search(Request $request)
    {
	$datta = $request->all();
	$search_text = $datta['search_text'];
	
	$searches = DB::table('shop')
				   ->where('status', '=', 1)
			       ->where('name','LIKE','%'.$search_text.'%')
			       ->orderBy('shop_id','desc')
		           ->get();
	$searches_count = DB::table('shop')
				   ->where('status', '=', 1)
			       ->where('name','LIKE','%'.$search_text.'%')
			       ->orderBy('shop_id','desc')
		           ->count();			   
	
	   $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	 $services = DB::table('services')
	             ->orderBy('name','asc')
		           ->get();
		$services_cnt = DB::table('services')
		                 ->orderBy('name','asc')
						->count();	
						
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
	
	$shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->get();
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->count();	
	$id="";
	$slug="";			 		 					   
	
	$data = array('services_cnt' => $services_cnt, 'services' => $services, 'id' => $id, 'slug' => $slug, 'countries' => $countries, 'shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'site_setting' => $site_setting, 'searches' => $searches, 'searches_count' => $searches_count);
	
	 return view('search')->with($data);
	
	
	}
	
	
	
	
	
	
	
	
	public function avigher_all_seller($seller)
	{
	
	
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	 $services = DB::table('services')
	             ->orderBy('name','asc')
		           ->get();
		$services_cnt = DB::table('services')
		                 ->orderBy('name','asc')
						->count();
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


    $shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->get();
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->count();		
	
	
	$searches = DB::table('shop')
		->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
		->where('shop_services.service_id', '!=', "")
		->where('shop.status', '=', 1)
		->groupBy('shop.shop_id')
		->get();
	$searches_count = DB::table('shop')
		->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
		->where('shop.status', '=', 1)
		->where('shop_services.service_id', '!=', "")
		->where('shop.status', '=', 1)
		->groupBy('shop.shop_id')
		->count();
		
			
		$id = "";		 	 					   
	    $slug = "";
	$data = array('services_cnt' => $services_cnt, 'services' => $services, 'id' => $id, 'slug' => $slug, 'countries' => $countries, 'shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'site_setting' => $site_setting, 'searches' => $searches, 'searches_count' => $searches_count);		   
	
	
	 return view('search')->with($data);
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function avigher_view_search($id,$slug)
    {
	
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	 $services = DB::table('services')
	             ->orderBy('name','asc')
		           ->get();
		$services_cnt = DB::table('services')
		                 ->orderBy('name','asc')
						->count();
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


    $shop_view = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->get();
	$shop_view_count = DB::table('shop')
	             ->where('status','=',1)
				 ->orderBy('shop_id','desc')->limit(10)
		         ->count();		
	
	
	$searches = DB::table('shop')
		->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
		->where('shop.status', '=', 1)
		->where('shop_services.service_id', '=', $id)
		->get();
	$searches_count = DB::table('shop')
		->leftJoin('shop_services', 'shop_services.user_id', '=', 'shop.user_id')
		->where('shop.status', '=', 1)
		->where('shop_services.service_id', '=', $id)
		->count();
		
			
				 	 					   
	
	$data = array('services_cnt' => $services_cnt, 'services' => $services, 'id' => $id, 'slug' => $slug, 'countries' => $countries, 'shop_view' => $shop_view, 'shop_view_count' => $shop_view_count, 'site_setting' => $site_setting, 'searches' => $searches, 'searches_count' => $searches_count);		   
	
	
	 return view('search')->with($data);
	
	
	}
	
	
	
	 
	
	
}
