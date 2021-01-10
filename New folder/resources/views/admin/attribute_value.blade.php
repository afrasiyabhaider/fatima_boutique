<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$log_id = Auth::user()->id;
				 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
    @include('admin.table-style')
    
  </head>

  <body>
  
  
  @include('admin.top')

@include('admin.menu')
<?php $url = URL::to("/"); ?>
  
  
  
  <div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Attribute Value</h1>
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



                 <div align="right">
                  
                  
				   <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Value</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add_attribute_value" class="btn btn-primary">Add Value</a>
				  <?php } ?>
                 </div>
<div class="widget-box">
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Attribute Value</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                          
                        
                          <th>Sno</th>
						  
                          <th>Type Name</th>
                          
                          <th>Value</th>
                          
                          <th>Status</th>
                         
                          <th>Action</th>
                         
                         </tr>
                         
                         
                         
                         
              </thead>
              <tbody>
             <?php 
					  $i=1;
					  foreach ($attribute_value as $value) { 
					  
					  $attribute_type_cnt = DB::table('product_attribute_type')
		                                ->where('delete_status','=','')
										->where('attr_id','=',$value->attr_id)
					                    ->count();
					  if(!empty($attribute_type_cnt))
					  {					
					  $attribute_type = DB::table('product_attribute_type')
		                                ->where('delete_status','=','')
										->where('attr_id','=',$value->attr_id)
					                    ->get();
										
					  $att_name = $attribute_type[0]->attr_name;
					  }
					  else
					  {
					  $att_name = "";
					  }										
					  ?>
                      
                      
                        <tr class="gradeX">
                       
                        
						 <td><?php echo $i;?></td>
						 
                          <td><?php echo $att_name;?></td>
                          
                          <td><?php echo $value->attr_value;?></td>
                          
                          <?php if($value->status==1){ $status_txt = "Active"; $clrs = "green"; } else { $status_txt = "Inactive"; $clrs = "red"; }?>
                          
						  <td style="color:<?php echo $clrs;?>; font-weight:bold;"><?php echo $status_txt;?></td>
                          
						  <td>
                          <?php if($log_id==$value->user_id){?>
                          <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-success btndisable">Active</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/attribute_value/action/{{ $value->value_id }}/1" class="btn btn-success">Active</a>
						  
				  <?php } ?>
                  
                  
                  <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Inactive</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/attribute_value/action/{{ $value->value_id }}/0" class="btn btn-danger">Inactive</a>
						  
				  <?php } ?>
                  
                  
                          
                          
						   <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/edit_attribute_value/{{ $value->value_id }}" class="btn btn-success">Edit</a>
						  <?php } ?>
                          
                          <?php } ?>
                          
				   <?php if(config('global.demosite')=="yes"){?>
				   <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/attribute_value/{{ $value->value_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						 
					 <?php } ?>
						 </td>
                         
                         
                        </tr>
                        
                    
                <?php $i++;} ?>
                                
              </tbody>
            </table>
           
          </div>
          
        </div>
  
  
  
  
   
		 </div>
         </div>
         </div>
         
         
         </div>
  
  
  
  
      

     @include('admin.footer') 
	
  </body>
</html>
