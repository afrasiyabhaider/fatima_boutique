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
				<li class='active'>@lang('languages.payment_success')</li>
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
	
		
        
        <div class="col-md-12 row"><div class="heading-title">@lang('languages.payment_success')</div></div>
                
        
        
        <div class="height20 clearfix"></div>
        
        <div class="table-responsive">
        
       
       
       <div class="text-center">   
	<div class="clear height50"></div>
	<div>
    <h2>@lang('languages.payment_thankyou')</h2>
	</div>
    
    <div class="col-md-12" align="center"><?php 
	if(!empty($stripe_token)){
	
	
	
	?>
	<h1 class="h3 black text-center">@lang('languages.payment_id') - <?php echo $stripe_token;?></h1> 
	<?php } ?></div>
	<div class="clear height100"></div>
    
    
    
        
    </div>
       
       
       
        
        
        
	</div>
</div>			









</div>
		</div>
		</div>
</div>


<div class="height30"></div>

@include('footer')
</body>
</html>
