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


class ShopController extends Controller
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
	 
	
	
	
	
	 
	 
    public function index()
    {
        $userid = Auth::user()->id;
		$edit_shop = DB::table('shop')
		         	 ->where('user_id', '=', $userid)
					 ->get();
		$shop_count = DB::table('shop')
		         	 ->where('user_id', '=', $userid)
					 ->count();
					 
				 if(!empty($shop_count))
				 {
		            $view_gallery =  DB::table('shop_gallery')
		         	 ->where('user_id', '=', $userid)
					 ->where('token', '=', $edit_shop[0]->token)
					 ->get();
					 
					 $view_gallery_count =  DB::table('shop_gallery')
		         	 ->where('user_id', '=', $userid)
					 ->where('token', '=', $edit_shop[0]->token)
					 ->count();
					}
					else
					{
					  $view_gallery="";
					  $view_gallery_count="";
					} 
		
					 			 
					 
		if(!empty($shop_count)){ $select_days = explode(",",$edit_shop[0]->working_days); } else {  $select_days = ""; }			 
		
		
		$daytext=array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");
		
		$time = array("12:00 AM"=>"0", "01:00 AM"=>"1", "02:00 AM"=>"2", "03:00 AM"=>"3", "04:00 AM"=>"4", "05:00 AM"=>"5", "06:00 AM"=>"6", "07:00 AM"=>"7", "08:00 AM"=>"8",
	 "09:00 AM"=>"9", "10:00 AM"=>"10", "11:00 AM"=>"11", "12:00 PM"=>"12", "01:00 PM"=>"13", "02:00 PM"=>"14", "03:00 PM"=>"15", "04:00 PM"=>"16", "05:00 PM"=>"17", "06:00 PM"=>"18", "07:00 PM"=>"19", "08:00 PM"=>"20", "09:00 PM"=>"21", "10:00 PM"=>"22", "11:00 PM"=>"23");
	 
	 $days=array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
			"10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18", "19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
			"28 Days" => "28", "29 Days" => "29", "30 Days" => "30");
		
		
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
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		$data = array('edit_shop' => $edit_shop, 'shop_count' => $shop_count, 'time' => $time,'days' => $days, 'daytext' => $daytext, 'select_days' => $select_days, 'site_setting'=> $site_setting, 'view_gallery' => $view_gallery, 'countries' => $countries, 'view_gallery_count' => $view_gallery_count);
		return view('myshop')->with($data);
    }
	
	
	
	
	public function avigher_delete_photo($delete,$id,$photo) 
	{
	   $orginalfile1 = base64_decode($photo);
	   $userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	   File::delete($path1);
	   DB::delete('delete from shop_gallery where id = ?',[$id]);
	   return back();
	
	}
	
	
	
	
	
	public function avigher_savedata(Request $request)
	{
	
	
	$userid = Auth::user()->id;
		$edit_shop = DB::table('shop')
		         	 ->where('user_id', '=', $userid)
					 ->get();
		$shop_count = DB::table('shop')
		         	 ->where('user_id', '=', $userid)
					 ->count();
					 
		if(!empty($shop_count)){ $select_days = explode(",",$edit_shop[0]->working_days); } else {  $select_days = ""; }			 
		
		
		$daytext=array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");
		
		$time = array("12:00 AM"=>"0", "01:00 AM"=>"1", "02:00 AM"=>"2", "03:00 AM"=>"3", "04:00 AM"=>"4", "05:00 AM"=>"5", "06:00 AM"=>"6", "07:00 AM"=>"7", "08:00 AM"=>"8",
	 "09:00 AM"=>"9", "10:00 AM"=>"10", "11:00 AM"=>"11", "12:00 PM"=>"12", "01:00 PM"=>"13", "02:00 PM"=>"14", "03:00 PM"=>"15", "04:00 PM"=>"16", "05:00 PM"=>"17", "06:00 PM"=>"18", "07:00 PM"=>"19", "08:00 PM"=>"20", "09:00 PM"=>"21", "10:00 PM"=>"22", "11:00 PM"=>"23");
	 
	 $days=array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
			"10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18", "19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
			"28 Days" => "28", "29 Days" => "29", "30 Days" => "30");
		
		
		
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
		
		
		
		
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	
	
	
	
	
	   
	   $data = $request->all();
	
	    
		$edit_shop = DB::table('shop')
		         	 ->where('user_id', '=', $userid)
					 ->get();
		$editid = DB::table('shop')
		         	 ->where('user_id', '=', $userid)
					 ->count();
					 
					 
					 
					 
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
		$imgtype = $settings[0]->image_type;			 
					 
	
		$rules = array(
               
		'cover_photo' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'profile_photo' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'file.*' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		
		
        );
		
		$messages = array(
            
            'email' => 'The :attribute field is already exists',
            'phone' => 'The :attribute field must only be letters and numbers (no spaces)'
			
        );
		
	
		 $validator = Validator::make(Input::all(), $rules, $messages);
		 
		


		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		
		
		 
		
	     $shop_cover_photo = Input::file('cover_photo');
		 if($shop_cover_photo!="")
		 {
		    if(!empty($editid))
			{
			$shophoto="/media/";
			$delpath = base_path('images'.$shophoto.$data['current_cover']);
			File::delete($delpath);
			}	
			 
            $filename  = time() . '.' . $shop_cover_photo->getClientOriginalExtension();
            $shopphoto="/media/";
            $path = base_path('images'.$shopphoto.$filename);
			$destinationPath=base_path('images'.$shopphoto);
 
        
               /*Image::make($shop_cover_photo->getRealPath())->resize(1400, 300)->save($path);*/
			   Input::file('cover_photo')->move($destinationPath, $filename);
				
				$cover_photo=$filename;
		 }
		 else
		 {
			 if(!empty($editid))
			 {
				 $cover_photo=$data['current_cover'];
			 }
			 else
			 {
			 $cover_photo="";
			 }
		 }
		 
		 
		 $shop_profile_photo = Input::file('profile_photo');
		 if($shop_profile_photo!="")
		 {
			 if(!empty($editid))
			{
			 $shopro="/media/";
			$delpaths = base_path('images'.$shopro.$data['current_photo']);
			File::delete($delpaths);
			}
			 
            $profilename  = time() . '.' . $shop_profile_photo->getClientOriginalExtension();
            $shopphoto="/media/";
            $paths = base_path('images'.$shopphoto.$profilename);
			
 
        
               Image::make($shop_profile_photo->getRealPath())->resize(200, 200)->save($paths);
				
				$profile_photo=$profilename;
		 }
		 else
		 {
			 if(!empty($editid))
			 {
				 $profile_photo=$data['current_photo'];
			 }
			 else
			 {
				 
			 $profile_photo="";
			 }
		 }
		 
	      
		  
		
	
		if(!empty($data['name'])){ $name = $data['name']; } else { $name = ""; }
		if(!empty($data['address'])){ $address = $data['address']; } else { $address = ""; }
		if(!empty($data['city'])){ $city = $data['city']; } else { $city = ""; }
		if(!empty($data['state'])){ $state = $data['state']; } else { $state = ""; }
		if(!empty($data['country'])){ $country = $data['country']; } else { $country = ""; }
		if(!empty($data['pin_code'])){ $pin_code = $data['pin_code']; } else { $pin_code = ""; }
		if(!empty($data['phone'])){ $phone = $data['phone']; } else { $phone = ""; }
		if(!empty($data['desc'])){ $desc = $data['desc']; } else { $desc = ""; }
		if(!empty($data['email'])){ $email = $data['email']; } else { $email = ""; }
		
		if(!empty($data['local_shipping_price'])){ $local_ship = $data['local_shipping_price']; } else { $local_ship = ""; }
		if(!empty($data['international_shipping_price'])){ $international_ship = $data['international_shipping_price']; } else { $international_ship = ""; }
		
		if(!empty($data['shop_open_time']))
		{ 
		$shop_open_time = $data['shop_open_time'];
			       if($shop_open_time > 12)
					{
						$start=$shop_open_time - 12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$shop_open_time."AM";
					}
		 } 
		 else 
		 { 
		    $shop_open_time = ""; 
			$stime = "";
		 }
		 
		if(!empty($data['shop_close_time']))
		{ 
		   $shop_close_time = $data['shop_close_time'];
		   if($shop_close_time > 12)
					{
						$end=$shop_close_time-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$shop_close_time."AM";
					}
		} 
		else
		{ 
		    $shop_close_time = "";
			$etime="";
		}
		if(!empty($data['booking_upto'])){ $booking_upto = $data['booking_upto']; } else { $booking_upto = ""; }
        if(!empty($data['working_days']))
		{ 
			$working_day = $data['working_days']; 
			$workdays="";
			foreach($working_day as $working_days)
			{
				$workdays .=$working_days.',';
			}
			$workingdays=rtrim($workdays,",");
		
		}
		else
		{ 
		$booking_upto = ""; 
		$workingdays="";
		}
		
		
		
		
		
		
		$featured=0; 
		
		
		
		$admin_email_status=0;
		
		
		
		if(!empty($data['status']))
		{
		$status=$data['status'];
		}
		else
		{
			$status=0;
		}
		
		$site_logo=$data['site_logo'];
		
		$site_name=$data['site_name'];
		
		
		$token = $data['token'];
		
		
		
		if(empty($editid))
		{
			
		
		 
		
			DB::insert('insert into shop (token,name,email,address,city,pin_code,country,state,shop_phone_no,description,working_days,open_time,close_time,cover_photo,
			profile_photo,user_id,featured,admin_email_status,booking_upto,local_shipping_price,international_shipping_price,status) values (?, ?, ? , ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
			[$token,$name,$email,$address,$city,$pin_code,$country,$state,$phone,$desc,$workingdays,$shop_open_time,
			$shop_close_time,$cover_photo,$profile_photo,$userid,$featured,$admin_email_status,$booking_upto,$local_ship,$international_ship,$status]);
			
			if(!empty($data['file']))
			{
			   
			$shop_gallery = $data['file'];
			
			foreach($shop_gallery as $shop_photo)
			{
			
			$photofile  = time() . '.' . $shop_photo->getClientOriginalExtension();
            $shopphoto="/media/";
            $paths = base_path('images'.$shopphoto.$photofile);
			
			Image::make($shop_photo->getRealPath())->resize(600, 600)->save($paths);
			$photo=$photofile;
			
			DB::insert('insert into shop_gallery (token,user_id,photo) values (?, ?, ?)', [$token,$userid,$photo]);
			
			
			}
			
			
			}
			
	
		   Mail::send('myshop_email', ['name' => $name, 'address' => $address, 'city' => $city, 'pin_code' => $pin_code, 'country' => $country,
		   'state' => $state, 'phone' => $phone, 'desc' => $desc, 'booking_upto' => $booking_upto,
		    'stime' => $stime, 'etime' => $etime, 'site_logo' => $site_logo, 'site_name' => $site_name ], function ($message)
			{
				$message->subject('Shop Created Successfully');
				
			   
				
				
				$message->from(Auth::user()->email, 'Admin');
	
				$message->to(Input::get('email'));
				
				
	
			});
		
		
		
				 Mail::send('myshop_email', ['name' => $name, 'address' => $address, 'city' => $city, 'pin_code' => $pin_code, 'country' => $country,
		   'state' => $state, 'phone' => $phone, 'desc' => $desc, 'booking_upto' => $booking_upto,
		    'stime' => $stime, 'etime' => $etime, 'site_logo' => $site_logo, 'site_name' => $site_name ], function ($message)
			{
				$message->subject('New Shop Created');
				
			   
				
				
				$message->from(Auth::user()->email, 'Admin');
	
				$message->to(Auth::user()->email);
				
				
	
			});
		
		
		
		
		
		

		
		
		
		
		
		}
		else
		{
		$idd = $edit_shop[0]->user_id;
		
		
		    if(!empty($data['file']))
			{
			   
			$shop_gallery = $data['file'];
			
			foreach($shop_gallery as $shop_photo)
			{
			
			$photofile  = time() . '.' . $shop_photo->getClientOriginalExtension();
            $shopphoto="/media/";
            $paths = base_path('images'.$shopphoto.$photofile);
			
			Image::make($shop_photo->getRealPath())->resize(600, 600)->save($paths);
			$photo=$photofile;
			
			DB::insert('insert into shop_gallery (token,user_id,photo) values (?, ?, ?)', [$token,$userid,$photo]);
			
			
			}
			
			
			}
		
		
		
		
		
		
			DB::update('update shop set name="'.$name.'",email="'.$email.'",address="'.$address.'",city="'.$city.'",pin_code="'.$pin_code.'",country="'.$country.'",
			state="'.$state.'",shop_phone_no="'.$phone.'",description="'.$desc.'",working_days="'.$workingdays.'",open_time="'.$shop_open_time.'",
			close_time="'.$shop_close_time.'",cover_photo="'.$cover_photo.'",profile_photo="'.$profile_photo.'",
			booking_upto="'.$booking_upto.'",local_shipping_price="'.$local_ship.'",international_shipping_price="'.$international_ship.'" where user_id = ?', [$idd]);
			
			
		}
		
		
			
			
			
        
		
		$data = array('edit_shop' => $edit_shop, 'shop_count' => $shop_count, 'time' => $time,'days' => $days, 'daytext' => $daytext, 'select_days' => $select_days, 'site_setting'=> $site_setting, 'countries' => $countries);
		
		
		return redirect('myshop');
		
		
      }
		
		
		
		
		
		
		
		
		
		
		
	    
	}
	
	
	
	
	
	 public function avigher_editdata($id) {
       
	   $set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();
		
		$userid=Auth::user()->id;
		
		
		$service_edit = DB::table('shop_services')
		                ->where('id','=', $id)
						 ->where('user_id','=', $userid)
						->get();
		$service_edit_cnt = DB::table('shop_services')
		                ->where('id','=', $id)
						 ->where('user_id','=', $userid)
						->count();
						
						
		
	   $shop_service = DB::table('shop_services')
	                 ->where('user_id','=', $userid)
		         	 ->orderBy('id','desc')
					 ->get();	
					 
		$shop_service_cnt = DB::table('shop_services')
		            ->where('user_id','=', $userid)
		         	 ->orderBy('id','desc')
					 ->count();	
					 
					 
		$services_view = DB::table('services')
		         	 ->orderBy('name','asc')
					 ->get();
	   $services_cnt = DB::table('services')
		         	 ->orderBy('name','asc')
					 ->count();			 				 				
		
		$editid=$id;
	   
      $data = array('services_view' => $services_view, 'services_cnt' => $services_cnt, 'shop_service' => $shop_service, 'shop_service_cnt' => $shop_service_cnt, 'site_setting' => $site_setting, 'service_edit' => $service_edit, 'service_edit_cnt' => $service_edit_cnt , 'editid' => $editid);

        return view('myservices')->with($data); 
   }
   
	
	
	
	public function myservice_index()
	{
	   $userid=Auth::user()->id;
	   $services_view = DB::table('services')
		         	 ->orderBy('name','asc')
					 ->get();
	   $services_cnt = DB::table('services')
		         	 ->orderBy('name','asc')
					 ->count();
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$shop_service = DB::table('shop_services')
		             ->where('user_id','=', $userid)
		         	 ->orderBy('id','desc')
					 ->get();	
					 
		$shop_service_cnt = DB::table('shop_services')
		             ->where('user_id','=', $userid)
		         	 ->orderBy('id','desc')
					 ->count();			 		 
					 				 
	   
	   $data = array('services_view' => $services_view, 'services_cnt' => $services_cnt, 'site_setting' => $site_setting, 'shop_service' => $shop_service, 'shop_service_cnt' => $shop_service_cnt);
	   return view('myservices')->with($data);
	}
	
	
	
	protected function avigher_servicedatas(Request $request)
   {
	   $data = $request->all();
	   $service_id=$data['service_id'];
	   
	   $price=$data['price'];
	   $time=$data['time'];
	   $userid = Auth::user()->id;
	   
	   $editid=$data['editid'];
	   
	   
	   
	   $service_count = DB::table('shop_services')
				->where('user_id', '=', $userid)
				->where('service_id', '=', $service_id)
				->count();
	   
	   if($editid=="")
	   {
	   
			   if($service_count==0)
			   
			   {
			   DB::insert('insert into shop_services (service_id,price,time,user_id) values (?, ?, ?, ?)', [$service_id,$price,$time,$userid]);
				
			   return back()->with('success', 'Services has been added');
			   }
			   else
			   {
				   return back()->with('error','That services is already added.');
			   }
	   }
       else if($editid!="")
       {
	       
		   DB::update('update shop_services set service_id="'.$service_id.'",price="'.$price.'",time="'.$time.'" where id = ?', [$editid]);
			return back()->with('success', 'Services has been updated');
		   
		   
		   
	   }	
	   	   
	   
   }
	
	
	
	
	public function avigher_service_destroy($id) {
		
		
      DB::delete('delete from shop_services where id = ?',[$id]);
	   
      
	 
	  return redirect('myservices');
      
   }
	
	
	
	
	
	
	
}
