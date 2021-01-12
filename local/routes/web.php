<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('setlocale/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);
  }
  return redirect()->back();
});

Route::get('/confirmemail/{id}', 'IndexController@confirmation');

Route::get('/confirmemail', 'IndexController@view_former');


Route::get('/resend/{email_address}', 'IndexController@resend_email');



Route::get('importExport', 'ImportExportController@importExport');
Route::get('downloadExcel/{type}', 'ImportExportController@downloadExcel');
Route::post('importExcel', 'ImportExportController@importExcel');





Route::get('/', 'IndexController@avigher_index');
Route::get('/index', 'IndexController@avigher_index');
/*Route::post('/index', ['as'=>'index','uses'=>'IndexController@avigher_subscribe']);*/
Route::get('/thankyou/{id}', 'IndexController@newsletter_activate');





/************* BLOG ***************/
Route::get('/blog', 'BlogController@avigher_index');
Route::get('/blog/{id}', 'BlogController@avigher_singlepost');
Route::post('/blog', ['as'=>'blog','uses'=>'BlogController@avigher_blog_comment']);


Route::get('/gallery', 'GalleryController@avigher_gallery');

/************ END BLOG *************/




/****************** PRODUCT **********/


Route::get('/product/{prod_id}/{prod_slug}', 'CategoryController@avigher_product_details');
Route::post('/product', ['as'=>'product','uses'=>'ProductController@avigher_cart']);


/****************** End PRODUCT **********/



/************* CART ************/

Route::get('/cart', 'CartController@avigher_view_cart');
Route::get('/cart/{token}', 'CartController@avigher_remove_cart');
Route::post('/checkout', ['as'=>'checkout','uses'=>'CheckoutController@avigher_update_cart']);
/*********** END CART ************/



/********** CHECKOUT **********/

Route::get('/checkout', 'CheckoutController@avigher_view_no_checkout');

/************* END CHECKOUT *********/


/*********** PAYMENT DETAILS **********/


Route::post('/payment-details', ['as'=>'payment-details','uses'=>'PaymentController@avigher_checkout_details']);


Route::post('/razorpay_verify', ['as'=>'razorpay_verify','uses'=>'RazorpayController@avigher_razorpay']);
Route::get('/razorpay-success/{razor_id}', 'RazorpayController@avigher_view_razorpay');
/************* PAYMENT DETAILS *********/




/********** MY PROFILE *********/


Route::get('/profile/{user_id}/{user_slug}', 'DashboardController@avigher_my_profile');

Route::post('/profile', ['as'=>'profile','uses'=>'DashboardController@avigher_contact_vendor']);

/************* MY PROFILE *********/




Route::get('/my-product', 'ProductController@avigher_product');
Route::get('/my-product/{token}', 'ProductController@avigher_product_delete');
Route::get('/add-product', 'ProductController@avigher_add_form');
Route::post('/add-product', ['as'=>'add-product','uses'=>'ProductController@avigher_add_product']);
Route::get('/edit-product/{token}', 'ProductController@avigher_edit_product');
Route::get('/edit-product/{delete}/{id}/{photo}', 'ProductController@avigher_delete_photo');
Route::post('/edit-product', ['as'=>'edit-product','uses'=>'ProductController@avigher_edit_data']);
/****************** END PRODUCT **********/




/************* SHOP ***********/
Route::get('/shop', 'CategoryController@avigher_all_category');
Route::get('/shop/{type}/{id}/{slug}', 'CategoryController@avigher_category');
Route::get('/shop/{pager}', 'CategoryController@avigher_pager_category');

Route::get('/shop/{sort}/{type}', 'CategoryController@avigher_sort_category');
Route::post('/shop', ['as'=>'shop','uses'=>'CategoryController@avigher_search_data']);


/************ SHOP ***********/




/********* WISHLIST ************/


Route::get('/wishlist/{log_id}/{prod_token}', 'ProductController@avigher_wishlist');
Route::get('/my-wishlist', 'ProductController@avigher_view_wishlist');
Route::get('/my-wishlist/{prod_token}', 'ProductController@avigher_wishlist_delete');



/************** WISHLIST ***********/

Route::get('/compare/{id}', 'ProductController@avigher_view_compare');

Route::get('/compare', 'ProductController@avigher_compare');

/********** COMPARE ********/



/****** COMPARE **********/





/************ WALLET ************/


