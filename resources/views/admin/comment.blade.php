<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
    
  </head>

  <body>
   @include('admin.top')

@include('admin.menu')
<?php $url = URL::to("/"); ?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Comments <?php if($urlcomment=='blog'){ $urls = "blog";?> - <?php echo $view_title[0]->post_title;?><?php } ?></h1>
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
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Back</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/<?php echo $urls;?>" class="btn btn-primary">Back</a>
				  <?php } ?>
                 </div>
<div class="widget-box">
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Comments</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                 <tr>
                          <th>Sno</th>
						  <th>Name</th>
                          <th>Email</th>
                          <th style="width:400px !important;">Message</th>
                         
                          <th>Status</th>
                          <th>Action</th>
                          
                        </tr>
              </thead>
              <tbody>
             <?php 
					  $i=1;
					  foreach ($view_comment as $comment) { 
					  
					  if($comment->post_status==0){ $btn = "btn btn-danger"; $text = "Deactive"; $sid = 1; } else { $btn = "btn btn-success"; $text = "Active"; $sid=0; }
					  ?>
                      
                      
                      
                      <tr class="gradeX">
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $comment->post_title;?></td>
                          
                          <td><?php echo $comment->post_email;?></td>
                          
						  <td style="width:400px !important;"><?php echo $comment->post_desc;?></td>
                          
                          <td> <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/comment/{{ $comment->post_id }}/{{ $sid }}" class="<?php echo $btn;?>"><?php echo $text;?></a>
						  
				  <?php } ?> </td>
                          
                         
                          
                          
						  
                          <td>
                          
                          
                          
                          
                          
                          
						  
				   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/comment/{{ $comment->post_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						  <?php } ?>
						  </td>
                        </tr>
                      
                      
                                      
                <?php $i++;} ?>
                                
              </tbody>
            </table>
           
          </div>
          
        </div>
   </form>
  
  
  
   
		 </div>
         </div>
         </div>
         
         
         </div>



    
	@include('admin.footer')
  </body>
</html>
