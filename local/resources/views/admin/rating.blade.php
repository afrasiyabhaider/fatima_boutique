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
    <h1>Ratings & Reviews</h1>
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
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Ratings & Reviews</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                          
          
                        
                          <th>Sno</th>
						  <th>User Name</th>
                          <th>Product Name</th>
                          <th>Rating</th>
                          <th>Review</th>
                          <th>Action</th>
                          
                         </tr>
                         
                         
                         
                         
                         
                         
              </thead>
              <tbody>
             <?php 
					  $i=1;
					  foreach ($rating as $ratings) {
					  
					  $user_count = DB::table('users')
		                            ->where('id','=',$ratings->user_id)
					                ->count();
					  if(!empty($user_count))
					  {				
					  $user_details = DB::table('users')
		                            ->where('id','=',$ratings->user_id)
					                ->get();
					    $user_namer = $user_details[0]->name;
					  }
					  else
					  {
					     $user_namer = "";
					  } 
					  
					  
					  
					  $prod_count = DB::table('product')
		                            ->where('prod_id','=',$ratings->prod_id)
					                ->count();
					  
					  if(!empty($prod_count))
					  {				
					  $prod_details = DB::table('product')
		                            ->where('prod_id','=',$ratings->prod_id)
					                ->get();
					    $prod_namer = $prod_details[0]->prod_name;
					  }
					  else
					  {
					     $prod_namer = "";
					  } 
					   ?>
    
						
                        <tr>
                         
                        
						 <td><?php echo $i;?></td>
                         
                         
						
                         
                         
                         
                         
                          <td><?php echo $user_namer;?></td>
                          <td><?php echo $prod_namer;?></td>
                          <?php if($ratings->rating==1){ $str = "Star"; } else { $str = "Stars"; } ?>
                          <td><?php echo $ratings->rating;?> <?php echo $str;?></td>
                          <td><?php echo $ratings->review;?></td>
						  
						  <td>
						  
						   <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/rating/{{ $ratings->rate_id }}" class="btn btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
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
