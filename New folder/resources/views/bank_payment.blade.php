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
<?php 

$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
?>
 
     
    <!-- fixed navigation bar -->
    @include('header')

	<header class="custom_header">
		
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="">
						<div class="animate-box" data-animate-effect="fadeIn">
							<h1>PAYMENT CONFIRMATION</h1>
							
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

    
     
  <?php 
  
  if(!empty($booking_count)){?>  

<div id="avigher-gallery">
		
		<div class="container">
        
        @if(Session::has('success'))
<div class="col-md-12">
	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>
</div>
	@endif
	
	
	
	@if(Session::has('error'))
<div class="col-md-12">
	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>
</div>
	@endif
        
        
        <div class="fontsize21 bold">BOOKING INFORMATION</div>
	<div class="height20"></div>
        
        
        <div class="text-left">
	<div class="min-space"></div>
	<p><label>Services Name </label> - <?php echo $service_names; ?><br>
     <label>Booking Date</label> -  <?php echo $booking_date; ?><br>
    <label>Price</label> - <?php echo $prices; ?> <?php echo $currency; ?></p>
    
    
    
    
    <div class="height30"></div>
    <div>
	
	<div class="fontsize21 bold">BANK PAYMENT INFORMATION</div>
	<div class="height20"></div>
	
	<div class="fweight500">
	<p>
	Reference Number:  #<?php echo $booking_id;?><br/>
	<?php echo $setts[0]->bank_payment;?></p>
	
	</div>
	<div class="height20"></div>
	
	<div>
	<div class="step fontsize21 bold">STEP #1</div>
	<p>Bookmark this page, you will need it to notify us when you made the payment.</p>
	</div>
	
	<div class="height20"></div>
	<div>
	<div class="step fontsize21 bold">STEP #2</div>
	<p>Go to your bank and send the payment to us.</p>
	</div>
	
	<div class="height20"></div>
	<div>
	<div class="step fontsize21 bold">STEP #3</div>
	<p>After you have sent the payment fill out the form below and then click on submit.</p>
	</div>
	
	<div class="height20"></div>
	
	<form id="formID" method="POST" action="{{ route('bank_payment') }}">
	{{ csrf_field() }}
                    <div class='row'>
                        <div class='col-sm-8'>
						
						
						<input type="hidden" name="admin_email" value="<?php echo $admin_mail;?>">
						
                        <input type="hidden" name="book_id" value="<?php echo $booking_id;?>">
                        
                            <div class='form-group'>
							
                                <label for='fname'>Your Name</label>
                                <input type='text' name='name' class='form-control validate[required]' readonly value="<?php echo Auth::user()->name;?>"/>
                            </div>
                            
                            <div class='form-group'>
                                <label for='email'>Date Sent (YYYY-MM-DD)</label>
                                <input type='text' name='payment_date_sent' class='form-control validate[required]' />
                            </div>
                            
                            <div class='form-group'>
                                <label for='message'>Any additional information you think will be helpful in identifying your payment</label>
                                <textarea class='form-control validate[required]' name='info' rows='10'></textarea>
                            </div>
                            <div class='text-left'>
                                <input type='submit' class='btn btn-primary' value='Submit' />
                            </div>
                        
                        </div>
                        
                    </div>
                </form>
	
	
	
	</div>
    
    
    
    
    
    
    
	
	
	
	</div>
        
        
        
           
           
           
           
          	
	
	
	
	
	</div>
    </div>
    <?php } else {?>
    
    
    <div id="avigher-gallery">
		
		<div class="container">
        
        <div class="height50"></div>
                    <div class="fontsize35 text-center">No Data Found!</div>
           <div class="height30"></div>          
        
        </div>
        
        
     </div>   
    
    
    
    <?php } ?>
   
    
<div class="clearfix height100"></div>
      
	  

      @include('footer')
</body>
</html>