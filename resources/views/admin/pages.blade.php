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
    <h1>Pages</h1>
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


<form action="{{ route('admin.pages') }}" method="post">
                 
                 {{ csrf_field() }}
                 <div align="right">
                  <?php if(config('global.demosite')=="yes"){?>
					
				   <a href="#" class="btn btn-danger btndisable">Delete All</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
				   <input type="submit" value="Delete All" class="btn btn-danger" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
				  <?php } ?>
                  
				   <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Page</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add-page" class="btn btn-primary">Add Page</a>
				  <?php } ?>
                 </div>
<div class="widget-box">
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Pages</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                          <th>
          <input type="checkbox" id="selectAll" class="main"></th>
                        
                         <th>Sno</th>
						  
                          <th>Heading</th>
                          
                          <th>Action</th>
                          
                         </tr>
              </thead>
              <tbody>
             <?php 
					  $i=1;
					  foreach ($pages as $page) { ?>
                      
                      <tr class="gradeX">
                        <td><input type="checkbox" name="pageid[]" value="<?php echo $page->page_id;?>"/></td>
                        
						 <td><?php echo $i;?></td>
						
                          <td><?php echo substr($page->page_title,0,30);?></td>
                          
						  
						  <td>
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/edit-page/{{ $page->page_id }}" class="btn btn-success">Edit</a>
				  <?php } ?>
                  
                  <?php if($page->page_id!=4){?>
                  <?php if(config('global.demosite')=="yes"){?>
				   <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/pages/{{ $page->page_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						 
					 <?php } ?>
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
