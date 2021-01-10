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


class ColorsettingsController extends Controller
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
      $msettings = DB::select('select * from color_settings where id = ?',[1]);
	  $currency=array("USD","CZK","DKK","HKD","HUF","ILS","JPY","MXN","NZD","NOK","PHP","PLN","SGD","SEK","CHF","THB","AUD","CAD","EUR","GBP","AFN","DZD",
							"AOA","XCD","ARS","AMD","AWG","SHP","AZN","BSD","BHD","BDT","INR");
		
		
		
	  $data=array('msettings'=>$msettings, 'currency' => $currency);
      return view('admin.color-settings')->with($data);
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
			
         
		
		
		
		 $rules = array(
               
		'site_logo' => 'max:1024|mimes:jpg,jpeg,png',
		'site_favicon' => 'max:1024|mimes:jpg,jpeg,png',
		'site_banner' => 'max:1024|mimes:jpg,jpeg,png'
		
		
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
		
		
		
		
		
		
		
		if($data['body_font']!="")
		{
			$bodyfont = $data['body_font'];
		}
		else
		{
			 $bodyfont = $data['save_body'];
		}
		
		
		if($data['font_size']!="")
		{
			$fontsize = $data['font_size'];
		}
		else
		{
			 $fontsize = $data['save_font'];
		}
		
		if($data['heading1']!="")
		{
			$heading1 = $data['heading1'];
		}
		else
		{
			 $heading1 = $data['save_heading1'];
		}
		
		
		if($data['head_font1']!="")
		{
			$headfont1 = $data['head_font1'];
		}
		else
		{
			 $headfont1 = $data['save_head_font1'];
		}
		
		
		if($data['heading2']!="")
		{
			$heading2 = $data['heading2'];
		}
		else
		{
			 $heading2 = $data['save_heading2'];
		}
		
		
		if($data['head_font2']!="")
		{
			$headfont2 = $data['head_font2'];
		}
		else
		{
			 $headfont2 = $data['save_head_font2'];
		}
		
		if($data['heading3']!="")
		{
			$heading3 = $data['heading3'];
		}
		else
		{
			 $heading3 = $data['save_heading3'];
		}
		
		if($data['head_font3']!="")
		{
			$headfont3 = $data['head_font3'];
		}
		else
		{
			 $headfont3 = $data['save_head_font3'];
		}
		
		
		if($data['heading4']!="")
		{
			$heading4 = $data['heading4'];
		}
		else
		{
			 $heading4 = $data['save_heading4'];
		}
		
		
		if($data['head_font4']!="")
		{
			$headfont4 = $data['head_font4'];
		}
		else
		{
			 $headfont4 = $data['save_head_font4'];
		}
		
		
		if($data['heading5']!="")
		{
			$heading5 = $data['heading5'];
		}
		else
		{
			 $heading5 = $data['save_heading5'];
		}
		
		
		if($data['head_font5']!="")
		{
			$headfont5 = $data['head_font5'];
		}
		else
		{
			 $headfont5 = $data['save_head_font5'];
		}
		
		if($data['heading6']!="")
		{
			$heading6 = $data['heading6'];
		}
		else
		{
			 $heading6 = $data['save_heading6'];
		}
		
		if($data['head_font6']!="")
		{
			$headfont6 = $data['head_font6'];
		}
		else
		{
			 $headfont6 = $data['save_head_font6'];
		}
		
		
		
		if($data['paragraph']!="")
		{
			$paragraph = $data['paragraph'];
		}
		else
		{
			 $paragraph = $data['save_paragraph'];
		}
		
		
		if($data['para_font_size']!="")
		{
			$para_font = $data['para_font_size'];
		}
		else
		{
			 $para_font = $data['save_para_font'];
		}
		
		
		
		if($data['list_font']!="")
		{
			$list_font = $data['list_font'];
		}
		else
		{
			 $list_font = $data['save_list_font'];
		}
		
		
		if($data['list_font_size']!="")
		{
			$list_size = $data['list_font_size'];
		}
		else
		{
			 $list_size = $data['save_list_size'];
		}
		
		
		if($data['theme_color']!="")
		{
			$theme_color = $data['theme_color'];
		}
		else
		{
			 $theme_color = $data['save_theme'];
		}
		
		
		if($data['button_color']!="")
		{
			$button_color = $data['button_color'];
		}
		else
		{
			 $button_color = $data['save_button'];
		}
		
		if($data['link_color']!="")
		{
			$link_color = $data['link_color'];
		}
		else
		{
			 $link_color = $data['save_link'];
		}
		
		
		
		
		
		DB::update('update color_settings set  body_font="'.$bodyfont.'",font_size="'.$fontsize.'",heading1="'.$heading1.'",head_font1="'.$headfont1.'",heading2="'.$heading2.'",head_font2="'.$headfont2.'",heading3="'.$heading3.'",head_font3="'.$headfont3.'",heading4="'.$heading4.'",head_font4="'.$headfont4.'",heading5="'.$heading5.'",head_font5="'.$headfont5.'",heading6="'.$heading6.'",head_font6="'.$headfont6.'",paragraph="'.$paragraph.'",para_font_size="'.$para_font.'",list_font="'.$list_font.'",list_font_size="'.$list_size.'",theme_color="'.$theme_color.'",button_color="'.$button_color.'",link_color="'.$link_color.'" where id = ?', [1]);
		
			return back()->with('success', 'Font & Color settings has been updated');
        
		
		}
		
		
    }
}