Route::get('/my-balance', 'WalletController@avigher_my_balance');
Route::post('/my-balance', ['as'=>'my-balance','uses'=>'WalletController@avigher_balance_data']);

/************ WALLET ********/






/* attribute type */
	
	Route::get('/attribute-type','AttributeController@attribute_type_index');
	Route::get('/add-attribute-type','AttributeController@formview');
	Route::post('/add-attribute-type', ['as'=>'add-attribute-type','uses'=>'AttributeController@attribute_type_data']);
	Route::get('/attribute-type/{id}','AttributeController@deleted');
	Route::get('/edit-attribute-type/{id}','AttributeController@showform');
	Route::post('/edit-attribute-type', ['as'=>'edit-attribute-type','uses'=>'AttributeController@edit_attribute_type']);
	/*Route::get('/admin/attribute_type/{action}/{id}/{status}','Admin\AttributeController@status');*/
	
	/* attribute type */
	
	
    /* attribute value */

    Route::get('/attribute-value','AttributeController@attribute_value_index');
	Route::get('/add-attribute-value','AttributeController@formview_value');
	Route::post('/add-attribute-value', ['as'=>'add-attribute-value','uses'=>'AttributeController@attribute_value_data']);
	
	Route::get('/attribute-value/{id}','AttributeController@value_deleted');
	
	
	Route::get('/edit-attribute-value/{id}','AttributeController@edit_showform');
	Route::post('/edit-attribute-value', ['as'=>'edit-attribute-value','uses'=>'AttributeController@edit_attribute_value']);

    /* attribute value */








/************ SEARCH *************/

Route::get('/search', 'SearchController@avigher_get_search');
Route::get('/search/{type}', 'SearchController@avigher_all_seller');

Route::get('/search/{id}/{slug}', 'SearchController@avigher_view_search');
Route::post('/index', ['as'=>'index','uses'=>'SearchController@avigher_search']);

Route::post('/search', ['as'=>'search','uses'=>'SearchController@avigher_advanced_search']);
/************ END SEARCH ************/



/************ SHOP ************/

Route::get('/seller', 'ProfileController@avigher_view_shop');
Route::get('/seller/{id}/{slug}', 'ProfileController@avigher_singleshop');

Route::post('/seller', ['as'=>'seller','uses'=>'ProfileController@avigher_shop_comment']);
Route::post('/contact_seller', ['as'=>'contact_seller','uses'=>'ProfileController@avigher_contact_seller']);


Route::get('/vendors', 'IndexController@avigher_all_vendors');

/*********** END SHOP *********/


/*********** BOOKING **********/

Route::get('/booking/{shop_id}/{service_id}/{user_id}', 'BookingController@avigher_booking');
Route::post('/booking', ['as'=>'booking','uses'=>'BookingController@avigher_bookingdata']);
/********** BOOKING *********/


/* MY ORDERS */

/*Route::get('/my_orders', 'MyhistoryController@avigher_view_myorders');
Route::get('/my-balance', 'MyhistoryController@avigher_view_mybalance');
Route::post('/my-balance', ['as'=>'my-balance','uses'=>'MyhistoryController@avigher_balance_data']);*/
/* END MY ORDERS */



/* MY SHOPPING */

Route::get('/my-shopping', 'MyhistoryController@avigher_view_myshopping');
Route::get('/view-shopping/{token}', 'MyhistoryController@avigher_myshopping');
Route::post('/view-shopping', ['as'=>'view-shopping','uses'=>'MyhistoryController@avigher_review_data']);

/* END MY SHOPPING */


/* MY ORDERS */

Route::get('/my-orders', 'MyhistoryController@avigher_view_myorders');

Route::get('/view-orders/{ord_id}/{user_id}', 'MyhistoryController@avigher_view_orderdetails');

/* END MY ORDERS */






/************** CHECKOUT ***************/

/*Route::get('/checkout', 'BookingController@avigher_checkout');

Route::post('/checkout', ['as'=>'checkout','uses'=>'BookingController@avigher_submit_checkout']);*/


Route::get('/success/{cid}', 'SuccessController@paypal_success');



Route::post('/stripe_shop_success', ['as'=>'stripe_shop_success','uses'=>'StripeController@avigher_shop_stripe']);


Route::get('/bank_payment/{token}/{book_id}', 'BookingController@avigher_bank_details');

Route::post('/bank_payment', ['as'=>'bank_payment','uses'=>'BookingController@avigher_bank_submit']);



