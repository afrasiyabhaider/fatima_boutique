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
    <h1>Membership</h1>
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
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Plan</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add_membership" class="btn btn-primary">Add Plan</a>
				  <?php } ?>
                 </div>
<div class="widget-box">
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Membership</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                         <th>Sno</th>
						  
                          <th>Plan Name</th>
                          
                          <th>Price</th>
                          
                          <th>Product Limit</th>
                          
                          <th>Status</th>
                          
                          <th>Action</th>
                         
                         
                         
                         
                         
              </thead>
              <tbody>
					  <?php 
					  $i=1;
					  foreach ($membership as $member) {  if($member->membership_status==0){ $btn = "btn btn-danger"; $text = "Deactive"; $sid = 1; } else { $btn = "btn btn-success"; $text = "Active"; $sid=0; } ?>
    
						
                        <tr>
                        
                        
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $member->membership_name;?></td>
                          
                          <?php if(!empty($member->membership_price)) { $price_value = $member->membership_price; } else { $price_value = "Free"; } ?>
                          
                          <td><?php echo $price_value;?></td>
                          
                          <td><?php echo $member->product_limit;?></td>
                          
                          
                          
                          
                          <td>
                          
                           <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/membership/action/{{ $member->mid }}/{{ $sid }}" class="<?php echo $btn;?>"><?php echo $text;?></a>
						  
				  <?php } ?>
                          
                          
                          </td>
                          
                          
                          
                          
                          
						  
						  <td>
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/edit_membership/{{ $member->mid }}" class="btn btn-success">Edit</a>
				  <?php } ?>
                  
                 
                  <?php if(config('global.demosite')=="yes"){?>
				   <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/membership/{{ $member->mid }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						 
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
