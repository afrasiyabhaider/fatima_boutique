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
    <h1>Edit <?php if($users[0]->admin==0){?>Customer<?php } else if($users[0]->admin==2){?>Vendor<?php } else { ?>User<?php } ?></h1>
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
            <h5>Edit User</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $url = URL::to("/"); ?> 
            <form class="form-horizontal" method="post" action="{{ route('admin.edituser') }}" enctype="multipart/form-data"  name="basic_validate" id="formID" novalidate="novalidate">
              {{ csrf_field() }}
              
              
              <div class="control-group">
                <label class="control-label">Username</label>
                <div class="controls">
                 <input id="name" class="validate[required] text-input span8"  name="name" value="<?php echo $users[0]->name; ?>" type="text">
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
                 
                                
                   <input type="email" id="email" name="email" value="<?php echo $users[0]->email; ?>" class="validate[required,custom[email]] text-input span8">
						  @if ($errors->has('email'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif             
                                
                  
                </div>
              </div>
              
              <?php if($userid==1) {?>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                 
                  <input id="password" type="text" name="password" value=""  class="span8">
                </div>
              </div>
              <?php } ?>
               <input type="hidden" name="savepassword" value="<?php echo $users[0]->password;?>">
              
              <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
               
                  <input type="tel" id="phone" name="phone" data-validate-length-range="8,20" class="validate[required] text-input span8" value="<?php echo $users[0]->phone; ?>"> 
                </div>
              </div>
              <input type="hidden" name="id" value="<?php echo $users[0]->id; ?>">
              
              
              <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">
              <select name="country" class="validate[required] span8">
							  
							  <option value="">Select Country</option>
							  <?php foreach($countries as $country){?>
                              <option value="<?php echo $country;?>" <?php if($users[0]->country==$country){?> selected <?php } ?>><?php echo $country;?></option>
                              <?php } ?>
							</select>
               </div>
              </div>
              
               <div class="control-group">
                <label class="control-label">Photo</label>
                <div class="controls">
                <input type="file" id="photo" name="photo" class="form-control col-md-7 col-xs-12">
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                  
                </div>
              </div>
              <?php $url = URL::to("/"); ?>
					  <?php 
					   $userphoto="/media/";
						$path ='/local/images'.$userphoto.$users[0]->photo;
						if($users[0]->photo!=""){
						?>
					  <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
					  </div>
                      </div>
						<?php } else { ?>
					  <div class="control-group">
                      <div class="controls">
					  <div class="span8">
					  <img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="100">
					  </div>
					  </div>
                      </div>
						<?php } ?>
              
              
              
              <input type="hidden" name="currentphoto" value="<?php echo $users[0]->photo;?>">
					  
					  
					  
					  
					  
					  <?php if($users[0]->admin!=1){?>
					 <div class="control-group">
                <label class="control-label">User Type</label>
                <div class="controls">
						<select name="usertype" class="validate[required] span8">
						<option value="">Select</option>
							   <option value="0" <?php if($users[0]->admin==0){?> selected="selected" <?php } ?>>Customer</option>
							   <option value="2" <?php if($users[0]->admin==2){?> selected="selected" <?php } ?>>Vendor</option>
						</select>
                          
                        </div>
                      </div>
                      
                     <?php /*?> <input type="hidden" name="usertype" value="2"> <?php */?>
                       
					  <?php } ?>
					  
					  
					  <?php if($users[0]->admin==1){?>
					  
					  <input type="hidden" name="usertype" value="1">
                      
                      <?php /*?> <input type="hidden" name="usertype" value="<?php echo $users[0]->admin;?>"><?php */?>
					  
					  <?php } ?>
              
              
              
              <?php if($users[0]->admin==2){?>
              <div class="control-group">
                <label class="control-label">Earning Balance : </label>
                <div class="controls">
						
                          <input id="name" class="text-input span8"  name="earning" value="<?php echo $users[0]->earning;?>" type="text">
                        </div>
                      </div>
                      
                <?php } ?>      
              
              
             
					
              
              <div class="form-actions">
                        <div class="span8">
                         
                                <?php /*?><a href="<?php echo $url;?>/admin/users" class="btn btn-primary">Cancel</a><?php */?>
						  
						  
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
