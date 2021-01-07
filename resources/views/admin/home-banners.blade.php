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
    <h1>Home Banners</h1>
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
            <h5>Home Banners</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                          
          
                        
                          <th>Sno</th>
						  <th>Image</th>
                          <th>Heading</th>
                          <th>Link</th>
                          <th>Status</th>
                          
                          <th>Action</th>
                          
                         </tr>
                         
                         
                         
                         
                         
                         
              </thead>
              <tbody>
             <?php 
					  $i=1;
					  foreach ($slideshow as $slideshows) { ?>
    
						
                        <tr>
                         
                        
						 <td><?php echo $i;?></td>
                         
                         
						 <?php 
					   $slideshowsphoto="/media/";
						$path ='/local/images'.$slideshowsphoto.$slideshows->slide_image;
						if($slideshows->slide_image!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="70"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="70"></td>
						 <?php } ?>
                         
                         
                         
                         
                          <td><?php echo $slideshows->slide_title;?></td>
                          <td><?php echo $slideshows->slide_btn_link;?></td>
                          
                          <td><?php if($slideshows->slide_status==1){?> Enabled <?php } else { ?> Disabled <?php } ?></td>
						  
						  <td>
						  
						   <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/edit-home-banner/{{ $slideshows->id }}" class="btn btn-success">Edit</a>
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
