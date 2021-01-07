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
    <h1>Edit Type</h1>
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
            <h5>Edit Type</h5>
          </div>
          <div class="widget-content nopadding">
          
              
              <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edit_attribute_type') }}"  enctype="multipart/form-data" id="formID">
                     {{ csrf_field() }} 
                     
                    
                     
              <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                 
                                
                   <input id="name" class="validate[required] span8"  name="name" value="<?php echo $attribute[0]->attr_name;?>" type="text">
						   @if ($errors->has('name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>That type is already exists</strong>
                                    </span>
                                @endif              
                  
                </div>
              </div>
              
              
              
              
              <div class="control-group">
                <label class="control-label">Search for category and product?</label>
                <div class="controls">
                 
                                
                   <input id="enable_search" class=""  name="enable_search" value="1" type="checkbox" <?php if($attribute[0]->search==1){?> checked <?php } ?>>
						                
                  
                </div>
              </div>
              
              
              
              <input type="hidden" name="attr_id" value="<?php echo $attribute[0]->attr_id; ?>">
              
              
              
              
              <div class="control-group">
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                        <div class="span8">
                         
                          <a href="<?php echo $url;?>/admin/attribute_type" class="btn btn-primary">Cancel</a>
                        
                       
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



</div>
  
  
  
 @include('admin.footer')
	
  </body>
</html>
