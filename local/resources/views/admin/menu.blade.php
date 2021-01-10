<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");

/*$ncounts = DB::table('users')->get();
		foreach($ncounts as $well)
		{
			$we = $well->id;
			$ewe = $well->email;
			DB::update('update shop set user_id="'.$we.'" where seller_email = ?', [$ewe]);
		}*/
?>	


<div id="sidebar"><a href="<?php echo $url;?>/admin" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li><a href="<?php echo $url;?>/admin"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Settings</span> </a>
      <ul>
        
         <li><a href="<?php echo $url;?>/admin/settings">General Settings </a></li>
         <li><a href="<?php echo $url;?>/admin/payment-settings">Payment Settings </a></li>
         <li><a href="<?php echo $url;?>/admin/media-settings">Media Settings </a></li>
         <li><a href="<?php echo $url;?>/admin/permissions">Permissions </a></li>
         <li><a href="<?php echo $url;?>/admin/home-banners">Home Banners </a></li>
         <li><a href="<?php echo $url;?>/admin/home-box-content">Home Box Content </a></li>
      </ul>
    </li>
    
    
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Category</span> </a>
                   <ul>
                    <li><a href="<?php echo $url;?>/admin/category">Category </a></li>
                     <li><a href="<?php echo $url;?>/admin/subcategory">Sub Category </a></li>
                  </ul>
                </li>
    
    
    
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Product</span> </a>
                   <ul>
                    <li><a href="<?php echo $url;?>/admin/product">Product </a></li>
                     <li><a href="<?php echo $url;?>/admin/attribute_type">Attribute Type </a></li>
                     <li><a href="<?php echo $url;?>/admin/attribute_value">Attribute Value </a></li>
                     
                     <li><a href="<?php echo $url;?>/admin/orders">Order Details </a></li>
                     
                     <li><a href="<?php echo $url;?>/admin/rating"> Rating & Reviews </a></li>
                  </ul>
                </li>
    
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Withdraw</span> </a>
                   <ul>
                    <li><a href="<?php echo $url;?>/admin/pending_withdraw">Pending Withdraw </a></li>
                    <li><a href="<?php echo $url;?>/admin/completed_withdraw">Completed Withdraw </a></li>
                   </ul>
     </li>               
    
     <li><a href="<?php echo $url;?>/admin/users"><i class="icon icon-user"></i> <span>Customers</span> </a></li>
     
     <li><a href="<?php echo $url;?>/admin/vendors"><i class="icon icon-user"></i> <span>Vendors</span> </a></li>
     
    <?php /*?> <li><a href="<?php echo $url;?>/admin/membership"><i class="icon icon-user"></i> <span>Membership</span> </a></li><?php */?>
     
     <li><a href="<?php echo $url;?>/admin/blog"><i class="icon icon-comment"></i> <span> Blog </span> </a></li>
     
     
     
     <li><a href="<?php echo $url;?>/admin/pages"><i class="icon icon-file"></i>  <span> Pages </span> </a></li>
                  
        
                   
                   <li><a href="<?php echo $url;?>/admin/slideshow"><i class="icon icon-file"></i> Slideshow </a></li>
                   
                   <li><a href="<?php echo $url;?>/admin/banners"><i class="icon icon-file"></i> Banners </a></li>
                   
                   <?php /*?><li><a href="<?php echo $url;?>/admin/testimonials"><i class="icon icon-file"></i> Testimonials </a></li><?php */?>
                   
                  
				 
    
    <!--<li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
    <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>
    <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>
    <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>
    
    <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="index2.html">Dashboard2</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="chat.html">Chat option</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="error403.html">Error 403</a></li>
        <li><a href="error404.html">Error 404</a></li>
        <li><a href="error405.html">Error 405</a></li>
        <li><a href="error500.html">Error 500</a></li>
      </ul>
    </li>-->
    
    
  </ul>
</div>

