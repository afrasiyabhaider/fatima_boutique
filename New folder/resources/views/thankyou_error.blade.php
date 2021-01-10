<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
     
    

	
    <div class="pagetitle" align="center">
        
           <?php if(!empty(Session::has('error'))){?>
                <h2 class="text-center">@lang('languages.oops_error')</h2>
           <?php } ?>
            
       
    </div>
	
	
	
	
	
	
	
	<div class="clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix"></div>
	<div class="headerbg">
    <div class="height30"></div>
	 <div class="col-md-12" align="center">
     <h1 class="h3 black text-center">
     <?php if(!empty(Session::has('error'))){?>
    <?php echo session()->get('error');?>
    <?php } ?>
    
     </h1></div>
     <div class="clear height50"></div>
	 </div>
	
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
       
</body>
</html>