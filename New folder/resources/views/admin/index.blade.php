<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   

     @include('admin.title')
    @include('admin.style')
    
    
    
    
  </head>

  <body>
    
    <!--Header-part-->
@include('admin.top')
<!--close-top-serch-->
<!--sidebar-menu-->
@include('admin.menu')
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="<?php echo $url;?>/admin"> <i class="icon-dashboard"></i>  My Dashboard </a> </li>
        <li class="bg_lg"> <a href="<?php echo $url;?>/admin/settings"> <i class="icon-key"></i> Settings</a> </li>
        <li class="bg_ly"> <a href="<?php echo $url;?>/admin/users"> <i class="icon-user"></i> Customers </a> </li>
        <li class="bg_lr"> <a href="<?php echo $url;?>/admin/vendors"> <i class="icon-user"></i> Vendors </a> </li>
        <li class="bg_lo"> <a href="<?php echo $url;?>/admin/category"> <i class="icon-th"></i> Category</a> </li>
        <li class="bg_lb"> <a href="<?php echo $url;?>/admin/product"> <i class="icon-shopping-cart"></i>Products</a> </li>
        <li class="bg_ls"> <a href="<?php echo $url;?>/admin/blog"> <i class="icon-edit"></i> Blog</a> </li>
        
        <li class="bg_ls"> <a href="<?php echo $url;?>/admin/pages"> <i class="icon-file"></i> Pages</a> </li>
        
        <li class="bg_lg"> <a href="<?php echo $url;?>/admin/slideshow"> <i class="icon-edit"></i> Slideshow</a> </li>
        <li class="bg_lr"> <a href="<?php echo $url;?>/admin/pending_withdraw"> <i class="icon-money"></i> Pending Withdraw </a> </li>
        <li class="bg_ly"> <a href="<?php echo $url;?>/admin/completed_withdraw"> <i class="icon-money"></i> Completed Withdraw </a> </li>
        <li class="bg_lo"> <a href="<?php echo $url;?>/admin/banners"> <i class="icon-edit"></i> Banners </a> </li>
      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
            
                          <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $total_customer;?></strong> <small>Total Customers</small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $total_vendor;?></strong> <small>Total Vendors</small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong><?php echo $total_product;?></strong> <small>Total Products</small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong><?php echo $total_orders;?></strong> <small>Total Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong><?php echo $pending_orders;?></strong> <small>Pending Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong><?php echo $completed_orders;?></strong> <small>Completed Orders</small></li>
                
                <li class="bg_lh"><i class="icon-money"></i> <strong><?php echo $pending_withdraw;?></strong> <small>Pending Withdraw </small></li>
                <li class="bg_lh"><i class="icon-money"></i> <strong><?php echo $completed_withdraw;?></strong> <small>Completed Withdraw</small></li>
              </ul>

              
            </div>
            
          </div>
        </div>
      </div>
    </div>

    
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->


@include('admin.footer')

<!--end-Footer-part-->

	
  </body>
</html>
