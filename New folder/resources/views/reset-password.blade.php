<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')
    <?php $url = URL::to("/"); ?>
    <div class="breadcrumb">
	<div class="container-fluid">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="<?php echo $url;?>">@lang('languages.home')</a></li>
				<li class='active'>@lang('languages.reset_password')</li>
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
	
		
        <div class="row">
        <div class="col-md-12">
        <div class="col-md-6"><div class="heading-title" style="border-bottom:none !important;">@lang('languages.reset_password')</div></div>
                <div class="col-md-6 text-right"></div>
         </div>       
        </div>
        
        
        <div class="height10 clearfix"></div>
        
        <div class="table-responsive">
          <div class="row">
                <div class="col-md-2"></div> 
                
                <div class="col-md-8">
    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('reset-password') }}" id="formID">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label para black">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control validate[required,custom[email]] text-input radiusoff" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label para black">Change Password</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control validate[required] text-input radiusoff" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <input type="hidden" name="password_token" value="<?php echo $id;?>">
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('languages.reset_password')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div> 
                
            </div>
        </div>
         
    </div>

	
	</div>
    
    
    
    
    
    </div>
    
   </div>
   
   </div>
   
   
   <div class="clearfix height50"></div>
	

      @include('footer')
      
</body>
</html>