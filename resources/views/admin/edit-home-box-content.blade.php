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
    <h1>Edit Home Box Content</h1>
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
            <h5>Edit Home Box Content/h5>
          </div>
          <div class="widget-content nopadding">
         <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edit-home-box-content') }}" enctype="multipart/form-data" id="formID">
                     {{ csrf_field() }}  
                     
                     
                     
             
              
              
              
              
              
              
              
              
              
              
              
              
              
                     
                     
               
              
              <input type="hidden" name="id" value="<?php echo $slideshow[0]->id; ?>">
              
              
              
              
              <div class="control-group">
                <label class="control-label">Icon <span class="required">*</span></label>
                <div class="controls">
                 
                 
                  
                  <input type="text" class="input" name="home_box_icon" id="inputid2" value="<?php echo $slideshow[0]->icon;?>" readonly/>
                  
                 
                  
                  
                </div>
                
                
     
              </div>
              
              
              
              
              
               <div class="control-group">
                <label class="control-label">Heading </label> 
                <div class="controls">
                 
                                
                                
                    <input id="heading" class="span8"  name="heading" value="<?php echo $slideshow[0]->heading; ?>" type="text">
						            
                  
                </div>
              </div>
              
              
              
              <div class="control-group">
                <label class="control-label">Sub Heading </label> 
                <div class="controls">
                 
                                
                                
                    <input id="subheading" class="span8"  name="subheading" value="<?php echo $slideshow[0]->subheading; ?>" type="text">
						            
                  
                </div>
              </div>
              
              
              
              <div class="control-group">
                <label class="control-label">Enable? </label> 
                <div class="controls">
                 
                                
                                
                    <input id="status"  name="status" value="1" type="checkbox" <?php if($slideshow[0]->status==1){?> checked <?php } ?>>
						            
                  
                </div>
              </div>
              
             
              
              
              
              
              
              
              
              
              
                     
              <div class="form-actions">
                        <div class="span8">
                         
                              
						   <a href="<?php echo $url;?>/admin/home-box-content" class="btn btn-primary">Cancel</a>
						  
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