Route::post('/ccavResponseHandler', ['as'=>'ccavResponseHandler','uses'=>'CcavenueController@avigher_ccavenue_success']);

Route::post('/ccavRequestHandler', ['as'=>'ccavRequestHandler','uses'=>'CcavenueController@avigher_shop_ccavenue']);


/************** CHECKOUT ***********/







/**************** SOCIAL LOGIN ***************/



Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');




/**************** SOCIAL LOGIN ***************/



/************** TAGS ***************/

Route::get('/tag/{type}/{id}', 'TagController@avigher_tag');



/************* END TAGS ***************/





/************** DASHBOARD **********/


Route::get('/logout', 'DashboardController@avigher_logout');
Route::get('/delete-account', 'DashboardController@avigher_deleteaccount');
Route::post('/dashboard', ['as'=>'dashboard','uses'=>'DashboardController@avigher_edituserdata']);

/*********** END DASHBOARD ************/






Route::get('/cancel', 'CancelController@avigher_showpage');

Route::get('/shop_success/{cid}', 'SuccessController@avigher_shop_success');

Route::get('/cash-on-delivery', 'CashondeliveryController@avigher_showpage');

Route::post('/cash-on-delivery', ['as'=>'cash-on-delivery','uses'=>'CashondeliveryController@avigher_success']);




Auth::routes();

	
	Route::get('/about-us','PageController@avigher_about_us');
	
	Route::get('/page/{id}/{slug}','PageController@avigher_viewpage');
	
	Route::get('/support','PageController@avigher_support');
	
	Route::get('/faq','PageController@avigher_faq');
	
	Route::get('/terms-of-use','PageController@avigher_terms');
	
	Route::get('/privacy-policy','PageController@avigher_privacy');
	
	
	
	Route::get('/404','PageController@avigher_404');
	
	
	/******** Forgot Password *********/
	
	
	Route::get('/forgot-password','ForgotpasswordController@avigher_forgot_view');
	Route::post('/forgot-password', ['as'=>'forgot-password','uses'=>'ForgotpasswordController@avigher_forgot_password']);
	
	
	/************* End Forgot Password **********/
	
	
	/************** Reset Password ***********/
	
	
	
	Route::get('/reset-password/{id}', 'ResetpasswordController@avigher_reset_view');
	
	Route::post('/reset-password', ['as'=>'reset-password','uses'=>'ResetpasswordController@avigher_reset_password']);
	/************** End Reset Password *************/
	
	
	
	
	Route::get('/contact-us','PageController@avigher_contact');
	
	Route::post('/contact-us', ['as'=>'contact-us','uses'=>'PageController@avigher_mailsend']);
	
	
	
	
	
	
	
	
	Route::post('/payment', ['as'=>'payment','uses'=>'PageController@avigher_donate_payment']);
	
	
	



/************* SHOP ***************/



Route::get('/myshop','ShopController@index');

Route::post('/myshop', ['as'=>'myshop','uses'=>'ShopController@avigher_savedata']);

Route::get('/myshop/{delete}/{id}/{photo}','ShopController@avigher_delete_photo');
/************ END SHOP ***********/



/***************** MY SERVICES **************/


Route::get('/myservices','ShopController@myservice_index');
Route::get('/myservices/{id}','ShopController@avigher_editdata');
Route::post('/myservices', ['as'=>'myservices','uses'=>'ShopController@avigher_servicedatas']);
Route::get('/myservices/{id}/delete','ShopController@avigher_service_destroy');

/**************** END MY SERVICES **********************/







/* Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function() {*/

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin','Admin\DashboardController@index');
    Route::get('/admin/index','Admin\DashboardController@index');
	
	/* user */
	Route::get('/admin/users','Admin\UsersController@index');
	Route::get('/admin/vendors','Admin\UsersController@vendor_index');
	Route::get('/admin/adduser','Admin\AdduserController@formview');
	Route::post('/admin/adduser', ['as'=>'admin.adduser','uses'=>'Admin\AdduserController@adduserdata']);
    
	Route::get('/admin/users/{id}','Admin\UsersController@destroy');
	Route::get('/admin/edituser/{id}','Admin\EdituserController@showform');
	Route::post('/admin/edituser', ['as'=>'admin.edituser','uses'=>'Admin\EdituserController@edituserdata']);
	Route::post('/admin/users', ['as'=>'admin.users','uses'=>'Admin\UsersController@delete_all']);
	/* end user */
	
	
	
	
	/* category */
	Route::get('/admin/category','Admin\CategoryController@index');
	Route::get('/admin/addcategory','Admin\AddcategoryController@formview');
	Route::post('/admin/addcategory', ['as'=>'admin.addcategory','uses'=>'Admin\AddcategoryController@addcategorydata']);
	Route::get('/admin/category/{id}','Admin\CategoryController@destroy');
	Route::get('/admin/editcategory/{id}','Admin\EditcategoryController@showform');
	Route::post('/admin/editcategory', ['as'=>'admin.editcategory','uses'=>'Admin\EditcategoryController@editcategorydata']);
	Route::post('/admin/category', ['as'=>'admin.category','uses'=>'Admin\CategoryController@delete_all']);
	/* end category */
	
	
	/* sub category */
	
	Route::get('/admin/subcategory','Admin\SubcategoryController@index');
	Route::get('/admin/addsubcategory','Admin\AddsubcategoryController@formview');
	Route::get('/admin/addsubcategory','Admin\AddsubcategoryController@getcategory');
	Route::post('/admin/addsubcategory', ['as'=>'admin.addsubcategory','uses'=>'Admin\AddsubcategoryController@addsubcategorydata']);
	Route::get('/admin/subcategory/{id}','Admin\SubcategoryController@destroy');
	
	
	
	Route::get('/admin/editsubcategory/{id}','Admin\EditsubcategoryController@edit');
	
	Route::post('/admin/editsubcategory', ['as'=>'admin.editsubcategory','uses'=>'Admin\EditsubcategoryController@editsubcategorydata']);
	Route::post('/admin/subcategory', ['as'=>'admin.subcategory','uses'=>'Admin\SubcategoryController@delete_all']);
	/* end sub category */
	
	
		
	/* Blogs */
	
	Route::get('/admin/blog','Admin\BlogController@index');
	Route::get('/admin/add-blog','Admin\AddblogController@formview');
	Route::post('/admin/add-blog', ['as'=>'admin.add-blog','uses'=>'Admin\AddblogController@addblogdata']);
	Route::get('/admin/blog/{id}','Admin\BlogController@destroy');
	Route::get('/admin/edit-blog/{id}','Admin\EditblogController@showform');
	Route::post('/admin/edit-blog', ['as'=>'admin.edit-blog','uses'=>'Admin\EditblogController@blogdata']);
	Route::post('/admin/blog', ['as'=>'admin.blog','uses'=>'Admin\BlogController@delete_all']);
	
	Route::get('/admin/comment/{blog}/{comment}/{id}','Admin\BlogController@view_comment');
	Route::get('/admin/comment/{pid}/{sid}','Admin\BlogController@status_comment');
	Route::get('/admin/comment/{id}','Admin\BlogController@comment_destroy');
	/* end Blogs */
	
	
	
	
	/* pages */
	
	Route::get('/admin/pages','Admin\PagesController@index');
	Route::get('/admin/edit-page/{id}','Admin\PagesController@showform');
	Route::post('/admin/edit-page', ['as'=>'admin.edit-page','uses'=>'Admin\PagesController@pagedata']);
	Route::post('/admin/pages', ['as'=>'admin.pages','uses'=>'Admin\PagesController@delete_all']);
	Route::get('/admin/pages/{id}','Admin\PagesController@deleted');
	
	Route::get('/admin/add-page','Admin\PagesController@formview');
	Route::post('/admin/add-page', ['as'=>'admin.add-page','uses'=>'Admin\PagesController@addpagedata']);
	/* end pages */
	
	
	
	/* start settings */
	
	
	Route::get('/admin/settings','Admin\SettingsController@showform');
	Route::post('/admin/settings', ['as'=>'admin.settings','uses'=>'Admin\SettingsController@editsettings']);
	
	/* end settings */
	
	
	/* media settings */
	
	Route::get('/admin/media-settings','Admin\MediasettingsController@showform');
	Route::post('/admin/media-settings', ['as'=>'admin.media-settings','uses'=>'Admin\MediasettingsController@editsettings']);
	
	/* end media settings */
	
	
	
	/* permission */
	
	Route::get('/admin/permissions','Admin\PermissionController@showform');
	Route::post('/admin/permissions', ['as'=>'admin.permissions','uses'=>'Admin\PermissionController@avigher_technologies_editsettings']);
	
	/* end permission */
	
	
	
	
	/* payment settings */
	
	Route::get('/admin/payment-settings','Admin\SettingsController@paymentform');
	Route::post('/admin/payment-settings', ['as'=>'admin.payment-settings','uses'=>'Admin\SettingsController@payment_settings']);
	/* end payment settings */
	
	
	
	/* color settings */
	
	Route::get('/admin/color-settings','Admin\ColorsettingsController@showform');
	Route::post('/admin/color-settings', ['as'=>'admin.color-settings','uses'=>'Admin\ColorsettingsController@editsettings']);
	
	/* end color settings */
	
	
	/* start slideshow */
	
	Route::get('/admin/slideshow','Admin\SlideshowController@index');
	Route::get('/admin/add-slideshow','Admin\AddslideshowController@formview');
	Route::post('/admin/add-slideshow', ['as'=>'admin.add-slideshow','uses'=>'Admin\AddslideshowController@addslideshowdata']);
	Route::get('/admin/slideshow/{id}','Admin\SlideshowController@destroy');
	Route::get('/admin/edit-slideshow/{id}','Admin\EditslideshowController@showform');
	Route::post('/admin/edit-slideshow', ['as'=>'admin.edit-slideshow','uses'=>'Admin\EditslideshowController@slideshowdata']);
	Route::post('/admin/slideshow', ['as'=>'admin.slideshow','uses'=>'Admin\SlideshowController@delete_all']);
	
	
	
	/* end slideshow */
	
	
	
	/* banner */
	
	
	Route::get('/admin/banners','Admin\BannersController@index');
	Route::get('/admin/edit-banner/{id}','Admin\EditbannerController@showform');
	Route::post('/admin/edit-banner', ['as'=>'admin.edit-banner','uses'=>'Admin\EditbannerController@slideshowdata']);
	
	
	Route::get('/admin/home-banners','Admin\HomeBannersController@index');
	Route::get('/admin/edit-home-banner/{id}','Admin\HomeBannersController@showform');
	Route::post('/admin/edit-home-banner', ['as'=>'admin.edit-home-banner','uses'=>'Admin\HomeBannersController@slideshowdata']);
	
	
	
	
	Route::get('/admin/home-box-content','Admin\HomeBannersController@box_index');
	Route::get('/admin/edit-home-box-content/{id}','Admin\HomeBannersController@box_form');
	Route::post('/admin/edit-home-box-content', ['as'=>'admin.edit-home-box-content','uses'=>'Admin\HomeBannersController@edit_slideshowdata']);
	/*
	
	Route::post('/admin/edit-slideshow', ['as'=>'admin.edit-slideshow','uses'=>'Admin\EditslideshowController@slideshowdata']);
	Route::post('/admin/slideshow', ['as'=>'admin.slideshow','uses'=>'Admin\SlideshowController@delete_all']);*/
	
	
	
	/* end banner */
	
	
	
	/* rating */
	
	Route::get('/admin/rating','Admin\RatingController@index');
	
	Route::get('/admin/rating/{id}','Admin\RatingController@destroy');
	/* end rating */
	
	
	
	/* membership */
	
	Route::get('/admin/membership','Admin\MembershipController@membership_index');
	Route::get('/admin/edit_membership/{id}','Admin\MembershipController@showform');
	Route::post('/admin/edit_membership', ['as'=>'admin.edit_membership','uses'=>'Admin\MembershipController@pagedata']);
	Route::get('/admin/add_membership','Admin\MembershipController@formview');
	Route::post('/admin/add_membership', ['as'=>'admin.add_membership','uses'=>'Admin\MembershipController@addplandata']);
	Route::get('/admin/membership/{id}','Admin\MembershipController@deleted');
	Route::get('/admin/membership/{action}/{id}/{sid}','Admin\MembershipController@status');
	
	/* end membership */
	
	
	/* withdraw */
	
	Route::get('/admin/pending_withdraw','Admin\WithdrawController@avigher_pending_withdraw');
	Route::get('/admin/pending_withdraw/{id}','Admin\WithdrawController@avigher_pending_withdraw_data');
	Route::get('/admin/completed_withdraw','Admin\WithdrawController@avigher_completed_withdraw');
	
	
	
	/* product */
	
	Route::get('/admin/product','Admin\ProductController@product_index');
	Route::get('/admin/product/{action}/{id}/{status}/{user_id}','Admin\ProductController@product_status');
	Route::get('/admin/product/{token}','Admin\ProductController@prod_deleted');
	
	/*Route::get('/admin/edit_membership/{id}','Admin\MembershipController@showform');
	Route::post('/admin/edit_membership', ['as'=>'admin.edit_membership','uses'=>'Admin\MembershipController@pagedata']);*/
	Route::get('/admin/add_product','Admin\ProductController@formview');
	Route::post('/admin/add_product', ['as'=>'admin.add_product','uses'=>'Admin\ProductController@addproductdata']);
	Route::get('/admin/view_product/{token}','Admin\ProductController@view_product_data');
	/*Route::get('/admin/membership/{id}','Admin\MembershipController@deleted');
	Route::get('/admin/membership/{action}/{id}/{sid}','Admin\MembershipController@status');*/
	
	/* end membership */
	
	
	
	
	/* attribute type */
	
	Route::get('/admin/attribute_type','Admin\AttributeController@attribute_type_index');
	Route::get('/admin/add_attribute_type','Admin\AttributeController@formview');
	Route::post('/admin/add_attribute_type', ['as'=>'admin.add_attribute_type','uses'=>'Admin\AttributeController@attribute_type_data']);
	Route::get('/admin/attribute_type/{id}','Admin\AttributeController@deleted');
	Route::get('/admin/edit_attribute_type/{id}','Admin\AttributeController@showform');
	Route::post('/admin/edit_attribute_type', ['as'=>'admin.edit_attribute_type','uses'=>'Admin\AttributeController@edit_attribute_type']);
	Route::get('/admin/attribute_type/{action}/{id}/{status}','Admin\AttributeController@status');
	
	/* attribute type */
	
	
	
	
	
	
	
	/* attribute value */
	
	Route::get('/admin/attribute_value','Admin\AttributeController@attribute_value_index');
	Route::get('/admin/attribute_value/{action}/{id}/{status}','Admin\AttributeController@value_status');
	Route::get('/admin/attribute_value/{id}','Admin\AttributeController@value_deleted');
	
	Route::get('/admin/add_attribute_value','Admin\AttributeController@formview_value');
	Route::post('/admin/add_attribute_value', ['as'=>'admin.add_attribute_value','uses'=>'Admin\AttributeController@attribute_value_data']);
	
	Route::get('/admin/edit_attribute_value/{id}','Admin\AttributeController@edit_showform');
	Route::post('/admin/edit_attribute_value', ['as'=>'admin.edit_attribute_value','uses'=>'Admin\AttributeController@edit_attribute_value']);
	/* attribute value */
	
	
	
	
	/* product orders */
	
	Route::get('/admin/orders','Admin\OrdersController@orders_index');
	Route::get('/admin/orders/{purchase_token}/{admin_commission}/{vendor_commission}','Admin\OrdersController@orders_approval');
	
	
	Route::get('/admin/view_orders/{purchase_token}','Admin\OrdersController@view_orders_index');
	
	Route::get('/admin/view_orders/{purchase_token}/{status}','Admin\OrdersController@view_orders_change');
	
	/* product orders */
	
	
	
	
	
	
	
	/* Testimonials */
	
	Route::get('/admin/testimonials','Admin\TestimonialsController@index');
	Route::get('/admin/add-testimonial','Admin\AddtestimonialController@formview');
	Route::post('/admin/add-testimonial', ['as'=>'admin.add-testimonial','uses'=>'Admin\AddtestimonialController@addtestimonialdata']);
	Route::get('/admin/testimonials/{id}','Admin\TestimonialsController@destroy');
	Route::get('/admin/edit-testimonial/{id}','Admin\EdittestimonialController@showform');
	Route::post('/admin/edit-testimonial', ['as'=>'admin.edit-testimonial','uses'=>'Admin\EdittestimonialController@testimonialdata']);
	Route::post('/admin/testimonials', ['as'=>'admin.testimonials','uses'=>'Admin\TestimonialsController@delete_all']);
	
	/* end Testimonials */
	
	
	
	
	
	
   
});


Route::group(['middleware' => 'web'], function (){
    
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/my-comments', 'DashboardController@mycomments');
	Route::get('/my-comments/{id}', 'DashboardController@mycomments_destroy');

});


Route::get('migrate-fresh',function ()
{
	\Artisan::call('migrate:fresh');
	dd("Command Success");
});

