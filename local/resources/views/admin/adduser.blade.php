<!DOCTYPE html>
<html lang="en">
  <head>
   
  
     @include('admin.title')
    @include('admin.style')
	
    
  </head>

  
  
  <body>
  
  
  @include('admin.top')
<!--close-top-serch-->
<!--sidebar-menu-->
@include('admin.menu')
  
  
  <div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Add User</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      @if(Session::has('error'))
      <div class="alert alert-error">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
              {{ Session::get('error') }}
              </div>
      @endif
      
      @if(Session::has('success'))

	           
        <div class="alert alert-success">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
               {{ Session::get('success') }}
              </div>

	@endif

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add User</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $url = URL::to("/"); ?> 
            <form class="form-horizontal" method="post" action="{{ route('admin.adduser') }}" enctype="multipart/form-data" name="basic_validate" id="formID" novalidate="novalidate">
              {{ csrf_field() }}
              
              
              <div class="control-group">
                <label class="control-label">Username</label>
                <div class="controls">
                 <input id="name" class="validate[required] text-input span8"  name="name" value="" type="text">
                         @if ($errors->has('name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                 <input type="email" id="email" name="email" value="{{ old('email') }}" required="required" class="validate[required,custom[email]] span8">
						  @if ($errors->has('email'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                 <input id="password" type="password" name="password"  class="validate[required] text-input span8">
                  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                <input type="tel" id="phone" name="phone" data-validate-length-range="8,20" class="validate[required] text-input span8">
                  
                </div>
              </div>
              
              
              
              <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">
              <select name="country" class="validate[required] span8">
							  
							  <option value="">Select Country</option>
							  <?php foreach($countries as $country){?>
                              <option value="<?php echo $country;?>"><?php echo $country;?></option>
                              <?php } ?>
							</select>
               </div>
              </div>
              
              
              
              
              
               <div class="control-group">
                <label class="control-label">Photo</label>
                <div class="controls">
                <input type="file" id="photo" name="photo" class="span8">
						  
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                  
                </div>
              </div>
              
              
              
              
              
                        
                         <div class="control-group">
                <label class="control-label">User Type</label>
                <div class="controls">
                        
						<select name="usertype" class="validate[required] text-input span8">
						<option value="">Select</option>
							   <option value="0">Customer</option>
							   <option value="2">Vendor</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
               <?php /*?><input type="hidden" name="usertype" value="2">      <?php */?> 
             
					
              
              <div class="form-actions">
                        <div class="span8">
                         
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                           <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>



</div>
  
  
  
  
  

    @include('admin.footer')
	
  </body>
</html>
