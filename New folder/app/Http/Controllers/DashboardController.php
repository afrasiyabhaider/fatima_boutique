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

class DashboardController extends Controller
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
	 
	 
	 
	 
	 
	public function avigher_my_profile($user_id,$user_slug)
	{
	
	    
		$editprofile_count = DB::table('users')
		               ->where('id', '=', $user_id)
	                   ->count();
		
		
		$editprofile = DB::table('users')
		               ->where('id', '=', $user_id)
	                   ->get();
					   
					   
		
	$viewcount = DB::table('product')
		          ->where('user_id', '=' , $user_id)
				  ->where('delete_status','=','')
				  ->orderBy('prod_id','desc')
		          ->count();
	
	$viewproduct = DB::table('product')
		          ->where('user_id', '=' , $user_id)
				   ->where('delete_status','=','')
				    ->orderBy('prod_id','desc')
		          ->get();
				  
				  
				  
	
						  
						  
			   
	
	   
	   $data = array('editprofile' => $editprofile, 'editprofile_count' => $editprofile_count, 'viewcount' => $viewcount, 'viewproduct' => $viewproduct, 'user_id' => $user_id);
		return view('profile')->with($data);
	   
	} 
	 
	 
	 
	 
    public function index()
    {
        $userid = Auth::user()->id;
		$editprofile = DB::select('select * from users where id = ?',[$userid]);
		
		
		
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

		
		
		
		
		
		$viewpost = DB::table('post')
		        ->where('post_type', '=' , 'comment')
				->where('post_user_id', '=' , $userid)
		        
				->count();
				
				
				
				
				
				$edited_count = DB::table('product_billing_shipping')
		        ->where('user_id', '=' , $userid)
				->count();
				
				
				$edited = DB::select('select * from product_billing_shipping where user_id = ?',[$userid]);
				
				
		
		$data = array('editprofile' => $editprofile, 'viewpost' => $viewpost, 'countries' => $countries, 'edited' => $edited, 'edited_count' => $edited_count);
		return view('dashboard')->with($data);
    }
	
	
	
	
	public function mycomments()
    {
	$userid = Auth::user()->id;
	
	$viewpost = DB::table('post')
		        ->where('post_type', '=' , 'comment')
				->where('post_user_id', '=' , $userid)
		        
				->get();
				
	$postcount = DB::table('post')
		        ->where('post_type', '=' , 'comment')
				->where('post_user_id', '=' , $userid)
		        
				->count();			
				
	$data = array('viewpost' => $viewpost, 'postcount' => $postcount);
	return view('my-comments')->with($data);
	}
	
	
	public function mycomments_destroy($id) {
		
		
	   
	   DB::delete('delete from post where post_type="comment" and post_id = ?',[$id]);
     
	   
      return back();
      
   }
	
	
	
	
	
	
	
	public function avigher_logout()
	{
		Auth::logout();
       return back();
	}
	
	
	public function avigher_deleteaccount()
	{
		$userid = Auth::user()->id;
		
		
		
		
		
		
	  DB::delete('delete from post where post_type="comment" and post_user_id = ?',[$userid]);
	  
		
		
		DB::delete('delete from users where id!=1 and id = ?',[$userid]);
		return back();
	}
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}  
	
	
	
	
	public function avigher_contact_vendor(Request $request)
	{
	
	    $data = $request->all();
		
		$name = $data['name'];
		
		$phone = $data['phone'];
		$msg = $data['msg'];
		
		$vendor_id = $data['vendor_id'];
		
		
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	
	   
	   $url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$seller_details = DB::table('users')
		 ->where('id', '=', $vendor_id)
		 ->get();
		
		
		$slug = $seller_details[0]->post_slug;
		
		$seller_email = $seller_details[0]->email;
		
		$user_email = $data['email'];
		
		$data = [
            'slug' => $slug, 'url' => $url, 'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name, 'user_email' => $user_email, 'phone' => $phone, 'msg' => $msg, 'seller_email' => $seller_email
        ];
		
		
		 Mail::send('seller_contactmail', $data , function ($message) use ($user_email,$seller_email,$name)
        {
            $message->subject('Contact Vendor');
			
            $message->from($user_email, $name);

            $message->to($seller_email);

        });  
		
		
		
		return back()->with('success', 'Thank you for contact us');
		
		
		
		
		
	
	}
	
	
	
	 protected function avigher_edituserdata(Request $request)
    {
       
		
		
		
		 $this->validate($request, [

        		'name' => 'required',

        		'email' => 'required|email'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		$input['email'] = Input::get('email');
       
		$input['name'] = Input::get('name');
		
		$providor = Auth::user()->provider;
		
		
		$settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		 $imagetype = $settings[0]->image_type;
		  $mp3size = $settings[0]->mp3_size;
		
		
		
		if($providor=="")
		{
		$rules = array(
        
       
		
        'email'=>'required|email|unique:users,email,'.$id,
		'name' => 'required|regex:/^[\w-]*$/|max:255|unique:users,name,'.$id,
		'photo' => 'max:'.$imgsize.'|mimes:'.$imagetype,
		'profile_banner' => 'max:'.$imgsize.'|mimes:'.$imagetype,
		'phone' => 'required|max:255|unique:users,phone,'.$id
		
		
        );
		}
		
		
		else
		{
		
		
		
		$rules = array(
        
       
		
        'email'=>'required|email:users,email,'.$id,
		'photo' => 'max:'.$imgsize.'|mimes:'.$imagetype,
		'profile_banner' => 'max:'.$imgsize.'|mimes:'.$imagetype,
		'phone' => 'required|max:255|unique:users,phone,'.$id
		
		
        );
		
		}
		
		
		
		
		
		
		
		$messages = array(
            
            'email' => 'The :attribute field is already exists',
            'name' => 'The :attribute field must only be letters and numbers (no spaces)'
			
        );
		
		
		
		
		
		 $validator = Validator::make(Input::all(), $rules, $messages);

		

		if ($validator->fails())
		{
			 $failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		  
        
		if(!empty($data['name'])){ $name=$data['name']; } else { $name = ""; }
		if(!empty($data['email'])){  $email=$data['email']; } else { $email = ""; }
		if(!empty($data['phone'])) { $phone=$data['phone']; } else { $phone= ""; }
		if(!empty($data['gender'])) { $gender = $data['gender']; } else { $gender = ""; }
		if(!empty($data['country'])){ $country =  $data['country']; } else { $country = ""; }
		if(!empty($data['address'])) { $address = $data['address']; } else { $address = ""; }
		$password=bcrypt($data['password']);
		if($data['password']!=""){ $passtxt=$password; } else { $passtxt=$data['savepassword']; }
		
		if(!empty($data['about'])){ $about_txt = $data['about']; } else { $about_txt = ""; } 
		
		
		
		/* billing fields */
		
		if(!empty($data['bill_firstname'])) { $bill_firstname = $data['bill_firstname']; } else { $bill_firstname = ""; }
		if(!empty($data['bill_lastname'])) { $bill_lastname = $data['bill_lastname']; } else { $bill_lastname = ""; }
		if(!empty($data['bill_companyname'])) { $bill_companyname = $data['bill_companyname']; } else { $bill_companyname = ""; }
		if(!empty($data['bill_email'])) { $bill_email = $data['bill_email']; } else { $bill_email = ""; }
		if(!empty($data['bill_phone'])) { $bill_phone = $data['bill_phone']; } else { $bill_phone = ""; }
		if(!empty($data['bill_country'])) { $bill_country = $data['bill_country']; } else { $bill_country = ""; }
		if(!empty($data['bill_address'])) { $bill_address = $data['bill_address']; } else { $bill_address = ""; }
		if(!empty($data['bill_city'])) { $bill_city = $data['bill_city']; } else { $bill_city = ""; }
		if(!empty($data['bill_state'])) { $bill_state = $data['bill_state']; } else { $bill_state = ""; }
		if(!empty($data['bill_postcode'])) { $bill_postcode = $data['bill_postcode']; } else { $bill_postcode = ""; }
		
		/* end billing fields */
		
		
		
		
		/* shipping fields */
		
		if(!empty($data['ship_firstname'])) { $ship_firstname = $data['ship_firstname']; } else { $ship_firstname = ""; }
		if(!empty($data['ship_lastname'])) { $ship_lastname = $data['ship_lastname']; } else { $ship_lastname = ""; }
		if(!empty($data['ship_companyname'])) { $ship_companyname = $data['ship_companyname']; } else { $ship_companyname = ""; }
		if(!empty($data['ship_email'])) { $ship_email = $data['ship_email']; } else { $ship_email = ""; }
		if(!empty($data['ship_phone'])) { $ship_phone = $data['ship_phone']; } else { $ship_phone = ""; }
		if(!empty($data['ship_country'])) { $ship_country = $data['ship_country']; } else { $ship_country = ""; }
		if(!empty($data['ship_address'])) { $ship_address = $data['ship_address']; } else { $ship_address = ""; }
		if(!empty($data['ship_city'])) { $ship_city = $data['ship_city']; } else { $ship_city = ""; }
		if(!empty($data['ship_state'])) { $ship_state = $data['ship_state']; } else { $ship_state = ""; }
		if(!empty($data['ship_postcode'])) { $ship_postcode = $data['ship_postcode']; } else { $ship_postcode = ""; }
		
		/* end shipping fields */
		
		
		if(!empty($data['enable_ship'])){ $enable_ship = $data['enable_ship']; } else { $enable_ship = 0; }
		
		
		
		if(!empty($data['local_shipping_price'])){ $local_shipping_price = $data['local_shipping_price']; } else { $local_shipping_price = 0; }
		if(!empty($data['world_shipping_price'])){ $world_shipping_price = $data['world_shipping_price']; } else { $world_shipping_price = 0; }
		
		
		
		
		$currentphoto=$data['currentphoto'];
		
		
		$image = Input::file('photo');
		
		$currentbanner=$data['currentbanner'];
		
		
		$profile_image = Input::file('profile_banner');
		
		
        if($image!="")
		{	
            $userphoto="/media/";
			$delpath = base_path('images'.$userphoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$userphoto.$filename);
      
                Image::make($image->getRealPath())->resize(200, 200)->save($path);
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentphoto;
		}	
		
		
		
		
		
		
        if($profile_image!="")
		{	
            $userphoto_two="/media/";
			$delpath_two = base_path('images'.$userphoto_two.$currentbanner);
			File::delete($delpath_two);	
			$filename_two  = time() . '.' . $profile_image->getClientOriginalExtension();
            
            $path_two = base_path('images'.$userphoto_two.$filename_two);
      
                Image::make($profile_image->getRealPath())->resize(1140, 370)->save($path_two);
				$save_banners=$filename_two;
		}
        else
		{
			$save_banners=$currentbanner;
		}
		
		
		if($image=="" && $profile_image=="")
		{
		$savefname=$currentphoto;
		$save_banners=$currentbanner;
		}
		
		if($image!="" && $profile_image!="")		
		{
           if($image!="")
		   {
          $userphoto="/media/";
			$delpath = base_path('images'.$userphoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$userphoto.$filename);
      
                Image::make($image->getRealPath())->resize(200, 200)->save($path);
				$savefname=$filename;
			}	
				
			if($profile_image!="")
			{	
				
				$userphoto_two="/media/";
			$delpath_two = base_path('images'.$userphoto_two.$currentbanner);
			File::delete($delpath_two);	
			$filename_two  = time() . '.' . $profile_image->getClientOriginalExtension();
            
            $path_two = base_path('images'.$userphoto_two.$filename_two);
      
                Image::make($profile_image->getRealPath())->resize(1140, 370)->save($path_two);
				$save_banners=$filename_two;
			}


		}
		
		
		
		
		$viewcount = DB::table('product_billing_shipping')
					  ->where('user_id','=',$id)
					  ->count();
		
		if(empty($viewcount))
		{
		   DB::insert('insert into product_billing_shipping (user_id,bill_firstname,bill_lastname,bill_companyname,bill_email,bill_phone,bill_country,bill_address,bill_city,bill_state,	bill_postcode,	enable_ship,ship_firstname,ship_lastname,ship_companyname,ship_email,ship_phone,ship_country,ship_address,ship_city,ship_state,ship_postcode) values (?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?,?,?, ?,?)', [$id,$bill_firstname,$bill_lastname,$bill_companyname,$bill_email,$bill_phone,$bill_country,$bill_address,$bill_city,$bill_state,$bill_postcode,$enable_ship,$ship_firstname,$ship_lastname,$ship_companyname,$ship_email,$ship_phone,$ship_country,$ship_address,$ship_city,$ship_state,$ship_postcode]);
		}
		
		else
		{
		
		DB::update('update product_billing_shipping set 
		bill_firstname="'.$bill_firstname.'",
		bill_lastname="'.$bill_lastname.'",
		bill_companyname="'.$bill_companyname.'",
		bill_email="'.$bill_email.'",
		bill_phone="'.$bill_phone.'",
		bill_country="'.$bill_country.'",
		bill_address="'.$bill_address.'",
		bill_city="'.$bill_city.'",
		bill_state="'.$bill_state.'",
		bill_postcode="'.$bill_postcode.'",
		enable_ship="'.$enable_ship.'",
		ship_firstname="'.$ship_firstname.'",
		ship_lastname="'.$ship_lastname.'",
		ship_companyname="'.$ship_companyname.'",
		ship_email="'.$ship_email.'",
		ship_phone="'.$ship_phone.'",
		ship_country="'.$ship_country.'",
		ship_address="'.$ship_address.'",
		ship_city="'.$ship_city.'",
		ship_state="'.$ship_state.'",
		ship_postcode="'.$ship_postcode.'"
		
		 where user_id = ?', [$id]);
		
		}
		
		
		
		
		DB::update('update post set post_email="'.$email.'" where post_type="comment" and post_user_id = ?', [$id]);
		
		
		
		DB::update('update users set name="'.$name.'",post_slug="'.$this->clean($name).'",email="'.$email.'",password="'.$passtxt.'",phone="'.$phone.'",gender="'.$gender.'",country="'.$country.'",photo="'.$savefname.'",profile_banner="'.$save_banners.'",about="'.$about_txt.'",address="'.$address.'",local_shipping_price="'.$local_shipping_price.'",world_shipping_price="'.$world_shipping_price.'" where id = ?', [$id]);
		
		
		
			return back()->with('success', 'Account has been updated');
        }
		
		
		
		
    }
	
	
}
