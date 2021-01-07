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
    <h1>Media Settings</h1>
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
            <h5>Media Settings</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $url = URL::to("/"); ?> 
            <form class="form-horizontal" method="post" action="{{ route('admin.media-settings') }}" enctype="multipart/form-data" name="basic_validate" id="formID" novalidate="novalidate">
              {{ csrf_field() }}
              
              
              
              <div class="control-group">
                <label class="control-label">Image upload size</label>
                <div class="controls">
                 
                   <input id="image_size" type="number" name="image_size" value="<?php echo $msettings[0]->image_size; ?>"  class="validate[required] text-input span8" > (ex : 1024kb )
                </div>
              </div>
              
               <input type="hidden" name="save_image" value="<?php echo $msettings[0]->image_size; ?>">
              
              
               <div class="control-group">
                <label class="control-label">Image upload type</label>
                <div class="controls">
                 
                  
                   <input id="image_type" type="text" name="image_type" value="<?php echo $msettings[0]->image_type; ?>"  class="validate[required] text-input span8"> (ex : jpg,jpeg,png,gif...ect )
                   
                </div>
              </div>
              
              
					 
					  <input type="hidden" name="save_image_type" value="<?php echo $msettings[0]->image_type; ?>">
                      
                      
                      
                      <input type="hidden" name="video_size" value="1024">
					  
					 
					  <input type="hidden" name="save_video_size" value="<?php echo $msettings[0]->video_size; ?>">
					 
					  
						  <div class="control-group">
                <label class="control-label">Mp3 upload size</label>
                <div class="controls">
                 
                  
                   <input id="mp3_size" type="number" name="mp3_size" value="<?php echo $msettings[0]->mp3_size; ?>"  class="validate[required] text-input span8"> (ex : 1024kb )
                   
                </div>
              </div>
              
              
              
              <div class="control-group">
                <label class="control-label">Zip upload size</label>
                <div class="controls">
                 
                  
                   <input id="zip_size" type="number" name="zip_size" value="<?php echo $msettings[0]->zip_size; ?>"  class="validate[required] text-input span8"> (ex : 1024kb )
                   
                </div>
              </div>
                        
                        
                      
                      
                      <input type="hidden" name="save_mp3" value="<?php echo $msettings[0]->mp3_size; ?>">
						
					
              
              <div class="form-actions">
                        <div class="span8">
                         <a href="<?php echo $url;?>/admin/media-settings" class="btn btn-primary">Cancel</a>
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
