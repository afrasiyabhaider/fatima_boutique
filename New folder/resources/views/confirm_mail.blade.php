<!DOCTYPE html>
<html lang="en">
<head>

    <title>Email Confirmation for Registration</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - Email Confirmation for Registration</h1>
	 
	 
	
	 
	 
	 <div class="clearfix"></div>
	 
	 <div class="row profile shop">
		<div class="col-md-6">
	 
	 
	
	<div id="outer" style="width: 100%;margin: 0 auto;background-color:#cccccc; padding:10px;">  
	
	
	<div id="inner" style="width: 80%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;
	font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px; padding:10px;">
			<?php if(!empty($site_logo)){?>
			<div align="center"><img src="<?php echo $site_logo;?>" border="0" alt="logo" /></div>
			<?php } else { ?>
			<div align="center"><h2><?php echo $site_name;?></h2></div>
			<?php } ?>
			
			<p> <?php echo $name;?>,</p><br/><br/>
			<p> To complete your registration, please confirm your e-mail address by clicking this link:</p>
			<p> <a href="<?php echo $url;?>/confirmemail/<?php echo $keyval;?>" target="_blank"><?php echo $url;?>/confirmemail?c=<?php echo $keyval;?></a></p><br/><br/> 	
			
			<p> Thank You,</p> 
			<P><?php echo $site_name;?></P>
				
	
	
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>