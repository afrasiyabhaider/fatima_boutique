<?php
/*
Theme Name: PayuKart
Theme URI: http://avigher.com
Author: Avigher Technologies
Author URI: http://avigher.com
Description: PayuKart
Version: 1.3
Text Domain: avigher
*/
?>
 <?php 
 use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();
 $url = URL::to("/"); 
 $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$color_setts = DB::table('color_settings')
		->where('id', '=', $setid)
		->get();
		
		
		$name = Route::currentRouteName();
 if($currentPaths=="/")
 {
	 $pagetitle="Home";
	 $activemenu = "/";
 }
 else 
 {
	 $pagetitle=$currentPaths;
	 $activemenu = $currentPaths;
 }
 
 


$ppid=1;
		$about_title = DB::table('pages')
		->where('page_id', '=', $ppid)
		->get();
$ppid_two=4;
		$contact_title = DB::table('pages')
		->where('page_id', '=', $ppid_two)
		->get();
$ppid_three=5;
		$donate_title = DB::table('pages')
		->where('page_id', '=', $ppid_three)
		->get();
$ppid_four=6;
		$support_title = DB::table('pages')
		->where('page_id', '=', $ppid_four)
		->get();
$ppid_five=7;
		$faq_title = DB::table('pages')
		->where('page_id', '=', $ppid_five)
		->get();	
		
$ppid_six=8;
		$terms_title = DB::table('pages')
		->where('page_id', '=', $ppid_six)
		->get();
$ppid_seven=9;
		$privacy_title = DB::table('pages')
		->where('page_id', '=', $ppid_seven)
		->get();

$author = DB::table('users')
		->where('id', '=', 1)
		->get();							
 ?>

 <title><?php echo $setts[0]->site_name;?> -  <?php if($activemenu == "/" or $activemenu == "index"){ echo "Home"; } else { echo ""; } if($activemenu == "shop" or $activemenu=="shop/{type}/{id}/{slug}") { echo "Shop"; } else { echo ""; } if($activemenu == "product/{prod_id}/{prod_slug}") { echo "Product"; } else { echo ""; }  if($activemenu == "page/{id}/{slug}") { echo "Page"; } else { echo ""; } if($activemenu == "cart") { echo "Cart"; } else { echo ""; } if($activemenu == "checkout") { echo "Checkout"; } else { echo ""; } if($activemenu == "vendors") { echo "Vendors"; } else { echo ""; }  if($activemenu == "profile/{user_id}/{user_slug}") { echo "Profile"; } else { echo ""; }    if($activemenu == "my-orders") { echo "My Orders"; } else { echo ""; }  if($activemenu == "view-orders/{ord_id}/{user_id}") { echo "My Orders"; } else { echo ""; }  if($activemenu == "my-shopping" or $activemenu=="view-shopping/{token}") { echo "My Shopping"; } else { echo ""; } if($activemenu == "attribute-type") { echo "My Attribute Type"; } else { echo ""; }if($activemenu == "add-attribute-type") { echo "Add Attribute Type"; } else { echo ""; }if($activemenu == "attribute-value") { echo "My Attribute Value"; } else { echo ""; }if($activemenu == "add-attribute-value") { echo "Add Attribute Value"; } else { echo ""; }if($activemenu == "my-balance") { echo "My Balance"; } else { echo ""; }if($activemenu == "my-wishlist") { echo "My Wishlist"; } else { echo ""; }  if($activemenu == "my-product") { echo "My Product"; } else { echo ""; } if($activemenu == "add-product") { echo "Add Product"; } else { echo ""; }if($activemenu == "blog" or $activemenu == "blog/{id}"){ echo "Blog"; } else { echo ""; }if($activemenu == "contact-us"){ echo $contact_title[0]->page_title; } else { echo ""; }if($activemenu == "dashboard"){ echo 'Dashboard'; } else { echo ""; }if($activemenu == "my-comments"){ echo 'My Comments'; } else { echo ""; }if($activemenu == "login"){ echo 'Login'; } else { echo ""; }if($activemenu == "register"){ echo 'Register'; } else { echo ""; }if($activemenu == "tag/{type}/{id}"){ echo 'Tags'; } else { echo ""; }if($activemenu == "404"){ echo '404 Page not found!'; } else { echo ""; }if($activemenu == "forgot-password"){ echo 'Forgot Password?'; } else { echo ""; }if($activemenu == "reset-password/{id}"){ echo 'Reset Password'; } else { echo ""; }if($activemenu == "thankyou/{id}"){ echo 'Thank You'; } else { echo ""; }?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content="<?php echo $setts[0]->site_desc;?>">
<meta name="author" content="<?php echo $author[0]->name;?>">
<meta name="keywords" content="<?php echo $setts[0]->site_keyword;?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if(!empty($setts[0]->site_favicon)){?>
	 <link rel="icon" type="image/x-icon" href="<?php echo $url.'/local/images/media/'.$setts[0]->site_favicon;?>" />
	 <?php } else { ?>
	 <link rel="icon" type="image/x-icon" href="<?php echo $url.'/local/images/noimage.jpg';?>" />
<?php } ?>
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/animate.min.css">
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/rateit.css">
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/font-awesome.css">



<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/popup_image/lumos.css">



<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8">
	</script>
    
    
    
    <?php /* menu */?>

<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/toggle_menu/menu.css">

<script type="text/javascript" src="<?php echo $url;?>/local/resources/views/theme/toggle_menu/menu.js"></script>


<?php /* menu */ ?>

<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/validationEngine.jquery.css" type="text/css"/>
<?php if($activemenu == "blog" or $activemenu == "blog/{id}" or $activemenu == "product/{prod_id}/{prod_slug}"){?>

<link rel="stylesheet" type="text/css" href="<?php echo $url;?>/local/resources/views/share/avigher.css">
 <script type="text/javascript" src="<?php echo $url;?>/local/resources/views/share/jquery.avigher.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($){

            

            $('#share1').sharegg();

            

            
        });
</script>

<?php } ?>
<script type="text/javascript">



 
$(document).ready(function () { 
 
 $('#prod_type').on('change', function() {
		
		if ( this.value == 'external')
      {
		  $("#price_container").show();
		  $("#zipformat").hide();
		  $("#notzipformat").show();
		  $("#notzipped").show();
		  
	  }
	  else if(this.value == 'physical')
      {
		  $("#price_container").hide();
		  $("#zipformat").hide();
		  $("#notzipformat").show();
		  $("#notzipped").show();
	  }
	  
	  else if(this.value == 'digital')
      {
		  $("#price_container").hide();
		  $("#zipformat").show();
		  $("#notzipped").hide();
		   $("#notzipformat").hide();
	  }
	  
	  else
	  {
	  $("#price_container").hide();
	  $("#zipformat").hide();
	  $("#notzipformat").show();
	  $("#notzipped").show();
	  }
		
	
	});
	
	
});	



function valueChanged()
{


    if($('.enable_ship').is(":checked"))   
        $(".ship_details").show();
    else
        $(".ship_details").hide();
}
	
</script>



<script>
	
	$(window).load(function() {
		
		$(".avigher_loader").fadeOut("slow");;
	});
</script>
	
<style type="text/css">


/* loader */


.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.avigher_loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(<?php echo $url;?>/local/images/media/<?php echo $setts[0]->site_loading_url;?>) center no-repeat #fff;
}


/* loader */

.notclick
{
pointer-events: none;
   cursor: default;
}

.disabletxt
{
color:red;
}


.m_nav_ham {
   
    background: <?php echo $setts[0]->site_button_color;?>;
    
}




.logo img
{
max-width:139px;
}


