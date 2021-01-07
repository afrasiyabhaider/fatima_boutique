<!DOCTYPE html>
<html lang="en">
<head>

    <title>Comment Received</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - @lang('languages.comment_received')</h1>
	 
	 
	
	 
	 
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
			
			<?php if(!empty($event_title)){ $txt_title ="Event"; $link ="events"; $slug =  $event_slug; $title = $event_title; }?>
			<?php if(!empty($blog_title)){ $txt_title ="Blog"; $link ="blog"; $slug =  $blog_slug; $title = $blog_title; }?>
			<?php if(!empty($sermon_title)){ $txt_title ="Sermon"; $link ="sermons"; $slug =  $sermon_slug; $title = $sermon_title; }?>
			
			<h3>@lang('languages.comment_received')</h3>
			<p> <?php echo $txt_title;?> @lang('languages.name') - <a href="<?php echo $url;?>/<?php echo $link;?>/<?php echo $slug;?>"><?php echo $title;?></a></p>
           
			<p> @lang('languages.name') - <?php echo $name;?></p> 	
			<p> @lang('languages.email_address') - <?php echo $email;?></p> 	
			
			<p> @lang('languages.message') - <?php echo $msg;?></p> 	
			
				
				
			
			
			
	
	
	
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>