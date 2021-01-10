<?php
	use Illuminate\Support\Facades\Route;
    $currentPaths= Route::getFacadeRoot()->current()->uri();
    $url = URL::to("/");
    $setid = 1;
	$setts = DB::table('settings')->where('id', '=', $setid)->get();
	$headertype = $setts[0]->header_type;
?>
<!DOCTYPE html>
<html lang="en">
<head>
   @include('style')
</head>
<body class="cnt-home">
    @include('header')
 <div class="row">
  <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
          <?php if(!empty($slideshow_cnt)){?>
                <?php foreach($slideshow as $slide){?>
          <?php if(!empty($slide->slide_image)){ $imgurls = $url.'/local/images/media/'.$slide->slide_image; } 
		  else { $imgurls = $url.'/local/images/noimage.jpg'; }
		  ?>
            <div class="item" style="background-image: url(<?php echo $imgurls;?>);">
              <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                 <?php if(!empty($slide->slide_title)){?><div class="big-text fadeInDown-1"> <?php echo $slide->slide_title;?> </div><?php } ?>
                   <?php if(!empty($slide->slide_sub_title)){?><div class="excerpt fadeInDown-2 hidden-xs"> <span><?php echo $slide->slide_sub_title;?></span> </div> <?php } ?>
                  <?php if(!empty($slide->slide_btn_link)){?><div class="button-holder fadeInDown-3"> <a href="<?php echo $slide->slide_btn_link;?>" class="btn-lg btn btn-uppercase btn-primary shop-now-button"><?php if(!empty($slide->slide_btn_text)){?><?php echo $slide->slide_btn_text;?><?php } ?></a> </div><?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
  </div>
  <div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

        <div class="info-boxes wow fadeInUp">
          <div class="info-boxes-inner">
           <?php if(!empty($box_content_count)){?>
           
            <div class="row">
              
              
              
              
              <?php foreach($box_content as $box){?>
              <div class="col-md-4 col-sm-4 col-lg-4">
                <div class="info-box">
                  
                  <div class="row">
                  <div class="col-xs-2">
                  <div class="ficon">
                  <i class="fa <?php echo $box->icon;?>"></i>
                  </div>
                  </div>
                  
                  
                    <div class="col-xs-10">
                      <h4 class="info-box-heading green"><?php echo $box->heading;?></h4>
                      <h6 class="text"><?php echo $box->subheading;?></h6>
                    </div>
                  </div>
                  
                </div>
              </div>
              <?php } ?>
              
              
              
              
            </div>
            <?php } ?>
            
            <!-- /.row --> 
          </div>
          <!-- /.info-boxes-inner --> 
          
        </div>

            <div class="row">
                <div class="homepage_inner_content clearfix">
        
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">       
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">@lang('languages.new_products')</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">@lang('languages.all')</a></li>
              
              
              <?php if(!empty($cate_cnt)){?>
                        <?php foreach($cate_get as $geti){?>
                        
                       <li><a data-transition-type="backSlide" href="#<?php echo $geti->id;?>" data-toggle="tab"><?php echo $geti->cat_name;?></a></li> 
                        <?php } ?>
                        <?php } ?>
            </ul>
            
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
              <div class="col-md-12">
                <div class=" owl-carousel  home-owl-carousel custom-carousel owl-theme" data-item="5">
                  
                  <?php if(!empty($cate_cnt)){?>
                        <?php foreach($cate_get as $geti){
						
						
						$viewcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->take(12)
					   ->orderBy('prod_id','desc')
					   ->count();
		
		if(!empty($viewcount))
		{
		 $viewproduct = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->take(12)
					   ->orderBy('prod_id','desc')
					   ->get();
					   $ii = 1;
					   foreach($viewproduct as $product){
						?>
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                        <?php
                            $prod_id = $product->prod_token; 
								 $product_img_count = DB::table('product_images')
													->where('prod_token','=',$prod_id)
													->count();
													?>
                          <div class="image"> <a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                 <?php 
                                        if(!empty($product_img_count)){					
														$product_img = DB::table('product_images')
																			->where('prod_token','=',$prod_id)
																			
																			->orderBy('prod_img_id','asc')
																			->get();
																			
										if(!empty($product_img[0]->image))
										{								
										?>
                                        <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt=""/>
                                        <?php } else { ?>
                                        <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt=""/>
                                        <?php } } ?>
                                        </a>
                                         </div>
                          
                          <?php if($ii==1){?>
                          <div class="tag new"><span>@lang('languages.new')</span></div>
                          <?php } ?>
                        </div>
                        
                        <?php
							
							
					
		
							
								
          $review_count_03 = DB::table('product_rating')
				->where('prod_id', '=', $product->prod_id)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_rating')
				               ->where('prod_id', '=', $product->prod_id)
				               ->get();
				
				
				$over_03 = 0;
		        $fine_value_03 = 0;
				foreach($review_value_03 as $review){
				if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
		if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
		if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
		if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
		if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
		
		$fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
		
      $over_03 +=$review->rating;
	  
	  
	  
				}
				if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
		  $roundeding_03 = 0; }	
				
				
				}
				
				
				
				
				
				if(!empty($review_count_03))
				                               {
	                                           if(!empty($roundeding_03)){
	
	                                           if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												
												
				
				
				
			
				
				?>                       
                                
          
                        <div class="product-info text-center product_names">
                          <h3 class="name"><a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a></h3>
                          
                          <div class="product-price">  <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> </div>
                          <p><?php if(!empty($product->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;" class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span> <span class="fontsize15 black"> <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span> <?php } else { ?> <span class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span> <?php } ?></p>
                          
                          
                        </div>
                        
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <a data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"> <i class="fa fa-shopping-cart"></i> </a>
                                
                                <a class="btn btn-primary cart-btn" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">@lang('languages.add_to_cart')</a>
                                
                                
                              </li>
                              <li class="lnk wishlist"> 
                              
                              <?php if(Auth::guest()) { ?>
                                                
                                                <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                <?php
														} else { 
														
														if(Auth::user()->id!=$product->user_id)
														{
														?>
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/wishlist/<?php echo Auth::user()->id;?>/<?php echo $product->prod_token;?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                              
                               
                                                         <?php } } ?>
                              
                              </li>
                              <li class="lnk"> 
                               <?php if(Auth::guest()) { ?>
                                                
                                            
                              
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
                              <?php } else {?>
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/compare/<?php echo $product->prod_token;?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                              
                              <?php } ?>
                              
                              
                              </li>
                            </ul>
                          </div>
                          
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                      </div>
                      
                      
                    </div>
                     
                  </div>
                 
                 
                 
                 
                 
                 
                 <?php  $ii++;} ?>
                        <?php } ?>
                        
                       <?php } ?>
                        <?php } ?>
                  
                  
                
                  
                  
                </div>
                
                </div>
                
                <div class="clearfix"></div>
                
              </div>
             
            </div>
           
            
            
            <?php if(!empty($cate_cnt)){?>
                        <?php foreach($cate_get as $geti){?>
            <div class="tab-pane" id="<?php echo $geti->id;?>">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="5">
                
               <?php 
                $viewcount = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_cat_type','=','cat')
					    ->where('prod_category','=',$geti->id)
						->inRandomOrder()
					   ->count();
		
		if(!empty($viewcount))
		{
		 $viewproduct = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_cat_type','=','cat')
					    ->where('prod_category','=',$geti->id)
						->inRandomOrder()
					   ->get();
					   $ij=1;
					   foreach($viewproduct as $product){
						?>
                
                <?php
                            $prod_id = $product->prod_token; 
								 $product_img_count = DB::table('product_images')
													->where('prod_token','=',$prod_id)
													->count();
													?>
                
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> 
                          
                          <a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                 <?php 
                                        if(!empty($product_img_count)){					
														$product_img = DB::table('product_images')
																			->where('prod_token','=',$prod_id)
																			
																			->orderBy('prod_img_id','asc')
																			->get();
																			
										if(!empty($product_img[0]->image))
										{								
										?>
                                        <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt=""/>
                                        <?php } else { ?>
                                        <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt=""/>
                                        <?php } } ?>
                                        </a>
                           </div>
                          
                          <?php if($ij==1){?>
                          <div class="tag new"><span>@lang('languages.new')</span></div>
                          <?php } ?>
                        </div>
                        
                        
                        
                        
                        
                        
                         <?php
							
							
					
		
							
								
          $review_count_03 = DB::table('product_rating')
				->where('prod_id', '=', $product->prod_id)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_rating')
				               ->where('prod_id', '=', $product->prod_id)
				               ->get();
				
				
				$over_03 = 0;
		        $fine_value_03 = 0;
				foreach($review_value_03 as $review){
				if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
		if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
		if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
		if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
		if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
		
		$fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
		
      $over_03 +=$review->rating;
	  
	  
	  
				}
				if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
		  $roundeding_03 = 0; }	
				
				
				}
				
				
				
				
				
				if(!empty($review_count_03))
				                               {
	                                           if(!empty($roundeding_03)){
	
	                                           if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												
												
				
				
				
			
				
				?>                       
                                
          
                        <div class="product-info text-center product_names">
                          <h3 class="name"><a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a></h3>
                          
                          <div class="product-price">  <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> </div>
                          <p><?php if(!empty($product->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;" class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span> <span class="fontsize15 black"> <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span> <?php } else { ?> <span class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span> <?php } ?></p>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <a data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"> <i class="fa fa-shopping-cart"></i> </a>
                                
                                <a class="btn btn-primary cart-btn" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">@lang('languages.add_to_cart')</a>
                                
                                
                              </li>
                              <li class="lnk wishlist"> 
                              
                              <?php if(Auth::guest()) { ?>
                                                
                                                <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                <?php
														} else { 
														
														if(Auth::user()->id!=$product->user_id)
														{
														?>
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/wishlist/<?php echo Auth::user()->id;?>/<?php echo $product->prod_token;?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                              
                               
                                                         <?php } } ?>
                              
                              </li>
                              <li class="lnk"> 
                              
                               <?php if(Auth::guest()) { ?>
                                                
                                            
                              
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
                              <?php } else {?>
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/compare/<?php echo $product->prod_token;?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                              
                              <?php } ?>
                              
                              
                              
                              
                              </li>
                            </ul>
                          </div>
                         
                        </div>
                        
                      </div>
                      
                      
                    </div>
                     
                  </div>
                  
                  
                  <?php $ij++;} } ?>
                 
                  
                  
                  
                </div>
                
              </div>
             
            </div>
            
            
            <?php } } ?>
           
            
          </div>
          <!-- /.tab-content --> 
        </div>
        
        
        
        
        
        
        
        
        <div class="row">
        
         <?php if(!empty($home_banner_one_count)){?>
            <div class="col-md-6 col-sm-6 mbottom30">
           
              <div class="wide-banner cnt-strip">
                <div class="image"> 
                
                <?php if(!empty($home_banner_one[0]->slide_image)){?>
                                <img src="<?php echo $url;?>/local/images/media/<?php echo $home_banner_one[0]->slide_image;?>" alt=""/>
                                <?php } else { ?>
                                <img src="<?php echo $url;?>/local/resources/views/assets/img/banner/banner1.jpg" alt=""/>
                                <?php } ?>
                
                 </div>
                 
                 <div class="left-banner-title">
								<?php if(!empty($home_banner_one[0]->slide_title)){?><h3 class="animated moveUp shown white"><?php echo $home_banner_one[0]->slide_title;?></h3><?php } ?>
								<?php if(!empty($home_banner_one[0]->slider_sub_title)){?><p class="animated moveUp shown white"><?php echo $home_banner_one[0]->slider_sub_title;?></p><?php } ?>
								<?php if(!empty($home_banner_one[0]->slide_btn_link)){?><a href="<?php echo $home_banner_one[0]->slide_btn_link;?>" class="custombtn animated moveUp shown"><?php } ?><?php if(!empty($home_banner_one[0]->slide_btn_text)){?><span>shop now</span><?php } ?><?php if(!empty($home_banner_one[0]->slide_btn_link)){?></a><?php } ?>
							</div>
                            
                            
                 
              </div>
             
              <!-- /.wide-banner --> 
            </div>
            
             <?php } ?>
            
            <!-- /.col -->
            <?php if(!empty($home_banner_two_count)){?>
            <div class="col-md-6 col-sm-6 mbottom30">
            
              <div class="wide-banner cnt-strip">
                <div class="image"> 
                
                
                <?php if(!empty($home_banner_two[0]->slide_image)){?>
                                <img src="<?php echo $url;?>/local/images/media/<?php echo $home_banner_two[0]->slide_image;?>" alt=""/>
                                <?php } else { ?>
                                <img src="<?php echo $url;?>/local/resources/views/assets/img/banner/banner1.jpg" alt=""/>
                                <?php } ?>
                                
                                
               
                
                </div>
                
                
                <div class="left-banner-title">
								<?php if(!empty($home_banner_two[0]->slide_title)){?><h3 class="animated moveUp shown white"><?php echo $home_banner_two[0]->slide_title;?></h3><?php } ?>
								<?php if(!empty($home_banner_two[0]->slider_sub_title)){?><p class="animated moveUp shown white"><?php echo $home_banner_two[0]->slider_sub_title;?></p><?php } ?>
								<?php if(!empty($home_banner_two[0]->slide_btn_link)){?><a href="<?php echo $home_banner_two[0]->slide_btn_link;?>" class="custombtn animated moveUp shown"><?php } ?><?php if(!empty($home_banner_two[0]->slide_btn_text)){?><span>shop now</span><?php } ?><?php if(!empty($home_banner_two[0]->slide_btn_link)){?></a><?php } ?>
							</div>
              </div>
             
            </div>
            
            <?php } ?>
          </div>
          
          
          
          
          
          
        <div class="clearfix"></div>
        
        
        
        
        
        <div class="featured-product">
        <div class="row">
         <div class="col-md-12">
        
          <h3 class="section-title">@lang('languages.featured_products')</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            
            
            
            <?php 
                $viewcountt = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_featured','=','yes')
						->orderBy('prod_id','desc')
					   ->count();
		
		if(!empty($viewcountt))
		{
		 $viewproductt = DB::table('product')
					  ->where('delete_status','=','')
					   ->where('prod_status','=',1)
					   ->where('prod_featured','=','yes')
						->orderBy('prod_id','desc')
					   ->get();
					   $ij=1;
					   foreach($viewproductt as $product){
						?>
                
                <?php
                            $prod_id = $product->prod_token; 
								 $product_img_count = DB::table('product_images')
													->where('prod_token','=',$prod_id)
													->count();
													?>
            
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image">  <a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                 <?php 
                                        if(!empty($product_img_count)){					
														$product_img = DB::table('product_images')
																			->where('prod_token','=',$prod_id)
																			
																			->orderBy('prod_img_id','asc')
																			->get();
																			
										if(!empty($product_img[0]->image))
										{								
										?>
                                        <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt=""/>
                                        <?php } else { ?>
                                        <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt=""/>
                                        <?php } } ?>
                                        </a> </div>
                   
                    
                    <!--<div class="tag hot"><span>hot</span></div>-->
                  </div>
                  
                  <?php
							
							
					
		
							
								
          $review_count_03 = DB::table('product_rating')
				->where('prod_id', '=', $product->prod_id)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_rating')
				               ->where('prod_id', '=', $product->prod_id)
				               ->get();
				
				
				$over_03 = 0;
		        $fine_value_03 = 0;
				foreach($review_value_03 as $review){
				if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
		if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
		if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
		if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
		if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
		
		$fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
		
      $over_03 +=$review->rating;
	  
	  
	  
				}
				if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
		  $roundeding_03 = 0; }	
				
				
				}
				
				
				
				
				
				if(!empty($review_count_03))
				                               {
	                                           if(!empty($roundeding_03)){
	
	                                           if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												
												
				
				
				
			
				
				?>        
                  <!-- /.product-image -->
                  
                  <div class="product-info text-center product_names">
                          <h3 class="name"><a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a></h3>
                          
                          <div class="product-price">  <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> </div>
                          <p><?php if(!empty($product->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;" class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span> <span class="fontsize15 black"> <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span> <?php } else { ?> <span class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span> <?php } ?></p>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <a data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"> <i class="fa fa-shopping-cart"></i> </a>
                                
                                <a class="btn btn-primary cart-btn" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">@lang('languages.add_to_cart')</a>
                                
                                
                              </li>
                              <li class="lnk wishlist"> 
                              
                              <?php if(Auth::guest()) { ?>
                                                
                                                <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                <?php
														} else { 
														
														if(Auth::user()->id!=$product->user_id)
														{
														?>
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/wishlist/<?php echo Auth::user()->id;?>/<?php echo $product->prod_token;?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                              
                               
                                                         <?php } } ?>
                              
                              </li>
                              <li class="lnk"> 
                              
                               <?php if(Auth::guest()) { ?>
                                                
                                            
                              
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
                              <?php } else {?>
                              
                              <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/compare/<?php echo $product->prod_token;?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                              
                              <?php } ?>
                              
                              
                              </li>
                            </ul>
                          </div>
                         
                        </div>
                  
                  
                  
                  
                  
                  
                   
                </div>
                
                
              </div>
              
            </div>
           
            
             <?php } } ?>
            
            
            
           
            
           
          </div>
          </div>
          </div>
          
          </div>
        
       
        <?php if(!empty($cate_cnt)){?>
              <?php foreach($cate_get as $geti){
              if($geti->id != 13){
              ?>
              
              <div class="featured-product">
              <div class="row">
                  <div class="col-md-12">
              <?php
              if ($geti->id == 11){ ?>
                  <h3 class="section-title">@lang('Men Fashion')</h3>
              <?php }elseif($geti->id == 12){ ?>
                  <h3 class="section-title">@lang('Kids Fashion')</h3>
              <?php }elseif($geti->id == 10){ ?>
                  <h3 class="section-title">@lang('Women Fashion')</h3>
              <?php }
              ?>
              
                      <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="5">

                          <?php
                          $viewcount = DB::table('product')
                              ->where('delete_status','=','')
                              ->where('prod_status','=',1)
                              ->where('prod_cat_type','=','cat')
                              ->where('prod_category','=',$geti->id)
                              ->inRandomOrder()
                              ->count();

                          if(!empty($viewcount))
                          {
                          $viewproduct = DB::table('product')
                              ->where('delete_status','=','')
                              ->where('prod_status','=',1)
                              ->where('prod_cat_type','=','cat')
                              ->where('prod_category','=',$geti->id)
                              ->inRandomOrder()
                              ->get();
                          $ij=1;
                          foreach($viewproduct as $product){
                          ?>

                          <?php
                          $prod_id = $product->prod_token;
                          $product_img_count = DB::table('product_images')
                              ->where('prod_token','=',$prod_id)
                              ->count();
                          ?>

                          <div class="item item-carousel">
                              <div class="products">
                                  <div class="product">
                                      <div class="product-image">
                                          <div class="image">

                                              <a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                                  <?php
                                                  if(!empty($product_img_count)){
                                                  $product_img = DB::table('product_images')
                                                      ->where('prod_token','=',$prod_id)

                                                      ->orderBy('prod_img_id','asc')
                                                      ->get();

                                                  if(!empty($product_img[0]->image))
                                                  {
                                                  ?>
                                                  <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt=""/>
                                                  <?php } else { ?>
                                                  <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt=""/>
                                                  <?php } } ?>
                                              </a>
                                          </div>

                                          <?php if($ij==1){?>
                                          <div class="tag new"><span>@lang('languages.new')</span></div>
                                          <?php } ?>
                                      </div>






                                      <?php






                                      $review_count_03 = DB::table('product_rating')
                                          ->where('prod_id', '=', $product->prod_id)
                                          ->count();

                                      if(!empty($review_count_03))
                                      {
                                          $review_value_03 = DB::table('product_rating')
                                              ->where('prod_id', '=', $product->prod_id)
                                              ->get();


                                          $over_03 = 0;
                                          $fine_value_03 = 0;
                                          foreach($review_value_03 as $review){
                                              if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
                                              if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
                                              if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
                                              if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
                                              if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }

                                              $fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;

                                              $over_03 +=$review->rating;



                                          }
                                          if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
                                              $roundeding_03 = 0; }


                                      }





                                      if(!empty($review_count_03))
                                      {
                                          if(!empty($roundeding_03)){

                                              if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
                                              }
                                              if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
                                              }

                                              if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
                                              }

                                              if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
                                              }

                                              if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											    </p>';
                                              }


                                          }
                                          else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
                                          }

                                      }



                                      $rateus_empty_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';







                                      ?>


                                      <div class="product-info text-center product_names">
                                          <h3 class="name"><a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a></h3>

                                          <div class="product-price">  <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> </div>
                                          <p><?php if(!empty($product->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;" class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span> <span class="fontsize15 black"> <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span> <?php } else { ?> <span class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span> <?php } ?></p>
                                          <!-- /.product-price -->

                                      </div>
                                      <!-- /.product-info -->
                                      <div class="cart clearfix animate-effect">
                                          <div class="action">
                                              <ul class="list-unstyled">
                                                  <li class="add-cart-button btn-group">
                                                      <a data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"> <i class="fa fa-shopping-cart"></i> </a>

                                                      <a class="btn btn-primary cart-btn" href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">@lang('languages.add_to_cart')</a>


                                                  </li>
                                                  <li class="lnk wishlist">

                                                      <?php if(Auth::guest()) { ?>

                                                      <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                      <?php
                                                      } else {

                                                      if(Auth::user()->id!=$product->user_id)
                                                      {
                                                      ?>

                                                      <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/wishlist/<?php echo Auth::user()->id;?>/<?php echo $product->prod_token;?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>


                                                      <?php } } ?>

                                                  </li>
                                                  <li class="lnk">

                                                      <?php if(Auth::guest()) { ?>




                                                      <a data-toggle="tooltip" class="add-to-cart" href="javascript:void(0);" onClick="alert('@lang('languages.login_user')');" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                      <?php } else {?>

                                                      <a data-toggle="tooltip" class="add-to-cart" href="<?php echo $url;?>/compare/<?php echo $product->prod_token;?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>

                                                      <?php } ?>




                                                  </li>
                                              </ul>
                                          </div>

                                      </div>

                                  </div>


                              </div>

                          </div>


                          <?php $ij++;} } ?>




                      </div>

                 

              
                  </div>
              </div>
              </div>


              <?php } } } ?>
        
        <div class="latest-blog">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 scroll-tabs">
        
          <h3 class="section-title">@lang('languages.latest_blog')</h3>
          <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">
              
              
              
              
              <?php if(!empty($blogs_cnt)) {
			foreach($blogs as $blog){ ?>
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> 
                    <?php if(!empty($blog->post_image)){?>
                        <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>">
          			<img src="<?php echo $url.'/local/images/media/'.$blog->post_image;?>" alt="">
                    </a>
        			<?php } else {?>
       				<a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>">
                    <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">
                    </a>
        			<?php } ?>
                    
                    
                    </div>
                  </div>
                  <!-- /.blog-post-image -->
                  <?php
			$old_dates = strtotime($blog->post_date);
			$new_dates = date('M j', $old_dates);
			?>
            <?php
					$post_comment = DB::table('post')
							 ->where('post_parent', '=', $blog->post_id)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->count();
					?> 
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>"><?php echo $blog->post_title;?></a></h3>
                    <span class="info"><?php echo $new_dates;?> </span>
                    <p class="text"><?php echo substr($blog->post_desc,0,150).'...';?></p>
                    <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" class="lnk btn btn-primary">@lang('languages.read_more')</a> </div>
                 
                  
                </div>
               
              </div>
              
               <?php } } ?>
              
              
              
              
            </div>
            
          </div>
          
          </div>
        
        
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div>
        
        
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
       
       
       
       
       <div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
	<h3 class="section-title">@lang('languages.latest_products')</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
        <?php if(!empty($latestcount)){?>
        <?php 
		$ii=1;
		foreach($latest_product as $product){
											
											$prod_id = $product->prod_token; 
								 $product_img_count = DB::table('product_images')
													->where('prod_token','=',$prod_id)
													->count();
											?>
					<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
                             <?php
                            $prod_id = $product->prod_token; 
								 $product_img_count = DB::table('product_images')
													->where('prod_token','=',$prod_id)
													->count();
													?>
								<a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                 <?php 
                                        if(!empty($product_img_count)){					
														$product_img = DB::table('product_images')
																			->where('prod_token','=',$prod_id)
																			
																			->orderBy('prod_img_id','asc')
																			->get();
																			
										if(!empty($product_img[0]->image))
										{								
										?>
                                        <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt=""/>
                                        <?php } else { ?>
                                        <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt=""/>
                                        <?php } } ?>
                                        </a>
							</div>
							<!--<div class="sale-offer-tag"><span>35%<br>off</span>sara</div>-->
                            
                            <?php
							
							
					
		
							
								
          $review_count_03 = DB::table('product_rating')
				->where('prod_id', '=', $product->prod_id)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_rating')
				               ->where('prod_id', '=', $product->prod_id)
				               ->get();
				
				
				$over_03 = 0;
		        $fine_value_03 = 0;
				foreach($review_value_03 as $review){
				if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
		if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
		if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
		if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
		if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
		
		$fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
		
      $over_03 +=$review->rating;
	  
	  
	  
				}
				if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
		  $roundeding_03 = 0; }	
				
				
				}
				
				
				
				
				
				if(!empty($review_count_03))
				                               {
	                                           if(!empty($roundeding_03)){
	
	                                           if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p>';
												}
												
												if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_03 = '
												<p class="review-icon">
                                                    <span>
                                                    
                                                    </span>
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i>
											    </p>';
												
				
				?>       
                            
                            
                            
							
						</div>
						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a></h3>
							<div class="product-price">  <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> </div>
							<p><?php if(!empty($product->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;" class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span> <span class="fontsize15 black"> <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span> <?php } else { ?> <span class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span> <?php } ?></p>
							
						</div>
                        
                        
                        
                        <div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button" onClick="window.location.href='<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>'">
										<i class="fa fa-shopping-cart"></i>													
									</button>
									<button class="btn btn-primary cart-btn" type="button" onClick="window.location.href='<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>'">@lang('languages.add_to_cart')</button>
									
                                    
                                    
                                    
                                    						
								</div>
								
							</div><!-- /.action -->
						</div>
                        
                        
                        
						
                        
                        
                        
                        
                        
					</div>	
					</div>		        
															        
			 <?php  $ii++;} ?>
                        <?php } ?>												        
						
	    
    </div>
</div>
       
       
       
       
       
       
       
       <div class="wow fadeInUp outer-top-vs">
       
       <?php if(!empty($banners_count)){?>
                <?php foreach($banners as $slide){?>
                <div class="item positionR hbanner">
                <?php if(!empty($slide->slide_image)){?>
                    <a href="<?php echo $slide->slide_btn_link;?>"><img src="<?php echo $url;?>/local/images/media/<?php echo $slide->slide_image;?>" alt=""/></a>
                    <?php } else { ?>
                   <a href="<?php echo $slide->slide_btn_link;?>"> <img src="<?php echo $url;?>/local/images/noimage.jpg" alt=""/></a>
                    <?php } ?>
                    
                </div>
                <?php } ?>
                <?php } ?>
       
       </div>
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        </div>

       
        </div>
            </div>
        <!-- /.wide-banners -->

      </div>
    </div>
     
  </div>
  
</div>
  
  
			
      @include('footer')
     <?php if(session()->has('success')){?>
    <script type="text/javascript">
        alert("<?php echo session()->get('success');?>");
		
		</script>
    
	 <?php } ?>
     <?php if(session()->has('error')){?>
    <script type="text/javascript">
        alert("<?php echo session()->get('error');?>");
		</script>
    
	 <?php } ?>
      
   
      
</body>
</html>