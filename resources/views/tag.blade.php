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
				<li>@lang('languages.tags')</li>
                <li class="active"><?php echo $tag_txt;?></li>
			</ul>
		</div>
	</div>
</div>



<div class="body-content">
	<div class="container-fluid">
		<div class="my-wishlist-page">
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
            
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4" class="heading-title">@lang('languages.tagged_with') <span class="tag_text"><?php echo $tag_txt;?></span></th>
				</tr>
			</thead>
			<tbody>
            <?php if($type=="blog"){?>
	
	<?php foreach($query as $nquery){ ?>
            
				
				<tr>
					<td class="col-md-2">
                    
                    <?php if($nquery->post_media_type=="image"){ ?>
    				<?php if(!empty($nquery->post_image)){ ?>
          			<a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url.'/local/images/media/'.$nquery->post_image;?>" class="img_responsive"></a>
        			<?php } else {?>
       				<a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" class="img_responsive"></a>
        			<?php } ?>
                    <?php } ?>
                    
                    <?php if($nquery->post_media_type=="mp3"){ ?>
                    <a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url;?>/local/images/blogaudio.png" class="img_responsive"></a>
                   
                    <?php } ?>
                    <?php if($nquery->post_media_type=="video"){?>
                    <a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url;?>/local/images/blogvideo.png" class="img_responsive"></a>
                    <?php } ?>
                    
                    
                    
                    
                   
                    
                    </td>
					<td class="col-md-9">
						<div class="product-name">
                        
                       
                        <a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" class="bold"><?php echo $nquery->post_title;?></a>
                        <p class="fontsize14"><?php echo substr($nquery->post_desc,0,150).'...';?></p>
                        
                        </div>
						
						<div class="fontsize13 btn_color">
							
							<?php echo date("d M Y h:i:s a",strtotime($nquery->post_date));?>
						</div>
                        
                        
                        
					</td>
					<td class="col-md-3">
                    <a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" class="btn-upper btn btn-primary">@lang('languages.view_more')</a>
						
					</td>
					
				</tr>
                
                
                <?php } } ?>
                
                
                
                <?php if($type=="product"){?>
	
	<?php foreach($query as $nquery){ 
	
	$product_img_count = DB::table('product_images')
						->where('prod_token','=',$nquery->prod_token)
						->count();
	
	?>
    
    
    
    <tr>
					<td class="col-md-2">
                     <?php if(!empty($product_img_count)){					
						$product_img = DB::table('product_images')
				                       ->where('prod_token','=',$nquery->prod_token)
									   ->orderBy('prod_img_id','asc')
									   ->get();
																		
														
														?>
                                                        <a href="<?php echo $url;?>/product/<?php echo $nquery->prod_id;?>/<?php echo $nquery->prod_slug;?>"><img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>" alt="" class="img_responsive"></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo $url;?>/product/<?php echo $nquery->prod_id;?>/<?php echo $nquery->prod_slug;?>"><img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt="" class="img_responsive"></a>
                                                        <?php } ?>
                    
                    
                    
                    
                    </td>
					<td class="col-md-9">
						<div class="product-name">
                        
                        <a href="<?php echo $url;?>/product/<?php echo $nquery->prod_id;?>/<?php echo $nquery->prod_slug;?>" ><?php echo $nquery->prod_name;?></a>
                        
                       
                        </div>
						
						<div class="price">
							
							<?php if(!empty($nquery->prod_offer_price)){?><span><?php echo $setts[0]->site_currency.' '.number_format($nquery->prod_price,2).' ';?></span><?php echo $setts[0]->site_currency.' '.number_format($nquery->prod_offer_price,2);?><?php } else { ?><?php echo $setts[0]->site_currency.' '.number_format($nquery->prod_price,2);?><?php } ?>
						</div>
                        
                        
                        
					</td>
					<td class="col-md-2">
						<a href="<?php echo $url;?>/product/<?php echo $nquery->prod_id;?>/<?php echo $nquery->prod_slug;?>" class="btn-upper btn btn-primary">@lang('languages.add_to_cart')</a>
					</td>
					
				</tr>
    
    
     <?php } ?>
    
    <?php } ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
			</tbody>
		</table>
	</div>
</div>			</div>
		</div>
		</div>
</div>


<div class="height30"></div>

@include('footer')
</body>
</html>
