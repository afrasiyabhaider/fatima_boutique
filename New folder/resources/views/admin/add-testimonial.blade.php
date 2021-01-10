<!DOCTYPE html>
<html lang="en">
  <head>
   
  
     @include('admin.title')
    @include('admin.style')
	
    
  </head>

  <body>
   @include('admin.top')

@include('admin.menu')






<div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Add Testimonial</h1>
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
            <h5>Add Testimonial</h5>
          </div>
          <div class="widget-content nopadding">
          
              
              <?php $url = URL::to("/"); ?>   
                   
                     
               <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.add-testimonial') }}" enctype="multipart/form-data" id="formID">
                     {{ csrf_field() }}       
                     
              <div class="control-group">
                <label class="control-label">Name <span class="required">*</span></label> 
                <div class="controls">
                 
                                
                                
                    <input id="name" class="validate[required] span8"  name="name" value="" type="text">
						   @if ($errors->has('name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>That testimonial name is already exists</strong>
                                    </span>
                                @endif            
                  
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Description <span class="required">*</span></label>
                <div class="controls">
                  
                        
                     <textarea id="desc" class="validate[required] span8" name="desc"></textarea>            
                                
                                
                  
                </div>
              </div>
              
              
              
              
              <div class="control-group">
                <label class="control-label">Image <span class="required">*</span></label>
                <div class="controls">
                  
                  
                                
                  <input type="file" id="photo" name="photo" class="validate[required] span8">
						  
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif              
                                
                </div>
              </div>
              
              
              
             
             
              
              
              
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                        <div class="span8">
                          
                          
                        <a href="<?php echo $url;?>/admin/testimonials" class="btn btn-primary">Cancel</a>
                       
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
