<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

     
    <!-- fixed navigation bar -->
    @include('header')

	<header class="custom_header">
		
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="">
						<div class="animate-box" data-animate-effect="fadeIn">
							<h1>@lang('languages.payment_success')</h1>
							
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

    
     
    

<div id="avigher-gallery">
		
		<div class="container">
        
        
        
        
        
        <div class="container text-center">
	<h2>@lang('languages.payment_thankyou')</h2>
    <h2>@lang('languages.payment_id') - <?php echo $cid; ?>.</h2>
	</div>
        
        
        
           
           
           
           
          	
	
	
	
	
	</div>
    </div>
    
   
    
<div class="clearfix height100"></div>
      
	  

      @include('footer')
</body>
</html>