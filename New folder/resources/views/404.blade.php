<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    

    <!-- fixed navigation bar -->
    @include('header')

	<div class="clear"></div>
        <section class="main-static-banner main-static-banner-light wa_main_bn_wrap">
            <div class="special-style special-style-dark col-md-12">
                <div class="bg-image parallax-style" style="background-image:url('<?php echo $url;?>/local/images/404.jpg');"></div>
            </div>
            <div class="container error-page">
                <div class="row text-center padTB100">
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 padT40 padB30">
                        <div class="call-to-action">
                            <h2 class="wa-theme-color">@lang('languages.page_not_found')</h2>
                            <div class="clear"></div>
                        </div>
                        <img src="<?php echo $url;?>/local/images/error.png" alt="">
                        <div class="block-detail-head marB30">
                            <p class="error-text color-light" style="font-size:16px;">
                                @lang('languages.page_sorry') <a href="<?php echo $url;?>" class="wa-theme-color"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <?php /*?><div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                            <div class="search-form positionR">
                                <form method="post" action="#">
                                    <div class="form-group clearfix">
                                        <div class="search-bar">
                                            <input type="text" name="search" placeholder="Search..">
                                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><?php */?>
                    </div>
                </div>
            </div>
        </section>
        <div class="clear"></div>
         
	  

      @include('footer')
</body>
</html>