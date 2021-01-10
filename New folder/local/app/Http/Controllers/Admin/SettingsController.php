<?php

namespace Responsive\Http\Controllers\Admin;


use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class SettingsController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
	
	public function showform() {
      $settings = DB::select('select * from settings where id = ?',[1]);
	  $currency=array("USD","CZK","DKK","HKD","HUF","ILS","JPY","MXN","NZD","NOK","PHP","PLN","SGD","SEK","CHF","THB","AUD","CAD","EUR","GBP","AFN","DZD",
							"AOA","XCD","ARS","AMD","AWG","SHP","AZN","BSD","BHD","BDT","INR","MUR","AED");
		
		
		
	  $data=array('settings'=>$settings, 'currency' => $currency);
      return view('admin.settings')->with($data);
   }
   
   
   
   public function paymentform() {
      $settings = DB::select('select * from settings where id = ?',[1]);
	  
	 /* $withdraw=array("paypal","stripe","localbank");
	  $payment=array("paypal","stripe","localbank");*/
	  
	  
	  $withdraw=array("paypal","stripe","localbank");
	  $payment=array("paypal","stripe","cash-on-delivery","payhere","razorpay");
	  
	 
   $data=array('settings'=>$settings, 'withdraw' => $withdraw, 'payment' => $payment);
      return view('admin.payment-settings')->with($data);
   }
   
   
   
   
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  protected $fillable = ['name', 'email','password','phone'];
	 
    protected function editsettings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		$site_name=$data['site_name'];
		
		
		$imgsize=$data['image_size'];
		$imgtype=$data['image_type'];
		
		
		
		
		
		
		
		 $rules = array(
               
		'site_logo' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'site_favicon' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'site_banner' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'site_loading_url' => 'max:'.$imgsize.'|mimes:'.$imgtype
		
		
        );
		
		$messages = array(
            
           
			
        );
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		
		$currentlogo=$data['currentlogo'];
		
		
		$image = Input::file('site_logo');
        if($image!="")
		{	
            $settingphoto="/media/";
			$delpath = base_path('images'.$settingphoto.$currentlogo);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$settingphoto.$filename);
			$destinationPath=base_path('images'.$settingphoto);
      
                /*Image::make($image->getRealPath())->resize(200, 200)->save($path);*/
				
				Input::file('site_logo')->move($destinationPath, $filename);
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentlogo;
		}	




		$currentfav = $data['currentfav'];
		
		
		
		$images = Input::file('site_favicon');
        if($images!="")
		{	
            $settingphotos="/media/";
			$delpaths = base_path('images'.$settingphotos.$currentfav);
			File::delete($delpaths);	
			$filenames  = time() . '.' . $images->getClientOriginalExtension();
            
            $paths = base_path('images'.$settingphotos.$filenames);
			$destinationPaths=base_path('images'.$settingphotos);
      
                Image::make($images->getRealPath())->resize(24, 24)->save($paths);
				
				/* Input::file('site_logo')->move($destinationPath, $filename);*/
				$savefav=$filenames;
		}
        else
		{
			$savefav=$currentfav;
		}
		
		
		
		$currentban = $data['currentban'];
		
		
		$banimages = Input::file('site_banner');
        if($banimages!="")
		{	
            $settingbanphotos="/media/";
			$delpathes = base_path('images'.$settingbanphotos.$currentban);
			File::delete($delpathes);	
			$banfilenames  = time() . '.' . $banimages->getClientOriginalExtension();
            
            $banpaths = base_path('images'.$settingbanphotos.$banfilenames);
			$destinationbanPaths=base_path('images'.$settingbanphotos);
      
                /* Image::make($banimages->getRealPath())->resize(1920, 500)->save($banpaths);*/
				Input::file('site_banner')->move($destinationbanPaths, $banfilenames);
				
				$savebanner=$banfilenames;
		}
        else
		{
			$savebanner=$currentban;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		$currentloading = $data['save_loading_url'];
		$loadurl = Input::file('site_loading_url');
        if($loadurl!="")
		{	
            $loadphotos="/media/";
			$delpathee = base_path('images'.$loadphotos.$currentloading);
			File::delete($delpathee);	
			$banfilenamee  = time() . '.' . $loadurl->getClientOriginalExtension();
            
            $banpathe = base_path('images'.$loadphotos.$banfilenamee);
			$destinationbanPathe=base_path('images'.$loadphotos);
      
                /*Image::make($loadurl->getRealPath())->resize(791, 547)->save($banpathe);*/
				
				 Input::file('site_loading_url')->move($destinationbanPathe, $banfilenamee);
				$savefavee=$banfilenamee;
		}
        else
		{
			$savefavee=$currentloading;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$site_desc=$data['site_desc'];
		$site_keyword=$data['site_keyword'];
		
		
		
		
		if($data['site_desc']!="")
		{
			$desctxt=$site_desc;
		}
		else
		{
			$desctxt=$data['save_desc'];
		}
		
		
		if($data['site_keyword']!="")
		{
			$keytxt=$site_keyword;
		}
		else
		{
			$keytxt=$data['save_key'];
		}
		
		
		
		if($data['site_address']!="")
		{
			$siteaddress=$data['site_address'];
		}
		else
		{
			$siteaddress=$data['save_address'];
		}
		
		
		
		
		
		
		
		
		
		if($data['site_url']!="")
		{
			$mojo_siteurl = $data['site_url'];
		}
		else
		{
			 $mojo_siteurl = $data['save_siteurl'];
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$fb = $data['site_facebook'];
		
		if($data['site_facebook']!="")
		{
			$facebook = $fb;
		}
		else
		{
			$facebook = "";
		}
		
		$twi = $data['site_twitter'];
		
		if($data['site_twitter']!="")
		{
			$twitter = $twi;
		}
		else
		{
			$twitter = "";
		}
		
		
		
		
		$gpl = $data['site_gplus'];
		
		if($data['site_gplus']!="")
		{
			$gplus = $gpl;
		}
		else
		{
			$gplus = "";
		}
		
		
		
		$pin = $data['site_pinterest'];
		
		if($data['site_pinterest']!="")
		{
			$pinterest = $pin;
		}
		else
		{
			$pinterest = "";
		}
		
		
		
		
		$ins = $data['site_instagram'];
		
		if($data['site_instagram']!="")
		{
			$instagram = $ins;
		}
		else
		{
			$instagram = "";
		}
		
		
		$copys = $data['site_copyright'];
		
		if($data['site_copyright']!="")
		{
			$copyrights = $copys;
		}
		else
		{
			$copyrights = $data['save_copyright'];
		}
		
		
		
		
		$site_post = $data['site_post_per'];
		
		if($data['site_post_per']!="")
		{
			$sitepost = $site_post;
		}
		else
		{
			$sitepost = $data['save_post_per'];
		}
		
		
		
		
		
		
		
		
		
		
		
		/*$header_type = $data['header_type'];
		
		if($data['header_type']!="")
		{ 
		  $headertype = $header_type;
		}
		else
		{
		  $headertype = $data['save_header_type'];
		}*/
		
		
		
		
		$map_api = $data['site_map_api'];
		
		if($data['site_map_api']!="")
		{ 
		  $mapapi = $map_api;
		}
		else
		{
		  $mapapi = $data['save_map_api'];
		}
		
		$site_loading = $data['site_loading'];
		
		
		
		$site_email = $data['site_email'];
		$site_phone = $data['site_phone'];
		
		
		
		
		if(!empty($data['site_gallery_per']))
		{
		    $site_gallery_per = $data['site_gallery_per'];
		}
		else
		{
		  $site_gallery_per = "";
		}
		
		
		
		if(!empty($data['site_blog_ads']))
		{
		  $site_blog_ads = htmlentities($data['site_blog_ads']);
		}
		else
		{
		   $site_blog_ads = "";
		}
		
		
		
		if(!empty($data['site_shop_ads']))
		{
		  $site_shop_ads = htmlentities($data['site_shop_ads']);
		}
		else
		{
		   $site_shop_ads = "";
		}
		
		
		
		
		
		if(!empty($data['site_vimeo']))
		{
		    $site_vimeo = $data['site_vimeo'];
		}
		else
		{
		   $site_vimeo = "";
		}
		
		
		
		
		
		
		if(!empty($data['site_product_per']))
		{
		    $site_product_per = $data['site_product_per'];
		}
		else
		{
		   $site_product_per= "";
		}
		
		
		
		if(!empty($data['site_vendor_per']))
		{
		    $site_vendor_per = $data['site_vendor_per'];
		}
		else
		{
		   $site_vendor_per= "";
		}
		
		
		
		if(!empty($data['currency']))
		{
		$currency=$data['currency'];
		}
		else
		{
		 $currency="";
		}
		
		
		
		if(!empty($data['site_primary_color']))
		{
		 $site_primary_color = $data['site_primary_color'];
		}
		else
		{
		 $site_primary_color = "";
		}
		
		
		if(!empty($data['site_secondary_color']))
		{
		 $site_secondary_color = $data['site_secondary_color'];
		}
		else
		{
		 $site_secondary_color = "";
		}
		
		
		if(!empty($data['site_button_color']))
		{
		 $site_button_color = $data['site_button_color'];
		}
		else
		{
		 $site_button_color = "";
		}
		
		
		DB::update('update settings set 
		site_name="'.$site_name.'",
		site_desc="'.$desctxt.'",
		site_keyword="'.$keytxt.'",
		site_blog_ads="'.$site_blog_ads.'",
		site_shop_ads="'.$site_shop_ads.'",
		site_address="'.$siteaddress.'",
		site_email="'.$site_email.'",
		site_phone="'.$site_phone.'",
		site_facebook="'.$facebook.'",
		site_twitter="'.$twitter.'",
		site_gplus="'.$gplus.'",
		site_pinterest="'.$pinterest.'",
		site_instagram="'.$instagram.'",
		site_copyright="'.$copyrights.'",
		site_post_per="'.$sitepost.'",
		site_product_per="'.$site_product_per.'",
		site_vendor_per="'.$site_vendor_per.'",
		site_currency="'.$currency.'",
		site_logo="'.$savefname.'",
		site_favicon="'.$savefav.'",
		site_banner="'.$savebanner.'",
		site_loading="'.$site_loading.'",
		site_loading_url="'.$savefavee.'",
		site_map_api="'.$mapapi.'",
		site_url="'.$mojo_siteurl.'",
		site_primary_color="'.$site_primary_color.'",
		site_secondary_color="'.$site_secondary_color.'",
		site_button_color="'.$site_button_color.'"
		 where id = ?', [1]);
		
			return back()->with('success', 'Settings has been updated');
        
		
		}
		
		
    }
	
	
	
	
	
	
	
	protected function payment_settings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		
		
		
		 $rules = array(
               
		
		
		
        );
		
		$messages = array(
            
           
			
        );
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		
		
		
		
		
		
		
		
		
		
		$withdraw_opt="";
		foreach($data['withdraw_opt'] as $with)
		{
			$withdraw_opt .=$with.",";
		}
		$withdraw = rtrim($withdraw_opt,",");
		
		
		
		$payment_opt="";
		foreach($data['payment_opt'] as $with)
		{
			$payment_opt .=$with.",";
		}
		$payment = rtrim($payment_opt,",");
		
		
		$paypal_id = $data['paypal_id'];
		$paypal_url = $data['paypal_url'];
		
		$commission_mode=$data['commission_mode'];
		$commission_amt=$data['commission_amt'];
		$withdraw_amt=$data['withdraw_amt'];
		
		$processing_fee = $data['processing_fee'];
		
		
		$stripe_mode = $data['stripe_mode'];
		$test_publish_key = $data['test_publish_key'];
		$test_secret_key = $data['test_secret_key'];
		$live_publish_key = $data['live_publish_key'];
		$live_secret_key = $data['live_secret_key'];
		if(!empty($data['bank_payment']))
		{
		   $bank_payment = $data['bank_payment'];
		}
		else
		{
		   $bank_payment="";
		}
		
		
		
		if(!empty($data['payhere_mode'])){ $payhere_mode = $data['payhere_mode']; } else { $payhere_mode = ""; }
		if(!empty($data['payhere_merchant_id'])) { $payhere_merchant_id = $data['payhere_merchant_id']; } else { $payhere_merchant_id = ""; }
		
		$day_before_withdraw = $data['day_before_withdraw'];
		
		
		$ccavenue_merchant_id = $data['ccavenue_merchant_id'];
		$ccavenue_working_key = $data['ccavenue_working_key'];
		$ccavenue_access_code = $data['ccavenue_access_code'];
		
		
		$razorpay_key_id = $data['razorpay_key_id'];
		$razorpay_key_secret = $data['razorpay_key_secret'];
		
		
		
		DB::update('update settings set
		payment_option="'.$payment.'", 
		withdraw_option="'.$withdraw.'",
		bank_payment="'.$bank_payment.'",
		paypal_id="'.$paypal_id.'",
		paypal_url="'.$paypal_url.'",
		stripe_mode="'.$stripe_mode.'",
		test_publish_key="'.$test_publish_key.'",
		test_secret_key="'.$test_secret_key.'",
		live_publish_key="'.$live_publish_key.'",
		live_secret_key="'.$live_secret_key.'",
		commission_mode="'.$commission_mode.'",
		commission_amt="'.$commission_amt.'",
		withdraw_amt="'.$withdraw_amt.'",
		day_before_withdraw="'.$day_before_withdraw.'",
		processing_fee="'.$processing_fee.'",
		payhere_mode="'.$payhere_mode.'",
		payhere_merchant_id="'.$payhere_merchant_id.'",
		ccavenue_merchant_id="'.$ccavenue_merchant_id.'",
		ccavenue_working_key="'.$ccavenue_working_key.'",
		ccavenue_access_code="'.$ccavenue_access_code.'",
		razorpay_key_id="'.$razorpay_key_id.'",
		razorpay_key_secret="'.$razorpay_key_secret.'"
		where id = ?', [1]);
		
			return back()->with('success', 'Payment Settings has been updated');
        
		
		}
		
		
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
