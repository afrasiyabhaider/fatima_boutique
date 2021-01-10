<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
     
    

	
    <div class="pagetitle" align="center">
        
          
            <?php if(!empty(Session::has('message'))){?>
                <h2 class="text-center">@lang('languages.thank_you')</h2>
           <?php } ?>
       
    </div>
	
	
	
	
	
	
	
	<div class="clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix"></div>
	<div class="headerbg">
    <div class="height30"></div>
	 <div class="col-md-12" align="center">
     <h1 class="h3 black text-center">
     
    <?php if(!empty(Session::has('message'))){?>
    <?php echo session()->get('message');?>
    <?php } ?>
     </h3></div>
     <div class="clear height50"></div>
	 </div>
	
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
       
</body>
</html>