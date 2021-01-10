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
<body>

  

   
    @include('header')

	<header class="custom_header">
		
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="">
						<div class="animate-box" data-animate-effect="fadeIn">
							<h1>@lang('languages.gallery')</h1>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	
	<div id="avigher-gallery">
		
		<div class="container-fluid">
			<div class="row row-bottom-padded-md">
				<div class="col-md-12">
					<ul id="avigher-portfolio-list" class="gallerylist">
                        <?php if(!empty($query_cnt)){?>
                        <?php 
						$z=1;
						foreach($query as $viewgallery){
						if($z==2){ $cls = "two-third"; } else { $cls = "one-third"; } 
						?>
						<li class="one-third animate-box gallerybox gallery-item" data-animate-effect="fadeIn" style="background-image: url(<?php echo $url;?>/local/images/media/<?php echo $viewgallery->galleryimage;?>);">
							<a href="<?php echo $url;?>/local/images/media/<?php echo $viewgallery->galleryimage;?>" class="lumos-link" data-lumos="demo2">
								<div class="case-studies-summary">
									<span><?php echo $viewgallery->title;?></span>
									<h2><?php echo $viewgallery->subtitle;?></h2>
								</div>
							</a>
						</li>
						 <?php $z++; } ?>
                        <?php } ?>
						
                        
                        
					</ul>	
                    
                    <div class="pagi"></div>	
				</div>
			</div>
		</div>
	</div>
	

	


	@include('footer')
      
</body>
</html>