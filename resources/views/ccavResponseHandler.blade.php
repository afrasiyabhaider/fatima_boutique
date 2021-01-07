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
				<li class='active'>Thank You</li>
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
	
		<div class="col-md-12 row"><div class="heading-title">Thank You</div></div>
        
        
        
        <div class="height20 clearfix"></div>
        
        <div class="table-responsive">
        
       
       
       <div class="text-center">   
	<div class="clear height50"></div>
	<div>
    <?php if($order_status==="Success"){?>
    <h2>@lang('languages.payment_thankyou')</h2>
    <?php }  else if($order_status==="Failure") {?>
    <h2>Thank you for shopping with us.However,the transaction has been declined.</h2>
    <?php } else if($order_status==="Aborted"){?>
    <h2>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail</h2>
    
    <?php } else { ?>
    <h2>Security Error. Illegal access detected</h2>
    <?php } ?>
	</div>
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