a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.theme_color
{
color: <?php echo $setts[0]->site_primary_color;?>;
}
.show-theme-options:hover,
.show-theme-options:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.btn-primary:hover,
.btn-black:hover,
.btn-primary:focus,
.btn-black:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.top-bar .cnt-account ul > li a:hover,
.top-bar .cnt-account ul > li a:focus {
  color: #fff;
}
.top-bar .cnt-block ul li a .caret {
  color: rgba(255,255,255,0.8);
}
.top-bar .cnt-block ul li .dropdown-menu li a:hover,
.top-bar .cnt-block ul li .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.main-header .top-search-holder .contact-row .icon {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .lnk-cart .items-cart-inner .total-price-basket .total-price {
  color: #fff;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .name a:hover,
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .action a:hover,
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .action a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-total .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a:hover,
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-1 .header-nav {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-home .header-style-1 .header-nav .navbar .navbar-nav > li.active {
  background: #085b9a;
  border-top-left-radius:3px;
  border-top-right-radius:3px;
}
.cnt-home .header-style-1 .header-nav .navbar .navbar-nav > li > a:hover,
.cnt-home .header-style-1 .header-nav .navbar .navbar-nav > li > a:focus {
  background: #fff;
  border-radius:3px 3px 0px 0px;
  color:#333
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar .navbar-nav > li.active,
.cnt-homepage .header-style-1.header-style-2 .header-nav .navbar .navbar-nav > li.active {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-home .header-style-1.header-style-3 .header-nav .navbar .navbar-nav > li.active {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-2 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:hover,
.header-style-2 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:focus {
  background: <?php echo $setts[0]->site_primary_color;?> !important;
}
.header-style-2 .header-nav .navbar-default .navbar-collapse .navbar-nav > li.open {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .side-menu nav .nav > li a:hover,
.sidebar .side-menu nav .nav > li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .side-menu nav .nav > li a:hover:after,
.sidebar .side-menu nav .nav > li a:focus:after {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.info-box .info-box-heading.green {
  color: #333;
}
.scroll-tabs .nav-tab-line li a:hover,
.scroll-tabs .nav-tab-line li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product .product-info .name a:hover,
.product .product-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product .product-info .product-price .price {
  color: #333;
}
.product .cart .action ul li.lnk a:hover,
.product .cart .action ul li.lnk a:focus {
  color: <?php echo $setts[0]->site_button_color;?> !important;
}
.product .cart .action ul li.add-cart-button .btn-primary:hover,
.product .cart .action ul li.add-cart-button .btn-primary:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.product .cart .action ul li.add-cart-button .btn-primary.icon:hover,
.product .cart .action ul li.add-cart-button .btn-primary.icon:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.tag.sale {
  background: #fdd922;
  color:#333
}
.copyright-bar .copyright a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-slider-container .blog-slider .blog-post-info .name a:hover,
.blog-slider-container .blog-slider .blog-post-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .links-social .social-icons a:hover,
.footer .links-social .social-icons a:focus,
.footer .links-social .social-icons a.active {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.latest-tweet .re-twitter .comment a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.latest-tweet .re-twitter .comment .icon .fa-stack-2x {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .contact-information .media .icon .fa-stack-2x {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .contact-information .media .media-body a:hover,
.footer .contact-information .media .media-body a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .footer-bottom .module-body ul li a:hover,
.footer .footer-bottom .module-body ul li a:focus {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.product-tag .item.active,
.product-tag .item:hover,
.product-tag .item:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.hot-deals .product-info .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.hot-deals .product-info .name a:hover,
.hot-deals .product-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.custom-carousel .owl-controls .owl-prev:hover,
.custom-carousel .owl-controls .owl-next:hover,
.custom-carousel .owl-controls .owl-prev:focus,
.custom-carousel .owl-controls .owl-next:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.yamm .dropdown-menu .title:hover,
.yamm .dropdown-menu .title:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.yamm .dropdown-menu li a:hover,
.yamm .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.breadcrumb ul li.active {
  color: <?php echo $setts[0]->site_secondary_color;?>;
}
.breadcrumb ul a:hover,
.breadcrumb ul a:focus {
  color: <?php echo $setts[0]->site_secondary_color;?>;
}
.filters-container .nav-tabs.nav-tab-box li.active a .icon {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .pagination-container ul li.active a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .pagination-container ul li.prev:hover,
.filters-container .pagination-container ul li.next:hover,
.filters-container .pagination-container ul li.prev:focus,
.filters-container .pagination-container ul li.next:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .pagination-container ul li a:hover,
.filters-container .pagination-container ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu li a:hover,
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:hover,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:focus,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:after {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-handle {
  border: 5px solid <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .list li a:hover,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .list li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .compare-report span {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination .owl-page.active span {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination .owl-page:hover span {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .gallery-holder .gallery-thumbs .owl-item .item:hover {
  border: 1px solid <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .rating-reviews .reviews .lnk:hover,
.single-product .product-info .rating-reviews .reviews .lnk:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .price-container .price-box .price,.ptsCell .price-box .price {
  color: #ff7878;
}
.single-product .product-info .quantity-container .cart-quantity .arrows .arrow:hover,
.single-product .product-info .quantity-container .cart-quantity .arrows .arrow:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .product-social-link .social-icons ul li a:hover,
.single-product .product-info .product-social-link .social-icons ul li a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:hover,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:hover:after,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:focus:after {
  border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li.active a {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li.active a:after {
  border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $setts[0]->site_primary_color;?>;
}
.cart .action .add-cart-button .btn.btn-primary.icon:hover,
.cart .action .add-cart-button .btn.btn-primary.icon:focus {
  background: <?php echo $setts[0]->site_button_color;?>;
  color:#000;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .date span {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .author span {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
#owl-main:hover .owl-prev:hover,
#owl-main:hover .owl-next:hover {
  background: <?php echo $setts[0]->site_primary_color;?>;
  color:#fff!important
}
#owl-main:hover .owl-prev:hover .icon,
#owl-main:hover .owl-next:hover .icon {
 color:#fff!important
}

#owl-main .owl-controls .owl-pagination .owl-page:active span,
#owl-main .owl-controls .owl-pagination .owl-page:hover span {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.cart .action ul .lnk .add-to-cart:hover,
.cart .action ul .lnk .add-to-cart:focus {
  color: #fff !important;
}
.cart .action .add-to-cart:hover,
.cart .action .add-to-cart:focus {
  color: <?php echo $setts[0]->site_primary_color;?> !important;
}
.homepage-container .product .tag.hot {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.homepage-container .product .product-info .name a:hover,
.homepage-container .product .product-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.homepage-container .btn-primary:hover,
.homepage-container .btn-primary:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
  border: 2px solid <?php echo $setts[0]->site_primary_color;?>;
}
.category-product .cart .action ul li .add-to-cart:hover,
.category-product .cart .action ul li .add-to-cart:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.furniture-container .product .btn-primary:hover,
.furniture-container .product .btn-primary:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:hover,
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li.open {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
#owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page.active span {
  background: <?php echo $setts[0]->site_primary_color;?> !important;
}
#owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page span:hover,
#owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page span:focus {
  background: <?php echo $setts[0]->site_primary_color;?> !important;
}
.cnt-homepage .sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-handle.max-slider-handle {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-post h1 a:hover,
.blog-page .blog-post h1 a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a:hover,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a:focus {
  color: <?php echo $setts[0]->site_secondary_color;?>;
}
.blog-page .blog-post .social-media a:hover,
.blog-page .blog-post .social-media a:focus {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .sidebar .sidebar-module-container .search-area .search-button:after {
  color: #333;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post h4 a:hover,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post h4 a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-post-author-details .author-social-network button .twitter-icon {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-review .review-action a,
.blog-page .blog-review .review-action a:hover,
.blog-page .blog-review .review-action a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a:hover,
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.checkout-box .checkout-steps .panel .panel-heading .unicase-checkout-title > a:not(.collapsed) span {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a:hover,
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.checkout-box .checkout-progress-sidebar .panel-body ul li a:hover,
.checkout-box .checkout-progress-sidebar .panel-body ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.contact-page .contact-info .contact-i {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info h4 a:hover,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info h4 a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info .cart-product-info span span {
  color: #84b943;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-edit a:hover,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-edit a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .cart-shopping-total table thead tr th .cart-grand-total {
  color: <?php echo $setts[0]->site_primary_color;?> !important;
}
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow:hover,
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.logo-color {
  fill: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:hover,
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-info-block .txt.txt-qty {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail {
  border-bottom: none;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li {
  margin-right: 10px;
  padding: 0;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:hover,
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
  border: 2px solid <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li.active a {
  background: <?php echo $setts[0]->site_primary_color;?>;
  border: 2px solid <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .dropdown-menu.open ul li a:hover,
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .dropdown-menu.open ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.mega-menu .dropdown-menu {
width:100%;
left:0px 
}

.navbar-nav>li>.dropdown-menu { box-shadow:0 4px 6px -1px rgba(0,0,0,0.4);}

.product-comparison .compare-table tr td .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .in-stock {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .my-wishlist-page .my-wishlist table tbody .product-name a:hover,
.body-content .my-wishlist-page .my-wishlist table tbody .product-name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .in-stock {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .x-page .x-text h1 {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .x-page .x-text a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sign-in-page .register-form .forgot-password,
.sign-in-page .register-form .forgot-password:hover,
.sign-in-page .register-form .forgot-password:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .my-wishlist-page .my-wishlist table tbody .price,.cart-product-quantity .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.terms-conditions-page .contact-form {
  color: <?php echo $setts[0]->site_primary_color;?>;
}


/* custom code */


.list-inline i
{
color:#CBE2F5;
}

.customheight li a
{
line-height:25px;
}


.review-icon span i
{
color:#FDD922;
display:inline-block;

}


.review-icon .yellow
{
color:#FDD922;
display:inline-block;

}

.review-icon i
{
font-size:17px;
color:#BEBEC0;
display:inline-block !important;
}




.product-image img {
    width: 100%;
    min-height: 200px;
    object-fit: cover;
    max-height: 200px;
}

.product_names .name
{
white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis;
}












/* main style */


@font-face {
  font-family: 'Montserrat';
  src: url('../fonts/Montserrat-Regular.eot?#iefix') format('embedded-opentype'),  url('../fonts/Montserrat-Regular.woff') format('woff'), url('../fonts/Montserrat-Regular.ttf')  format('truetype'), url('../fonts/Montserrat-Regular.svg#Montserrat-Regular') format('svg');
  font-weight: normal;
  font-style: normal;
}



@font-face {
  font-family: 'Open Sans';
  src: url('../fonts/OpenSans-Regular.eot?#iefix') format('embedded-opentype'),  url('../fonts/OpenSans-Regular.woff') format('woff'), url('../fonts/OpenSans-Regular.ttf')  format('truetype'), url('../fonts/OpenSans-Regular.svg#OpenSans-Regular') format('svg');
  font-weight: normal;
  font-style: normal;
}


.green-text {
  color: #abd07e !important;
}
.green-text:hover {
  background-color: #abd07e !important;
  color: #fff !important;
}
.blue-text {
  color: #3498db !important;
}
.blue-text:hover {
  background-color: #3498db !important;
  color: #fff !important;
}
.red-text {
  color: #ff6c6c !important;
}
.red-text:hover {
  background-color: #ff6c6c !important;
  color: #fff !important;
}
.orange-text {
  color: #f39c12 !important;
}
.orange-text:hover {
  background-color: #f39c12 !important;
  color: #fff !important;
}
.dark-green-text {
  color: <?php echo $setts[0]->site_primary_color;?> !important;
}
.dark-green-text:hover {
  background-color: <?php echo $setts[0]->site_primary_color;?> !important;
  color: #fff !important;
}
.inline {
  display: inline-block;
  vertical-align: top;
}
ul {
  list-style: none;
}
a {
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
}
body {
  font-size: 13px;
  color: #333;
  overflow-x: hidden;
  margin: 0;
  padding: 0;
  font-family: 'Open Sans', sans-serif;
  background-color: #ffffff;
}

.cnt-home {background-color: #F1F3F6;}

ul {
  margin: 0;
  padding: 0;
}
a {
  outline: none!important;
}
a:hover,
a:active,
a:focus {
  text-decoration: none;
}
img[src="theme/images/blank.gif"] {
  background: url("../images/ajax.gif") no-repeat scroll center center #ffffff;
}

.btn-upper {
  text-transform: uppercase;
}
.m-t-20 {
  margin-top: 20px;
}
.m-t-15 {
  margin-top: 15px;
}
.m-t-10 {
  margin-top: 10px;
}

/*===================================================================================*/
/*  Buttons
/*===================================================================================*/

.btn-uppercase {
  text-transform: uppercase;
}
.btn-default {
  background: #cbc9c9;
  color: #fff;
  font-weight: 700;
  /*line-height:30px;*/
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -ms-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
}
.btn-primary {
  -webkit-transition: all linear 0.2s;
  -moz-transition: all linear 0.2s;
  -ms-transition: all linear 0.2s;
  -o-transition: all linear 0.2s;
  transition: all linear 0.2s;
  background: <?php echo $setts[0]->site_primary_color;?>;
  color: #fff;
  border: none;
  font-size: 13px;
  line-height: 22px;
  border-radius:0;
  padding: 6px 14px;
  font-family: 'Montserrat', sans-serif;
  border-radius:2px

}
.btn-black {
  -webkit-transition: all linear 0.2s;
  -moz-transition: all linear 0.2s;
  -ms-transition: all linear 0.2s;
  -o-transition: all linear 0.2s;
  transition: all linear 0.2s;
  background: #3a3a3a;
  color: #fff;
  border: none;
  font-size: 15px;
  line-height: 30px;
  font-weight: 500;
  padding: 3px 22px;
}
.btn-primary:hover,
.btn-black:hover,
.btn-black:focus,
.btn-primary:focus {
  color: #fff;
}


/*===================================================================================*/
/*  Layout
/*===================================================================================*/
.center-block {
  float: none;
}
.inner {
  padding-top: 120px;
  padding-bottom: 120px;
}
.inner-md {
  padding-top: 100px;
  padding-bottom: 100px;
}
.inner-sm {
  padding-top: 80px;
  padding-bottom: 80px;
}
.inner-xs {
  padding-top: 40px;
  padding-bottom: 40px;
}
.inner-vs {
  padding-top: 30px;
  padding-bottom: 30px;
}
.inner-top {
  padding-top: 120px;
}
.inner-top-md {
  padding-top: 100px;
}
.inner-top-sm {
  padding-top: 80px;
}
.inner-top-xs {
  padding-top: 40px;
}
.inner-top-vs {
  padding-top: 30px;
}
.inner-bottom {
  padding-bottom: 120px;
}
.inner-bottom-md {
  padding-bottom: 100px;
}
.inner-bottom-sm {
  padding-bottom: 80px;
}
.inner-bottom-xs {
  padding-bottom: 40px;
}
.inner-bottom-vs {
  padding-bottom: 60px;
}
.inner-left {
  padding-left: 75px;
}
.inner-left-md {
  padding-left: 60px;
}
.inner-left-sm {
  padding-left: 45px;
}
.inner-left-xs {
  padding-left: 30px;
}
.inner-right {
  padding-right: 75px;
}
.inner-right-md {
  padding-right: 60px;
}
.inner-right-sm {
  padding-right: 45px;
}
.inner-right-xs {
  padding-right: 30px;
}
.inner-right-vs {
  padding-right: 10px;
}
.outer {
  margin-top: 120px;
  margin-bottom: 120px;
}
.outer-md {
  margin-top: 100px;
  margin-bottom: 100px;
}
.outer-sm {
  margin-top: 80px;
  margin-bottom: 80px;
}
.outer-xs {
  margin-top: 40px;
  margin-bottom: 40px;
}
.outer-top {
  margin-top: 120px;
}
.outer-top-md {
  margin-top: 100px;
}
.outer-top-sm {
  margin-top: 80px;
}
.outer-top-xs {
  margin-top: 0px;
}

.outer-top-ss {
  margin-top: 20px;
}

.outer-top-n {
  margin-top: 0px!important;
}

.outer-top-vs {
  margin-top: 30px;
}
.outer-top-small {
  margin-top: 50px;
}
.outer-bottom {
  margin-bottom: 120px;
}
.outer-bottom-md {
  margin-bottom: 100px;
}
.outer-bottom-sm {
  margin-bottom: 80px;
}
.outer-bottom-vs {
  margin-bottom: 60px;
}
.outer-bottom-xs {
  margin-bottom: 30px;
}
.outer-bottom-small {
  margin-bottom: 30px;
}
.outer-top-bd {
  margin-top: 50px;
}
.inner-bottom-30 {
  padding-bottom: 30px;
}
.inner-bottom-20 {
  padding-bottom: 20px;
}





@media (max-width: 767px) {











#ptsBlock_535808 .ptsCol {
            width: 100%;
      }


  .inner {
    padding-top: 80px;
    padding-bottom: 80px;
  }
  .inner-md {
    padding-top: 65px;
    padding-bottom: 65px;
  }
  .inner-sm {
    padding-top: 50px;
    padding-bottom: 50px;
  }
  .inner-xs {
    padding-top: 40px;
    padding-bottom: 40px;
  }
  .inner-top {
    padding-top: 80px;
  }
  .inner-top-md {
    padding-top: 65px;
  }
  .inner-top-sm {
    padding-top: 50px;
  }
  .inner-top-xs {
    padding-top: 40px;
  }
  .inner-bottom {
    padding-bottom: 80px;
  }
  .inner-bottom-md {
    padding-bottom: 65px;
  }
  .inner-bottom-sm {
    padding-bottom: 50px;
  }
  .inner-bottom-xs {
    padding-bottom: 40px;
  }
}
.section-title {
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
  border-bottom: 1px solid #e3e3e3;
  padding-bottom: 10px;
  text-transform: uppercase;
  font-weight:bold;
  margin-top:0px;
}

.featured-product .section-title {
    margin-bottom: 20px;
    margin-top: 5px;
    font-size: 16px;
    font-family: 'Open Sans', sans-serif;
    text-transform: uppercase;
    font-weight: bold;
	border-bottom: 1px solid #e3e3e3;
    padding-bottom: 10px;
    padding: 18px 20px;
}

.best-deal {
	background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);

}

.best-deal .section-title {
    margin-bottom: 0px;
    margin-top: 5px;
    font-size: 16px;
    font-family: 'Open Sans', sans-serif;
    text-transform: uppercase;
    font-weight: bold;
	border-bottom: 1px solid #e3e3e3;
    padding-bottom: 10px;
    padding: 18px 20px;
}

.best-deal .best-seller {padding:21px; padding-top:0px;}
.best-deal .best-seller .col2 {padding-left:0px}

.home-owl-carousel .owl-controls,
.blog-slider .owl-controls,
.brand-slider .owl-controls {
  margin-top: 0px;
}
/*carousel control button*/
.sidebar-widget .custom-carousel .owl-controls {right:0px}

.custom-carousel .owl-controls {
  position: absolute;
  right: 20px;
  top: -32px;
  width: 100%;
  display: block;
}
.custom-carousel .owl-controls .owl-prev {
  position: absolute;
  width: 20px;
  height: 20px;
  top: -25px;
  right: 27px;
  -webkit-transition: all linear 0.2s;
  -moz-transition: all linear 0.2s;
  -ms-transition: all linear 0.2s;
  -o-transition: all linear 0.2s;
  transition: all linear 0.2s;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.custom-carousel .owl-controls .owl-prev:before {
  color: #fff;
  content: "\f104";
  font-family: fontawesome;
  font-size: 13px;
  left: 7px;
  position: absolute;
  top: 2px;
}
.custom-carousel .owl-controls .owl-next {
  position: absolute;
  width: 20px;
  height: 20px;
  top: -25px;
  right: 0px;
  -webkit-transition: all linear 0.2s;
  -moz-transition: all linear 0.2s;
  -ms-transition: all linear 0.2s;
  -o-transition: all linear 0.2s;
  transition: all linear 0.2s;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.custom-carousel .owl-controls .owl-next:before {
  content: "\f105";
  font-family: fontawesome;
  color: #fff;
  font-size: 13px;
  left: 7px;
  position: absolute;
  top: 2px;
}
.logo-slider .owl-controls .owl-prev,
.logo-slider .owl-controls .owl-next {
  top: -57px;
  display:none
}
.featured-product {
  margin-bottom:30px;
      background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
	
}

.featured-product .cart-btn {display:none}

.featured-product .products {
    margin-left: 0px;
    margin-right: 18px;
    padding-bottom: 15px;
}

.featured-product .home-owl-carousel {padding-left: 20px;}

.new-arriavls{
  margin-bottom: 19px;
      background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
	
}

.new-arriavls .products {
    margin-left: 0px;
    margin-right: 18px;
    padding-bottom: 15px;
}

.new-arriavls .home-owl-carousel {padding-left: 20px;}

.new-arriavls .section-title {
    margin-bottom: 0px;
    margin-top: 5px;
    font-size: 16px;
    font-family: 'Open Sans', sans-serif;
    text-transform: uppercase;
    font-weight: bold;
    border-bottom: 1px solid #e3e3e3;
    padding-bottom: 10px;
    padding: 18px 20px;
}

.new-arriavls .cart-btn {display:none}

.latest-blog {
	margin-bottom: 30px;
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
	
}

.latest-blog .btn-primary {margin:3px}

.latest-blog .section-title {
    margin-bottom: 20px;
    margin-top: 5px;
    font-size: 16px;
    font-family: 'Open Sans', sans-serif;
    text-transform: uppercase;
    font-weight: bold;
    border-bottom: 1px solid #e3e3e3;
    padding-bottom: 10px;
    padding: 18px 20px;
}

.latest-blog .blog-slider {padding-left: 20px; padding-bottom:25px;}
.latest-blog .blog-post {margin-right:25px}
.latest-blog .blog-post img {width:100%}

.logo-slider-inner {
  margin-top: 10px;
  margin-bottom: 20px;
}
.special-product .product:first-child {
  margin-bottom: 20px;
}

.special-product .product .image img {width:100%}
.special-product .product .col {padding-right:0px}
.special-product .product .btn-primary {background:none; padding:0px; color:<?php echo $setts[0]->site_secondary_color;?>; text-decoration:underline; margin-top:5px;}

.special-product .product:last-child {
  margin-top: 20px;
}
.best-product .product:first-child {
  margin-bottom: 20px;
}
#owl-main .owl-controls .owl-buttons .icon {
  position: relative;
  top: 8px;
  color: #fff !important;
}
.config-options ul > li > a {
  display: block;
}
.read-more-bottom {
  margin-bottom: 10px;
}
.unicase-form-control {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  border-color: #eee;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  height: auto;
  padding: 10px 12px;
}
.unicase-form-control:focus {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-color: #d8d8d8;
}
.animate-dropdown .open > .dropdown-menu,
.animate-dropdown .open > .dropdown-menu > .dropdown-submenu > .dropdown-menu {
  animation-name: slidenavAnimation;
  animation-duration: 200ms;
  animation-iteration-count: 1;
  animation-timing-function: ease-out;
  animation-fill-mode: forwards;
  -webkit-animation-name: slidenavAnimation;
  -webkit-animation-duration: 200ms;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-name: slidenavAnimation;
  -moz-animation-duration: 200ms;
  -moz-animation-iteration-count: 1;
  -moz-animation-timing-function: ease-out;
  -moz-animation-fill-mode: forwards;
}
@keyframes slidenavAnimation {
  from {
    margin-top: -30px;
    opacity: 0;
  }
  to {
    margin-top: 0;
    opacity: 1;
  }
}
@-webkit-keyframes slidenavAnimation {
  from {
    margin-top: -30px;
    opacity: 0;
  }
  to {
    margin-top: 0;
    opacity: 1;
  }
}
.seller-product .products {
  margin-bottom: 35px;
}

.product-slider .products {margin-left:0px; margin-right:18px; padding-bottom:15px}
.product-slider .products .cart-btn {display:none}
.category-product .products .cart-btn {display: none;}

.seller-product .products .product .product-info .name {
  font-size: 18px;
  margin-top: 5px !important;
}
a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.show-theme-options:hover,
.show-theme-options:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.btn-primary:hover,
.btn-black:hover,
.btn-primary:focus,
.btn-black:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.top-bar .cnt-account ul > li a:hover,
.top-bar .cnt-account ul > li a:focus {
  color: #fff;
}
.top-bar .cnt-block ul li a .caret {
  color: #CED1D4;
}
.top-bar .cnt-block ul li .dropdown-menu li a:hover,
.top-bar .cnt-block ul li .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.main-header .top-search-holder .contact-row .icon {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .lnk-cart .items-cart-inner .total-price-basket .total-price {
  color: #fff;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .name a:hover,
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .action a:hover,
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .action a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-total .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a:hover,
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-1 .header-nav {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-home .header-style-1 .header-nav .navbar .navbar-nav > li.active {
  background: <?php echo $setts[0]->site_button_color;?>;
}
.cnt-home .header-style-1 .header-nav .navbar .navbar-nav > li > a:hover,
.cnt-home .header-style-1 .header-nav .navbar .navbar-nav > li > a:focus {
  background: <?php echo $setts[0]->site_button_color;?>;
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar .navbar-nav > li.active,
.cnt-homepage .header-style-1.header-style-2 .header-nav .navbar .navbar-nav > li.active {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-home .header-style-1.header-style-3 .header-nav .navbar .navbar-nav > li.active {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-2 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:hover,
.header-style-2 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:focus {
  background: <?php echo $setts[0]->site_primary_color;?> !important;
}
.header-style-2 .header-nav .navbar-default .navbar-collapse .navbar-nav > li.open {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .side-menu nav .nav > li a:hover,
.sidebar .side-menu nav .nav > li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .side-menu nav .nav > li a:hover:after,
.sidebar .side-menu nav .nav > li a:focus:after {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.info-box .info-box-heading.green {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.scroll-tabs .nav-tab-line li a:hover,
.scroll-tabs .nav-tab-line li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product .product-info .name a:hover,
.product .product-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product .product-info .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product .cart .action ul li.lnk a:hover,
.product .cart .action ul li.lnk a:focus {
  color: <?php echo $setts[0]->site_button_color;?> !important;
}
.product .cart .action ul li.add-cart-button .btn-primary:hover,
.product .cart .action ul li.add-cart-button .btn-primary:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.product .cart .action ul li.add-cart-button .btn-primary.icon:hover,
.product .cart .action ul li.add-cart-button .btn-primary.icon:focus {
  background: <?php echo $setts[0]->site_button_color;?>;
}
.tag.sale {
  background: #abd07e;
}
.copyright-bar .copyright a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-slider-container .blog-slider .blog-post-info .name a:hover,
.blog-slider-container .blog-slider .blog-post-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .links-social .social-icons a:hover,
.footer .links-social .social-icons a:focus,
.footer .links-social .social-icons a.active {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.latest-tweet .re-twitter .comment a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.latest-tweet .re-twitter .comment .icon .fa-stack-2x {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .contact-information .media .icon .fa-stack-2x {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .contact-information .media .media-body a:hover,
.footer .contact-information .media .media-body a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.footer .footer-bottom .module-body ul li a:hover,
.footer .footer-bottom .module-body ul li a:focus {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.product-tag .item.active,
.product-tag .item:hover,
.product-tag .item:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}

.hot-deals {margin-top:30px}

.hot-deals .product-info .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.hot-deals .product-info .name a:hover,
.hot-deals .product-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.custom-carousel .owl-controls .owl-prev:hover,
.custom-carousel .owl-controls .owl-next:hover,
.custom-carousel .owl-controls .owl-prev:focus,
.custom-carousel .owl-controls .owl-next:focus {
  background: <?php echo $setts[0]->site_button_color;?>;
}
.yamm .dropdown-menu .title:hover,
.yamm .dropdown-menu .title:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.yamm .dropdown-menu li a:hover,
.yamm .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.breadcrumb ul li.active {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.breadcrumb ul a:hover,
.breadcrumb ul a:focus {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.filters-container .nav-tabs.nav-tab-box li.active a .icon {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .pagination-container ul li.active a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .pagination-container ul li.prev:hover,
.filters-container .pagination-container ul li.next:hover,
.filters-container .pagination-container ul li.prev:focus,
.filters-container .pagination-container ul li.next:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .pagination-container ul li a:hover,
.filters-container .pagination-container ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu li a:hover,
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:hover,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:focus,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:after {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-handle {
  border: 5px solid <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .list li a:hover,
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .list li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .compare-report span {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination .owl-page.active span {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination .owl-page:hover span {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .gallery-holder .gallery-thumbs .owl-item .item:hover {
  border: 1px solid <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .rating-reviews .reviews .lnk:hover,
.single-product .product-info .rating-reviews .reviews .lnk:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .price-container .price-box .price,.ptsCell .price-box .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .quantity-container .cart-quantity .arrows .arrow:hover,
.single-product .product-info .quantity-container .cart-quantity .arrows .arrow:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-info .product-social-link .social-icons ul li a:hover,
.single-product .product-info .product-social-link .social-icons ul li a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:hover,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:hover:after,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li a:focus:after {
  border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li.active a {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li.active a:after {
  border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $setts[0]->site_primary_color;?>;
}
.cart .action .add-cart-button .btn.btn-primary.icon:hover,
.cart .action .add-cart-button .btn.btn-primary.icon:focus {
  background: <?php echo $setts[0]->site_button_color;?>;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .date span {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .author span {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
#owl-main:hover .owl-prev:hover,
#owl-main:hover .owl-next:hover {
  background: <?php echo $setts[0]->site_button_color;?>;
}
#owl-main .owl-controls .owl-pagination .owl-page:active span,
#owl-main .owl-controls .owl-pagination .owl-page:hover span {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.cart .action ul .lnk .add-to-cart:hover,
.cart .action ul .lnk .add-to-cart:focus {
  color: <?php echo $setts[0]->site_primary_color;?> !important;
}
.cart .action .add-to-cart:hover,
.cart .action .add-to-cart:focus {
  color: <?php echo $setts[0]->site_primary_color;?> !important;
}
.homepage-container .product .tag.hot {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.homepage-container .product .product-info .name a:hover,
.homepage-container .product .product-info .name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.homepage-container .btn-primary:hover,
.homepage-container .btn-primary:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
  border: 2px solid <?php echo $setts[0]->site_primary_color;?>;
}

.category-list {    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;}
.category-product .cart .action ul li .add-to-cart:hover,
.category-product .cart .action ul li .add-to-cart:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.furniture-container .product .btn-primary:hover,
.furniture-container .product .btn-primary:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:hover,
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li.open {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
#owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page.active span {
  background: <?php echo $setts[0]->site_primary_color;?> !important;
}
#owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page span:hover,
#owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page span:focus {
  background: <?php echo $setts[0]->site_primary_color;?> !important;
}
.cnt-homepage .sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-handle.max-slider-handle {
  background: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-post h1 a:hover,
.blog-page .blog-post h1 a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a:hover,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a:focus {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.blog-page .blog-post .social-media a:hover,
.blog-page .blog-post .social-media a:focus {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .sidebar .sidebar-module-container .search-area .search-button:after {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post h4 a:hover,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post h4 a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-post-author-details .author-social-network button .twitter-icon {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-review .review-action a,
.blog-page .blog-review .review-action a:hover,
.blog-page .blog-review .review-action a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a:hover,
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.checkout-box .checkout-steps .panel .panel-heading .unicase-checkout-title > a:not(.collapsed) span {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a:hover,
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.checkout-box .checkout-progress-sidebar .panel-body ul li a:hover,
.checkout-box .checkout-progress-sidebar .panel-body ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.contact-page .contact-info .contact-i {
  background-color: <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info h4 a:hover,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info h4 a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info .cart-product-info span span {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-edit a:hover,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-edit a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .cart-shopping-total table thead tr th .cart-grand-total {
  color: <?php echo $setts[0]->site_button_color;?>;
}
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow:hover,
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.logo-color {
  fill: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:hover,
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-info-block .txt.txt-qty {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail {
  border-bottom: none;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li {
  margin-right: 10px;
  padding: 0;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:hover,
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:focus {
  background: <?php echo $setts[0]->site_primary_color;?>;
  border: 2px solid <?php echo $setts[0]->site_primary_color;?>;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li.active a {
  background: <?php echo $setts[0]->site_primary_color;?>;
  border: 2px solid <?php echo $setts[0]->site_primary_color;?>;
}
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .dropdown-menu.open ul li a:hover,
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .dropdown-menu.open ul li a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.yamm .dropdown-menu {
  border-top-color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .in-stock {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .my-wishlist-page .my-wishlist table tbody .product-name a:hover,
.body-content .my-wishlist-page .my-wishlist table tbody .product-name a:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .product-price .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.product-comparison .compare-table tr td .in-stock {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .x-page .x-text h1 {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .x-page .x-text a {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.sign-in-page .register-form .forgot-password,
.sign-in-page .register-form .forgot-password:hover,
.sign-in-page .register-form .forgot-password:focus {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.body-content .my-wishlist-page .my-wishlist table tbody .price {
  color: <?php echo $setts[0]->site_primary_color;?>;
}
.terms-conditions-page .contact-form {
  color: <?php echo $setts[0]->site_primary_color;?>;
}

.top-bar {
  padding:0px;
  font-size: 12px;
}
.top-bar .cnt-account {
  float: right;
  padding: 6px 0px;
}
.top-bar .cnt-account ul {
  margin: 0px;
}
.top-bar .cnt-account ul > li {
  display: inline-block;
  line-height: 12px;
  padding:3px 12px 3px 7px;
  border-right: 1px solid hsla(0,0%,100%,.2);

}
.top-bar .cnt-account ul > li:last-child {
	border:none;
	/*padding-right:0px*/

}
.top-bar .cnt-account ul > li a {
  color:rgba(255,255,255,0.8);
  padding: 0px;
  font-weight: 400;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
}
.top-bar .cnt-account ul > li a .icon {
  display: block;
  float: left;
  padding-right: 6px;
  font-size: 11px;
}
.top-bar .cnt-account ul > li a:hover,
.top-bar .cnt-account ul > li a:focus {
  text-decoration: none;
}
.top-bar .cnt-block {
  float: right;
}
.top-bar .cnt-block .list-inline {
  margin: 0px;
}
.top-bar .cnt-block .list-inline > li {
  display: inline-block;
  margin-right:10px;
  padding:0px;
}
.top-bar .cnt-block .list-inline > li > a {
  padding: 7px 0px;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  color: #888;
  display: inline-block;
}
.top-bar .cnt-block .list-inline > li > a .value {
  color: rgba(255,255,255,0.8);
  margin: 2px 4px 2px 7px;
}
.top-bar .cnt-block .list-inline > li > a:hover,
.top-bar .cnt-block .list-inline > li > a:focus {
  text-decoration: none;
  color: #888888;
}
.top-bar .cnt-block .list-inline > li .dropdown-menu {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid #e1e1e1;
  top: 125%;
  left: 5px;
  z-index:999999 !important;
}

.top-bar .dropdown-menu>li>a {
	padding:3px 10px;
	font-size:13px
}

.top-bar .cnt-block .list-inline > li .dropdown-menu li a:hover,
.top-bar .cnt-block .list-inline > li .dropdown-menu li a:focus {
  background: rgba(0, 0, 0, 0);
}


/*===================================================================================*/
/* Header
/*===================================================================================*/
header{background:<?php echo $setts[0]->site_primary_color;?>}

.main-header {
  padding:5px 0px 12px 0px;
}
.main-header .logo-holder {
  margin-top: 10px;
}
.main-header .top-search-holder .contact-row {
  line-height: 20px;
  color: #9b9b9b;
}
.main-header .top-search-holder .contact-row .phone {
  margin: 0 23px 0 0;
  border-right: 1px solid #E2E2E2;
  padding-right: 35px;
}
.main-header .top-search-holder .contact-row .icon {
  font-size: 18px;
  line-height: 23px;
  margin: 0 8px 0 0;
  vertical-align: middle;
}
.main-header .top-search-holder .search-area {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  margin: 8px 0 0;
  background:#fff;
  border-radius:2px;
}
.main-header .top-search-holder .search-area .search-field {
  border: medium none;
  -webkit-border-radius: 5px 0 0 5px;
  -moz-border-radius: 5px 0 0 5px;
  border-radius: 5px 0 0 5px;
  padding: 13px;
  width: 67%;
}
.main-header .top-search-holder .search-area .categories-filter {
  border-right: 1px solid #E0E0E0;
  text-transform: capitalize;
  display: inline-block;
  line-height: 44px;
  background: #f6f6f6;
  border-radius:3px 0px 0px 3px;
  
}

.categories-filter select
{
border:none;
background:#F6F6F6;
max-width:130px;

}


input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}

.main-header .top-search-holder .search-area .categories-filter a {
  padding: 0 10px;
  color: #666;
  font-size: 13px;
}
.main-header .top-search-holder .search-area .categories-filter a .caret {
  margin-left: 15px;
  color: #a0a0a0;
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid #e1e1e1;
  padding: 12px 17px;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li {
  margin-bottom: 10px;
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a {
  padding: 0px;
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a:hover,
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li a:focus {
  background: rgba(0, 0, 0, 0);
}
.main-header .top-search-holder .search-area .categories-filter .dropdown-menu li.menu-header {
  font-family: 'Open Sans', sans-serif;
  line-height: 30px;
}
.main-header .top-search-holder .search-area .search-button {
  border-radius: 0px 3px 3px 0px;
  display: inline-block;
  float: right;
  margin: 0px;
  padding: 12px 19px 12px;
  text-align: center;
    background-color: #fdd922;
    border: 1px solid #e0bc27;
}
.main-header .top-search-holder .search-area .search-button:after {
  color: #333;
  content: "\f002";
  font-family: fontawesome;
  font-size: 16px;
  line-height: 9px;
  vertical-align: middle;
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar-default {
  background: #404040;
}
.top-cart-row {
  padding-top:8px;
  padding-left:0px
}
.top-cart-row .dropdown-cart {
  float: right;
}

.top-cart-row .dropdown-cart img {width:100%}

.top-cart-row .dropdown-cart .lnk-cart {
  padding: 0px;
      
    border: 1px solid #4F5965;
  border-radius: 3px;
  display: inline-block;
  color: #fff;
}
.top-cart-row .dropdown-cart .lnk-cart .items-cart-inner {
  position: relative;
}
.top-cart-row .dropdown-cart .lnk-cart .items-cart-inner .total-price-basket {
    padding: 12px 12px 13px 15px;
    font-family: 'Open Sans', sans-serif;
    text-transform: uppercase;
    float: left;
    letter-spacing: 0.5px;
}
.top-cart-row .dropdown-cart .lnk-cart .items-cart-inner .basket {
  float: left;
  padding: 12px;
  /*border-right: 1px solid rgba(255,255,255,0.2);*/
  padding: 12px 18px 13px 12px;
}
.top-cart-row .dropdown-cart .lnk-cart .items-cart-inner .basket-item-count {
  -webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  border-radius: 100px;
    height: 18px;
    position: absolute;
    left: 34px;
    top: 13px;
    width: 18px;
    background: #fdd922;
    color: <?php echo $setts[0]->site_primary_color;?>;
    font-size: 11px;
    text-align: center;
    line-height: 19px;;
}
.top-cart-row .dropdown-cart .dropdown-menu {
  border: 1px solid #e1e1e1;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  float: right;
  left: auto;
  min-width: 0;
  padding: 24px 22px;
  right: 0;
  width: 350px;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .name {
  font-size: 13px;
  font-family: 'Open Sans', sans-serif;
  margin-top: 0px;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .name a {
  color: #666666;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .price {
  font-weight: 700;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .action {
  padding: 0;
  position: relative;
  font-size: 15px;
  right: 8px;
  top: 8px;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-item.product-summary .action a {
  color: #898989;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-total .text {
  font-size: 13px;
  font-family: 'Open Sans', sans-serif;
  color: #666666;
  margin-right: 10px;
}
.top-cart-row .dropdown-cart .dropdown-menu .cart-total .price {
  font-weight: 700;
}
.header-style-1 .header-nav .navbar-default {
  border: medium none;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  background: rgba(0, 0, 0, 0);
  margin: 0;
  min-height:auto;
}
.header-style-1 .header-nav .navbar-default .navbar-collapse {
  padding: 0;
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li.active > a {
  color: #fff; 
}

.navbar-nav {float:none}

.special-menu {float:right}
.special-menu a {color:<?php echo $setts[0]->site_button_color;?> !important; border:none!important; padding-right:0px!important} 
.special-menu a:hover{ background:none!important; color:#fff!important}

.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  color: #FFFFFF;
  font-family: 'Open Sans', sans-serif;
  font-size: 13px;
  line-height: 20px;
  padding: 11px 15px;
  text-transform:capitalize;
  -webkit-transitio: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  font-weight:normal;
  letter-spacing:0.5px;
  
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label {
  position: absolute;
  text-transform: uppercase;
  top: -10px;
  display: inline;
  padding: 1px 7px;
  color: #fff;
  font-size: 9px;
  font-family: 'Open Sans', sans-serif;
  right: 23px;
  line-height: normal;
  letter-spacing:1px;
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label:after {
  border-width: 6px 7px 0 6px;
  right: 18px;
  top: 90%;
  border-style: solid;
  content: "";
  display: block;
  height: 0;
  position: absolute;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transitio: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  width: 0;
  z-index: 100;
  
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label:before {
  right: 18px;
  top: 90%;
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label.new-menu {
  background: #f1c40f;
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label.new-menu:after {
  border-color: #f1c40f rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label.new-menu:before {
  border-color: #f1c40f rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label.hot-menu {
  background: #ff7878;
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label.hot-menu:after {
  border-color: #ff7878 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li .menu-label.hot-menu:before {
  border-color: #ff7878 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.header-style-2 {
  /*margin-bottom:10px;*/
}
.header-style-2 .header-nav {
  background: rgba(0, 0, 0, 0) !important;
}
.header-style-2 .header-nav .navbar-default .nav-bg-class {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  margin: 0;
}
.header-style-2 .header-nav .navbar-default .nav-bg-class .navbar-collapse .navbar-nav > li > a {
  color: #555;
}
.header-style-2 .header-nav .navbar-default .nav-bg-class .navbar-collapse .navbar-nav > li > a:hover,

.header-style-2 .header-nav .navbar-default .nav-bg-class .navbar-collapse .navbar-nav > li > a:focus {
  color: #fff;
}
.header-style-2 .header-nav .navbar-default .nav-bg-class .navbar-collapse .navbar-nav > li.open > a {
  color: #fff;
}
.header-style-3 .header-nav {
  background: #202020 !important;
  border: medium none;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  margin: 0;
}
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a {
  color: #fff;
}
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:hover,
.header-style-3 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a:focus {
  color: #fff;
}
.header-style-3 .header-nav .yamm .dropdown-menu {
  top: 62px;
}
.yamm .nav,
.yamm .collapse,
.yamm .dropup,
.yamm .dropdown {
  position: static;
}
.yamm .dropdown-menu {
  left:auto;
  top: 100% ;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  border:none;
  padding:0px
}

.yamm .dropdown-menu .custom-banner a {padding:0px}
.yamm .dropdown-menu .banner-image { margin-bottom:-20px}

.navbar-nav .open a{
    float: none;
	background:#fff!important;
	color:#888!important;
	border-radius:3px 3px 0px 0px;
}

.yamm .dropdown-menu .yamm-content {
  padding: 20px 20px;

}

.yamm .dropdown-menu .yamm-content .col-menu {min-width:150px}

.yamm .dropdown-menu .yamm-content .links li a {
  padding: 4px 0px;
  font-family: 'Open Sans', sans-serif;
    letter-spacing: 0.2px;
	font-size:13px;
	color:#565656;
	
}


.yamm .dropdown-menu h2 {
  font-size: 14px;
  color: #555;
  font-family: 'Open Sans', sans-serif;
  margin-top: 0px;
  font-weight:bold
}
.yamm .dropdown-menu li {
  line-height:normal;
  padding: 0px 0px;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}
.yamm .dropdown-menu li a {
  color: #3D3D3D;
  line-height: normal;
  text-transform: none ;
  display: block;
  padding: 8px 16px;
}
.yamm .dropdown-menu li a:hover,
.yamm .dropdown-menu li a:focus {
  background: rgba(0, 0, 0, 0);
  margin-left: 0px;
}
.yamm .dropdown-menu .text {
  font-size: 13px;
  line-height: 20px;
  position: relative;
  bottom: 0px;
  top: 73px;
}
.yamm .dropdown.yamm-fw .dropdown-menu {
  left: 0;
  right: 0;
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar .navbar-nav > li.active > a,
.cnt-homepage .header-style-1.header-style-2 .header-nav .navbar .navbar-nav > li.active > a {
  color: #fff;
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar-default {
  background: #404040;
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar-default .nav-bg-class {
  border: none;
}
.cnt-home .header-style-1.header-style-2 .header-nav .navbar-default .nav-bg-class .navbar-collapse .navbar-nav > li > a {
  color: #fff;
}
.cnt-homepage .header-style-2 .header-nav .navbar-default {
  background: #fff;
}
.cnt-homepage .header-style-2 .header-nav .navbar-default .nav-bg-class {
  -moz-box-shadow: 0 0 0 3px #F6F6F6 inset;
  -webkit-box-shadow: 0 0 0 3px #F6F6F6 inset;
  box-shadow: 0 0 0 3px #F6F6F6 inset;
}
.header-nav .navbar-default .dropdown .dropdown-menu.pages .links > li {
  border-bottom: 1px solid #E0E0E0;
  padding: 5px 0;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}
.header-nav .navbar-default .dropdown .dropdown-menu.pages .links > li:last-child {
  border-bottom: none;
}
.header-nav .navbar-default .dropdown .dropdown-menu.pages .links > li > a {
  line-height: 26px;
  padding: 0px;
}
.header-nav .navbar-default .dropdown .dropdown-menu.pages .links > li > a:hover,
.header-nav .navbar-default .dropdown .dropdown-menu.pages .links > li > a:focus {
  margin-left: 0px;
}


/*===================================================================================*/
/*  Side menu
/*===================================================================================*/

.sidebar .side-menu {
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
}

.sidebar .custom-carousel .owl-controls .owl-prev  {top: -20px;}
.sidebar .custom-carousel .owl-controls .owl-next  {top: -20px;}

.sidebar .side-menu .head {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  color: #333;
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
  padding: 12px 17px;
  text-transform: uppercase;
  background-color: #fdd922;
    border: 1px solid #e9c532;
	font-weight:700;
	letter-spacing: 0.5px;
	border-bottom:1px #f1ce3c solid
}
.sidebar .side-menu .head .icon {
  margin-right: 5px;
}
.sidebar .side-menu nav .nav > li {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
   -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  position: relative;
  width: 100%;
  border-bottom: 1px solid #eaeaea;

}

.sidebar .side-menu nav .nav > li:last-child {border-bottom:none}

.sidebar .side-menu nav .nav > li > a {
  padding: 13px 15px;
  color: #666666;
  font-family: 'Open Sans', sans-serif;
  letter-spacing:0.2px
}
.sidebar .side-menu nav .nav > li > a:after {
  color: #bababa;
  content: "\f105";
  float: right;
  font-size: 12px;
  height: 20px;
  line-height: 18px;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  width: 10px;
  font-family: FontAwesome;
}
.sidebar .side-menu nav .nav > li > a .icon {
  font-size: 16px;
  margin-right: 12px;
}
.sidebar .side-menu nav .nav > li > a:hover,
.sidebar .side-menu nav .nav > li > a:focus {
  background: #fff;

}
.sidebar .side-menu nav .nav > li > a:hover .icon,
.sidebar .side-menu nav .nav > li > a:focus .icon {
  color: #666666;
}
.sidebar .side-menu nav .nav > li > .mega-menu {
  padding: 3px 0;
  top: 0 !important;
  left: 100%;
  margin: 0;
  min-width: 330%;
  /*338%;*/
  position: absolute;
  top: 0px;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  overflow:hidden
}
.sidebar .side-menu nav .nav > li > .mega-menu .yamm-content {
  padding: 10px 20px;
}
.sidebar .side-menu nav .nav > li > .mega-menu .yamm-content ul > li {

  padding:3px 0;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}
.sidebar .side-menu nav .nav > li > .mega-menu .yamm-content ul > li:last-child {
  border-bottom: none;
}
.sidebar .side-menu nav .nav > li > .mega-menu .yamm-content ul > li > a {
  line-height: 26px;
  padding: 0px;
  font-size:13px;
  font-family: 'Open Sans', sans-serif;
}
.sidebar .side-menu nav .nav > li > .mega-menu .yamm-content .dropdown-banner-holder {
  position: absolute;
  right: -16px;
  top: -8px;
}
.sidebar .side-menu2 nav .nav li a {
  padding: 14.3px 15px;
}
.sidebar .sidebar-module-container .sidebar-widget .widget-header {
  padding: 10px 0px 5px 0px;
}
.sidebar .sidebar-module-container .sidebar-widget .widget-header .widget-title {
  font-size: 13px;
  font-family: 'Open Sans', sans-serif;
  margin: 0px;
  font-weight:bold
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle {
  clear: both;
  display: block;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 13px;
  line-height: 28px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle:after {
  content:"\f068";
  float: right;
  font-family: fontawesome;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle.collapsed {
  color: #666666;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-heading .accordion-toggle.collapsed:after {
  color: #636363;
  content: "\f067";
  font-family: fontawesome;
  font-weight:normal
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-body .accordion-inner {
  margin: 0px 0 20px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-body .accordion-inner ul {
  padding-left: 15px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-body .accordion-inner ul li {
  line-height: 27px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-body .accordion-inner ul li a {
  color: #666666;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-body .accordion-inner ul li a:before {
  content: "\f105";
  font-family: fontawesome;
  font-size: 14px;
  line-height: 15px;
  margin: 0 5px 0 0;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .accordion .accordion-group .accordion-body .accordion-inner ul li a:hover:before {
  margin: 0 8px 0 0;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder {
  padding: 0 0 20px;
  position: relative;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider {
  display: inline-block;
  position: relative;
  vertical-align: middle;
  margin-top:0px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider.slider-horizontal {
  height: 20px;
  width: 100% !important;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track {
  background-color: #f1f1f1;
  background-repeat: repeat-x;
  cursor: pointer;
  position: absolute;
  width: 94% !important;
  height: 6px;
  left: 0;
  margin-top: -5px;
  top: 50%;
  width: 100%;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-selection {
  bottom: 0;
  height: 100%;
  top: 0;
  background-repeat: repeat-x;
  box-sizing: border-box;
  position: absolute;
  background: #c3c3c3;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-handle {
  background-color: #FFFFFF;
  background-repeat: repeat-x;
  -webkit-border-radius: 400px;
  -moz-border-radius: 400px;
  border-radius: 400px;
  height: 20px;
  margin-left: -3px !important;
  opacity: 1;
  position: absolute;
  top: -3px;
  width: 20px;
  margin-top: -5px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .tooltip {
  margin-top: -36px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .min-max {
  font-size: 15px;
  font-weight: 700;
  color: #fe5252;
  margin-top: 15px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .list li {
  clear: both;
  display: block;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 13px;
  font-weight: normal;
  line-height: 28px;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .list li a {
  color: #666666;
  display: block;
}
.sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .compare-report {
  margin-top: 20px;
  margin-bottom: 30px;
}
.sidebar .sidebar-widget .advertisement .item {
  background-position: center 55%;
  background-size: cover;
  padding-bottom:60px

}
.sidebar .sidebar-widget .advertisement .item .caption {
  color: #636363;
  left: 12%;
  letter-spacing: -3px;
  position: absolute;
  top: 11%;
  z-index: 100;
  display: table-cell;
}
.sidebar .sidebar-widget .advertisement .item .caption .big-text {
  font-size: 60px;
  line-height: 125px;
  text-transform: uppercase;
  font-family: 'Open Sans', sans-serif;
  color: #fff;
  text-shadow: 1px 1px 3px #cfcfcf;
}
.sidebar .sidebar-widget .advertisement .item .caption .big-text .big {
  font-size: 120px;
  color: #ff7878;
  display: block;
  text-shadow: 1px 1px 3px #cfcfcf;
}
.sidebar .sidebar-widget .advertisement .item .caption .excerpt {
  font-size: 24px;
  letter-spacing: -1px;
  text-transform: uppercase;
  color: #e6e6e6;
  text-shadow: 1px 1px 3px #cfcfcf;
}
.sidebar .sidebar-widget .advertisement .owl-controls {
  bottom: 10px;
  position: absolute;
  text-align: center;
  top: auto;
  width: 100%;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination {
  display: inline-block;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination .owl-page {
  display: inline-block;
}
.sidebar .sidebar-widget .advertisement .owl-controls .owl-pagination .owl-page span {
  display: block;
  width: 10px;
  height: 10px;
  background: #ddd;
  border: none;
  border-radius: 2px;
  margin: 0 2px;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
}

.sidebar-widget { background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
	padding:20px;}

.related-product .tag {
  font-size: 15px;
  font-weight: 700;
  height: 50px;
  line-height: 45px;
  left: 15px;
  text-align: center;
  top: 3.5%;
  width: 50px;
  position: absolute;
}

/*===================================================================================*/
/*  Slider
/*===================================================================================*/
#owl-main {
  text-align: center;
  cursor: default;
  height: 300px;
}
#owl-main .owl-controls {
  display: inline-block;
  position: relative;
  margin-top: 40px;
}
/*.panel-group .panel .owl-controls {
  margin-top: 25px;
}
.panel-group.blank .panel .owl-controls {
  margin-top: 40px;
}*/
#owl-main .owl-pagination {
  position: relative;
  line-height: 30px;
}
#owl-main .owl-buttons {
  display: block;
}
#owl-main .owl-prev,
#owl-main .owl-next {
  display: inline-block;
  position: absolute;
  top: 0;
  bottom: 0;
  width: 30px;
  height: 50px;
  font-size: 21px;
  background-color: <?php echo $setts[0]->site_secondary_color;?>;
  border: none;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: auto;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
  opacity: 1;
  color:#FFFFFF !important;
}
#owl-main .owl-prev {
  left: 20px;
  
  
  /* -35px;*/
}
#owl-main .owl-next {
  right: 20px;
  
}




#owl-main:hover .owl-prev {
  left: 20px;
  opacity: 1;
}
#owl-main:hover .owl-next {
  right: 20px;
  opacity: 1;
}
#owl-main:hover .owl-prev:hover,
#owl-main:hover .owl-next:hover {
  opacity: 1;
}
#owl-main .owl-outer-nav:after {
  content: "";
  position: absolute;
  top: 0;
  left: -15%;
  width: 130%;
  height: 100%;
  z-index: 0;
}
#owl-main .owl-outer-nav .owl-wrapper-outer,
#owl-main .owl-outer-nav .owl-pagination,
#owl-main .owl-outer-nav .owl-prev,
#owl-main .owl-outer-nav .owl-next {
  z-index: 1;
}
#owl-main .owl-outer-nav .owl-controls {
  position: static;
}
#owl-main .owl-outer-nav .owl-prev {
  left: -65px;
}
#owl-main .owl-outer-nav .owl-next {
  right: -65px;
}
#owl-main .owl-outer-nav:hover .owl-prev {
  left: -80px;
}
#owl-main .owl-outer-nav:hover .owl-next {
  right: -80px;
}
#owl-main .owl-ui-md .owl-pagination {
  line-height: 45px;
}
#owl-main .owl-ui-md .owl-prev,
#owl-main .owl-ui-md .owl-next {
  width: 45px;
  height: 45px;
  font-size: 45px;
}
#owl-main .owl-ui-md .owl-prev {
  left: -55px;
}
#owl-main .owl-ui-md .owl-next {
  right: -55px;
}
#owl-main .owl-ui-md:hover .owl-prev {
  left: -60px;
}
#owl-main .owl-ui-md:hover .owl-next {
  right: -60px;
}
#owl-main .owl-outer-nav.owl-ui-md:after {
  left: -18%;
  width: 136%;
}
#owl-main .owl-outer-nav.owl-ui-md .owl-prev {
  left: -85px;
}
#owl-main .owl-outer-nav.owl-ui-md .owl-next {
  right: -85px;
}
#owl-main .owl-outer-nav.owl-ui-md:hover .owl-prev {
  left: -100px;
}
#owl-main .owl-outer-nav.owl-ui-md:hover .owl-next {
  right: -100px;
}
#owl-main .owl-ui-lg .owl-pagination {
  line-height: 60px;
}
#owl-main .owl-ui-lg .owl-prev,
#owl-main .owl-ui-lg .owl-next {
  width: 60px;
  height: 60px;
  font-size: 42px;
}
#owl-main .owl-ui-lg .owl-prev {
  left: -75px;
}
#owl-main .owl-ui-lg .owl-next {
  right: -75px;
}
#owl-main .owl-ui-lg:hover .owl-prev {
  left: -80px;
}
#owl-main .owl-ui-lg:hover .owl-next {
  right: -80px;
}
#owl-main .owl-outer-nav.owl-ui-lg:after {
  left: -22%;
  width: 144%;
}
#owl-main .owl-outer-nav.owl-ui-lg .owl-prev {
  left: -105px;
}
.owl-outer-nav.owl-ui-lg .owl-next {
  right: -105px;
}
#owl-main .owl-outer-nav.owl-ui-lg:hover .owl-prev {
  left: -120px;
}
#owl-main .owl-outer-nav.owl-ui-lg:hover .owl-next {
  right: -120px;
}
#owl-main .owl-inner-nav .owl-controls {
  position: static;
}
#owl-main .owl-inner-nav .owl-prev {
  left: 45px;
}
#owl-main .owl-inner-nav .owl-next {
  right: 45px;
}
#owl-main .owl-inner-nav:hover .owl-prev {
  left: 30px;
}
#owl-main .owl-inner-nav:hover .owl-next {
  right: 30px;
}
#owl-main .owl-outer-nav .owl-prev,
#owl-main .owl-outer-nav .owl-next,
#owl-main .owl-inner-nav .owl-prev,
#owl-main .owl-inner-nav .owl-next {
  bottom: 70px;
}
#owl-main .owl-outer-nav.owl-ui-md .owl-prev,
#owl-main .owl-outer-nav.owl-ui-md .owl-next,
#owl-main .owl-inner-nav.owl-ui-md .owl-prev,
#owl-main .owl-inner-nav.owl-ui-md .owl-next {
  bottom: 85px;
}
#owl-main .owl-outer-nav.owl-ui-lg .owl-prev,
#owl-main .owl-outer-nav.owl-ui-lg .owl-next,
#owl-main .owl-inner-nav.owl-ui-lg .owl-prev,
#owl-main .owl-inner-nav.owl-ui-lg .owl-next {
  bottom: 100px;
}
#owl-main .owl-inner-pagination .owl-pagination,
#owl-main .owl-inner-pagination .owl-prev,
#owl-main .owl-inner-pagination .owl-next {
  margin-top: -40px;
  top: -60px;
}
#owl-main .owl-inner-pagination.owl-ui-md .owl-pagination,
#owl-main .owl-inner-pagination.owl-ui-md .owl-prev,
#owl-main .owl-inner-pagination.owl-ui-md .owl-next {
  margin-top: -50px;
  top: -65px;
}
#owl-main .owl-inner-pagination.owl-ui-lg .owl-pagination,
#owl-main .owl-inner-pagination.owl-ui-lg .owl-prev,
#owl-main .owl-inner-pagination.owl-ui-lg .owl-next {
  margin-top: -60px;
  top: -75px;
}
#owl-main .owl-inner-pagination.owl-outer-nav .owl-prev,
#owl-main .owl-inner-pagination.owl-outer-nav .owl-next,
#owl-main .owl-inner-pagination.owl-inner-nav .owl-prev,
#owl-main .owl-inner-pagination.owl-inner-nav .owl-next {
  margin: auto;
  top: 0;
  bottom: 43px;
}
#owl-main .owl-inner-pagination .owl-pagination {
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
  opacity: 0;
}
#owl-main .owl-inner-pagination:hover .owl-pagination {
  opacity: 1;
}
#owl-main .owl-inner-pagination.owl-inner-nav .owl-pagination,
.owl-inner-pagination.owl-outer-nav .owl-pagination {
  top: -45px;
}
.owl-inner-pagination.owl-inner-nav.owl-ui-md .owl-pagination,
.owl-inner-pagination.owl-outer-nav.owl-ui-md .owl-pagination {
  top: -50px;
}
.owl-inner-pagination.owl-inner-nav.owl-ui-lg .owl-pagination,
.owl-inner-pagination.owl-outer-nav.owl-ui-lg .owl-pagination {
  top: -60px;
}
.owl-inner-pagination.owl-inner-nav:hover .owl-pagination,
.owl-inner-pagination.owl-outer-nav:hover .owl-pagination {
  top: -60px;
}
.owl-inner-pagination.owl-inner-nav.owl-ui-md:hover .owl-pagination,
.owl-inner-pagination.owl-outer-nav.owl-ui-md:hover .owl-pagination {
  top: -65px;
}
.owl-inner-pagination.owl-inner-nav.owl-ui-lg:hover .owl-pagination,
.owl-inner-pagination.owl-outer-nav.owl-ui-lg:hover .owl-pagination {
  top: -75px;
}
#owl-main.height-md .item {
  height: 457px;
}
#owl-main.height-lg .item {
  height: 675px;
}
#owl-main .container {
  display: table;
  height: inherit;
}
#owl-main .caption {
  display: table-cell;
}
#owl-main .caption.vertical-center {
  vertical-align: middle;
  padding-bottom: 3vh;
}
#owl-main .caption.vertical-top {
  vertical-align: top;
  padding-top: 8vh;
}
#owl-main .caption.vertical-bottom {
  vertical-align: bottom;
  padding-bottom: 14vh;
}
#owl-main .caption.text-center {
  padding-left: 10%;
  padding-right: 10%;
}
#owl-main .caption.text-left {
  padding-right: 20%;
}
#owl-main .caption.text-right {
  padding-left: 20%;
}
#owl-main .owl-controls {
  display: block;
  position: static;
  margin-top: -47px;
 
}
#owl-main .owl-pagination {
  background: #FFF;
  line-height: inherit;
  position: relative;
  bottom: -40px;
  padding: 10px;
  display: inline-block;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: auto;
  opacity: 0;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
}
#owl-main:hover .owl-pagination {
  bottom: -15px;
  opacity: 1;
   display:none
}
#owl-main .owl-prev,
#owl-main .owl-next {
  bottom: 0;
}
#owl-main .owl-controls .owl-page {
  display: inline-block;
}
#owl-main .owl-pagination .owl-page span {
  display: block;
  width: 15px;
  height: 15px;
  background: #d3d3d3;
  border: none;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  margin: 0 5px;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
}
#owl-main .owl-item-gap .item {
  margin: 0 15px;
}
#owl-main .owl-item-gap-sm .item {
  margin: 0 10px;
}
#owl-main .owl-item.loading {
  min-height: inherit;
  background: none;
}
#owl-main .item {
  background-color: #FFFFFF;
  background-position: center 55%;
  background-size: cover;
  height:300px;
}
#owl-main .item .caption {
  color: #636363;
  left: 200px;
  position: absolute;
  top: 24%;
  z-index: 100;
  padding-right: 8%;
}
#owl-main .item .caption .slider-header {
 font-family: 'Montserrat', sans-serif;
 font-size:14px;
 font-weight:bold;
 text-transform:uppercase	
}

#owl-main .item .caption .big-text {
  font-size: 42px;
  line-height: 50px;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  padding: 0px 25px;
  background: #bbbbbb;
  color: #fff;
  font-weight:700;
  letter-spacing:-1px
}
#owl-main .item .caption .big-text .highlight {
  color: #f1c40f;
}
#owl-main .item .caption .excerpt,
#owl-main .item .caption .small {
  font-size: 20px;
  /*line-height: 50px;*/
  margin-top: 10px;
  font-family: 'Open Sans', sans-serif;
  font-weight: 500;
  padding-left: 23px;
  background: rgba(0, 0, 0, 0);
  color: #fff;
}
#owl-main .item .caption .excerpt span,
#owl-main .item .caption .small span {
  background: none repeat scroll 0 0 #bbbbbb;
  -moz-box-shadow: -1.4em 0 0 #bbbbbb, 1.4em 0 0 #bbbbbb;
  -webkit-box-shadow: -1.4em 0 0 #bbbbbb, 1.4em 0 0 #bbbbbb;
  box-shadow: -1.4em 0 0 #bbbbbb, 1.4em 0 0 #bbbbbb;
  line-height: 336%;
  padding: 5px 0;
  display: inline;
}
#owl-main .item .caption .button-holder {
  margin: 20px 0 0;
}
#owl-main .item .caption.bg-color {
  padding-right: 3%;
}
#owl-main .item .caption.bg-color .big-text {
  background: rgba(0, 0, 0, 0);
  padding: 0px;
  color: #000;
}
#owl-main .item .caption.bg-color .excerpt,
#owl-main .item .caption.bg-color .small {
  background: rgba(0, 0, 0, 0);
  padding: 0px;
  color: #000;
  margin-top: 0px;
}
#owl-main .item .caption.bg-color .excerpt span,
#owl-main .item .caption.bg-color .small span {
  background: rgba(0, 0, 0, 0);
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  display: block;
  line-height: 24px;
}
#owl-main .full-width-slider {
  margin-bottom: 30px;
}
#owl-main .full-width-slider .item {
  background-color: #FFFFFF;
  background-position: center 55%;
  background-size: cover;
  height: 449px;
}
#owl-main .full-width-slider .item .caption {
  position: absolute;
  top: 11%;
  z-index: 100;
}
#owl-main .full-width-slider .item .caption .big-text {
  font-size: 119px;
  line-height: 80px;
  font-family: 'PacificoRegular';
  color: #fff;
  background: rgba(0, 0, 0, 0);
  padding: 0px;
  text-transform: none;
}
#owl-main .full-width-slider .item .caption .excerpt {
  font-size: 60px;
  line-height: 80px;
  margin-top: 15px;
  font-family: 'LatoBold';
  text-transform: uppercase;
  color: #fff;
  background: rgba(0, 0, 0, 0);
  padding: 0px;
}
#owl-main .full-width-slider .item .caption .button-holder {
  margin: 31px 0 0;
}
.cnt-homepage .homepage-slider2 {
  height: 449px;
}
.cnt-homepage .homepage-slider2 #owl-main .item .caption {
  top: 24%;
  padding-right: 10%;
  right: 0px;
  left: 0px;
}
.cnt-homepage .homepage-slider2 #owl-main .owl-controls {
  margin-top: -89px;
  text-align: center !important;
}
.cnt-homepage .breadcrumb ul {
  text-align: left;
}
.cnt-homepage .cart .action .left {
  margin-left: 10px;
  padding: 2px 10px;
}
.cnt-homepage .sidebar .sidebar-module-container .sidebar-widget .sidebar-widget-body .price-range-holder .slider .slider-track .slider-handle {
  height: 15px;
  width: 15px;
  top: 0px;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  border: 2px solid #e4e4e4;
}
.homepage-slider3 {
  height: 368px;
}
.homepage-slider3 #owl-main .item {
  height: 368px;
}
.homepage-slider3 #owl-main .item .caption {
  padding-left: 10%;
  padding-right: 44%;
}
.homepage-slider3 #owl-main .item .caption .small {
  font-size: 15px;
  line-height: 50px;
  text-transform: uppercase;
  font-family: 'Open Sans', sans-serif;
  text-shadow: 2px 2px #c3c3c3;
  color: #fff ;
  padding-left: 0px;
}
.homepage-slider3 #owl-main .item .caption .big-text {
  font-size: 45px;
  line-height: 50px;
  text-transform: uppercase;
  font-family: 'Open Sans', sans-serif;
  text-shadow: 2px 2px #c3c3c3;
  color: #000;
}
.homepage-slider3 #owl-main .item .caption .excerpt {
  font-size: 13px;
  line-height: 20px;
  color: #fff;
  text-transform: none;
}
.homepage-slider3 #owl-main .owl-controls {
  margin-top: -79px;
}
.home-page-slider4 {
  position: relative;
}
.home-page-slider4 .customNavigation {
  position: absolute;
  top: 50%;
  width: 100%;
  margin-top: -15px;
}
.home-page-slider4 .customNavigation .controls {
  position: relative;
}
.home-page-slider4 .owl-controls {
  bottom: 20px;
  position: absolute;
  text-align: center;
  top: auto;
  width: 100%;
}
.home-page-slider4 .owl-controls .owl-buttons {
  display: none !important;
}
.home-page-slider4 .owl-controls .owl-pagination .owl-page {
  display: inline-block;
}
.home-page-slider4 .owl-controls .owl-pagination .owl-page span {
  background: none repeat scroll 0 0 #e6e6e6;
  border: medium none;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  display: block;
  height: 12px;
  margin: 0 5px;
  -webkit-transition: all 200ms ease-out 0s;
  -moz-transition: all 200ms ease-out 0s;
  -o-transition: all 200ms ease-out 0s;
  transition: all 200ms ease-out 0s;
  width: 12px;
  -moz-box-shadow: 1px 3px rgba(0, 0, 0, 0.1) inset;
  -webkit-box-shadow: 1px 3px rgba(0, 0, 0, 0.1) inset;
  box-shadow: 1px 3px rgba(0, 0, 0, 0.1) inset;
}
.home-page-slider4 .owl-prev,
.home-page-slider4 .owl-next {
  position: absolute;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
  opacity: 0;
}
.home-page-slider4 .owl-prev {
  left: 20px;
}
.home-page-slider4 .owl-next {
  right: 20px;
}
.home-page-slider4:hover .owl-prev {
  left: 0px;
  opacity: 1;
}
.home-page-slider4:hover .owl-next {
  right: 0px;
  opacity: 1;
}
.home-page-slider4:hover .owl-prev:hover,
.home-page-slider4:hover .owl-next:hover {
  opacity: 1;
}
.home-page-slider4 #owl-main .owl-pagination {
  background: rgba(0, 0, 0, 0);
  -webkit-border-radius: 3px;
  -moz-border-radiu: 3px;
  border-radius: 3px;
  display: inline-block;
  line-height: inherit;
  margin: auto;
  opacity: 1;
  padding: 10px;
  position: relative;
  -webkit-transition: all 200ms ease-out 0s;
  -moz-transition: all 200ms ease-out 0s;
  -o-transition: all 200ms ease-out 0s;
  transition: all 200ms ease-out 0s;
  bottom: none;
  bottom: 0px;
}
.cnt-homepage .homepage-container .btn-primary {
  padding: 2px 17px;
  -webkit-border-radius: 0px;
  -moz-border-radiu: 0px;
  border-radius: 0px;
}
.cnt-homepage .homepage-container #owl-main .owl-prev,
.cnt-homepage .homep2474
age-container #owl-main .owl-next {
  top: 25%;
}

.info-boxes-inner {
  background-color: #fff;
  box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
  
}
  

.info-boxes {


}
.info-boxes .info-box {
  padding:24px 25px;
  text-align:left;
}
.info-boxes .info-box .icon {
  font-size: 35px;
}
.info-boxes .info-box .info-box-heading {
  font-size: 14px;
  line-height:21px;
  text-transform: uppercase;
  font-family:'Montserrat', sans-serif;
  margin-top: 0px;
  font-weight:bold;
  margin-bottom:0px;
  letter-spacing:1px
}
.info-boxes .info-box .info-box-heading.orange {
  color: #ffb847;
}
.info-boxes .info-box .info-box-heading.red {
  color: #ff7878;
}
.info-boxes .info-box .text {
  color:#333;
  font-weight: normal;
  font-size: 13px;
  margin: 0px;
  letter-spacing:0.5px;
  font-family:'Open Sans', sans-serif
  
}

/*===================================================================================*/
/*  Home Tabs
/*===================================================================================*/

.scroll-tabs {
  margin-bottom: 30px;
  background-color: #fff;
  border-radius: 2px;
   box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);
	    border-top: 1px solid #e0e0e0;
  
}
.scroll-tabs .more-info-tab {
  border-bottom: 1px solid #e3e3e3;
  padding-bottom: 10px;
  padding: 15px 20px;
  margin-bottom:20px;
}
.scroll-tabs .more-info-tab .new-product-title {
  margin-bottom: 0px;
  margin-top: 5px;
  font-size:16px;
  font-family: 'Open Sans', sans-serif;
  text-transform: uppercase;
  font-weight:bold
}
.scroll-tabs .nav-tab-line {
  border-bottom: none;
  margin-top: 4px;
  margin-right: 55px;
}
.scroll-tabs .nav-tab-line li.active a {
  border: none;
}
.scroll-tabs .nav-tab-line li a {
   font-weight: 500;
  color: #666666;
  font-size: 13px;
  border: medium none;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  padding: 0 10px !important;
  position: relative;
  font-family:'Open Sans', sans-serif
}
.scroll-tabs .nav-tab-line li a:hover,
.scroll-tabs .nav-tab-line li a:focus {
  background: rgba(0, 0, 0, 0);
}

.tab-content {padding-left:0px}

.product {
  position: relative;
}
.product .product-image img {width:100%}

.product .product-image .tag {
  position: absolute;
}
.product .product-info .name {
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
}
.product .product-info .name a {
  color: #555;
}
.product .product-info .star-rating .color {
  color: #ffb400;
}
.product .product-info .product-price .price {
  font-weight: 700;
  font-size: 14px;
  line-height: 30px;
  margin-right: 8px;
}
.product .product-info .product-price .price-before-discount {
  text-decoration: line-through;
  color: #d3d3d3;
  font-weight: 400;
  line-height: 30px;
  font-size: 14px;
}
.product .cart {
  margin-top: 5px;
  opacity: 0;
  -webkit-transition: all 0.5s linear 0s;
  -moz-transition: all 0.5s linear 0s;
  -o-transition: all 0.5s linear 0s;
  transition: all 0.5s linear 0s;
  width: 100%;
  z-index: 666;
  left: 50%;
  position:absolute;
   top:0;
    margin-left:-55px
 
}
.product .cart .action ul li {
  float: left;
}
.product .cart .action ul li.add-cart-button .btn.btn-primary.icon {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  background: <?php echo $setts[0]->site_button_color;?> ;
}
.product .cart .action ul li.lnk {
  margin: 10px 0px;
      background: <?php echo $setts[0]->site_primary_color;?>;
    margin: 0px;
    padding: 8px 2px;
	border-left:1px solid hsla(0,0%,100%,.2);
	border-radius:0px 3px 3px 0px
}
.product .cart .action ul li.lnk a {
  padding: 0 10px;
  color: #fff;
  padding: 8px 10px;
}
.product .cart .action ul li.lnk.wishlist {
	background:<?php echo $setts[0]->site_primary_color;?>;
	margin:0px;
	border-radius:0px
	

}
.tag {
  font-size: 10px;
  font-weight: 700;
  line-height: 40px;
  width: 40px;
  height: 40px;
  text-transform: uppercase;
  top: 2.5%;
  z-index: 100;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  color: #fff;
  right: 10px;
  /*11px;*/
  text-align: center;
}
.tag span {
  position: relative;
  z-index: 100;
}
.tag.new {
  background: #46aad7;
}
.tag.hot {
  background: #ff7878;
}
.product:hover .cart {
  opacity: 1;
  top:45%
}
.best-seller .product .product-info .name,
.special-offer .product .product-info .name {
  margin-top: 4px;
}
.cart {
  margin-top: 5px;
  opacity: 1;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  width: 100%;
  z-index: 666;
  left: 0px;
 
 
}
.cart .action {
  float: left;
}
.cart .action .add-cart-button .btn.btn-primary.icon {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  background: #fdd922 ;
  color:#333
}


.cart .action.lnk {
  margin: 10px 0px;
}
.cart .action.lnk a {
  padding: 0 10px;
  color: #dadada;
}
.cart .action.lnk.wishlist {
  border-right: 1px solid #dadada;
}
.product-micro .product-image .image a .zoom-overlay:before {
  color: #FFFFFF;
  content: "\f00e";
  font-family: fontawesome;
  left: 45%;
  position: relative;
  right: 40%;
}
.product-micro .product-image .image a .zoom-overlay {
  height: 100%;
  left: 0;
  opacity: 0;
  position: absolute;
  top: 0;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  width: 100%;
  z-index: 99;
}
.product-micro .product-image .image a .zoom-overlay:hover,
.product-micro .product-image .image a .zoom-overlay:focus {
  opacity: 1;
}
.cnt-home .product-micro .tag-micro {
  width: 30px;
  height: 30px;
  font-size: 11px;
  line-height: 29px;
  top: 5.5%;
}
.cnt-home .product-micro .product-info .name {
  font-size: 13px;
  margin-top: 0px !important;
}
.cnt-home .product-micro .product-info .product-price .price {
  font-size: 12px;
  font-family: 'Open Sans', sans-serif;
}
.cnt-home .product-micro .product-info .action .lnk.btn.btn-primary {
  font-size: 12px;
  line-height: 1.7;
}
.copyright-bar {
  background: <?php echo $setts[0]->site_secondary_color;?>;
  padding: 20px 0px;
}
.copyright-bar .copyright {
  color: #5d5c5c;
  line-height: 28px;
}
.copyright-bar .payment-methods {
  text-align: right;
}
.copyright-bar .payment-methods ul li {
  display: inline-block;
  margin-right: 15px;
}
.copyright-bar .payment-methods ul li:last-child {
  margin-right: 0px;
}
.copyright-bar .no-padding {
  padding: 0px;
}
.wide-banner {
  /*overflow: hidden;*/
}
.wide-banner .image img {
  display: block;
  -webkit-transition: all 0.3s ease;
  -moz-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

.wide-banner:hover img {
  
}
.cnt-strip {
  position: relative;
}
.cnt-strip .strip {
  position: absolute;
  bottom: 40px;
  width: 100%;
  padding: 8px 30px 5px 30px;
  right:50px;
}
.cnt-strip .strip h1 {
  font-size: 36px;
  color: #ff4c4c;
  margin: 0;
  text-transform: uppercase;
  font-family:'Montserrat', sans-serif;
  font-weight:bold
}
.cnt-strip .strip h2 {
  font-size: 36px;
  color: #fff;
  margin: 0;
  text-transform: uppercase;
  font-family:'Montserrat', sans-serif;
  font-weight:bold
}
.cnt-strip .strip h2 .shopping-needs {
  font-family:'Montserrat', sans-serif;
  color: #fff;
  font-weight:normal;
  font-size:22px
}
.cnt-strip .strip h3 {
  font-size: 30px;
  color: #434343;
  margin: 0;
  text-transform: uppercase;
  font-family:'Montserrat', sans-serif;
}
.cnt-strip .strip h4 {
  font-size: 20px;
  margin: 0;
  text-transform: uppercase;
  font-family:'Montserrat', sans-serif;
}
.cnt-strip .strip.strip-text {
  width: 60%;
}
.cnt-strip .strip .red {
  color: #ff7878;
}
.cnt-strip .strip .black {
  color: #434343;
}
.cnt-strip .strip .green {
  color: #83c038;
}
.cnt-strip .strip .white {
  color: #fff;
}
.cnt-strip .strip .normal-shopping-needs {
  font-size: 35px;
  font-family: 'Open Sans', sans-serif;
}
.cnt-strip .new-label {
  background: url("../images/label.png") no-repeat scroll right top;
  height: 72px;
  position: absolute;
  left: -1px;
  top: -1px;
  width: 72px;
  z-index: 999;
}
.cnt-strip .new-label .text {
  color: #fff;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 14px;
  font-weight: bold;
  line-height: 22px;
  left: -13px;
  position: absolute;
  text-align: center;
  top: 14px;
  -ms-transform: rotate(-43deg);
  letter-spacing:1px;
  /* IE 9 */
  -webkit-transform: rotate(-43deg);
  /* Chrome, Safari, Opera */
  transform: rotate(-43deg);
  width: 100%;
}
.wide-banners {
	overflow:hidden

}
.wide-banners.homepage-banner {
  margin-top: 30px;
}
.wide-banners.homepage-banner h4 {
  font-size: 30px;
  font-family: 'Open Sans', sans-serif;
}
.wide-banners.homepage-banner h3 {
  font-size: 35px;
  font-family: 'Open Sans', sans-serif;
}
.new-banner {
  margin-top: 30px;
}
.new-banner .cnt-strip .strip {
  width: auto;
  padding: 0px;
  right: 23px;
}
.new-banner .cnt-strip .strip h3 {
  background: #707070;
  padding: 13px 23px 13px 16px;
  line-height: 24px;
  font-size: 30px;
  font-family: 'Open Sans', sans-serif;
}
.new-banner .cnt-strip .strip h5 {
  font-size: 16px;
  line-height: 30px;
  font-weight: 700;
  padding-right: 21px;
  text-transform: uppercase;
}
.new-banner .cnt-strip .strip h5 span {
  background: none repeat scroll 0 0 #707070;
  -moz-box-shadow: -1.4em 0 0 #707070, 1.4em 0 0 #707070;
  -webkit-box-shadow: -1.4em 0 0 #707070, 1.4em 0 0 #707070;
  box-shadow: -1.4em 0 0 #707070, 1.4em 0 0 #707070;
  padding: 0.6em 0;
}
.new-banner.no-margin {
  margin-top: -10px;
}
.megamenu-banner {
  margin-top: 30px !important;
}
.megamenu-banner h3 {
  font-size: 30px;
  font-family: 'BebasNeueRegular';
}
.megamenu-banner h2 {
  font-size: 40px;
  font-family: 'BebasNeueBold';
}
.wide-banner-4 .cnt-strip .strip h1 {
  font-size: 50px;
  font-family: 'Open Sans', sans-serif;
}
.wide-banner-4 .cnt-strip .strip h2 {
  font-size: 40px;
  font-family: 'Open Sans', sans-serif;
}
.wide-banner-4 .cnt-strip .strip h3 {
  font-size: 30px;
  font-family: 'Open Sans', sans-serif;
}
.wide-banner-4 .cnt-strip .strip h4 {
  font-size: 20px;
  font-family: 'Open Sans', sans-serif;
}
.wide-banner-4 .cnt-strip .strip p {
  font-size: 23px;
  font-family: 'Open Sans', sans-serif;
  margin-bottom: 0px;
}
.blog-slider-container .blog-slider .blog-post-info .name {
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
  font-weight:bold
}
.blog-slider-container .blog-slider .blog-post-info .name a {
  color: #555;
}
.blog-slider-container .blog-slider .blog-post-info .info {
  color: #9c9c9c;
  font-size: 13px;
  margin-bottom:8px;
  overflow:hidden;
  display:block
}
.blog-slider-container .blog-slider .blog-post-info .text {
  color: #434343;
  font-size: 13px;
}
.footer .links-social {
  border-top: 1px solid #e5e5e5;
  font-size: 12px;
  line-height: 18px;
  color: #666666;
  margin-bottom: 70px;
}

.social {
	overflow: hidden
}
.social a {
	color: #fff;
	width: 35px;
	height: 35px;
	line-height: 35px;
    border-radius: 3px;
}
.social a:hover {
	color: #fff;
}
.social .fb a:before {
	content: "\f09a";
	font-family: FontAwesome;
}
.social .fb a {
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #3C5B9B !important;
}
.social .tw a:before {
	content: "\f099";
	font-family: FontAwesome;
}
.social .tw a {
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #359BED !important;
}
.social .googleplus a:before {
	content: "\f0d5";
	font-family: FontAwesome;
}
.social .googleplus a {
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #E33729!important;
}
.social .rss a:before {
	content: "\f09e";
	font-family: FontAwesome;
}
.social .rss a {
	content: "\f09e";
	font-family: FontAwesome;
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #FD9F13 !important;
}
.social .pintrest a:before {
	content: "\f0d3";
	font-family: FontAwesome;
}
.social .pintrest a {
	content: "\f0d3";
	font-family: FontAwesome;
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #cb2027 !important;
}
.social .linkedin a:before {
	content: "\f0e1";
	font-family: FontAwesome;
}
.social .linkedin a {
	content: "\f0e1";
	font-family: FontAwesome;
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #027ba5 !important;
}
.social .youtube a:before {
	content: "\f167";
	font-family: FontAwesome;
}
.social .youtube a {
	font-size: 16px;
	display: inline-block!important;
	text-align: center;
	padding: 0;
	background: #F03434 !important;
}
.social h4 {
	margin: 25px 0 0px 0px;
}
.social ul {
	margin: 0;
	list-style: none;
}
.social ul li {
	margin-right: 7px;
}
.social ul li {
	border-bottom: none;
}
.social a {
	transition: background 400ms ease-in-out;
	-webkit-transition: background 400ms ease-in-out;
	-moz-transition: background 400ms ease-in-out;
	-o-transition: background 400ms ease-in-out;
}

.footer .links-social .contact-info .footer-logo {
  margin-top: 10px;
}
.footer .links-social .contact-info .about-us {
  margin-bottom: 20px;
}
.footer .links-social .contact-info .social-icons a {
  color: #888888;
  font-size: 16px;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  width: 2em;
  height: 2em;
  display: inline-block;
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  text-align: center;
}
.footer .links-social .contact-info .social-icons a:hover,
.footer .links-social .contact-info .social-icons a:focus,
.footer .links-social .contact-info .social-icons a.active {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  color: #fff;
}
.footer .links-social .contact-info .social-icons a .icon {
  line-height: 2em;
}
.footer .module-heading {
  font-size: 16px;
  text-transform: uppercase;
  font-family: 'Open Sans', sans-serif;
  color: #555555;
}
.footer .contact-timing .table tbody tr {
  border-bottom: 1px solid #e1e1e1;
}
.footer .contact-timing .table tbody tr td {
  border-top: none;
  font-size: 12px;
  line-height: 36px;
  padding: 0px !important;
}
.footer .contact-timing .contact-number {
  font-family: 'Open Sans', sans-serif;
}
.footer .contact-information .media .media-body a {
  color: #666666;
}
.footer .footer-bottom {
  background: <?php echo $setts[0]->site_primary_color;?>;
  padding-top: 30px;
  padding-bottom:30px
}

.footer .module-title {
	font-size:14px;
	font-weight:bold;
	letter-spacing:0.5px;
	margin-bottom:15px
	}

.footer .footer-bottom .module-heading {
  font-size: 16px;
  text-transform: uppercase;
  font-family: 'Open Sans', sans-serif;
  color: #fff;
}
.footer .footer-bottom .module-body ul li {

}

.toggle-footer {color:#666}
.toggle-footer a {margin-left:0px!important}
.toggle-footer a:before {display:none}
.toggle-footer i{ border-radius:2px}

.footer .footer-bottom .module-body ul li:last-child{border:none}

.footer .footer-bottom .module-body ul li a {
  font-size: 13px;
  line-height: 30px;
  color: #ddd;
  position: relative;
  margin-left: 23px;
  
}
.footer .footer-bottom .module-body ul li a:before {
  content: "\f111";
  font-family: FontAwesome;
  position: absolute;
  margin-left: -22px;
  font-size: 6px;
}
.product-tag .item {
  background-color: #f5f5f5;
  color: #666666;
  display: inline-block;
  margin-bottom: 5px;
  margin-right: 2px;
  padding: 6px 12px;
}
.product-tag .item.active,
.product-tag .item:hover,
.product-tag .item:focus {
  color: #fff;
}
.newsletter .sidebar-widget-body input {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  border: 1px solid #eaeaea;
  background: #fafafa;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  font-size:13px
}

.hot-deals .custom-carousel .owl-controls .owl-next {
	top:-20px
}
.hot-deals .custom-carousel .owl-controls .owl-prev {
	top:-20px
}
.hot-deals .hot-deal-wrapper {
  position: relative;
}
.hot-deals .hot-deal-wrapper .image img{
  width: 100%;
}

.hot-deals .hot-deal-wrapper .sale-offer-tag {
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  color: #FFFFFF;
  font-size: 11px;
  font-weight: 700;
  height: 50px;
  text-transform: uppercase;
  top: 4%;
  right: 10px;
  width: 50px;
  z-index: 100;
  background: #ff7878;
  position: absolute;
  text-align: center;
}
.hot-deals .hot-deal-wrapper .sale-offer-tag span {
  position: relative;
  z-index: 100;
  top: 10px;
}
.hot-deals .hot-deal-wrapper .timing-wrapper {
  bottom: 20px;
  position: absolute;
  left: 15px;
}
.hot-deals .hot-deal-wrapper .timing-wrapper .box-wrapper {
  display: table;
  text-align: center;
  margin-right: 4px;
  float: left;
}
.hot-deals .hot-deal-wrapper .timing-wrapper .box-wrapper .box {
  background-color: #fff;
  color: #333;
  display: table-cell;
  height: 44px;
  vertical-align: middle;
  width: 45px;
  line-height: 15px;

}
.hot-deals .hot-deal-wrapper .timing-wrapper .box-wrapper .box .key {
  display: block;
  font-size: 14px;
  text-transform: uppercase;
  font-weight: 700;
  font-family:'Open Sans', sans-serif
}
.hot-deals .hot-deal-wrapper .timing-wrapper .box-wrapper .box .value {
  display: block;
  font-size: 9px;
  font-weight: 500;
  letter-spacing:0.5px
}
.hot-deals .hot-deal-wrapper .timing-wrapper .box-wrapper:last-child {
  margin-right: 0px;
}
.hot-deals .product-info .name {
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
}
.hot-deals .product-info .name a {
  color: #555;
}
.hot-deals .product-info .product-price .price {
  font-weight: 700;
  font-size: 16px;
  line-height: 30px;
  margin-right: 8px;
}
.hot-deals .product-info .product-price .price-before-discount {
  text-decoration: line-through;
  color: #d3d3d3;
  font-weight: 400;
  line-height: 30px;
  font-size: 14px;
}
.hot-deals .cart {
  margin-top: 5px;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  z-index: 666;
  left: 0px;
}
.hot-deals .cart .action {
  float: left;
}
.hot-deals .cart .action .add-cart-button a {
  background: none repeat scroll 0 0 #a8a8a8;
  border: medium none;
  color: #FFFFFF;
  display: block;
  overflow: hidden;
  position: relative;
  text-decoration: none;
  padding: 0px;
}
.hot-deals .cart .action .add-cart-button a .icon {
  background: none repeat scroll 0 0 #575757;
  color: #FFFFFF;
  height: 100%;
  left: 0;
  font-size: 13px;
  padding: 11px 0 0;
  position: absolute;
  text-align: center;
  top: 0;
  width: 35px;
}
.hot-deals .cart .action .add-cart-button a span {
  display: block;
  margin-left: 35px;
  overflow: hidden;
  padding: 8px 13px;
}
.hot-deals .cart .action .add-cart-button a:hover,
.hot-deals .cart .action .add-cart-button a:focus {
  background: #c6c6c6;
}
.breadcrumb {
  background: rgba(0, 0, 0, 0);
  padding: 0;
}
.breadcrumb ul {

  margin: auto;
  padding:8px 0 0px;
  text-align: left;
}
.breadcrumb ul li:after {
  color: #666666;
  content: "/";
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 12px;
  line-height: 24px;
  margin-left: 9px;
  margin-right: -4px;
  padding: 0px;
}
.breadcrumb ul li:last-child:after {
  content: "";
}
.breadcrumb ul li a {
  color: #666666;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 12px;
  line-height: 24px;
  font-weight: 500;
}
.category-carousel {
  text-align: center;
  cursor: default;
}
.category-carousel .item {
  position: relative;
  margin-bottom:30px;
}
.category-carousel .item .caption {
  color: #636363;
  left: 12%;
  letter-spacing: -3px;
  position: absolute;
  top: 10%;
  z-index: 100;
  display: table-cell;
}
.category-carousel .item .caption .big-text {
  font-size: 100px;
  line-height: 145px;
  text-transform: uppercase;
  font-family: 'Open Sans', sans-serif;
  color: #fdd922;
}
.category-carousel .item .caption .excerpt {
  font-size:36px;
  letter-spacing:normal;
  color: #fff;
}
.category-carousel .item .caption .excerpt-normal {
  font-size:14px;
  letter-spacing:normal;
  color: #fff;
  letter-spacing:0.5px
}


.category-carousel .item .owl-controls {
  display: inline-block;
  position: relative;
  margin-top: 40px;
}
.category-carousel .item .owl-controls .owl-prev,
.category-carousel .item .owl-controls .owl-next {
  display: inline-block;
  position: absolute;
  top: 0;
  bottom: 0;
  width: 30px;
  height: 30px;
  font-size: 21px;
  color: #FFF;
  background-color: #d3d3d3;
  border: none;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: auto;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
  opacity: 0;
}
.category-carousel .item .owl-controls .owl-prev {
  left: -35px;
}
.category-carousel .item .owl-controls .owl-next {
  right: -35px;
}
.category-carousel .item:hover .owl-prev {
  left: -40px;
  opacity: .25;
}
.category-carousel .item:hover .owl-next {
  right: -40px;
  opacity: .25;
}
.category-carousel .item:hover .owl-prev:hover,
.category-carousel .item:hover .owl-next:hover {
  opacity: 1;
}
.filters-container {
  padding: 15px 20px;
   background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
	padding-bottom:0px
}
.filters-container .nav-tabs.nav-tab-box {
  border: medium none;
  margin-top: 3px;
}
.filters-container .nav-tabs.nav-tab-box li {
  margin-right: 5px;
  padding: 0;
}
.filters-container .nav-tabs.nav-tab-box li a {
  background: none repeat scroll 0 0 #FFFFFF;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  color: #666666;
  font-family: 'Open Sans', sans-serif, sans-serif;
  line-height: 18px;
  border: none !important;
  padding: 0px;
}
.filters-container .nav-tabs.nav-tab-box li a .icon {
  margin-right: 5px;
  color: #aaa;
}
.filters-container .lbl-cnt {
  color: #666666;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 12px;
  line-height: 24px;
}
.filters-container .lbl-cnt .lbl {
  color: #666666;
  display: inline-block;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 12px;
  line-height: 28px;
  margin-right: 10px;
}
.filters-container .lbl-cnt .dropdown.dropdown-med .btn {
  border: 1px solid #e5e5e5;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  padding: 4px 12px;
  background: #fff;
  font-size: 13px;
}
.filters-container .lbl-cnt .dropdown.dropdown-med .btn .caret {
  margin-left: 13px;
  margin-top: -2px;
}
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0;
  border-radius: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid #e1e1e1;
}
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu li a:hover,
.filters-container .lbl-cnt .dropdown.dropdown-med .dropdown-menu li a:focus {
  background: rgba(0, 0, 0, 0);
}
.filters-container .pagination-container {
  margin-top: 4px;
  margin-bottom:20px;
}
.filters-container .pagination-container ul {
  margin: 0px;
}
.filters-container .pagination-container ul li.prev,
.filters-container .pagination-container ul li.next {
  background: none repeat scroll 0 0 #dddddd;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
.filters-container .pagination-container ul li.prev a,
.filters-container .pagination-container ul li.next a,
.filters-container .pagination-container ul li.prev a:hover,
.filters-container .pagination-container ul li.next a:hover,
.filters-container .pagination-container ul li.prev a:focus,
.filters-container .pagination-container ul li.next a:focus {
  color: #fff;
}
.filters-container .pagination-container ul li a {
  color: #666666;
  display: inline-block;
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 13px;
  line-height: 20px;
  padding: 0 3px;
}
.filters-container .pagination-container ul li.active a {

}
.search-result-container .category-product {

}
.search-result-container .category-product .product {
  margin-bottom: 30px;
}
.search-result-container .category-product .product .product-image .tag {
    width: 35px;
    height: 35px;
    line-height: 35px;
    font-size: 10px;
    right: 14px;
    letter-spacing: 0.5px;
}


.search-result-container .category-product-inner .product-list.product {
  position: relative;
  margin-bottom: 30px;
}
.search-result-container .category-product-inner .product-list.product .product-info {
  padding:0px;
}
.search-result-container .category-product-inner .product-list.product .product-info .cart {
    margin-top: 20px;
    top: auto;
    bottom: 0px;
    opacity: 1;
    left: 0;
    position: relative;
	margin-left:0px
}

.search-result-container .category-product-inner .product-list.product .product-info .cart-btn {
    display: block;
    margin-right: 5px;
}

.search-result-container .category-product-inner .product-list.product .tag {
  position: absolute;
  right: 12px;
  top: 18px;
    width: 35px;
    height: 35px;
    line-height: 35px;
    font-size: 10px;
    right: 14px;
    letter-spacing: 0.5px;
}
.product-list.product .product-info .name {
  font-size: 18px;
}
.product-list.product .product-info .description {
  line-height: 20px;
}

/*===================================================================================*/
/*  Product Detail
/*===================================================================================*/

.detail-block {
 background-color: #fff;
 box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
 padding: 20px;
 overflow:hidden
	
}

.single-product .product-info-block .name {margin-top:0px; font-weight:bold; letter-spacing:-1px}

.single-product .single-product-gallery {padding-bottom:30px}

.single-product .favorite-button .btn-primary {background:#ddd}

.single-product .gallery-holder #owl-single-product .single-product-gallery-item {
  border: 1px solid #e5e5e5;
}
.single-product .gallery-holder .gallery-thumbs {
  margin: 15px 0 0;
  position: relative;
  text-align: left;
}
.single-product .gallery-holder .gallery-thumbs .owl-item .item {
  margin-right: 10px;
  border: 1px solid #e5e5e5;
}

.single-product .product-info .rating-reviews .reviews .lnk {
  color: #aaaaaa;
}
.single-product .product-info .stock-container .stock-box .label {
  font-size: 13px;
  font-family: 'Open Sans', sans-serif;
  line-height: 18px;
  color: #666666;
  padding: 0px;
  font-weight: normal;
}
.single-product .product-info .stock-container .stock-box .value {
  font-size: 13px;
  color: #ff7878;
}
.single-product .product-info .description-container {
  line-height: 20px;
  color: #666666;
}
.single-product .product-info .price-container {
  border-bottom: 1px solid #F2F2F2;
  border-top: 1px solid #F2F2F2;
  margin-bottom: 0;
  padding: 20px 0;
}
.single-product .product-info .price-container .price-box .price {
  font-size: 30px;
  font-weight: 700;
  line-height: 50px;
}

.ptsCell .price-box .price {
 font-size: 20px;
  font-weight: 600;
  line-height: 20px;
}


.single-product .product-info .price-container .price-box .price-strike {
  color: #aaa;
  font-size: 16px;
  font-weight: 300;
  line-height: 50px;
  text-decoration: line-through;
}
.ptsCell .price-box .price-strike
{
color: #aaa;
  font-size: 16px;
  font-weight: 300;
  line-height: 20px;
  text-decoration: line-through;

}



.single-product .product-info .quantity-container {
  margin-bottom: 0;
  padding: 20px 0;
}
.single-product .product-info .quantity-container .label {
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
  line-height: 35px;
  text-transform: uppercase;
  color: #666666;
  padding: 0px;
  font-weight: normal;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input {
  display: inline-block;
  height: 35px;
  position: relative;
  width: 70px;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input .arrows {
  position: absolute;
  right: 0;
  top: 0;
  z-index: 2;
  height: 100%;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow {
  box-sizing: border-box;
  display: block;
  text-align: center;
  width: 40px;
  cursor: pointer;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow .ir .icon {
  position: relative;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow .ir .icon.fa-sort-asc {
  top: 5px;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow .ir .icon.fa-sort-desc {
  top: -7px;
}
.single-product .product-info .quantity-container .cart-quantity .quant-input input {
  background: none repeat scroll 0 0 #fff;
  border: 1px solid #f2f2f2;
  box-sizing: border-box;
  font-size: 15px;
  height: 35px;
  left: 0;
  padding: 0 20px 0 18px;
  position: absolute;
  top: 0;
  width: 70px;
  z-index: 1;
}
.single-product .product-info .product-social-link .social-label {
  font-size: 15px;
  font-family: 'Open Sans', sans-serif;
  line-height: 20px;
  text-transform: uppercase;
}
.single-product .product-info .product-social-link .social-icons {
  display: inline-block;
}
.single-product .product-info .product-social-link .social-icons ul li a {
  color: #888888;
  font-size: 16px;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  padding: 5px 6px;
}
.single-product .product-info .product-social-link .social-icons ul li a:hover,
.single-product .product-info .product-social-link .social-icons ul li a:focus {
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  color: #fff;
}
.single-product .product-tabs {
  margin-top: 30px;
   background-color: #fff;
 box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
 padding: 0px;
 overflow:hidden;
 margin-bottom:30px;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li {
  float: none !important;

}
.single-product .nav-tabs {border:none}

.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a {
  border: none;
  color: #555;
  display: block;
  padding: 12px 28px;
  font-size: 13px;
  font-family: 'Open Sans', sans-serif;
  line-height: 28px;
  text-transform: uppercase;
  position: relative;
  font-weight:bold;
  letter-spacing:1px;
  background: #f8f8f8;
  border: 1px #fff solid;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a:hover,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a:focus {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  color: #fff;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a:hover:before,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a:focus:before {
  border-color: rgba(0, 0, 0, 0) #e0e0e0 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
  right: -10px;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a:hover:after,
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li > a:focus:after {
  border-style: solid;
  border-width: 7.5px 1px 7.5px 10px;
  content: "";
  height: 0;
  position: absolute;
  top: 20px;
  width: 0;
  right: -8px;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li.active > a {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  color: #fff;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li.active > a:before {
  border-color: rgba(0, 0, 0, 0) #e0e0e0 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
  right: -10px;
}
.single-product .product-tabs .nav.nav-tabs.nav-tab-cell > li.active > a:after {
  border-style: solid;
  border-width: 7.5px 1px 7.5px 10px;
  content: "";
  height: 0;
  position: absolute;
  top: 20px;
  width: 0;
  right: -8px;
}
.single-product .product-tabs .tab-content {
 padding-left:0px
}
.single-product .product-tabs .tab-content .tab-pane {
  padding: 24px;
}
.single-product .product-tabs .tab-content .tab-pane .text {
  line-height: 20px;
}

.single-product #owl-single-product-thumbnails .owl-controls {
  position: absolute;
  text-align: center;
  top: auto;
  width: 100%;
  margin-top: 20px;
}
.single-product #owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page {
  display: inline-block;
}
.single-product #owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page span {
  background: none repeat scroll 0 0 #ddd;
  border: medium none;
  border-radius: 3px;
  display: block;
  height: 10px;
  margin: 0 2px;
  -webkit-transition: all 200ms ease-out 0s;
  -moz-transition: all 200ms ease-out 0s;
  -o-transition: all 200ms ease-out 0s;
  transition: all 200ms ease-out 0s;
  width: 10px;
  cursor: pointer;
}
.single-product .sidebar .sidebar-module-container .sidebar-widget .section-title {
  margin-top: 0px;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder {
  background-color: #FFFFFF;
  height: 100%;
  position: absolute;
  top: 0;
  width: 30px;
  z-index: 50;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder.left {
  left: 0px;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder.right {
  right: 0;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn {
  left: 0;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:after {
  content: "\f104";
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn {
  right: 0px;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:after {
  content: "\f105";
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn,
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn {
  background-color: #fff;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  display: inline-block;
  height: 100%;
  position: absolute;
  vertical-align: top;
  width: 90%;
  z-index: 100;
  border: 1px solid #e5e5e5;
  color: #dadada;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:after,
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:after {
  bottom: 0;
  font-family: fontawesome;
  font-size: 30px;
  height: 30px;
  left: 0;
  line-height: 30px;
  margin: auto;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
}
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:hover,
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:hover,
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:focus,
.cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:focus {
  background: #dadada;
  color: #fff;
}
.cnt-homepage .single-product .single-product-gallery .owl-item .single-product-gallery-item > a > img {
  display: block;
  width: 100%;
}
.cnt-homepage .single-product .single-product-gallery .owl-item .single-product-gallery-thumbs.gallery-thumbs .owl-item {
  margin-left: 10px;
}
.cnt-homepage .single-product .product-info-block label,
.cnt-homepage .single-product .product-info-block .label {
  font-size: 13px;
  font-weight: normal;
  line-height: 30px;
  color: #434343 !important;
}
.cnt-homepage .single-product .product-info-block .label {
  padding: 0px;
}
.cnt-homepage .single-product .product-info-block .cart {
  width: auto;
  left: 0;
  margin-top: -8px;
  padding: 0px;
}
.cnt-homepage .single-product .product-info-block .cart .action .left {
  padding: 2px 8px;
  margin-left: 5px;
}
.cnt-homepage .single-product .product-info-block .form-control .selectpicker {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid #f1f1f1;
  background: #fff;
  color: #b0b0b0;
}
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  border: 1px solid #f1f1f1;
}
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:hover,
.cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:focus {
  background: rgba(0, 0, 0, 0);
}
.cnt-homepage .single-product .product-info-block .txt.txt-qty {
  font-size: 15px;
  line-height: 18px;
  border: 1px solid #f1f1f1;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  height: 30px;
  padding: 5px 10px;
  text-align: center;
  width: 60px;
}
.cnt-homepage .single-product .product-info-block .stock-container .stock-box .label {
  color: #434343;
  font-family: 'Open Sans', sans-serif;
  font-size: 13px;
  font-weight: normal;
  line-height: 20px;
  padding: 0;
  text-transform: none;
}
.cnt-homepage .single-product .product-info-block .stock-container .stock-box .value {
  font-size: 13px;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li {
  margin-right: 10px;
  padding: 0;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a {
  border: 2px solid #e1e1e1;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  color: #666666;
  font-family: 'Open Sans', sans-serif;
  font-size: 20px;
  line-height: 30px;
  padding-bottom: 4px;
  padding-top: 4px;
  text-transform: uppercase;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:hover,
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:focus {
  color: #fff;
}
.cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li.active a {
  color: #fff;
}
.cnt-homepage .single-product .product-tabs .tab-content {
  border: none;
}
.cnt-homepage .single-product .product-tabs .tab-content .tab-pane {
  padding: 0px;
}
.cnt-homepage .single-product .product-tabs .tab-content .tab-pane .product-tab .text {
  font-size: 13px;
  line-height: 22px;
}
.single-product .second-gallery-thumb.gallery-thumbs {
  padding: 0 40px;
}
.single-product .second-gallery-thumb.gallery-thumbs #owl-single-product2-thumbnails .owl-wrapper-outer {
  margin-left: 5px;
}
.product-tabs .tab-content .tab-pane .product-reviews .title {
  color: #666666;
  font-size: 14px;
  font-weight: bold;
  line-height: 20px;
  margin: 0 0 10px;
  font-family: 'Open Sans', sans-serif;

}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review {
  margin-bottom: 20px;
  font-family: 'Open Sans', sans-serif, sans-serif;
  text-transform: none;
  background:#f8f8f8;
  padding:20px
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title {
  margin-bottom: 5px;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .summary {
  color: #666666;
  font-size: 14px;
  font-weight: normal;
  margin-right: 10px;
  font-style:italic

}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .date {
  font-size: 12px;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .date span {
  margin-left: 5px;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .text {
  line-height: 18px;
}
.product-tabs .tab-content .tab-pane .product-reviews .reviews .review .author span {
  margin-left: 5px;
}
.product-tabs .tab-content .tab-pane .product-add-review .title {
  color: #666666;
  font-size: 14px;
  font-weight: 500;
  line-height: 20px;
  margin: 0 0 10px;
  font-family: 'Open Sans', sans-serif;
}
.product-tabs .tab-content .tab-pane .product-add-review .review-table .table thead th {
    font-weight: normal;
    border-bottom-width: 1px;
    text-align: center;
    vertical-align: middle;
    background: #f8f8f8;
	border:none
}
.product-tabs .tab-content .tab-pane .product-add-review .review-table .table tbody tr td {
  text-align: center;
  vertical-align: middle;
}
.product-tabs .tab-content .tab-pane .product-add-review .review-table .table tbody tr td input {
  float: none;
  margin: auto;
}
.product-tabs .tab-content .tab-pane .product-add-review .review-form label {
  font-weight: normal;
  font-size: 13px;
}
.product-tabs .tab-content .tab-pane .product-add-review .review-form label .astk {
  color: #FF0000;
  font-size: 12px;
}
.product-tabs .tab-content .tab-pane .product-add-review .review-form .txt {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.product-tabs .tab-content .tab-pane .product-tag .title {
  color: #666666;
  font-size: 14px;
  font-weight: bold;
  line-height: 20px;
  margin: 0 0 20px;
  font-family: 'Open Sans', sans-serif;
}
.product-tabs .tab-content .tab-pane .product-tag .form-group label {
  font-weight: normal;
  font-size: 13px;
  line-height: 24px;
  margin-right: 10px;
}
.product-tabs .tab-content .tab-pane .product-tag .form-group .txt {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.product-tabs .tab-content .tab-pane .product-tag .form-group .text {
  margin-left: 90px;
}
.furniture-container .product {
  position: relative;
}
.furniture-container .product .btn-primary {
  font-size: 15px;
  line-height: 30px;
  font-family: 'Open Sans', sans-serif;
  background: #cbc9c9;
  text-transform: uppercase;
  border: none;
  color: #fff;
}
.furniture-container .product .btn-primary:hover,
.furniture-container .product .btn-primary:focus {
  border: none;
}
.furniture-container .best-seller .product .product-info .name,
.furniture-container .special-offer .product .product-info .name {
  margin-top: 4px;
}
.furniture-container .cart {
  margin-top: 5px;
  opacity: 1;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -ms-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  width: 100%;
  z-index: 666;
  left: 0px;
}
.furniture-container .cart .action {
  float: left;
}
.furniture-container .cart .action .add-cart-button .btn.btn-primary.icon {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  background: #575757 ;
}
.furniture-container .cart .action.lnk {
  margin: 10px 0px;
}
.furniture-container .cart .action.lnk a {
  padding: 0 10px;
  color: #dadada;
}
.furniture-container .cart .action.lnk.wishlist {
  border-right: 1px solid #dadada;
}
.homepage-container .product {
  position: relative;
}
.homepage-container .product .product-image .tag {
  font-size: 15px;
  font-weight: 700;
  width: 50px;
  height: 50px;
  text-transform: uppercase;
  top: 2.5%;
  z-index: 100;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  color: #fff;
  right: 25px;
  /*11px;*/
  text-align: center;
  position: absolute;
}
.homepage-container .product .product-image .tag span {
  position: relative;
  z-index: 100;
  line-height: 48px;
}
.homepage-container .product .product-image .tag.new {
  background: #46aad7;
}
.homepage-container .product .product-image .tag.hot {
  background: #ff7878;
}
.homepage-container .product .product-info .name {
  font-size: 18px !important;
  font-family: 'Open Sans', sans-serif;
}
.homepage-container .product .product-info .name a {
  color: #555;
}
.homepage-container .product .product-info .star-rating .color {
  color: #ffb400;
}
.homepage-container .product .product-info .product-price .price {
  font-weight: 700;
  font-size: 16px;
  line-height: 30px;
  margin-right: 8px;
}
.homepage-container .product .product-info .product-price .price-before-discount {
  text-decoration: line-through;
  color: #d3d3d3;
  font-weight: 400;
  line-height: 30px;
  font-size: 14px;
}
.homepage-container .product .cart {
  margin-top: 5px;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  width: 100%;
  z-index: 666;
  left: 0px;
  opacity: 1;
}
.homepage-container .product .cart .action {
  float: left;
}
.homepage-container .product .cart .action .add-cart-button .btn.btn-primary.icon {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  background: #575757 ;
}
.homepage-container .product .cart .action.lnk {
  margin: 10px 0px;
}
.homepage-container .product .cart .action.lnk a {
  padding: 0 10px;
  color: #dadada;
}
.homepage-container .product .cart .action.lnk.wishlist {
  border-right: 1px solid #dadada;
}
.homepage-container .featured-product .products .product:first-child {
  margin-bottom: 30px;
}
.homepage-container .blog-slider-container .blog-slider .blog-post-info .name {
  font-size: 18px;
}
.homepage-container .btn-primary {
  font-size: 15px;
  line-height: 30px;
  font-family: 'Open Sans', sans-serif;
  background: rgba(0, 0, 0, 0);
  text-transform: uppercase;
  border: 2px solid #f2f2f2;
  color: #747474;
}
.homepage-container .btn-primary:hover,
.homepage-container .btn-primary:focus {
  color: #fff;
}
.homepage-container .best-seller .product .product-info .name,
.homepage-container .special-offer .product .product-info .name {
  margin-top: 4px;
}
.homepage-container .cart {
  margin-top: 5px;
  opacity: 1;
  -webkit-transition: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  width: 100%;
  z-index: 666;
  left: 0px;
}
.homepage-container .cart .action .add-cart-button .btn.btn-primary.icon {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  background: #575757 ;
}
.wrapper .box {
  margin-left: auto;
  margin-right: auto;
  padding-left: 50px;
  padding-right: 50px;
}
.wrapper .box .wrapper-inner {
  background: none repeat scroll 0 0 #FFFFFF;
  -moz-box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
}
.wrapper .box .wrapper-inner .wrapper-body-inner .owl-item .tag {
  font-size: 15px;
  font-weight: 700;
  line-height: 55px;
  width: 55px;
  height: 55px;
  text-transform: uppercase;
  top: 2.5%;
  z-index: 100;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  color: #fff;
  right: 25px;
  /*11px;*/
  text-align: center;
}
.wrapper .box .wrapper-inner .wrapper-body-inner .owl-item .tag span {
  position: relative;
  z-index: 100;
}
.wrapper .box .wrapper-inner .wrapper-body-inner .owl-item .tag.new {
  background: #46aad7;
}
.wrapper .box .wrapper-inner .wrapper-body-inner .owl-item .tag.sale {
  background: #989898;
}
.wrapper .box .wrapper-inner .wrapper-body-inner .owl-item .tag.hot {
  background: #ff7878;
}
/*===================================================================================*/
/*  Responsive Layout
/*===================================================================================*/



@media (max-width: 767px) {



.hider
{
display:none !important;
}

.main-header .top-search-holder .search-area
{
background:#fff;
}


.main-header .top-search-holder .search-area .categories-filter
{
max-width:100px;

}



.main-header .top-search-holder .search-area .search-field {
  
  border-radius: 0px !important;
  
  width: 47%;
}


}


@media (min-width: 320px) and (max-width: 480px) {




	
	.categories-filter select
{
border:none;
background:#F6F6F6;
max-width:100%;
width:100%;

}
	
	
	
#ptsBlock_535808 .ptsCol {
            width: 100% !important;
      }



.top-bar .cnt-block {float:right;}
.top-cart-row .dropdown-cart .lnk-cart {display:block; overflow:hidden}
.top-cart-row {padding-left:15px}
.top-cart-row .dropdown-cart {
    float: none;
}
#owl-main .item .caption .big-text {font-size:18px; line-height: normal}
#owl-main .item .caption {left:0px}
#owl-main {height:100%}
#owl-main .item {height:150px}
#owl-main .item .caption .button-holder {margin:0px}
#hero .btn-primary {padding:5px 10px; font-size:12px; line-height:normal; margin-top:8px}

}

/* Extra small devices (phones, less than 768px) */


@media (max-width: 767px) {
	.navbar-toggle {float:left; border:none}
	.navbar-default .navbar-toggle .icon-bar {background-color: #fff;}
	.navbar-collapse {box-shadow:none; border:none; padding-right: 15px; padding-left: 15px;}
	.header-style-1 .header-nav .navbar-default .navbar-collapse {padding-right: 15px; padding-left: 15px;}
	.header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a {border:none}
	.mega-menu img {width:100%}
	.yamm .dropdown-menu .yamm-content .col-menu {margin-bottom:15px}
	
	
  .top-bar .header-top-inner {
    text-align: center;
  }
  .top-bar .header-top-inner .cnt-account {
    clear: both;
    display: inline-block;
    float: none;
    margin: auto;
    text-align: center;
  }
  .top-bar .header-top-inner .cnt-account li {
    margin-bottom: 8px;
  }
  .top-bar .header-top-inner .cnt-block .list-inline li {
    margin:0px 0;
  }
  .main-header .logo-holder {
    text-align: left;
    margin-bottom: 20px;
  }
  .main-header .top-search-holder .contact-row {
    margin-bottom: 20px;
    text-align: center;
  }
  .main-header .top-search-holder .contact-row .phone,
  .main-header .top-search-holder .contact-row .contact {
    margin: 0 0 5px;
    padding-right: 0px;
    border-right: none;
    display: block;
  }
  .main-header .top-search-holder .search-area .categories-filter {
    
    border-right: none;
    border-bottom: 1px solid #e0e0e0;
  }
  .main-header .top-search-holder .search-area .search-button {
    padding: 12px 19px;
  }
  .sidebar .side-menu nav .nav > li > .mega-menu {
    left: 0px;
    min-width: 100%;
    top: 100%!important;
  }
  .logo-slider-inner .item {
    text-align: center;
  }
  .filters-container .filter-tabs,
  .filters-container .lbl-cnt,
  .filters-container .pagination-container {
    margin-bottom: 10px;
  }
  .homepage-container .wide-banners .wide-banner {
    margin-bottom: 10px;
  }
  .cnt-homepage .wrapper .box {
    padding: 0 10px;
  }
  #owl-main .item .caption {
    padding: 0 22px;
  }
  .wide-banners .wide-banner:first-child {
    margin-bottom: 10px;
  }
  .product .product-image .image img {
    width: 100%;
    height: auto;
    display: block;
  }
  .header-nav .yamm .dropdown-menu {
    background: #fff;
  }
  .body-content .sidebar {
    margin-bottom: 30px;
  }
  .filters-container .no-padding {
    padding: 0px;
  }
  .search-result-container .category-product-inner .product-list.product .product-info {
    padding: 0px;
  }
  .search-result-container .category-product-inner .product-list.product .product-info .cart {
    margin-bottom: 20px;
  }
  .single-product .gallery-holder {
    margin-bottom: 30px;
  }
  .single-product .product-info-block {
    clear: both;
  }
  .yamm .dropdown-menu.pages {
    padding: 10px 37px;
  }
  .hot-deal-wrapper .image img {
    width: 100%;
    height: auto;
    display: block;
  }
  .seller-product .products .product .product-info .name {
    font-size: 15px;
    margin-top: 0px !important;
  }
  .cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a {
    font-size: 16px;
  }
  .cnt-homepage .header-nav .yamm .navbar-header {
    border: 1px solid #f1f1f1;
  }
  .info-boxes .info-box {
    margin-bottom: 10px;
  }
  .cnt-homepage .single-product .product-info-block .cart {
    margin-top: 10px;
    padding: 0 15px;
  }
  .product-comparison .compare-table tr td .product .product-image .image img {
    width: auto;
  }
  
.hot-deals .products {margin-right:15px}

.copyright-bar .payment-methods {text-align:left; margin-top:10px}
.single-product  .home-banner {display:none}
}
/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991px) {


.showing
{
display:none;
}


  .top-bar .cnt-account ul > li {

  }
  .sidebar .side-menu nav .nav > li > .mega-menu {
    min-width: 100%;
    left: 0px;
	top:100%!important
  }
  .logo-slider-inner .item {
    text-align: center;
  }
  .filters-container .filter-tabs,
  .filters-container .lbl-cnt,
  .filters-container .pagination-container {
    margin-bottom: 10px;
  }
  .filters-container .pagination-container {
    float: left;
  }
  .homepage-container .wide-banners .wide-banner {
    margin-bottom: 10px;
  }
  .cnt-homepage .wrapper .box {
    padding: 0 15px;
  }
  .cnt-homepage .container {
    width: 100%;
  }
  .body-content .sidebar {
    margin-bottom: 30px;
  }
  .product .product-image .image img {
    width: 100%;
    height: auto;
    display: block;
  }
  .blog-slider .image img {
    width: 100%;
    height: auto;
    display: block;
  }
  .owl-item {
    padding: 10px;
  }
  #owl-main .owl-item {
    padding: 0px;
  }
  .wide-banners .wide-banner:first-child {
    margin-bottom: 10px;
  }
  .filters-container .no-padding {
    padding: 0px;
  }
  .search-result-container .category-product-inner .product-list.product .product-info {
    padding: 0px;
  }
  .hot-deal-wrapper .image img {
    width: 100%;
    height: auto;
    display: block;
  }
  .main-header .logo-holder {
    text-align: left;
    margin-bottom: 20px;
  }
  .main-header .contact-row {
    text-align: center;
  }
  .special-menu {display:none!important}
  .single-product  .home-banner {display:none}
}
/* Medium devices (desktops, 992px and up) */


@media (min-width: 1200px) and (max-width: 1920px) {

.showing
{
display:none;
}

.border_left
{
border-left:1px solid #ddd;
}


}

@media (min-width: 992px) and (max-width: 1199px) {

.showing
{
display:none;
}


  .main-header .top-search-holder .search-area .control-group {
    position: relative;
  }
  .main-header .top-search-holder .search-area .control-group .search-button {
    position: absolute;
    top: 0px;
    right: 0px;
  }
  .category-carousel .item {
    height: auto;
  }
  .filters-container .nav-tabs.nav-tab-box li {
    margin-right: 3px;
  }
  .filters-container .lbl-cnt .lbl {
    margin-right: -1px;
  }
  .cnt-homepage .single-product .product-info-block .cart {
    clear: both;
    margin-top: 20px;
  }
  .shopping-cart .estimate-ship-tax table thead tr th .estimate-title {
    font-size: 16px !important;
  }
  .shopping-cart .cart-shopping-total table thead tr th .cart-sub-total,
  .shopping-cart .cart-shopping-total table thead tr th .cart-grand-total {
    font-size: 16px !important;
  }
  .wrapper .box .wrapper-inner .container {
    width: auto !important;
  }
  
    .special-menu {display:none!important}
	.home-banner img {width:100%}
}
/* Large devices (large desktops, 1200px and up) */


.blog-page .blog-post {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
}

.blog-page .blog-post h1 {
  font-family: 'Open Sans', sans-serif;
  font-size: 22px;
  font-weight:bold;

}
.blog-page .blog-post h1 a {
  color: #555;
}

.blog-page .tab-content .blog-post {padding:0px 0px 25px 0px!important; box-shadow:none!important}

.blog-page .blog-post span {
  padding-right: 20px;
  color: #aaa;
  font-size: 13px;
}
.blog-page .blog-post p {
  padding-top: 16px;
  font-size: 13px;
  color: #666666;
  margin-bottom: 0px;
}
.blog-page .blog-post a {
  margin-top: 20px;
}
.blog-page .blog-post .blog-pagination .pagination {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
}
.blog-page .blog-post .social-media {
  margin-top: 20px;
  margin-bottom: 30px;
}
.blog-page .blog-post .social-media span {
  font-size: 13px;
   color: #434343;
}
.blog-page .blog-post .social-media a {
  font-size: 18px;
  margin: 0px 10px 0px 0px;
  height: 30px;
  width: 30px;
  display: inline-block;
  text-align: center;
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  color: #888888;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post h4 {
  font-family: 'Open Sans', sans-serif;
  font-size: 15px;

}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post h4 a {
  color: #555;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post span {
  padding-right: 10px;
  color: #aaa;
  font-size: 12px;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post p {
  padding-top: 10px;
  font-size: 13px;
  color: #666666;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs {
  border-bottom: none;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li {
  text-transform: uppercase;
  color: #666666;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li > a {
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  font-size: 13px;
  border: none;
  letter-spacing:1px
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li:first-child > a {
  padding-right: 10px;
  border-right: 1px solid #d4d4d4;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li:last-child > a {
  padding-left: 10px;
  letter-spacing:0.5px
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav > li > a {
  padding: 0px;
  color: #666666;
}
.blog-page .sidebar .sidebar-module-container .search-area .search-button:after {
  content: "\f002";
  font-family: fontawesome;
  font-size: 13px;
  position: absolute;
  top: 14px;
  right: 30px;
  background-color: #fff;
  padding-left: 10px;
}
.blog-page .sidebar .sidebar-module-container .search-area input {
  font-size: 12px;
  color: #9e9e9e;
  padding: 14px;
  border: 1px solid #e1e1e1;
  width: 100%;
  position: relative;
}
.blog-page .blog-pagination {
  border-top: 1px solid #ececec;
}
.blog-page .blog-pagination .pagination > li:first-child > a {
  margin-right: 10px;
}
.blog-page .blog-pagination .pagination > li:last-child > a {
  margin-left: 2px;
}
.blog-page .side-bar-blog .widget .categories .side-bar-title h3 {
  font-family: 'Open Sans', sans-serif;
  font-size: 18px;
  text-transform: uppercase;
  color: #555;
  padding-bottom: 8px;
  border-bottom: 1px solid #e3e3e3;
  margin: 0px;
}
.blog-page .blog-post-author-details {
  padding: 40px 0px;
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
}

.blog-review {
	 background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;}
	
.blog-write-comment {
	 background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;}	

.blog-page .blog-post-author-details .author-social-network {
  display: inline-block;
}
.blog-page .blog-post-author-details .author-social-network button {
  background-color: #fff;
  border: 1px solid #e3e3e3;
}
.blog-page .blog-post-author-details .author-social-network button .twitter-icon {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  color: #fff;
  font-size: 16px;
  height: 26px;
  width: 26px;
  text-align: center;
  display: inline-block;
  margin: 6px;
  line-height: 26px;
}
.blog-page .blog-post-author-details .author-social-network > span {
  font-size: 13px;
  color: #434343;
  text-transform: uppercase;
  margin-right: 16px;
}
.blog-page .blog-post-author-details .author-social-network .caret {
  color: #e3e3e3;
}
.blog-page .blog-post-author-details .btn-group.open .dropdown-toggle {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.blog-page .blog-post-author-details img {
  float: left;
}
.blog-page .blog-post-author-details .author-job {
  display: block;
  padding: 0px;
  color: #aaa;
  font-size: 12px;
}
.blog-page .blog-post-author-details h4 {
  display: inline-block;
  font-size: 15px;
  font-family: 'Open Sans', sans-serif;
  color: #555;
  margin: 0px;
}
.blog-page .blog-post-author-details p {
  font-size: 13px;
  color: #666666;
  padding: 16px 0px 0px 0px;
  text-align: justify;
}
.blog-page .blog-review .title-review-comments {
  font-size: 16px;
  color: #555;
  font-family: 'Open Sans', sans-serif;
  margin-bottom: 40px;

}
.blog-page .blog-review p {
  font-size: 13px;
  color: #666666;

}
.blog-page .blog-review .review-action {
  font-size: 12px;
  color: #666666;
}
.blog-page .blog-review .post-load-more {
  text-align: center;
  padding-bottom: 10px;
}
.blog-page .blog-post .author:before,
.blog-page .blog-post .review:before,
.blog-page .blog-post .date-time:before {
  color: #666666;
  font-size: 13px;
  padding-right: 4px;
  font-family: FontAwesome;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post .author:before,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post .review:before,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post .date-time:before {
  color: #666666;
  font-size: 13px;
  padding-right: 4px;
  ont-family: FontAwesome;
}
.blog-page .blog-post .author:before,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post .author:before {
  content: "\f007";
}
.blog-page .blog-post .review:before,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post .review:before {
  content: "\f086";
}
.blog-page .blog-post .date-time:before,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .blog-post .date-time:before {
  content: "\f073";
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a:hover,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav-tabs > li.active > a:focus {
  background-color: #fff;
}
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav > li > a:hover,
.blog-page .sidebar .sidebar-module-container .sidebar-widget .nav > li > a:focus {
  background-color: #fff;
}
.blog-page .blog-post .social-media a:hover,
.blog-page .blog-post .social-media a:focus {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  color: #fff;
}
.blog-page .blog-post .social-media i,
.blog-page .blog-post-author-details .author-social-network button a i {
  padding-top: 6px;
}
.blog-page .blog-review h4,
.blog-page .blog-write-comment h4,
.contact-page .contact-title h4 {
  font-size: 14px;
  color: #555;
  font-family: 'Open Sans', sans-serif;
  display: inline-block;
}
.blog-page .blog-review .review-action a:hover,
.blog-page .blog-review .review-action a:focus {
  text-decoration: underline;
}
.blog-page .blog-review .blog-comments,
.blog-page .blog-review .blog-sub-comments {
  border-bottom: 1px solid #e3e3e3;
}
.blog-page .blog-post-author-details .author-social-network .dropdown-menu {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
}
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a .icon {
  margin-right: 5px;
}
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a:hover,
.blog-page .blog-post-author-details .author-social-network .dropdown-menu > li > a:focus {
  background: rgba(0, 0, 0, 0);
}

/*===================================================================================*/
/* Checkout
/*===================================================================================*/
.checkout-box .checkout-steps .panel-default    {
	background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
}

.checkout-box .checkout-steps .checkout-step-01 .already-registered-login form .form-group .info-title {
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-weight: normal;
  margin-bottom: 5px;
  font-size: 13px;
}
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login .forgot-password {
  padding-top: 14px;
  display: inline-block;
}
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a {
  font-size: 13px;
  color: #666666;
  text-decoration: underline;
}
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login button {
  margin-top: 15px;
}
.checkout-box .checkout-steps .panel .panel-heading .unicase-checkout-title {
  margin: 0px !important;
  font-size: 13px;
  font-weight: bold;
}
.checkout-box .checkout-steps .panel .panel-heading .unicase-checkout-title a {
  color: #555;
  text-transform: uppercase;
  display: block;
}
.checkout-box .checkout-steps .panel .panel-heading .unicase-checkout-title a span {
  background-color: #aaaaaa;
  color: #fff !important;
  display: inline-block;
  margin-right: 10px;
  padding: 15px 20px;
}
.checkout-box .checkout-steps .checkout-subtitle {
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  color: #434343;
  margin-right: 12px;
}
.checkout-box .checkout-steps .panel-body {
  padding: 20px;
  border:none
}

.panel-group .panel-heading+.panel-collapse>.panel-body {border:none}

.checkout-box .checkout-steps .guest-login form .radio-checkout-unicase .guest-check {
  margin-bottom: 6px;
}
.checkout-box .checkout-steps .guest-login ul .save-time-reg {
  padding-bottom: 4px;
}
.checkout-box .panel-group .panel {
  -webkit-border-radius: 0px !important;
  -moz-border-radius: 0px !important;
  border-radius: 0px !important;
      background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
	border:none
}
.checkout-box .checkout-progress-sidebar .panel-body ul li a {
  color: #666666;
}
.checkout-box .checkout-progress-sidebar .panel .panel-heading {
  padding: 27px 30px;
  border-bottom: 1px solid #ddd;
}
.checkout-box .checkout-progress-sidebar .panel .panel-heading h4 {
      margin: 0px;
    font-size: 14px;
    font-weight: bold;
    background: #fff;
    border-bottom: 1px #e5e5e5 solid;
    padding-bottom: 14px;
    margin-bottom: 10px;
}
.checkout-box .checkout-steps .checkout-step-01 .guest-login form .radio input[type="radio"],
.checkout-box .checkout-steps form .radio-inline input[type="radio"],
.checkout-box .checkout-steps form .checkbox input[type="checkbox"],
.checkout-box .checkout-steps form .checkbox-inline input[type="checkbox"] {
  margin-left: 0px;
}
.checkout-box .checkout-steps .panel .panel-heading,
.checkout-box .checkout-progress-sidebar .panel .panel-heading {
  font-family: 'Open Sans', sans-serif;
  font-size: 20px;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  text-transform: uppercase;
  padding:0px;
  border:none
}
.checkout-box .checkout-steps .guest-login .title-tag-line,
.checkout-box .checkout-steps .already-registered-login .title-tag-line {
  margin-bottom: 15px;
  font-size: 13px;
}
.checkout-box .checkout-steps .guest-login form .radio-checkout-unicase,
.checkout-box .checkout-steps .guest-login ul {
  padding-left: 10px;
  font-size: 13px;
}
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a:hover,
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login a:focus,
.checkout-box .checkout-progress-sidebar .panel-body ul li a:hover {
  background-color: rgba(0, 0, 0, 0);
}

.checkout-progress-sidebar .nav>li>a {padding: 10px 0px;} 
.checkout-progress-sidebar .nav>li>a:hover, .nav>li>a:focus {background:none}

/*===================================================================================*/
/*  Contact Us
/*===================================================================================*/

.contact-page {
	 background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
	overflow:hidden}	

.contact-page .contact-map iframe {
  height: 400px;
  width: 100%;
}
.contact-page .contact-info {
  font-size: 13px;
  color: #666;
}
.contact-page .contact-info .contact-i {
  display: inline-block;
  height: 30px;
  width: 30px;
  text-align: center;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  color: #fff;
  margin-right: 16px;
  float: left;
}
.contact-page .contact-info .contact-i i {
  padding-top: 8px;
  font-size: 14px;
}
.contact-page .contact-info .contact-span {
  display: block;
}
.contact-page .contact-title h4 {
  margin-bottom: 30px;
}
.contact-page .contact-info .address,
.contact-page .contact-info .phone-no {
  margin-bottom: 10px;
}


/*===================================================================================*/
/*  Shopping Cart
/*===================================================================================*/

.shopping-cart {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
	overflow:hidden	
}

.shopping-cart .shopping-cart-table {
  margin-bottom: 50px;
}
.shopping-cart .shopping-cart-table table {
  margin-bottom: 0px !important;
}
.shopping-cart .shopping-cart-table table tbody tr td {
  vertical-align: middle;
}

.shopping-cart .cart-image img {
 width:150px
}

.cart-shopping-total {background:#f8f8f8}

.shopping-cart .shopping-cart-table table tbody tr .romove-item a {
  font-size: 18px;
  color: #666666;
}
.shopping-cart .shopping-cart-table table tbody tr .romove-item a:hover,
.shopping-cart .shopping-cart-table table tbody tr .romove-item a:focus {
  color: #ff000 !important;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-image .entry-thumbnail {
  display: block;
  text-align: center;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info {
  vertical-align: middle !important;
  text-align:center;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info h4 {
  margin-top: 0px;
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;

}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info h4 a {
  color: #555;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info .reviews {
  font-size: 11px;
  color: #aaa;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info .cart-product-info {
  margin-top: 10px;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info .cart-product-info span {
  font-family: 'Open Sans', sans-serif;
  font-size: 12px;
  color: #666666;
  text-transform: uppercase;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-name-info .cart-product-info span span {
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 12px;
  text-transform: lowercase;
  margin-left: 14px;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-edit a {
  color: #666666;
  text-decoration: underline;
}
.shopping-cart .shopping-cart-table .table > thead > tr > th {
  text-align: center;
  padding: 16px;
  font-family: 'Open Sans', sans-serif;
  font-size: 15px;
}
.shopping-cart .shopping-cart-table .shopping-cart-btn span {
  padding: 20px 0px;
  display: block;
}
.shopping-cart .estimate-ship-tax table thead tr th .estimate-title {
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  color: #555;
  margin-bottom: 2px;
  margin-top: 0px;
  display: block;
}
.shopping-cart .estimate-ship-tax table thead tr th p {
  font-family: 'Open Sans', sans-serif, sans-serif;
  font-size: 13px;
  color: #666666;
  font-weight: normal;
  margin-bottom: 0px;
}
.shopping-cart .estimate-ship-tax table thead tr > th {
  padding: 24px 10px 20px 10px;
}
.shopping-cart .estimate-ship-tax table tbody tr > td {
  padding: 24px 10px !important;
}
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .selectpicker {
  background: #fff;
  color: #999;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid #eee;
}
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .dropdown-menu.open ul li a:hover,
.shopping-cart .estimate-ship-tax table tbody .unicase-form-control .dropdown-menu.open ul li a:focus {
  background: rgba(0, 0, 0, 0);
}
.shopping-cart .cart-shopping-total table thead tr th {
  background-color: #fafafa;
  text-align: right;
  padding: 24px 50px;

}
.shopping-cart .cart-shopping-total table thead tr th .cart-sub-total {
  color: #555;
  margin-bottom: 7px;
}
.shopping-cart .cart-shopping-total table tbody tr td {
  padding: 24px 50px;
}
.shopping-cart .cart-shopping-total table tbody tr td .cart-checkout-btn button {
  float: right !important;
  margin-bottom: 8px;
}
.shopping-cart .cart-shopping-total table tbody tr td .cart-checkout-btn span {
  display: block;
  font-weight: normal;
  color: #666666;
}
.shopping-cart .shopping-cart-table table tbody tr .romove-item,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-edit,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-sub-total,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-grand-total,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-quantity {
  text-align: center;
}
.shopping-cart .shopping-cart-table table tbody tr .cart-product-sub-total span,
.shopping-cart .shopping-cart-table table tbody tr .cart-product-grand-total span {
  display: block;
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: #555;
  text-transform: uppercase;
}
.shopping-cart .estimate-ship-tax table tbody tr td .form-group label,
.shopping-cart .estimate-ship-tax table tbody tr td .form-group input,
.blog-page .blog-write-comment .form-group label,
.blog-page .blog-write-comment .form-group input,
.contact-page .contact-form form label,
.contact-page .contact-form form input {
  font-size: 13px;
  font-weight: normal;
  color: #999;
}
.shopping-cart .estimate-ship-tax table tbody tr td .form-group label span,
.blog-page .blog-write-comment label span,
.contact-page .contact-form form label span,
.checkout-box .checkout-steps .checkout-step-01 .already-registered-login form .form-group label span {
  color: red;
}
.shopping-cart .cart-shopping-total table thead tr th .cart-sub-total,
.shopping-cart .cart-shopping-total table thead tr th .cart-grand-total {
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
}
.shopping-cart-table table tbody tr td .quant-input {
  display: inline-block;
  height: 35px;
  position: relative;
  width: 70px;
}
.shopping-cart-table table tbody tr td .quant-input .arrows {
  height: 100%;
  position: absolute;
  right: 0;
  top: 0;
  z-index: 2;
}
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow {
  box-sizing: border-box;
  cursor: pointer;
  display: block;
  text-align: center;
  width: 40px;
}
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow .ir .icon.fa-sort-asc {
  top: 5px;
}
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow .ir .icon.fa-sort-desc {
  top: -7px;
}
.shopping-cart-table table tbody tr td .quant-input .arrows .arrow .ir .icon {
  position: relative;
}
.shopping-cart-table table tbody tr td .quant-input input {
  background: none repeat scroll 0 0 #FFFFFF;
  border: 1px solid #F2F2F2;
  box-sizing: border-box;
  font-size: 15px;
  height: 35px;
  left: 0;
  padding: 0 10px 0 18px;
  position: absolute;
  top: 0;
  width: 70px;
  z-index: 1;
}

.checkout-btn { background:#fdd922; color:#333; padding: 10px 18px;}


.product-comparison .page-title {
  font-family: 'Open Sans', sans-serif;
  font-size: 30px;
  text-transform: uppercase;
  color: #666666;
  margin-bottom: 40px;
}

.product-comparison img  {width:150px!important}

.product-comparison .compare-table tr th {
  font-size: 16px;
  font-weight: 500;
  color: #666666;
  padding: 18px 25px;
  vertical-align: middle;
  border: 1px solid #e5e5e5;
}
.product-comparison .compare-table tr td {
  padding: 18px 30px;
  border: 1px solid #e5e5e5;
}
.product-comparison .compare-table tr td .product {
  margin-bottom: 15px;
  margin-top: 40px;
}
.product-comparison .compare-table tr td .product .product-image .image a {
  display: block;
  text-align: left;
}
.product-comparison .compare-table tr td .product-price .price {
  font-size: 16px;
  font-weight: 700;
  line-height: 30px;
  margin-right: 8px;
}
.product-comparison .compare-table tr td .product-price .price-before-discount {
  color: #D3D3D3;
  font-size: 14px;
  font-weight: 400;
  line-height: 30px;
  text-decoration: line-through;
}
.product-comparison .compare-table tr td .text {
  font-size: 14px;
  line-height: 22px;
}
.product-comparison .compare-table tr td .in-stock {
  font-size: 15px;
  font-weight: 700;
  margin-bottom: 0px;
}
.product-comparison .compare-table tr td .remove-icon {
  color: #666666;
}
.product-comparison .compare-table tr td .remove-icon:hover,
.product-comparison .compare-table tr td .remove-icon:focus {
  color: #ff6666;
}
.body-content .x-page .x-text h1 {
  font-family: 'Open Sans', sans-serif;
  font-size: 200px;
  font-weight:bold
}
.body-content .x-page .x-text p {
  font-size: 18px;
  font-style: normal;
  font-weight: normal;
}
.body-content .x-page .x-text .le-button {
  border-radius: 0 3px 3px 0;
  margin: 0 0 0 -5px;
  padding: 19px 23px 20px;
  font-size: 15px;
  font-weight: bold;
  line-height: 10px;
  border: medium none;
  color: #333;
  background:#fdd922
}
.body-content .x-page .x-text form input {
  border: 1px solid #e0e0e0;
  border-radius: 3px 0 0 3px;
  color: #3d3d3d;
  padding: 13px;
  font-size: 15px;
  width: 40%;
}
.body-content .x-page .x-text a {
  font-size: 15px;
}
.body-content .x-page .x-text a i {
  padding-right: 2px;
}

/*===================================================================================*/
/*  Terms and Condition/track orders/
/*===================================================================================*/

.terms-conditions-page {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
    overflow: hidden;
}

.body-content .terms-conditions-page .terms-conditions h2,
.body-content .faq-page h2,
.body-content .track-order-page h2 {
  font-size: 30px;
  text-transform: uppercase;
  color: #555;
  text-align: center;
  font-family: 'Open Sans', sans-serif;
}
.body-content .terms-conditions-page .terms-conditions h3 {
    font-size: 14px;
    text-transform: uppercase;
    color: #555;
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 30px;
    font-weight: bold;
}
.body-content .terms-conditions-page .terms-conditions ol {
  padding-left: 22px;
}
.body-content .terms-conditions-page .terms-conditions ol li {
  font-style: normal;
  font-size: 13px;
  color: #666;
  padding-bottom: 20px;
}
.body-content .terms-conditions-page .terms-conditions p {
  font-size: 15px;
}
.body-content .terms-conditions-page .terms-conditions h2,
.body-content .terms-conditions-page .terms-conditions span,
.body-content .track-order-page span {
  text-align: left;
}

.track-order-page {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
    overflow: hidden;
}

.product-comparison {
    background-color: #fff;
    
    
    overflow: hidden;
}

.faq-page {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
    overflow: hidden;
}

.faq-page .panel-group .panel {padding:0px; box-shadow:none}


.body-content .terms-conditions-page .terms-conditions span,
.body-content .faq-page .title-tag,
.body-content .track-order-page span {
  display: block;
  font-style: normal;
  font-size: 14px;
  color: #666;
}
.body-content .faq-page .title-tag {
  text-align: left;
  padding-bottom: 30px;
}
.body-content .track-order-page .register-form label {
  font-weight: 400;
  font-size: 14px;
}
.body-content .track-order-page .register-form .form-group {
  margin-bottom: 25px;
}


/*===================================================================================*/
/*  Wishlist
/*===================================================================================*/

.my-wishlist-page {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
    overflow: hidden;
}
.my-wishlist-page_new {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
    overflow: hidden;
}

.heading-title {
	text-align: left!important;
    text-transform: none!important;
    padding: 0px 0px 6px 0px!important;
    font-weight: bold!important;
    font-size: 22px!important;
    border-bottom: 1px <?php echo $setts[0]->site_primary_color;?> dashed !important;}

.body-content .my-wishlist-page .my-wishlist table > thead > tr > th {
  text-align: center;
  font-size: 30px;
  font-family: 'Open Sans', sans-serif;
  text-transform: uppercase;
  border: none;
  font-weight: 400;
}

.body-content .my-wishlist-page img {width:100%}
.body-content .my-wishlist-page .my-wishlist table tbody tr:nth-child(even) {
  border-top: 0px solid #ddd;
}
.body-content .my-wishlist-page .my-wishlist table tbody .product-name {
  font-size: 16px;
  font-family: 'Open Sans', sans-serif;
  padding-bottom: 6px;
}
.body-content .my-wishlist-page .my-wishlist table tbody .product-name a {
  color: #434343;
}
.body-content .my-wishlist-page .my-wishlist table tbody .rating span {
  font-size: 11px;
  color: #aaa;
  padding-left: 10px;
}
.body-content .my-wishlist-page .my-wishlist table tbody .rating .rate {
  color: #ffb400;
}
.body-content .my-wishlist-page .my-wishlist table tbody .rating .non-rate {
  color: #dcdcdc;
}
.body-content .my-wishlist-page .my-wishlist table tbody .price,.cart-product-quantity .price {
  font-size: 16px;
  padding-top: 4px;
  font-weight: bold;
}
.body-content .my-wishlist-page .my-wishlist table tbody .price span,.cart-product-quantity .price span {
  font-size: 15px;
  color: #ddd;
  text-decoration: line-through;
  
}
.body-content .my-wishlist-page .my-wishlist table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  vertical-align: middle;
  border: none;
  padding: 30px;
}
.body-content .my-wishlist-page .my-wishlist table tbody .close-btn a,
.body-content .my-wishlist-page .my-wishlist table tbody .close-btn a:hover {
  color: #ff7878;
  font-size: 15px;
}

/*===================================================================================*/
/*  Signup and login
/*===================================================================================*/

.sign-in-page {
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
    padding: 20px;
    overflow: hidden;
}

.body-content .sign-in-page .sign-in h4,
.body-content .sign-in-page .create-new-account h4 {
  font-size:18px;
  font-family: 'Open Sans', sans-serif;
  padding-bottom: 14px;
  border-bottom: 1px solid #ddd;

}
.body-content .sign-in-page .sign-in p,
.body-content .sign-in-page .create-new-account p {
  font-size: 15px;
  color: #666;
}
.body-content .sign-in-page .sign-in .social-sign-in a,
.body-content .sign-in-page .sign-in .social-sign-in a:hover,
.body-content .sign-in-page .sign-in .social-sign-in a:focus {
  border-radius: 3px;
  padding: 14px 30px;
  font-size: 15px;
  display: inline-block;
  color: #fff;
  text-align: center;
}
.body-content .sign-in-page .sign-in .social-sign-in a i {
  padding-right: 6px;
}
.body-content .sign-in-page .sign-in .social-sign-in .facebook-sign-in {
  background-color: #3d5c98;
  margin-right: 10px;
}
.body-content .sign-in-page .sign-in .social-sign-in .facebook-sign-in:hover,
.body-content .sign-in-page .sign-in .social-sign-in .facebook-sign-in:focus {
  background-color: #153470;
}
.body-content .sign-in-page .sign-in .social-sign-in .twitter-sign-in {
  background-color: #22aadf;
}
.body-content .sign-in-page .sign-in .social-sign-in .twitter-sign-in:hover,
.body-content .sign-in-page .sign-in .social-sign-in .twitter-sign-in:focus {
  background-color: #0084B9;
}
.body-content .sign-in-page .create-new-account > span {
  font-size: 20px;
  font-family: 'Open Sans', sans-serif;
  padding-bottom: 14px;
  text-transform: uppercase;
  display: inline-block;
}
.body-content .sign-in-page .create-new-account .checkbox label {
  margin-bottom: 10px;
  font-size: 16px;
}
.body-content .sign-in-page form .form-group span {
  color: red;
}
.body-content .sign-in-page .register-form label {
  font-size: 14px;
  font-weight: 400;
}
.body-content .sign-in-page .register-form .form-group {
  margin-bottom: 25px;
}

.tooltip.top {
    padding: 5px 0;
    margin-top: -5px;

}
.tooltip-inner {
font-family: 'Open Sans', sans-serif;
border-radius:2px;
min-width:70px;
z-index:10000


}

/*===================================================================================*/
/*  Testimonials
/*===================================================================================*/

.avatar  {margin-top:10px; text-align:center; overflow:hidden; margin-bottom:10px}
.avatar img  {border-radius:0px; margin-bottom:10px; width:auto; display:inline-block; width:110px }
.testimonials {color:#333;font-size:13px; margin-bottom:15px; letter-spacing:0.5px; text-align:center}
.clients_author {font-size:14px; font-weight:bold; color:#333;  letter-spacing:0.5px; display:block; text-align:center}
.clients_author span{font-size:13px; font-weight:normal; color:#999; display:block;}
.testimonials-section .bx-wrapper .bx-pager {padding-top: 30px;}
.testimonials-section .bx-wrapper {margin: 0 0 50px;}
.testimonials-section em {font-size:30px; font-style:normal; vertical-align:top; display:inline-block; line-height:5px; margin-top:15px;     font-family: Arial, Helvetica, sans-serif;}

/*===================================================================================*/
/*  LHS banners
/*===================================================================================*/

.home-banner {
    margin-top: 30px;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
	}




.categories-filter select
{
padding-left:5px;
}



.single-product-gallery-item img
{
max-height:375px !important;
min-width:345px !important;
margin:0 auto;
}


#owl-single-product-thumbnails img
{
min-height:75px !important;
width:100%;
}

.w90
{
width:90px;
}


.font10
{
font-size:10px !important;
}
.font11
{
font-size:11px !important;
}
.font12
{
font-size:12px !important;
}
.font13
{
font-size:13px !important;
}
.font14
{
font-size:14px !important;
}
.font15
{
font-size:15px !important;
}
.font16
{
font-size:16px !important;
}
.font17
{
font-size:17px !important;
}
.font18
{
font-size:18px !important;
}
.font19
{
font-size:19px !important;
}
.font20
{
font-size:20px !important;
}
.font21
{
font-size:21px !important;
}
.font22
{
font-size:22px !important;
}
.font23
{
font-size:23px !important;
}
.font24
{
font-size:24px !important;
}
.font25
{
font-size:25px !important;
}
.font26
{
font-size:26px !important;
}
.font27
{
font-size:27px !important;
}
.font28
{
font-size:28px !important;
}
.font29
{
font-size:29px !important;
}
.font30
{
font-size:30px !important;
}


.height5
{
height:5px !important;
}
.height10
{
height:10px !important;
}
.height20
{
height:20px !important;
}
.height30
{
height:30px !important;
}
.height40
{
height:40px !important;
}
.height50
{
height:50px !important;
}
.height60
{
height:60px !important;
}
.height70
{
height:70px !important;
}
.height80
{
height:80px !important;
}
.height90
{
height:90px !important;
}
.height100
{
height:100px !important;
}


input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {  

   opacity: 1;

}






/*************** PAGINATION *************/


.pagess {
	clear: both;
	float:right;
	
	display: inline;
}

.pagess ul {
	float: left;
}

.pagess ul li {
	float: left;
	display: inline;
	margin-right: 3px;
	text-transform:uppercase;
}

.pagess ul li a {
	padding: 3px 9px 2px;
	background:#22313F !important;
	color: #fff;
}

.pagess ul li.on a {
	background: #06C7AC !important;
	color: #fff;
}

.pagess ul li span span {
	    color: #fff;
    padding: 10px 10px 6px 10px;
    background: #454545;
   
    position: relative;
    top: 5px;
}









.grid_prodss {
	clear: both;
	float:right;
	
	display: inline;
}

.grid_prodss ul {
	float: left;
}

.grid_prodss ul li {
	float: left;
	display: inline;
	margin-right: 3px;
	text-transform:uppercase;
}

.grid_prodss ul li a {
	padding: 10px 10px 6px 10px;
	background:#22313F !important;
	color: #fff;
	position: relative;
    top: 5px;
}

.grid_prodss ul li.on a {
	background: <?php echo $setts[0]->site_button_color;?> !important;
	color: #fff;
}

.grid_prodss ul li span span {
	    color: #fff;
    padding: 10px 10px 6px 10px;
    background: #454545;
   
    position: relative;
    top: 5px;
}









.list_prodss {
	clear: both;
	float:right;
	
	display: inline;
}

.list_prodss ul {
	float: left;
}

.list_prodss ul li {
	float: left;
	display: inline;
	margin-right: 3px;
	text-transform:uppercase;
}

.list_prodss ul li a {
	padding: 3px 9px 2px;
	background:#22313F !important;
	color: #fff;
}

.list_prodss ul li.on a {
	background: #06C7AC !important;
	color: #fff;
}

.list_prodss ul li span span {
	    color: #fff;
    padding: 10px 10px 6px 10px;
    background: #454545;
   
    position: relative;
    top: 5px;
}






.grid_page {
	clear: both;
	float:right;
	
	display: inline;
}

.grid_page ul {
	float: left;
}

.grid_page ul li {
	float: left;
	display: inline;
	margin-right: 3px;
	text-transform:uppercase;
}

.grid_page ul li a {
	padding: 3px 9px 2px;
	background:#22313F !important;
	color: #fff;
}

.grid_page ul li.on a {
	background: #06C7AC !important;
	color: #fff;
}

.grid_page ul li span span {
	    color: #fff;
    padding: 10px 10px 6px 10px;
    background: #454545;
   
    position: relative;
    top: 5px;
}



/**************** END PAGINATION ***************/




.img_responsive
{
width:100%;
max-width:120px;
}


.clearfix
{
clear:both;
}


.fontnromal
{
font-weight:normal;
}




.dropdown-menu .submenu_new:hover .dropdown-menu {
    display: block;
	left:-160px !important;
	top:135px !important;
	position:absolute !important;
	float:left !important;
    
 }



.wallet_border
{
border:1px solid #DDDDDD;
min-height:200px;
vertical-align:middle;

}
.review_bottom
{
vertical-align:middle;
margin-top:70px;
margin-bottom:70px;
}

.review_bottom_two
{
vertical-align:middle;
margin-top:70px;
margin-bottom:70px;
}


.newfonts
{
font-size:17px;
}


.fontsize17
{
font-size:17px;
font-weight:600;
}



.fontsize18
{
font-size:18px;
}


.fontsize19
{
font-size:19px;
line-height:30px;
}
.fontsize35
{
font-size:35px;
}

.fontsize20
{
font-size:20px;
}
.fontsize11
{
font-size:11px;
}
.fontsize24
{
font-size:24px;
}

.fontsize13
{
font-size:13px;
}

.fontsize14
{
font-size:14px;
}

.fontsize15
{
font-size:15px;
}

.bold
{
font-weight:bold;
}

.btn_color
{
color:<?php echo $setts[0]->site_button_color;?>;
}


.min_with
{
font-size:25px;
}



.radio-label
{
margin-left:5px;
top:-3px;
position:relative;
}

.mtop10
{
margin-top:10px;
}


.page_banner
{
max-height: 450px;
    min-height: 450px;
    width: 100%;
    object-fit: cover;
    
}

.blog_responsive
{
width: 100%;
    object-fit: cover;
	max-height: 450px;
    min-height: 450px;
}


.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}


.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

p.review-icon {
    margin: 0;
}


.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}





/* MP3 PLAYER */





.mediPlayer .control {
    opacity        : 0; /* transition: opacity .2s linear; */
    pointer-events : none;
    cursor         : pointer;
}

.mediPlayer .not-started .play, .mediPlayer .paused .play {
    opacity : 1;

}

.mediPlayer .playing .pause {
    opacity : 1;

}

.mediPlayer .playing .play {
    opacity : 0;
}

.mediPlayer .ended .stop {
    opacity        : 1;
    pointer-events : none;
}

.mediPlayer .precache-bar .done {
    opacity : 0;
}

.mediPlayer .not-started .progress-bar, .mediPlayer .ended .progress-bar {
    display : none;
}

.mediPlayer .ended .progress-track {
    stroke-opacity : 1;
}

.mediPlayer .progress-bar,
.mediPlayer .precache-bar {
    transition        : stroke-dashoffset 500ms;

    stroke-dasharray  : 298.1371428256714;
    stroke-dashoffset : 298.1371428256714;
}



/* MP3 PLAYER */



.compare_heading a
{
white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis !important;
	font-size:21px;
}

.contactus i
{
font-size:16px;
margin-right:5px;
}



.sidehead
{
font-size:17px;
white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis;
	
}
.under_line
{
text-decoration:underline;
}
.blog-recent-post figure
{
margin-top:15px;
}
.blogpage .fa
{
font-size:20px;
margin-right:5px;
}

.mbottom40
{
margin-bottom:40px;
}
.embed-container {
    position: relative;
    overflow: hidden;
	background:#ddd;
}

.embed-container iframe, .embed-container object, .embed-container embed {
    width: 100%;
    min-height: 350px;
}
.paddingoff
{
padding:0px;
}

.marB30
{
margin-bottom:30px;
}

.marB20
{
margin-bottom:20px;
}



.marT10
{
margin-top:10px !important;

}
.marT20
{
margin-top:20px !important;
}
.marT30
{
margin-top:30px !important;
}
.marT40
{
margin-top:40px !important;
}
.marT50
{
margin-top:50px !important;
}
.marT60
{
margin-top:60px !important;
}
.marT70
{
margin-top:70px !important;
}



.cmd_thumb
{
width:100%;
max-width:80px;
}


/* my profile */



.fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
}

.fb-image-profile
{
    margin: -90px 10px 20px 80px;
    z-index: 9;
    width: 13%;
}





/* my profile */










.widget-products li>a:after {
    content: "\f07a";
    font-family: FontAwesome;
    font-size: 0.875em;
    font-style: normal;
    font-weight: normal;
    margin-top: 32px;
    position: absolute;
    right: 10px;
    text-decoration: inherit;
    top: 0;
    color: #FCB800 !important;
    font-size: 1.3em;
	
}

.widget-todo .name {
    float: left;
}
.widget-todo>li {
    border-bottom: 1px solid #ebebeb;
    padding: 10px 5px;
}
.widget-todo {
    list-style: none;
    margin: 0;
    padding: 0;
}
.widget-products li .product>.warranty>i {
    color: #f1c40f;
}
.widget-products li .product>.warranty {
    display: block;
    text-decoration: none;
    width: 50%;
    float: left;
    font-size: 0.875em;
}
.widget-products li .product>.price>i {
    color: #2ecc71;
}
.widget-products li .product>.price {
    display: block;
    text-decoration: none;
    width: 50%;
    float: left;
    font-size: 0.875em;
}
.widget-products li .product>.name {
    display: block;
    font-weight: 600;
    padding-bottom: 7px;
}
.widget-products li .product {
    display: block;
    margin-left: 90px;
    margin-top: 2px;
}
.widget-products li .img {
    display: block;
    float: left;
    text-align: center;
    width: 70px;
    height: 68px;
    overflow: hidden;
    margin-top: 7px;
}
.widget-products li>a {
    height: 88px;
    display: block;
    width: 100%;
    color: #666;
    padding: 3px 10px;
    position: relative;
    -webkit-transition: border-color 0.1s ease-in-out 0s,background-color 0.1s ease-in-out 0s;
    transition: border-color 0.1s ease-in-out 0s,background-color 0.1s ease-in-out 0s;
}
.widget-products li {
    border-bottom: 1px solid #ebebeb;
	clear:both;
}
.widget-products {
    list-style: none;
    margin: 0;
    padding: 0;
}



.img-thumbnail
{
border:none;
}


.single.contact-info li .icon {
   
    float: left;
   
    
}

.fontsize15
{
font-size:12px;
}
.product-info
{
min-height:90px;
}

.media-body
{
color:#ddd;
}

.link li
{
display:inline-block;
list-style:none;
}

.social a i
{
/*font-size:17px;*/
}
.social a
{
color:#ddd;
margin-left:5px;
margin-right:5px;
border:1px solid #ddd;
width:30px !important;
height:30px !important;
padding:5px;
}
.fa-inverse
{
color:#ddd;
}

.media, .media .media
{
margin-top:0px;
}



.footertxt
{
color:#ddd;
}

.ffleft
{
float:left;
}












/* compare */

.ptsBlock,.ptsEl{position:relative}.ptsEl,.ptsElImg,.ptsElInput,.ptsInputShell{display:inline-block}.ptsCol,.ptsTableAlign_left.ptsBlock{float:left}.ptsBlock{background-color:transparent}.ptsBlock,.ptsBlock *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;line-height:initial;margin:initial;padding:initial;vertical-align:initial;outline:initial;text-align:inherit}.ptsBlock p{text-align:inherit}.glyphicon-spin{-webkit-animation:spin 1s infinite linear;animation:spin 1s infinite linear}@-webkit-keyframes spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}@keyframes spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}.ptsShowSmooth{visibility:hidden;opacity:0;transition:visibility 0s linear .2s,opacity .2s linear}.ptsShowSmooth.active{visibility:visible;opacity:1;transition-delay:0s;z-index: 10000;}.ptsEl{min-width:15px}.ptsElImg img{width:100%;height:auto}.ptsElOverlay{position:absolute;width:100%;height:100%;top:0;left:0;display:none}.ptsCell,.ptsCol .ptsElArea{position:relative}.ptsBlockContent .ptsCol .ptsColDesc,.ptsBlockContent .ptsCol .ptsColFooter,.ptsBlockContent .ptsCol .ptsColHeader,.ptsBlockContent .ptsCol .ptsRows .ptsCell{text-align:center}.ptsBlock.ptsAlign_left .ptsBlockContent .ptsCol .ptsColDesc,.ptsBlock.ptsAlign_left .ptsBlockContent .ptsCol .ptsColFooter,.ptsBlock.ptsAlign_left .ptsBlockContent .ptsCol .ptsColHeader,.ptsBlock.ptsAlign_left .ptsBlockContent .ptsCol .ptsRows .ptsCell,.ptsBlock.ptsAlign_left p{text-align:left}.ptsBlock.ptsAlign_right .ptsBlockContent .ptsCol .ptsColDesc,.ptsBlock.ptsAlign_right .ptsBlockContent .ptsCol .ptsColFooter,.ptsBlock.ptsAlign_right .ptsBlockContent .ptsCol .ptsColHeader,.ptsBlock.ptsAlign_right .ptsBlockContent .ptsCol .ptsRows .ptsCell,.ptsBlock.ptsAlign_right p{text-align:right}.ptsBlock.ptsAlign_center .ptsBlockContent .ptsCol .ptsColDesc,.ptsBlock.ptsAlign_center .ptsBlockContent .ptsCol .ptsColFooter,.ptsBlock.ptsAlign_center .ptsBlockContent .ptsCol .ptsColHeader,.ptsBlock.ptsAlign_center .ptsBlockContent .ptsCol .ptsRows .ptsCell,.ptsBlock.ptsAlign_center p,.ptsContainer{text-align:center}.ptsContainer{clear:both}.ptsColBadge{position:absolute;z-index:1002;top:0;overflow:hidden}.ptsColBadgeContent{padding:5px 10px;margin:0 auto;display:inline-block;text-align:center;white-space:nowrap}.ptsColBadge.ptsColBadge-left .ptsColBadgeContent{transform:rotate(-90deg);border-bottom-left-radius:5px;transform-origin:left top}.ptsColBadge.ptsColBadge-left-top .ptsColBadgeContent{transform:rotate(-45deg);transform-origin:center bottom}.ptsColBadge.ptsColBadge-right-top .ptsColBadgeContent{transform:rotate(45deg);transform-origin:center bottom}.ptsColBadge.ptsColBadge-right .ptsColBadgeContent{transform:rotate(90deg);border-bottom-right-radius:5px;transform-origin:right top}.ptsColBadge.ptsColBadge-top .ptsColBadgeContent{border-bottom-left-radius:5px;border-bottom-right-radius:5px}.ptsColBadge.ptsColBadge-top{width:100%}.ptsColBadge.ptsColBadge-left,.ptsColBadge.ptsColBadge-left-top{left:0}.ptsColBadge.ptsColBadge-right,.ptsColBadge.ptsColBadge-right-top{right:0}.ptsBlock [data-icon]:before,.ptsElInput [data-icon]:before,.ptsElInput[data-icon]:before{content:none}.ptsTableAlign_right.ptsBlock{float:right}.ptsTableAlign_center.ptsBlock{margin:0 auto}.ptsBlock .ptsBlockContent .ptsCol .ptsRows .ptsCell.ptsCellAlignLeft{text-align:left}.ptsBlock .ptsBlockContent .ptsCol .ptsRows .ptsCell.ptsCellAlignCenter{text-align:center}.ptsBlock .ptsBlockContent .ptsCol .ptsRows .ptsCell.ptsCellAlignRight{text-align:right} .ptsContainer *{border:none;white-space:normal;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;-o-box-sizing:border-box;box-sizing:border-box}.ptsSwitchWrapper{float:left;width:100%;height:auto}.ptsSwitchContent{float:none;vertical-align:middle;position:relative;border-radius:35px;-moz-border-radius:35px;-webkit-border-radius:35px;-o-border-radius:35px;height:54px;display:inline-block;background:#FFF;min-width:350px;width:auto;text-align:center}.ptsSwitchButton,.ptsSwitchButtonBackground{cursor:pointer!important;top:3px;font-size:20px;font-weight:700;float:left;width:50%;height:46px;line-height:46px}.ptsSwitchButton{position:relative;z-index:1}.ptsSwitchButton.selected{border-radius:22px;-webkit-border-radius:22px;-moz-border-radius:22px;-o-border-radius:22px}.ptsSwitchButtonBackground{letter-spacing:normal!important;outline:0;text-decoration:none;text-transform:none;position:absolute!important;border-radius:22px;-webkit-border-radius:22px;-moz-border-radius:22px;-o-border-radius:22px;z-index:0!important;transition:left ease-in-out .4s;-moz-transition:left ease-in-out .4s;-webkit-transition:left ease-in-out .4s;-o-transition:left ease-in-out .4s;color:#FFF;left:.7%}.ptsSwitchWrapper input[type=radio]:checked:before{width: 6px!important; } .ptsBlock .ptsCell .ptsEl{	visibility: visible !important;}
.ptsToggle > div{
    visibility: visible!important;
}
.ptsShowSmooth{
    display: none;
}
.ptsBlockMobile .ptsSwitchWrapper .ptsSwitchContent{
    min-width: 250px;
    max-width: 300px;
}
.ptsBlockMobile .ptsSwitchWrapper .ptsSwitchButton{
    font-size: 14px;
}
.supsystic-content #ptsCanvas .ptsShowSmooth{
    display: inline-block;
}
.ptsSwitchWrapper .ptsSwitchButton {
    overflow: hidden;
    max-width: 300px;
}


#ptsBlock_535808 .ptsCell {
    padding: 15px 5px;
    border: 1px solid transparent;
    border-bottom-color: #dcdcdc;
}




#ptsBlock_535808 .ptsCol .ptsTableElementContent,
#ptsBlock_535808 .ptsCol .ptsTableElementContent span {
  transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
}

#ptsBlock_535808 .ptsCol.hover .ptsTableElementContent {
  z-index: 101;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

#ptsBlock_535808 .ptsTableElementContent {
    background: #fff;
    border: solid 1px #e1e1e1;
    border-bottom: solid 2px #dcdcdc;
    border-top-width: 2px;
 }

#ptsBlock_535808 .ptsColHeader .ptsElImg, #ptsBlock_535808  .ptsColHeader .ptsElImg .ptsElArea {
  height: 100%;
}

#ptsBlock_535808 .ptsColHeader .ptsElImg img {
    width: 100%;
  height: 100%;
}

#ptsBlock_535808 .ptsColDesc span, #ptsBlock_535808  .ptsColDesc p {
    text-align: center;
    font-size: 22px;
    color: #9d9d9d;
    
}

#ptsBlock_535808 .ptsCell span, #ptsBlock_535808  .ptsCell p {
  text-align: center;
  
}

#ptsBlock_535808 .ptsCell .ptsActBtn a {
    color: #fff;
    padding: 5px 19px;
    display: inline-block;
    margin: -5px -18px;
    font-size: 12px;
    border-radius: 4px;
  	text-decoration: blink;
}

#ptsBlock_535808 .ptsCell .ptsActBtn {
    text-align: center;
}

#ptsBlock_535808 .ptsColFooter .ptsActBtn a {
    color: #fff;
    font-size: 14px;
    border-radius: 4px;
    margin: 0 5px;
   	padding: 7px 13px 7px;
  	text-decoration: blink;
}

#ptsBlock_535808 .ptsColFooter a, .ptsColFooter p {
    text-align: center;
}

#ptsBlock_535808 .ptsColFooter .ptsActBtn {
  text-align: center;
}

#ptsBlock_535808 .ptsCell {
    padding: 15px 5px;
    border: 1px solid transparent;
    border-bottom-color: #dcdcdc;
}

#ptsBlock_535808 .ptsColDesc {
    border-bottom: 1px solid #dcdcdc;
    padding: 25px 20px;
}

#ptsBlock_535808 .ptsColFooter .ptsEl {
    display: block;
    margin: 0px 0 10px 0px;
}

#ptsBlock_535808 .ptsColFooter {
	padding: 10px 0 5px 0px;
    box-sizing: border-box;
}

#ptsBlock_535808 .ptsColFooter .ptsEl {
    display: block;
    margin: 0px 0  10px 0px;
}

#ptsBlock_535808 .ptsColFooter .ptsWpWhiteList > div {
    display: inline-block !important;
}

#ptsBlock_535808 .ptsColFooter .ptsWpWhiteList .ptsIcon .fa {
    font-size: 14px;
}

#ptsBlock_535808 .ptsCell .ptsEl[data-type="txt"] {
    display: block;
}

#ptsBlock_535808 .ptsCell .ptsElImg img {
    display: inline-block;
    width: 100%;
}

#ptsBlock_535808 .ptsWpWhiteList > div {
    display: inline-block !important;
}

#ptsBlock_535808 .ptsWpWhiteList .ptsIcon .fa {
    font-size: 14px;
}

#ptsBlock_535808 .ptsTableDescCol .ptsTableElementContent {
    background-color: #f0f0f0;
}

#ptsBlock_535808 .ptsTableDescCol .ptsColDesc {
    border-top: 1px solid #dcdcdc;
}

#ptsBlock_535808 .ptsTableDescCol .ptsCoDesc span {
    font-size: 14px;
}

#ptsBlock_535808 .ptsTableDescCol .ptsColDesc, #ptsBlock_535808  .ptsTableDescCol .ptsCell,
#ptsBlock_535808  .ptsTableDescCol .ptsCell span, #ptsBlock_535808  .ptsTableDescCol .ptsCell p{
	text-align: right !important;
}

#ptsBlock_535808 .ptsTableDescCol .ptsCell span, #ptsBlock_535808  .ptsTableDescCol .ptsCell p {
	padding-right: 10px;
}

#ptsBlock_535808 .ptsTableDescCol .ptsColDesc span, #ptsBlock_535808  .ptsTableDescCol .ptsColDesc p {
	
  
  	color: <?php echo $setts[0]->site_primary_color;?>;
}

.parahead p
{
color: <?php echo $setts[0]->site_primary_color;?> !important;
}


#ptsBlock_535808 {
    width: 100%;
  }



#ptsBlock_535808 p {
  margin: 0;
}

#ptsBlock_535808 a {
  text-decoration: blink;
}

#ptsBlock_535808 .ptsCol {
            width: 100%;
      }
	  
	  
	  .greenstock
	  {
	  color:#006600 !important;
	  }
	  .redstock
	  {
	  color:#FF0000 !important;
	  }
	  
	  
	  
	  .nodata
	  {
	  font-size:30px;
	  line-height:30px;
	  margin-top:100px;
	  margin-bottom:100px;
	  text-align:center;
	  }
	  
	  
	  .tag_text
	  {
	  color:<?php echo $setts[0]->site_button_color;?>;
	  }


.cart-product-description
{
line-height:25px;
}


.cart-shopping-total label
{
text-align:left !important;
float:left;
color: <?php echo $setts[0]->site_primary_color;?> !important;

}



.left-banner-title
{
position:absolute;
z-index:999;



    
	top:10px;
	
   
}
.left-banner-title h3
{
color:#FFFFFF;

font-weight:600;
margin-left:10px;
}

.left-banner-title p
{
color: <?php echo $setts[0]->site_button_color;?> !important;
margin-left:10px;
padding-bottom:10px;
}

.left-banner-title a
{
color:#fff;
margin-left:10px;
border:2px solid #ffffff;
border-radius:50px;
padding:6px 15px 6px 15px;


font-size:17px;
}
.left-banner-title a:hover
{
border:2px solid <?php echo $setts[0]->site_button_color;?>;
color:<?php echo $setts[0]->site_button_color;?>;
}

.wide-banner .image img
{
    width: 100%;
    min-height: 180px;
    object-fit: cover;
}

.hbanner
{
margin-bottom:30px;
}

.hbanner img
{
width: 100%;
   
    object-fit: cover;
}
.mbottom30
{
margin-bottom:30px;
}

.ficon i
{
font-size:30px;
margin-top:2px;
}


.error-text color-light
{
font-size:18px !important;
}




.mobilemenu
{
padding-left:20px !important;
}

.mobilemenu li a
{
font-size:16px;
color:#fff;

}
.mobilemenu li
{
line-height:35px;
}

#m_nav_menu
{
z-index:99999 !important;
}


#m_nav_container {
 background-color: <?php echo $setts[0]->site_primary_color;?>;
}

.mobilemenu .navbar-nav .open a{
    float: none;
	background:none !important;
	color:<?php echo $setts[0]->site_button_color;?> !important;
	border-radius:3px 3px 0px 0px;
}


.red
{
color:red;
}
</style>    
