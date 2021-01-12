<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();
$url = URL::to("/");
$setid=1;
$setts = DB::table('settings')
    ->where('id', '=', $setid)
    ->get();
$headertype = $setts[0]->header_type;
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    @include('style')
</head>

<body>
    @include('header')
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="<?php echo $url;?>">@lang('languages.home')</a></li>
                    <li><a href="<?php echo $url;?>/shop">@lang('languages.shop')</a></li>
                    <?php if(!empty($viewcount)){?><li class="active"><?php echo $viewproduct[0]->prod_name;?></li>
                    <?php } ?>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if(Session::has('success'))
                    <p class="alert alert-success">
                        {{ Session::get('success') }}
                    </p>
                    @endif
                    @if(Session::has('error'))
                    <p class="alert alert-danger">
                        {{ Session::get('error') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class='row'>
                <div class="col-md-12">
                    <div class="clearfix single-product">
                        <?php if(!empty($viewcount)){
                $prod_id = $viewproduct[0]->prod_token;
                $product_img_count = DB::table('product_images')
                    ->where('prod_token','=',$prod_id)
                    ->count();
                ?>
                        <div class='col-md-9'>
                            <div class="detail-block">
                                <div class="row  wow fadeInUp">
                                    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                        <div class="product-item-holder size-big single-product-gallery small-gallery">
                                            <div id="owl-single-product">
                                                <?php if(!empty($product_img_count)){
                                        $product_img = DB::table('product_images')
                                            ->where('prod_token','=',$prod_id)
                                            ->orderBy('prod_img_id','asc')
                                            ->get();
                                        foreach($product_img as $pimg){
                                        ?>
                                                <div class="single-product-gallery-item"
                                                    id="slide<?php echo $pimg->prod_img_id;?>">
                                                    <?php if(!empty($pimg)){?>
                                                    <a class="lumos-link" data-lumos="demo1"
                                                        href="<?php echo $url;?>/local/images/media/<?php echo $pimg->image;?>">
                                                        <img class="img-responsive" alt=""
                                                            src="<?php echo $url;?>/local/images/media/<?php echo $pimg->image;?>"
                                                            data-echo="<?php echo $url;?>/local/images/media/<?php echo $pimg->image;?>" />
                                                    </a>
                                                    <?php } else {?>
                                                    <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" />
                                                    <?php } ?>
                                                </div>
                                                <?php } } ?>
                                            </div>
                                            <div class="single-product-gallery-thumbs gallery-thumbs">
                                                <div id="owl-single-product-thumbnails">
                                                    <?php if(!empty($product_img_count)){
                                            $product_img = DB::table('product_images')
                                                ->where('prod_token','=',$prod_id)
                                                ->orderBy('prod_img_id','asc')
                                                ->get();
                                            foreach($product_img as $pimg){
                                            ?>
                                                    <div class="item">
                                                        <?php if(!empty($pimg)){?>
                                                        <a class="horizontal-thumb active"
                                                            data-target="#owl-single-product" data-slide="1"
                                                            href="#slide<?php echo $pimg->prod_img_id;?>">
                                                            <img class="img-responsive" width="85" alt=""
                                                                src="<?php echo $url;?>/local/images/media/<?php echo $pimg->image;?>"
                                                                data-echo="<?php echo $url;?>/local/images/media/<?php echo $pimg->image;?>" />
                                                        </a>
                                                        <?php } else {?>
                                                        <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" />
                                                        <?php } ?>
                                                    </div>
                                                    <?php } } ?>
                                                </div><!-- /#owl-single-product-thumbnails -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                            /************** STAR RATING *************/
                            $review_count_02 = DB::table('product_rating')
                                ->where('prod_id', '=', $viewproduct[0]->prod_id)
                                ->count();
                            if(!empty($review_count_02))
                            {
                                $review_value_02 = DB::table('product_rating')
                                    ->where('prod_id', '=', $viewproduct[0]->prod_id)
                                    ->get();
                                $over_02 = 0;
                                $fine_value_02 = 0;
                                foreach($review_value_02 as $review){
                                    if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
                                    if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
                                    if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
                                    if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
                                    if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
                                    $fine_value_02 += $value1 + $value2 + $value3 + $value4 + $value5;
                                    $over_02 +=$review->rating;
                                }
                                if(!empty(round($fine_value_02/$over_02))){ $roundeding_02 = round($fine_value_02/$over_02); } else {
                                    $roundeding_02 = 0; }
                            }
                            if(!empty($review_count_02))
                            {
                                if(!empty($roundeding_02)){
                                    if($roundeding_02==1){ $rateus_new_02 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                    }
                                    if($roundeding_02==2){ $rateus_new_02 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>

                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                    }
                                    if($roundeding_02==3){ $rateus_new_02 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                    }
                                    if($roundeding_02==4){ $rateus_new_02 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                    }
                                    if($roundeding_02==5){ $rateus_new_02 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>
                                                    </p>';
                                    }
                                }
                                else if(empty($roundeding_02)){  $rateus_new_02 = '
                                                    <p class="review-icon">
                                                        <span>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                }
                            }
                            $rateus_empty_02 = '
                                                    <p class="review-icon">
                                                        <span>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                            /************** STAR RATING *************/
                            ?>
                                    <div class='col-sm-6 col-md-7 product-info-block'>
                                        <div class="product-info">
                                            <h1 class="name"><?php echo $viewproduct[0]->prod_name;?></h1>
                                            <div class="rating-reviews m-t-20">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <?php if(!empty($review_count_02)){ echo $rateus_new_02; } else { echo $rateus_empty_02; }?>
                                                    </div>
                                                    <div class="col-sm-7">
                                                    </div>
                                                </div><!-- /.row -->
                                            </div><!-- /.rating-reviews -->
                                            <?php if($viewproduct[0]->prod_type!="digital"){?>
                                            <div class="stock-container info-container m-t-10">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="stock-box">
                                                            <span class="label">@lang('languages.availability') :</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="stock-box">
                                                            <?php if(!empty($viewproduct[0]->prod_available_qty)){?>
                                                            <span class="value">@lang('languages.in_stock')
                                                                (<?php echo $viewproduct[0]->prod_available_qty;?>)</span>
                                                            <?php } else { ?>
                                                            <span class="value">@lang('languages.out_of_stock')</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div><!-- /.row -->
                                            </div><!-- /.stock-container -->
                                            <?php } ?>
                                            <div class="description-container m-t-20">
                                                <?php echo substr($viewproduct[0]->prod_desc,0,200);?>
                                            </div>
                                            <?php
                                    $sold_id = $viewproduct[0]->user_id;
                                    $sold = DB::table('users')
                                        ->where('id', '=', $sold_id)
                                        ->count();
                                    if(!empty($sold))
                                    {
                                        $view_sold = DB::table('users')
                                            ->where('id', '=', $sold_id)
                                            ->get();
                                        $view_sold_name = $view_sold[0]->name;
                                        $view_sold_slug = $view_sold[0]->post_slug;
                                    }
                                    else
                                    {
                                        $view_sold_name = "";
                                        $view_sold_slug = "";
                                    }
                                    ?>
                                            <div class="price-container info-container m-t-20">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="price-box">
                                                            <?php if(!empty($viewproduct[0]->prod_offer_price)){?> <span
                                                                class="price">
                                                                <?php echo $setts[0]->site_currency.' '.number_format($viewproduct[0]->prod_offer_price,2);?></span>
                                                            <span
                                                                class="price-strike"><?php echo $setts[0]->site_currency.' '.number_format($viewproduct[0]->prod_price,2).' ';?></span><?php } else { ?>
                                                            <span
                                                                class="price"><?php echo $setts[0]->site_currency.' '.number_format($viewproduct[0]->prod_price,2);?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="favorite-button m-t-10">
                                                            <?php if(Auth::guest()) { ?>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Wishlist"
                                                                href="javascript:void(0);"
                                                                onClick="alert('@lang('languages.login_user')');">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                            <?php
                                                    } else {
                                                    if(Auth::user()->id!=$viewproduct[0]->user_id && Auth::user()->id!=1)
                                                    {
                                                    ?>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Wishlist"
                                                                href="<?php echo $url;?>/wishlist/<?php echo Auth::user()->id;?>/<?php echo $viewproduct[0]->prod_token;?>">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                            <?php } } ?>
                                                            <?php if(Auth::guest()) { ?>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Add to Compare"
                                                                href="javascript:void(0);"
                                                                onClick="alert('@lang('languages.login_user')');">
                                                                <i class="fa fa-signal"></i>
                                                            </a>
                                                            <?php } else {?>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Add to Compare"
                                                                href="<?php echo $url;?>/compare/<?php echo $viewproduct[0]->prod_token;?>">
                                                                <i class="fa fa-signal"></i>
                                                            </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div><!-- /.row -->
                                            </div><!-- /.price-container -->
                                            <?php
                                    $sold_id = $viewproduct[0]->user_id;
                                    $sold = DB::table('users')
                                        ->where('id', '=', $sold_id)
                                        ->count();
                                    if(!empty($sold))
                                    {
                                        $view_sold = DB::table('users')
                                            ->where('id', '=', $sold_id)
                                            ->get();
                                        $view_sold_name = $view_sold[0]->name;
                                        $view_sold_slug = $view_sold[0]->post_slug;
                                    }
                                    else
                                    {
                                        $view_sold_name = "";
                                        $view_sold_slug = "";
                                    }
                                    ?>
                                            <form class="register-form" role="form" method="POST"
                                                action="{{ route('product') }}" id="formID"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="quantity-container info-container">
                                                    <div class="row">
                                                        <?php if($viewproduct[0]->prod_type!="digital"){?>
                                                        <div class="col-sm-3">
                                                            <h4>@lang('languages.qty')</h4>
                                                            <select
                                                                class="col-xs-12 marB20 form-control unicase-form-control"
                                                                name="quantity">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                            </select>
                                                        </div>
                                                        <?php } else {?>
                                                        <input type="hidden" name="quantity" value="1">
                                                        <?php } ?>
                                                        <?php
                                                $newer_count = DB::table('product_attribute_type')
                                                    ->where('delete_status','=','')
                                                    ->where('status','=',1)
                                                    ->whereIn('user_id',[1,$viewproduct[0]->user_id])
                                                    ->orderBy('attr_name', 'asc')->count();
                                                $newer = DB::table('product_attribute_type')
                                                    ->where('delete_status','=','')
                                                    ->where('status','=',1)
                                                    ->whereIn('user_id',[1,$viewproduct[0]->user_id])
                                                    ->orderBy('attr_name', 'asc')->get();
                                                ?>
                                                        <?php if(!empty($newer_count)){?>
                                                        <?php foreach($newer as $type){
                                                $value_cnt = DB::table('product_attribute_value')
                                                    ->where('delete_status','=','')
                                                    ->where('status','=',1)
                                                    ->whereRaw('FIND_IN_SET(value_id,"'.$viewproduct[0]->prod_attribute.'")')
                                                    ->where('attr_id','=',$type->attr_id)
                                                    ->orderBy('attr_value', 'asc')->count();
                                                $value = DB::table('product_attribute_value')
                                                    ->where('delete_status','=','')
                                                    ->where('status','=',1)
                                                    ->whereRaw('FIND_IN_SET(value_id,"'.$viewproduct[0]->prod_attribute.'")')
                                                    ->where('attr_id','=',$type->attr_id)
                                                    ->orderBy('attr_value', 'asc')->get();
                                                ?>
                                                        <?php
                                                if(!empty($value_cnt))
                                                {
                                                ?>
                                                        <div class="col-md-3 col-sm-3">
                                                            <h4><?php echo $type->attr_name;?></h4>
                                                            <select
                                                                class="col-xs-12 marB20 form-control unicase-form-control"
                                                                name="attribute[]">
                                                                <?php if(!empty($value_cnt)){?>
                                                                <?php foreach($value as $values){?>
                                                                <option value="<?php echo $values->value_id;?>">
                                                                    <?php echo $values->attr_value;?></option>
                                                                <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <?php } else {?>
                                                        <input type="hidden" name="attribute[]" value="">
                                                        <?php } } } ?>
                                                        <input type="hidden" name="prod_token"
                                                            value="<?php echo $viewproduct[0]->prod_token;?>">
                                                        <input type="hidden" name="prod_id"
                                                            value="<?php echo $viewproduct[0]->prod_id;?>">
                                                        <?php if(!empty($viewproduct[0]->prod_offer_price)){?>
                                                        <input type="hidden" name="price"
                                                            value="<?php echo $viewproduct[0]->prod_offer_price;?>">
                                                        <?php } else {?>
                                                        <input type="hidden" name="price"
                                                            value="<?php echo $viewproduct[0]->prod_price;?>">
                                                        <?php } ?>
                                                        <input type="hidden" name="prod_user_id"
                                                            value="<?php echo $viewproduct[0]->user_id;?>">
                                                    </div><!-- /.row -->
                                                    <div class="info-container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mtop10"><strong
                                                                        class="black">@lang('languages.sold_by'):
                                                                    </strong><a
                                                                        href="<?php echo $url;?>/profile/<?php echo $sold_id;?>/<?php echo $view_sold_slug;?>"
                                                                        class="theme_color"><?php echo $view_sold_name;?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="height10 clearfix"></div>
                        <div class="row">
                    <?php 
                        if(Auth::guest()) { 
                    ?>
                        <div class="col-sm-3">
                            <a href="javascript:void(0);" class="btn btn-primary"
                                onClick="alert('Login user only');">
                                <i class="fa fa-shopping-cart inner-right-vs"></i>
                                @lang('languages.add_to_cart')
                            </a>
                        </div>
                    <?php 
                        } else {
                            // Auth::user()->id != $viewproduct[0]->user_id &&
                        if( Auth::user()->id != 1) {
                            if(!empty($viewproduct[0]->prod_available_qty)){
                                if($viewproduct[0]->prod_type!="external"){
                    ?>
                            <div class="col-sm-3">
                                <input type="submit" name="add_to_cart"
                                    class="btn btn-primary"
                                    value="@lang('languages.add_to_cart')">
                            </div>
                    <?php } else { ?>
                            <div class="col-sm-3">
                                <a href="<?php echo $viewproduct[0]->prod_external_url;?>"
                                    class="btn btn-primary" target="_blank">
                                    <i class="fa fa-shopping-cart inner-right-vs"></i>
                                    @lang('languages.buy_now')
                                </a>
                            </div>
                            <?php } }
                    }
                    } ?>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <?php if(!empty($product_img_count)){
                    $product_img = DB::table('product_images')
                        ->where('prod_token','=',$prod_id)
                        ->orderBy('prod_img_id','asc')
                        ->get();
                    if(!empty($product_img[0]->image))
                    {
                        $share_img = $url.'/local/images/media/'.$product_img[0]->image;
                    }
                    else
                    {
                        $share_img = $url.'/local/resources/views/assets/img/product/product-detail.jpg';
                    }
                }
                ?>
                        <div class="height40 clearfix"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="share1"
                                    data-url="<?php echo $url;?>/product/<?php echo $viewproduct[0]->prod_id;?>/<?php echo $viewproduct[0]->prod_slug;?>"
                                    data-title="<?php echo $viewproduct[0]->prod_name;?>"
                                    data-description="<?php echo $viewproduct[0]->prod_desc;?>"
                                    data-image="<?php echo $share_img;?>"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.quantity-container -->
            </form>
                                        </div><!-- /.product-info -->
                                    </div><!-- /.col-sm-7 -->
                                </div><!-- /.row -->
                            </div>
                            <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                            <li class="active"><a data-toggle="tab"
                                                    href="#description">@lang('languages.description')</a></li>
                                            <li><a data-toggle="tab" href="#review">@lang('languages.review')</a></li>
                                            <li><a data-toggle="tab" href="#tags">@lang('languages.tags')</a></li>
                                        </ul><!-- /.nav-tabs #product-tabs -->
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="tab-content">
                                            <div id="description" class="tab-pane in active">
                                                <div class="product-tab">
                                                    <p class="text"><?php echo $viewproduct[0]->prod_desc;?></p>
                                                </div>
                                            </div><!-- /.tab-pane -->
                                            <div id="review" class="tab-pane">
                                                <div class="product-tab">
                                                    <div class="product-reviews">
                                                        <h3 class="title font17">@lang('languages.customer_reviews')
                                                        </h3>
                                                        <div class="height20"></div>
                                                        <div class="reviews">
                                                            <div class="comment-section">
                                                                <?php if(!empty($viewcount_rating)){?>
                                                                <div class="comment-list">
                                                                    <?php
                                                            $jzoo=0;
                                                            foreach($view_rating as $rating){
                                                            $user_count = DB::table('users')
                                                                ->where('id', '=', $rating->user_id)
                                                                ->count();
                                                            if(!empty($user_count))
                                                            {
                                                                $user = DB::table('users')
                                                                    ->where('id', '=', $rating->user_id)
                                                                    ->get();
                                                                $userphoter = $user[0]->photo;
                                                                $usernameo = $user[0]->name;
                                                                $userid = $user[0]->id;
                                                                $userslug = $user[0]->post_slug;
                                                            }
                                                            else
                                                            {
                                                                $userphoter = "";
                                                                $usernameo = "";
                                                                $userid = "";
                                                                $userslug = "";
                                                            }
                                                            ?>
                                                                    <div class="comment-box marB30">
                                                                        <div class="row">
                                                                            <div class="col-md-2 col-sm-2 col-xs-4">
                                                                                <figure>
                                                                                    <?php
                                                                            $userphoto="/media/";
                                                                            $path ='/local/images'.$userphoto.$userphoter;
                                                                            if($userphoter!=""){?>
                                                                                    <a
                                                                                        href="<?php echo $url;?>/profile/<?php echo $userid;?>/<?php echo $userslug;?>">
                                                                                        <img src="<?php echo $url.$path;?>"
                                                                                            class="img-circle w90"
                                                                                            alt="">
                                                                                    </a>
                                                                                    <?php } else { ?>
                                                                                    <a
                                                                                        href="<?php echo $url;?>/profile/<?php echo $userid;?>/<?php echo $userslug;?>">
                                                                                        <img src="<?php echo $url.'/local/images/nophoto.jpg';?>"
                                                                                            class="img-circle w90"
                                                                                            alt="">
                                                                                    </a>
                                                                                    <?php } ?>
                                                                                </figure>
                                                                                <?php
                                                                        if($rating->rating==1){ $rateus_views ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                                        }
                                                                        if($rating->rating==2){ $rateus_views ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>

                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                                        }
                                                                        if($rating->rating==3){ $rateus_views ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                                        }
                                                                        if($rating->rating==4){ $rateus_views ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                                        }
                                                                        if($rating->rating==5){ $rateus_views ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>
                                                    </p>';
                                                                        }
                                                                        if($rating->rating==0 or $rating->rating==""){
                                                                            $rateus_views ='
                                                    <p class="review-icon">
                                                        <span>


                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                                        }
                                                                        ?>
                                                                            </div>
                                                                            <div class="col-md-10 col-sm-10 ">
                                                                                <h4><a
                                                                                        href="<?php echo $url;?>/profile/<?php echo $userid;?>/<?php echo $userslug;?>">
                                                                                        - <?php echo $usernameo;?>
                                                                                    </a> </h4>
                                                                                <?php echo $rateus_views;?>
                                                                                <p><?php echo $rating->review;?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div><!-- /.reviews -->
                                                    </div><!-- /.product-reviews -->
                                                    <!-- /.product-add-review -->
                                                </div><!-- /.product-tab -->
                                            </div><!-- /.tab-pane -->
                                            <div id="tags" class="tab-pane">
                                                <div class="product-tag">
                                                    <div class="tag-list">
                                                        <?php
                                                $post_tags = explode(',',$viewproduct[0]->prod_tags);
                                                foreach($post_tags as $tags)
                                                {
                                                $tag =strtolower(str_replace(" ","-",$tags));
                                                if(!empty($tags))
                                                {
                                                ?>
                                                        <a href="<?php echo $url;?>/tag/product/<?php echo $tag;?>"
                                                            class="item"><?php echo $tags;?></a>
                                                        <?php
                                                }
                                                }
                                                ?>
                                                    </div>
                                                </div><!-- /.product-tab -->
                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.product-tabs -->
                            <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                            <section class="section featured-product wow fadeInUp">
                                <h3 class="section-title">@lang('languages.related_products')</h3>
                                <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs"
                                    data-item="5">
                                    <?php if(!empty($relatedcount)){?>
                                    <?php
                            $ij=1;
                            foreach($relatedproduct as $product){
                            $prod_id = $product->prod_token;
                            $product_img_count = DB::table('product_images')
                                ->where('prod_token','=',$prod_id)
                                ->count();
                            ?>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                                            <?php
                                                    if(!empty($product_img_count)){
                                                    $product_img = DB::table('product_images')
                                                        ->where('prod_token','=',$prod_id)
                                                        ->orderBy('prod_img_id','asc')
                                                        ->get();
                                                    if(!empty($product_img[0]->image))
                                                    {
                                                    ?>
                                                            <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>"
                                                                alt="" />
                                                            <?php } else { ?>
                                                            <img src="<?php echo $url;?>/local/images/noimage_box.jpg"
                                                                alt="" />
                                                            <?php } } ?>
                                                        </a>
                                                    </div><!-- /.image -->
                                                    <?php if($ij==1){?>
                                                    <div class="tag new"><span>@lang('languages.new')</span></div>
                                                    <?php } ?>
                                                </div><!-- /.product-image -->
                                                <?php
                                        $review_count_03 = DB::table('product_rating')
                                            ->where('prod_id', '=', $product->prod_id)
                                            ->count();
                                        if(!empty($review_count_03))
                                        {
                                            $review_value_03 = DB::table('product_rating')
                                                ->where('prod_id', '=', $product->prod_id)
                                                ->get();
                                            $over_03 = 0;
                                            $fine_value_03 = 0;
                                            foreach($review_value_03 as $review){
                                                if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
                                                if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
                                                if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
                                                if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
                                                if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
                                                $fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
                                                $over_03 +=$review->rating;
                                            }
                                            if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
                                                $roundeding_03 = 0; }
                                        }
                                        if(!empty($review_count_03))
                                        {
                                            if(!empty($roundeding_03)){
                                                if($roundeding_03==1){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                }
                                                if($roundeding_03==2){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>

                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                }
                                                if($roundeding_03==3){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                }
                                                if($roundeding_03==4){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                }
                                                if($roundeding_03==5){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>
                                                    </p>';
                                                }
                                            }
                                            else if(empty($roundeding_03)){  $rateus_new_03 = '
                                                    <p class="review-icon">
                                                        <span>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                            }
                                        }
                                        $rateus_empty_03 = '
                                                    <p class="review-icon">
                                                        <span>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                        ?>
                                                <div class="product-info text-center">
                                                    <h3 class="name"><a
                                                            href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?>
                                                    </div>
                                                    <p><?php if(!empty($product->prod_offer_price)){?><span
                                                            style="text-decoration:line-through; color:#FF0000;"
                                                            class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span>
                                                        <span class="fontsize15 black">
                                                            <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span>
                                                        <?php } else { ?> <span
                                                            class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span>
                                                        <?php } ?></p>
                                                    <!-- /.product-price -->
                                                </div><!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <a data-toggle="tooltip" class="btn btn-primary icon"
                                                                    title="Add Cart"
                                                                    href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                                                    <i class="fa fa-shopping-cart"></i> </a>
                                                                <a class="btn btn-primary cart-btn"
                                                                    href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">@lang('languages.add_to_cart')</a>
                                                            </li>
                                                            <li class="lnk wishlist">
                                                                <?php if(Auth::guest()) { ?>
                                                                <a data-toggle="tooltip" class="add-to-cart"
                                                                    href="javascript:void(0);"
                                                                    onClick="alert('@lang('languages.login_user')');"
                                                                    title="Wishlist"> <i class="icon fa fa-heart"></i>
                                                                </a>
                                                                <?php
                                                        } else {
                                                        if(Auth::user()->id!=$product->user_id)
                                                        {
                                                        ?>
                                                                <a data-toggle="tooltip" class="add-to-cart"
                                                                    href="<?php echo $url;?>/wishlist/<?php echo Auth::user()->id;?>/<?php echo $product->prod_token;?>"
                                                                    title="Wishlist"> <i class="icon fa fa-heart"></i>
                                                                </a>
                                                                <?php } } ?>
                                                            </li>
                                                            <li class="lnk">
                                                                <?php if(Auth::guest()) { ?>
                                                                <a data-toggle="tooltip" class="add-to-cart"
                                                                    href="javascript:void(0);"
                                                                    onClick="alert('@lang('languages.login_user')');"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i> </a>
                                                                <?php } else {?>
                                                                <a data-toggle="tooltip" class="add-to-cart"
                                                                    href="<?php echo $url;?>/compare/<?php echo $product->prod_token;?>"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i> </a>
                                                                <?php } ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- /.product -->
                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <?php $ij++;} ?>
                                    <?php } ?>
                                </div><!-- /.home-owl-carousel -->
                            </section><!-- /.section -->
                            <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
                        </div>
                        <?php } ?>
                        <div class='col-md-3 sidebar'>
                            <div class="sidebar-module-container">
                                <div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
                                    <h3 class="section-title">@lang('languages.latest_products')</h3>
                                    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
                <?php 
                    if(!empty($latestcount)){
                        $ii=1;
                        foreach($latest_product as $product){
                            $prod_id = $product->prod_token;
                            $product_img_count = DB::table('product_images')
                                    ->where('prod_token','=',$prod_id)
                                    ->count();
                ?>
                                        <div class="item">
                                            <div class="products">
                                                <div class="hot-deal-wrapper">
                                                    <div class="image">
                                            <?php
                                                $prod_id = $product->prod_token;
                                                $product_img_count = DB::table('product_images')
                                                    ->where('prod_token','=',$prod_id)
                                                    ->count();
                                            ?>
                                                        <a
                                                            href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>">
                                                            <?php
                                                    if(!empty($product_img_count)){
                                                    $product_img = DB::table('product_images')
                                                        ->where('prod_token','=',$prod_id)
                                                        ->orderBy('prod_img_id','asc')
                                                        ->get();
                                                    if(!empty($product_img[0]->image))
                                                    {
                                                    ?>
                                                            <img src="<?php echo $url;?>/local/images/media/<?php echo $product_img[0]->image;?>"
                                                                alt="" />
                                                            <?php } else { ?>
                                                            <img src="<?php echo $url;?>/local/images/noimage_box.jpg"
                                                                alt="" />
                                                            <?php } } ?>
                                                        </a>
                                                    </div>
                                                    <!--<div class="sale-offer-tag"><span>35%<br>off</span>sara</div>-->
                                                    <?php
                                            $review_count_03 = DB::table('product_rating')
                                                ->where('prod_id', '=', $product->prod_id)
                                                ->count();
                                            if(!empty($review_count_03))
                                            {
                                                $review_value_03 = DB::table('product_rating')
                                                    ->where('prod_id', '=', $product->prod_id)
                                                    ->get();
                                                $over_03 = 0;
                                                $fine_value_03 = 0;
                                                foreach($review_value_03 as $review){
                                                    if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
                                                    if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
                                                    if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
                                                    if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
                                                    if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
                                                    $fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
                                                    $over_03 +=$review->rating;
                                                }
                                                if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
                                                    $roundeding_03 = 0; }
                                            }
                                            if(!empty($review_count_03))
                                            {
                                                if(!empty($roundeding_03)){
                                                    if($roundeding_03==1){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                    }
                                                    if($roundeding_03==2){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>

                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                    }
                                                    if($roundeding_03==3){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                    }
                                                    if($roundeding_03==4){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>


                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                    }
                                                    if($roundeding_03==5){ $rateus_new_03 ='
                                                    <p class="review-icon">
                                                        <span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                        </span>
                                                    </p>';
                                                    }
                                                }
                                                else if(empty($roundeding_03)){  $rateus_new_03 = '
                                                    <p class="review-icon">
                                                        <span>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                                }
                                            }
                                            $rateus_empty_03 = '
                                                    <p class="review-icon">
                                                        <span>

                                                        </span>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>';
                                            ?>
                                                </div>
                                                <div class="product-info text-left m-t-20">
                        <h3 class="name"><a
                                href="<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>"><?php echo $product->prod_name;?></a>
                        </h3>
                                                    <div class="product-price">
                <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?>
            </div>
                    <p><?php if(!empty($product->prod_offer_price)){?><span
                                                            style="text-decoration:line-through; color:#FF0000;"
                                                            class="fontsize15"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2).' ';?></span>
                                                        <span class="fontsize15 black">
                                                            <?php echo $setts[0]->site_currency.' '.number_format($product->prod_offer_price,2);?></span>
                                                        <?php } else { ?> <span
                                                            class="fontsize15 black"><?php echo $setts[0]->site_currency.' '.number_format($product->prod_price,2);?></span>
                                                        <?php } ?></p>
                                                </div>
            <div class="cart clearfix animate-effect">
                <div class="action">
                    <div class="add-cart-button btn-group">
                        <button class="btn btn-primary icon" data-toggle="dropdown"
                            type="button"
                            onClick="window.location.href='<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>'">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                        <button class="btn btn-primary cart-btn" type="button"
                            onClick="window.location.href='<?php echo $url;?>/product/<?php echo $product->prod_id;?>/<?php echo $product->prod_slug;?>'">@lang('languages.add_to_cart')</button>
                    </div>
                </div><!-- /.action -->
            </div>
                                            </div>
                                        </div>
                                        <?php  $ii++;} ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php /*?><div
                                    class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                                    <h3 class="section-title">Newsletters</h3>
                                    <div class="sidebar-widget-body outer-top-xs">
                                        <p>Sign Up for Our Newsletter!</p>
                                        <form>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Subscribe to our newsletter">
                                            </div>
                                            <button class="btn btn-primary">Subscribe</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                                    <div id="advertisement" class="advertisement">
                                        <div class="item">
                                            <div class="avatar"><img src="theme/images/member1.png" alt="Image"></div>
                                            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem
                                                lacus port mollis. Nunc condime tum metus eud molest sed
                                                consectetuer.<em>"</em></div>
                                            <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                        </div>
                                        <div class="item">
                                            <div class="avatar"><img src="theme/images/member3.png" alt="Image"></div>
                                            <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem
                                                lacus port mollis. Nunc condime tum metus eud molest sed
                                                consectetuer.<em>"</em></div>
                                            <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                                        </div>
                                        <div class="item">
                                            <div class="avatar"><img src="theme/images/member2.png" alt="Image"></div>
                                            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem
                                                lacus port mollis. Nunc condime tum metus eud molest sed
                                                consectetuer.<em>"</em></div>
                                            <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                            <!-- /.container-fluid -->
                                        </div>
                                    </div>
                                </div>
                                <?php */?>
                            </div>
                            <div class="sidebar-module-container">
                                <?php
                        if(!empty($setts[0]->site_shop_ads)){?>
                                <div class="animate-box">
                                    <div class="clearfix height20"></div>
                                    <?php echo html_entity_decode($setts[0]->site_shop_ads);?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div><!-- /.body-content -->
        @include('footer')
</body>

</html>