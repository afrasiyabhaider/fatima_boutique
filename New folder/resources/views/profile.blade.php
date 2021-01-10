<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$headertype = $setts[0]->header_type;
	?>
<!DOCTYPE html>

<html class="no-js"  lang="en">
<head>

		

   @include('style')
   




</head>
<body  class="cnt-home">

  

   
    @include('header')
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container-fluid">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="<?php echo $url;?>">@lang('languages.home')</a></li>
				<li class='active'>@lang('languages.my_profile')</li>
			</ul>
		</div>
	</div>
</div>



<div class="body-content">
	<div class="container-fluid">
		<div class="my-wishlist-page_new">
        <div class="row">
                     <div class="col-md-12 col-sm-12">
                    @if(Session::has('success'))

	    <p class="alert alert-success">

	      {{ Session::get('success') }}

	    </p>

	@endif


	
	
 	@if(Session::has('error'))

	    <p class="alert alert-danger">

	      {{ Session::get('error') }}

	    </p>

	@endif
    </div>
    </div>
        
			<div class="row">
            <?php if(!empty($editprofile_count)){?>
				<div class="col-md-12 my-wishlist">
                
	<div class="col-md-12">
    <div class="col-md-6"><div class="heading-title" style="border-bottom:none !important;">@lang('languages.my_profile')</div></div>
                <div class="col-md-6 text-right"></div>
    </div>
    <div class="container">
                
                
                
                
                <div class="container-fluid">
  <div class="row">
  
    <div class="fb-profile">
        
        
        <?php 
				
				$userphoto="/media/";
						$path ='/local/images'.$userphoto.$editprofile[0]->profile_banner;
						if($editprofile[0]->profile_banner!=""){?>
					
              <img align="left" class="fb-image-lg" src="<?php echo $url.$path;?>" alt="<?php echo $editprofile[0]->name;?>"/>      
						<?php } else { ?>
						<img src="<?php echo $url.'/local/images/no-image-big.jpg';?>" align="left" class="fb-image-lg" alt="<?php echo $editprofile[0]->name;?>">
						<?php } ?>
        
        
       
        
        
        <?php 
				
				$userphoto_two="/media/";
						$path_two ='/local/images'.$userphoto_two.$editprofile[0]->photo;
						if($editprofile[0]->photo!=""){?>
					
           <img align="left" class="fb-image-profile thumbnail" src="<?php echo $url.$path_two;?>" alt="<?php echo $editprofile[0]->name;?>"/>          
						<?php } else { ?>
						<img src="<?php echo $url.'/local/images/nophoto.jpg';?>" align="left" class="fb-image-profile thumbnail" alt="<?php echo $editprofile[0]->name;?>">
						<?php } ?>
        <div class="fb-profile-text">
            <?php if(!empty($editprofile[0]->name)){?><h1><?php echo $editprofile[0]->name;?></h1><?php } ?>
            
        </div>
    </div>
  </div>
</div> <!-- /container fluid-->  
<div class="container">
  <div class="col-sm-12">
<?php if($editprofile[0]->admin=="2") { $txt_name = __('languages.vendor'); } else if($editprofile[0]->admin=="0"){ $txt_name = __('languages.customer'); } else if($editprofile[0]->admin == "1"){ $txt_name = __('languages.admin'); } else { $txt_name = ""; } ?>
      <div data-spy="scroll" class="tabbable-panel">
        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
            <li class="active">
              <a href="#tab_default_1" data-toggle="tab">
              @lang('languages.about')</a>
            </li>
            
            <?php if($editprofile[0]->admin=="2") {?>
            <li>
              <a href="#tab_default_2" data-toggle="tab">
             @lang('languages.products')</a>
            </li>
            <?php } ?>
           <li>
              <a href="#tab_default_3" data-toggle="tab">
             @lang('languages.contact') <?php echo $txt_name;?></a>
            </li>
             
          </ul>
          
          
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
            <div class="height20"></div>
              <?php if(!empty($editprofile[0]->about)){?>
              <p>
                <?php echo $editprofile[0]->about;?>
              </p>
              <?php } ?>
           
            </div>
            <div class="tab-pane" id="tab_default_2">
            <div class="height20"></div>
              <?php if(!empty($viewcount)){?>
              <div class="row">
              <div class="col-sm-12">
               
               
<ul class="widget-products">
                 <?php foreach($viewproduct as $product){
				 $prod_id = $product->prod_token; 
				$product_img_count = DB::table('product_images')
									->where('prod_token','=',$prod_id)
									->count();
				 ?>
                  <li>
                     <a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>" title="@lang('languages.buy_now')">
                     <span class="img">
                     
                     
                      <?php
														if(!empty($product_img_count)){					
														$product_img = DB::table('product_images')
																			->where('prod_token','=',$prod_id)
																			->orderBy('prod_img_id','asc')
																			->get();
																		
														
														?>
                                                        <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt="" class="img-thumbnail">
                                                        <?php } else { ?>
                                                        <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt="" class="img-thumbnail">
                                                        <?php } ?>
                     
                     
                     
                     </span>
                     <span class="product">
                     <span class="name">
                     <?php echo $product->prod_name;?>
                     </span>
                     <span class="price">
                      <?php if(!empty($product->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;" class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span> <span class="fontsize15 black"> <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span> <?php } else { ?> <span class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span> <?php } ?>
                     </span>
                     </span>
                     </a>
                  </li>
                 <?php } ?> 
               </ul>
               
               
               
               
              </div>
              
              </div>
             <?php } ?>
             
           
            </div>
            <div class="tab-pane" id="tab_default_3">
              
              <div class="row">
              <div class="col-sm-6">
              
              <aside class="sidebar">
<div class="single contact-info contactus">
<h3 class="side-title">@lang('languages.contact_information')</h3>
<div class="height10"></div>
<ul class="list-unstyled">

<li>
<div class="icon"><i class="fa fa-map-marker"></i></div>
<div class="info"><?php if(!empty($editprofile[0]->address)){?><p> <?php echo $editprofile[0]->address;?></p><?php } ?>
<?php if(!empty($editprofile[0]->country)){?><p><?php echo $editprofile[0]->country;?></p><?php } ?>

</div>
</li>
<div class="height10"></div>
<?php if(!empty($editprofile[0]->phone)){?>
<li>
<div class="icon"><i class="fa fa-phone"></i></div>
<div class="info"><p><?php echo $editprofile[0]->phone;?></p></div>
</li>
<div class="height10"></div>
<?php } ?>
<?php if(!empty($editprofile[0]->email)){?>
<li>
<div class="icon"><i class="fa fa-envelope"></i></div>
<div class="info"><p><?php echo $editprofile[0]->email;?></p></div>
</li>
<div class="height10"></div>
<?php } ?>


<?php if(!empty($editprofile[0]->gender)){?>
<li>
<div class="icon"><i class="fa fa-user"></i></div>
<div class="info"><p><?php echo $editprofile[0]->gender;?></p></div>
</li>
<?php } ?>
</ul>
</div>
</aside>
              
              
                
              </div>
              
              
              <div class="col-sm-6">
    <aside class="sidebar">
<div class="single contact-info">
<h3 class="side-title">@lang('languages.contact_form')</h3>          
              <form class="register-form" role="form" method="POST" action="{{ route('profile') }}" id="formID" enctype="multipart/form-data">
                            {{ csrf_field() }}
              
  
    <input type="hidden" id="vendor_id" name="vendor_id" placeholder="" class="validate[required] input-xlarge" value="<?php echo $user_id;?>">
    <div class="height10"></div>
    
    <div class="row">
    <div class="col-md-12 contact-form paddingoff">
    <div class="col-md-6 ">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.your_name') <span>*</span></label>
		    
            
             <input type="text" id="name" name="name" placeholder="" class="form-control unicase-form-control validate[required] input-xlarge">
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6 ">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.your_email') <span>*</span></label>
		    
            <input type="text" id="email" name="email" placeholder="" class="form-control unicase-form-control validate[required,custom[email]] input-xlarge">
             
		  </div>
		
	</div>
    
    
    
    
    <div class="col-md-6 ">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.your_phone_number') <span>*</span></label>
		    
            <input type="text" id="phone" name="phone" placeholder="" class="form-control unicase-form-control  validate[required] input-xlarge">
            
            
             
		  </div>
		
	</div>
    
    
    
    
    <div class="col-md-6 ">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.your_message') <span>*</span></label>
		    
            
            
            <textarea id="msg" name="msg" placeholder="" class="form-control unicase-form-control validate[required] input-xlarge"></textarea>
             
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6 outer-bottom-small m-t-20">
                                 <?php if(config('global.demosite')=="yes"){?><button type="submit" class="btn-upper btn btn-primary">@lang('languages.submit')</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                            <button id="send" type="submit" class="btn-upper btn btn-primary">@lang('languages.submit')</button>
								<?php } ?>   
                               </div>
    
    
    </div>

   </div>
</form>
              
           </div>
</aside>     
              </div>
              
              </div>
            </div>
            
            
            
             
          </div>
        </div>
      </div>
  
  </div>
  
</div>
                
   
            </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>	
<?php } ?>






		</div>
		</div>
		</div>
</div>


<div class="height30"></div>

@include('footer')
</body>
</html>
