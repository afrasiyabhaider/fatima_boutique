<!DOCTYPE html>
<html lang="en">
<head>

    <title>Payment Received</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - @lang('languages.payment_received')</h1>
	 
	 
	
	 
	 
	 <div class="clearfix"></div>
	 
	 <div class="row profile shop">
		<div class="col-md-6">
	 
	 
	
	<div id="outer" style="width: 100%;margin: 0 auto;background-color:#cccccc; padding:10px;">  
	
	
	<div id="inner" style="width: 80%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;
	font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px; padding:10px;">
			
			<div style="background:#B98B4B;padding:15px 10px 10px 10px;">
			<?php if(!empty($site_logo)){?>
			<div align="center"><img src="<?php echo $site_logo;?>" border="0" alt="logo" /></div>
			<?php } else { ?>
			<div align="center"><h2><?php echo $site_name;?></h2></div>
			<?php } ?>
			</div>
			
			
			<h3>@lang('languages.payment_received')</h3>
			
            
            
            <p> @lang('languages.order_id') - <?php echo $order_id;?></p> 	
			<p> @lang('languages.name') - <?php echo $name;?></p> 	
			<p> @lang('languages.email') - <?php echo $email;?></p> 	
			<p> @lang('languages.phone') - <?php echo $phone;?></p> 
            <p> @lang('languages.amount') - <?php echo $amount;?></p> 
			
			
				
				
			
			
			
	
	
	
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>