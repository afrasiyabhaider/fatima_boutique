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
    <h1>Edit Value</h1>
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
            <h5>Edit Value</h5>
          </div>
          <div class="widget-content nopadding">
          
              
              <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edit_attribute_value') }}"  enctype="multipart/form-data" id="formID">
                     {{ csrf_field() }} 
                     
                    
                     
              <div class="control-group">
                <label class="control-label">Select Type <span class="required">*</span></label>
                <div class="controls">
                 
                                
                   <select name="attribute_type" id="attribute_type" class="validate[required] text-input span8">
						<option value="">Select</option>
                        <?php if(!empty($type_count)){?>
                        <?php foreach($attribute_type as $type){?>
									<option value="<?php echo $type->attr_id;?>" <?php if($attribute[0]->attr_id==$type->attr_id){?> selected <?php } ?>><?php echo $type->attr_name;?></option>
									<?php } ?>
                                    <?php } ?>
                                    
								</select>            
                  
                </div>
              </div>
              
              
              
              <div class="control-group">
                <label class="control-label">Value <span class="required">*</span></label> 
                <div class="controls">
                        
                        
                          <input id="attribute_value" class="validate[required] span8"  name="attribute_value" value="<?php echo $attribute[0]->attr_value;?>" type="text">
                         
					   </div>
                      </div>
              
              
              <input type="hidden" name="value_id" value="<?php echo $attribute[0]->value_id;?>">
              
              
              
              <div class="control-group">
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                        <div class="span8">
                         
                          <a href="<?php echo $url;?>/admin/attribute_value" class="btn btn-primary">Cancel</a>
                        
                       
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
