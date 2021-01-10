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
    <h1>Edit Testimonial</h1>
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
            <h5>Edit Testimonial</h5>
          </div>
          <div class="widget-content nopadding">
         <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edit-testimonial') }}" enctype="multipart/form-data" id="formID">
                     {{ csrf_field() }}  
                     
                     
                     
                     
                     
               <div class="control-group">
                <label class="control-label">Name <span class="required">*</span></label>
                <div class="controls">
                 
                                
                        <input id="name" class="validate[required] span8"  name="name" value="<?php echo $testimonials[0]->name; ?>" type="text">
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
                  
                        
                                
                 <textarea id="desc" class="validate[required] span8" name="desc"><?php echo $testimonials[0]->description; ?></textarea>               
                                
                  
                </div>
              </div>       
              
              
               
              
              <input type="hidden" name="id" value="<?php echo $testimonials[0]->id; ?>">
              
              
              
              
              <div class="control-group">
                <label class="control-label">Image <span class="required">*</span></label>
                <div class="controls">
                 
                 
                  
                  
                  
                  <input type="file" id="photo" name="photo" class="span8<?php if($testimonials[0]->image==""){?> validate[required]<?php } ?>">
						  
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                  
                  
                </div>
                
                <?php $url = URL::to("/"); ?>
					  <?php 
					   $testimonialphoto="/media/";
						$path ='/local/images'.$testimonialphoto.$testimonials[0]->image;
						if($testimonials[0]->image!=""){
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
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="100">
					  </div>
					  </div>
                      </div>
						<?php } ?>
               
               
               
                
					  
					  <input type="hidden" name="currentphoto" value="<?php echo $testimonials[0]->image;?>">
                     
               
     
              </div>
              
                     
              <div class="form-actions">
                        <div class="span8">
                         
                              
						   <a href="<?php echo $url;?>/admin/testimonials" class="btn btn-primary">Cancel</a>
						  
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
                          
                           <button id="send" type="submit" class="btn btn-success">Submit</button>
						  <?php } ?>
                                
                        </div>
                        </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>




	 @include('admin.footer')
  </body>
</html>
