<!DOCTYPE html>
<html lang="en">
<head>

    <title>Reset Password</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - @lang('languages.reset_password')</h1>
	 
	 
	
	 
	 
	 <div class="clearfix"></div>
	 
	 <div class="row profile shop">
		<div class="col-md-6">
	 
	 
	
	<div id="outer" style="width: 100%;margin: 0 auto;background-color:#cccccc; padding:10px;">  
	
	
	<div id="inner" style="width: 80%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;
	font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px; padding:10px;">
			
			<div style="background:#22313F;padding:15px 10px 10px 10px;">
			<?php if(!empty($site_logo)){?>
			<div align="center"><img src="<?php echo $site_logo;?>" border="0" alt="logo" /></div>
			<?php } else { ?>
			<div align="center"><h2><?php echo $site_name;?></h2></div>
			<?php } ?>
			</div>
            
            
            <br/><br/>
            <div>
			<h2> @lang('languages.hello')</h2>
			<div style="font-size:16px;"><p> @lang('languages.your_profile_password')

</p>
			<br/><br/><p align="center">@lang('languages.to_sign') <a href='<?php echo $url;?>/login'><?php echo $url;?>/login</a> @lang('languages.enter_the_following')
				</p><br/>
	
	<p><strong>@lang('languages.username_email'): </strong> <?php echo $email;?></p>
    <p><strong>@lang('languages.password'): </strong> <?php echo $new_pass;?></p>
    
    
    <br/><br/>
    
    <p>@lang('languages.regards'),<br/><br/>@lang('languages.admin')</p>
    
    </div>
    
    </div>
    
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>