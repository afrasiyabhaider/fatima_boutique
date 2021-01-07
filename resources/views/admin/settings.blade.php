<!DOCTYPE html>
<html lang="en">
  <head>
   
  
     @include('admin.title')
    @include('admin.style')
	
    <script type="text/javascript">
	


function showDiver(elem)
{
   
   if(elem.value == 'static')
   {
      document.getElementById('heading_banner').style.display = "block";
	  document.getElementById('subheading_banner').style.display = "block";
   }
   else if(elem.value == 'slider')
   {
       document.getElementById('heading_banner').style.display = "none";
	  document.getElementById('subheading_banner').style.display = "none";
   }
   else
   {
     document.getElementById('heading_banner').style.display = "none";
	  document.getElementById('subheading_banner').style.display = "none";
   }
   
}


function showLoad(elem)
{

   if(elem.value == "1")
   {
     document.getElementById('animated').style.display = "block";
   }
   else if(elem.value == "0")
   {
     document.getElementById('animated').style.display = "none";
   }
   else
   {
     document.getElementById('animated').style.display = "none";
	}

}
</script>
  </head>

  <body>
  
  
  @include('admin.top')
<!--close-top-serch-->
<!--sidebar-menu-->
@include('admin.menu')
  
  
  <div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>General Settings</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      @if(Session::has('error'))
      <div class="alert alert-error">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
              {{ Session::get('error') }}
              </div>
      @endif
      
      @if(Session::has('success'))

	           
        <div class="alert alert-success">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
               {{ Session::get('success') }}
              </div>

	@endif

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>General Settings</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $url = URL::to("/"); ?> 
            <form class="form-horizontal" method="post" action="{{ route('admin.settings') }}" name="basic_validate" id="formID" novalidate="novalidate" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Site Name <span>*</span></label>
                <div class="controls">
                  <input type="text" name="site_name" class="validate[required] text-input span8" id="required" value="<?php echo $settings[0]->site_name; ?>">
                   
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Site Description <span>*</span></label>
                <div class="controls">
                 
                 
                  <textarea class="validate[required] text-input span8" rows="6" placeholder="Enter text ..."  name="site_desc"><?php echo $settings[0]->site_desc; ?></textarea>
                </div>
              </div>
              <input type="hidden" name="save_desc" value="<?php echo $settings[0]->site_desc; ?>">
             
              
              <div class="control-group">
                <label class="control-label">Site Keyword <span>*</span></label>
                <div class="controls">
                 
                   <input id="site_keyword" type="text" name="site_keyword" value="<?php echo $settings[0]->site_keyword; ?>"  class="validate[required] text-input span8">
						  
                </div>
              </div>
              
              
              
              
              <div class="control-group">
                <label class="control-label">Blog Advertisement <span>*</span></label>
                <div class="controls">
                 
                 
                  <textarea class="validate[required] text-input span8" rows="6" placeholder="Enter code ..."  name="site_blog_ads"><?php echo $settings[0]->site_blog_ads; ?></textarea>
                </div>
              </div>
              
              
              
              
               <div class="control-group">
                <label class="control-label">Shop Advertisement <span>*</span></label>
                <div class="controls">
                 
                 
                  <textarea class="validate[required] text-input span8" rows="6" placeholder="Enter code ..."  name="site_shop_ads"><?php echo $settings[0]->site_shop_ads; ?></textarea>
                </div>
              </div>
              
              
              
                      
                      
					 
              
              <div class="control-group">
                <label class="control-label">Site Address <span>*</span></label>
                <div class="controls">
                  
                  <textarea id="site_address" class="validate[required] text-input span8" name="site_address"><?php echo $settings[0]->site_address; ?></textarea>
                </div>
              </div>
               <input type="hidden" name="save_address" value="<?php echo $settings[0]->site_address; ?>">
					  
					  <input type="hidden" name="save_key" value="<?php echo $settings[0]->site_keyword; ?>">
                      
               <input type="hidden" name="save_facebook" value="<?php echo $settings[0]->site_facebook; ?>">
					  <input type="hidden" name="save_twitter" value="<?php echo $settings[0]->site_twitter; ?>">
					  <input type="hidden" name="save_gplus" value="<?php echo $settings[0]->site_gplus; ?>">
					  <input type="hidden" name="save_pinterest" value="<?php echo $settings[0]->site_pinterest; ?>">
					  <input type="hidden" name="save_instagram" value="<?php echo $settings[0]->site_instagram; ?>">
					  
					  <input type="hidden" name="save_copyright" value="<?php echo $settings[0]->site_copyright; ?>">
					  
                             
				
                      
                   <div class="control-group">
                <label class="control-label">Email <span>*</span></label>
                <div class="controls">
                  
                 <input id="site_email" type="text" name="site_email" value="<?php echo $settings[0]->site_email; ?>" required="required"  class="validate[required,custom[email]] text-input span8">  
                </div>
              </div>  
              
              
              <div class="control-group">
                <label class="control-label">Phone No <span>*</span></label>
                <div class="controls">
                  
                 
                 
                 <input id="site_phone" type="text" name="site_phone" value="<?php echo $settings[0]->site_phone; ?>" required="required"  class="validate[required] text-input span8">
                </div>
              </div>   
              
              
              <div class="control-group">
                <label class="control-label">Facebook Link</label>
                <div class="controls">
                 
                  <input id="site_facebook" type="text" name="site_facebook" value="<?php echo $settings[0]->site_facebook; ?>"  class="span8">
						  
                </div>
              </div>
              
              
              
              
              <div class="control-group">
                <label class="control-label">Twitter Link</label>
                <div class="controls">
                
                  
				<input id="site_twitter" type="text" name="site_twitter" value="<?php echo $settings[0]->site_twitter; ?>"  class="span8">
						  		  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">GPlus Link</label>
                <div class="controls">
             
				 <input id="site_gplus" type="text" name="site_gplus" value="<?php echo $settings[0]->site_gplus; ?>"  class="span8">
						  		  		  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Pinterest Link</label>
                <div class="controls">
             
				
				<input id="site_pinterest" type="text" name="site_pinterest" value="<?php echo $settings[0]->site_pinterest; ?>"  class="span8">		  		  		  
                </div>
              </div>
              	  
                  
                <div class="control-group">
                <label class="control-label">Instagram Link</label>
                <div class="controls">
             	
				
                 <input id="site_instagram" type="text" name="site_instagram" value="<?php echo $settings[0]->site_instagram; ?>"  class="span8">		  		  		  
                </div>
              </div>  
                  
                  
                  
                   <div class="control-group">
                <label class="control-label">Footer Copyright <span>*</span></label>
                <div class="controls">
             	
				
                 
                 <input id="site_copyright" type="text" name="site_copyright" value="<?php echo $settings[0]->site_copyright; ?>"  class="validate[required] text-input span8">
                 		  		  		  
                </div>
              </div>  
                  
                  
             <div class="control-group">
                <label class="control-label">Blog Post Per Page <span>*</span></label>
                <div class="controls">
             	
			
                  <input id="site_post_per" type="text" name="site_post_per" value="<?php echo $settings[0]->site_post_per; ?>"  class="validate[required] text-input  span8">
						  
                 		  		  		  
                </div>
              </div>    
              
              
              
              
              
              
              
              
             
              
              
               <div class="control-group">
                <label class="control-label">Product Per Page <span>*</span></label>
                <div class="controls">
             	
			
                  <input id="site_product_per" type="text" name="site_product_per" value="<?php echo $settings[0]->site_product_per; ?>"  class="validate[required] text-input  span8">
						  
                 		  		  		  
                </div>
              </div>
              
              
              
              
              <div class="control-group">
                <label class="control-label">Vendor Per Page <span>*</span></label>
                <div class="controls">
             	
			
                  <input id="site_vendor_per" type="text" name="site_vendor_per" value="<?php echo $settings[0]->site_vendor_per; ?>"  class="validate[required] text-input  span8">
						  
                 		  		  		  
                </div>
              </div> 
                  
              
              
              
              
               <div class="control-group">
                <label class="control-label">Currency <span>*</span></label>
                <div class="controls">
             	
			
                 
				<select name="currency" class="validate[required] text-input span8">
						<option value=""></option>
						<?php foreach($currency as $newcurrency){?>
							   <option value="<?php echo $newcurrency;?>" <?php if($settings[0]->site_currency==$newcurrency){?> selected="selected" <?php } ?>><?php echo $newcurrency;?></option>
						<?php } ?>
						</select>		  
                 		  		  		  
                </div>
              </div>     
					  
                      
                      
                 <div class="control-group">
                <label class="control-label">Logo <span>*</span></label>
                <div class="controls">
             	
			
                 
			<input type="file" id="site_logo" name="site_logo" class="<?php if(empty($settings[0]->site_logo)){?>validate[required]<?php } ?> span8">
						  
						   @if ($errors->has('site_logo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_logo') }}</strong>
                                    </span>
                                @endif		  
                 		  		  		  
                </div>
              </div>         
               
					  <?php 
					   $settingphoto="/media/";
						$path ='/local/images'.$settingphoto.$settings[0]->site_logo;
						if($settings[0]->site_logo!=""){
						?>
					  <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
                      </div>
					  </div>
						<?php } else { ?>
					  <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100">
					  </div>
                      </div>
					  </div>
						<?php } ?>
                        
                        
                        
                        
                        <div class="control-group">
                <label class="control-label">Favicon <span>*</span></label>
                <div class="controls">
             	<input type="file" id="site_favicon" name="site_favicon" class="<?php if(empty($settings[0]->site_favicon)){?>validate[required]<?php }?> span8">
						   @if ($errors->has('site_favicon'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_favicon') }}</strong>
                                    </span>
                                @endif
			
                 		  		  		  
                </div>
              </div>   
						
				
					  <?php 
					   $settingphotos="/media/";
						$paths ='/local/images'.$settingphotos.$settings[0]->site_favicon;
						if($settings[0]->site_favicon!=""){
						?>
					  <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.$paths;?>" class="thumb" width="24" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
                      </div>
						<?php } else { ?>
					   <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="24" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
                      </div>
						<?php } ?>
                        
                        
                        
                       
						
                   
					 <div style="display:none;">
                     <div class="control-group" >
                <label class="control-label">Static Banner <span>*</span></label>
                <div class="controls">
             	<input type="file" id="site_banner" name="site_banner" class="<?php if(empty($settings[0]->site_banner)){?>validate[required]<?php } ?> span8"><br/>[Please select an image 1920px / 305px]
						   @if ($errors->has('site_banner'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_banner') }}</strong>
                                    </span>
                                @endif
			
                 		  		  		  
                </div>
              </div>   
                     
                 
					   <?php 
					   $bannerphotos="/media/";
						$pathes ='/local/images'.$bannerphotos.$settings[0]->site_banner;
						if($settings[0]->site_banner!=""){
						?>
					 <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.$pathes;?>" class="thumb" width="200" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
                      </div>
						<?php } else { ?>
					  <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
                      </div>
						<?php } ?>
                        
                     </div> 
                        
                        
                       
						
                        
                        
                        
                         <div class="control-group">
                <label class="control-label">Page Loading Animation <span>*</span></label>
                <div class="controls">
             	<select name="site_loading" id="site_loading" class="validate[required] text-input span8" onChange="showLoad(this)">
						<option value="">Select</option>
									<option value="1" <?php { if($settings[0]->site_loading=="1") echo "selected='selected'"; }?>>On</option>
									<option value="0" <?php { if($settings[0]->site_loading=="0") echo "selected='selected'"; }?>>Off</option>
								</select>
			
                 		  		  		  
                </div>
              </div>   
                        
                        
                       
                       
                       
                        <div class="control-group" id="animated" <?php if($settings[0]->site_loading!="1"){?> style="display:none;" <?php } ?>>
                        
                        
                <label class="control-label">Animated Gif Image</label>
                <div class="controls">
             	 <input type="file" id="site_loading_url" name="site_loading_url"  class="<?php if(empty($settings[0]->site_loading_url)){?>validate[required] text-input  <?php } ?>  span8"><br/>
                          ( Gif format only )						  
						   @if ($errors->has('site_loading_url'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_loading_url') }}</strong>
                                    </span>
                                @endif
			
                 		  		  		  
                </div>
                
                 <?php 
					   $setting_gif="/media/";
						$pathh ='/local/images'.$setting_gif.$settings[0]->site_loading_url;
						if($settings[0]->site_loading_url!=""){
						?>
					   <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.$pathh;?>" class="thumb" width="100">
					  </div>
					  </div>
                      </div>
						<?php } else { ?>
					   <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100">
					  </div>
					  </div>
                      </div>
						<?php } ?>
              </div>
                        
              
					 
                      
                      
                     <input type="hidden" name="save_loading_url" value="<?php echo $settings[0]->site_loading_url;?>">
					  
                      
                      
                         
                      
                    
					  
					   <div class="control-group">
                <label class="control-label">Google Map Api Key  <span>*</span></label>
                <div class="controls">
             	
			
                <input id="site_map_api" type="text" name="site_map_api" value="<?php echo $settings[0]->site_map_api; ?>"  class="validate[required] text-input span8">
						   		  		  		  
                </div>
              </div>   
                      
					  
					<div class="control-group">
                <label class="control-label">Site Url  <span>*</span></label>
                <div class="controls">
             	
			
               
				 <input id="site_url" type="text" name="site_url" value="<?php echo $settings[0]->site_url; ?>"  class="validate[required] text-input span8">
						  <br/> ( ex : http://www.yoursite.com/ )		   		  		  		  
                </div>
              </div>     
              
              
              
              
                 
					  <div class="control-group">
                <label class="control-label">Site Primary Color  <span>*</span></label>
                <div class="controls">
             	
			
               
				 <input id="site_primary_color" type="text" name="site_primary_color" value="<?php echo $settings[0]->site_primary_color; ?>"  class="validate[required] text-input span8">
						  <br/> ( ex : #000000 )		   		  		  		  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Site Secondary Color  <span>*</span></label>
                <div class="controls">
             	
			
               
				 <input id="site_secondary_color" type="text" name="site_secondary_color" value="<?php echo $settings[0]->site_secondary_color; ?>"  class="validate[required] text-input span8">
						  <br/> ( ex : #000000 )		   		  		  		  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Site Button Color  <span>*</span></label>
                <div class="controls">
             	
			
               
				 <input id="site_button_color" type="text" name="site_button_color" value="<?php echo $settings[0]->site_button_color; ?>"  class="validate[required] text-input span8">
						  <br/> ( ex : #000000 )		   		  		  		  
                </div>
              </div>
					  
					
                      
                      
                      
                      <input type="hidden" name="save_map_api" value="<?php echo $settings[0]->site_map_api; ?>">
                      
					  <input type="hidden" name="save_header_type" value="<?php echo $settings[0]->header_type; ?>">
                      
                      
                       
                       <input type="hidden" name="image_size" value="<?php echo $settings[0]->image_size; ?>">
                       <input type="hidden" name="image_type" value="<?php echo $settings[0]->image_type; ?>">
					  
					 
					  
					  <input type="hidden" name="save_siteurl" value="<?php echo $settings[0]->site_url; ?>">
					  
						
						
						
						
					  
					  <input type="hidden" name="currentlogo" value="<?php echo $settings[0]->site_logo;?>">
					  
					  
					  <input type="hidden" name="currentfav" value="<?php echo $settings[0]->site_favicon;?>">
					  
					  <input type="hidden" name="currentban" value="<?php echo $settings[0]->site_banner;?>">
			
              
              
              <div class="form-actions">
                        <div class="span8">
                          <a href="<?php echo $url;?>/admin/settings" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>


</div>

    
     

    @include('admin.footer')
	
  </body>
</html>
