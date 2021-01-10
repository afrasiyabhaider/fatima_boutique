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
    <h1>Blog</h1>
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


<form action="{{ route('admin.blog') }}" method="post">
                 
                 {{ csrf_field() }}
                 <div align="right">
                 <?php if(config('global.demosite')=="yes"){?>
					
				   <a href="#" class="btn btn-danger btndisable">Delete All</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
				   <input type="submit" value="Delete All" class="btn btn-danger" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
				  <?php } ?>
                  
                  
				  <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Post</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add-blog" class="btn btn-primary">Add Post</a>
				  <?php } ?>
                 </div>
<div class="widget-box">
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Blog</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                          <th>
          <input type="checkbox" id="selectAll" class="main"></th>
                        
                          <th>Sno</th>
						  <th>Title</th>
                         
                         <th>Comment</th>
                          <th>Media</th>
                          <th>Action</th>
                          
                </tr>
              </thead>
              <tbody>
             <?php 
					  $i=1;
					  foreach ($blog as $blogs) { 
					  
					  $post_comment = DB::table('post')
							 ->where('post_parent', '=', $blogs->post_id)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->count();
					   $active_comment = DB::table('post')
							 ->where('post_parent', '=', $blogs->post_id)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->count();		 
						$deactive_comment = DB::table('post')
							 ->where('post_parent', '=', $blogs->post_id)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '0')
							 ->count();	 
					  ?>
                      
                      
                      <tr class="gradeX">
                        
                        <td><input type="checkbox" name="postid[]" value="<?php echo $blogs->post_id;?>"/></td>
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $blogs->post_title;?></td>
                          
						  
                          
                          <td> <a href="<?php echo $url;?>/admin/comment/blog/comment/<?php echo $blogs->post_id;?>" style="color:#067DE3; text-decoration:underline;"><?php echo $post_comment;?> Comment</a> 
                          <br/>
                          <span style="color:#006600;"><?php echo $active_comment;?> Active</span> |  <span style="color:#FF0000;"><?php echo $deactive_comment;?> Deactive</span>
                          </td>
                          
                          <?php 
					  
						$path ='/local/images/media/'.$blogs->post_image;
						if($blogs->post_media_type=="image"){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="70"></td>
						 <?php } if($blogs->post_media_type=="mp3"){ ?>
						  <td><img src="<?php echo $url.'/local/images/mp3.png';?>" class="thumb" width="70"></td>
						 <?php } if($blogs->post_media_type=="video"){ ?>
						  <td><img src="<?php echo $url.'/local/images/video.png';?>" class="thumb" width="70"></td>
						 <?php  } ?>
                          
                          
						  
                          <td>
						   <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/edit-blog/{{ $blogs->post_id }}" class="btn btn-success">Edit</a>
						  <?php } ?>
				   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/blog/{{ $blogs->post_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
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
