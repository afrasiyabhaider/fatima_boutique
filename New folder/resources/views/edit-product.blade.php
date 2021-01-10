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

<html class="no-js"  lang="en">
<head>

		

   @include('style')
   




</head>
<body class="cnt-home">

  

   
    @include('header')


<div class="breadcrumb">
	<div class="container-fluid">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="<?php echo $url;?>">@lang('languages.home')</a></li>
				<li class='active'>@lang('languages.edit_product')</li>
			</ul>
		</div>
	</div>
</div>



<div class="body-content">
	<div class="container-fluid">
    <div class="contact-page">
    
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
    
    
    
    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        
                        
                         
                               @if (count($errors) > 0)
	<div class="alert alert-danger">
		@lang('languages.some_problem')
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
            </ul> 
             </div>
             @endif
                              
                  </div>      
                        
                    </div>
    
		
			
            
            
                   
            <form class="register-form" role="form" method="POST" action="{{ route('edit-product') }}" id="formID" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
            
            
				<div class="col-md-6 contact-form">
	<div class="col-md-12 contact-title">
		<div class="heading-title" style="border-bottom:none !important;">@lang('languages.edit_product')</div>
	</div>
    
    <div class="height50 clearfix"></div>
    
	<div class="col-md-6 ">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.product_name') <span>*</span></label>
		    
            <input type="text" name="product_name" id="product_name" class="form-control unicase-form-control validate[required]" value="<?php if(!empty($viewcount)){ echo $viewproduct[0]->prod_name; } ?>">
		  </div>
		
	</div>
	<div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.url_slug') <span>*</span></label>
		    <input type="text" name="url_slug" id="url_slug" class="form-control unicase-form-control validate[required]" value="<?php if(!empty($viewcount)){ echo $viewproduct[0]->prod_slug; } ?>">
            
		  </div>
		
	</div>
	<div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">@lang('languages.category') <span>*</span></label>
		    <select class="form-control unicase-form-control validate[required]"  name="cat_id">
						  <option value=""></option>
						  <?php foreach($category as $service){?>
						  <option value="<?php echo $service->id;?>_cat" <?php if(!empty($viewcount)){ if($viewproduct[0]->prod_cat_type=='cat'){ if($viewproduct[0]->	prod_category==$service->id){?> selected <?php } } } ?>><?php echo $service->cat_name;?></option>
                          <?php 
						  $subcount = DB::table('subcategory')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$service->id)
							->orderBy('subcat_name', 'asc')->count();
							if(!empty($subcount)){
							$subcategory = DB::table('subcategory')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$service->id)
							->orderBy('subcat_name', 'asc')->get();
							foreach($subcategory as $subview){
					      ?>
                          
                          <option value="<?php echo $subview->subid;?>_subcat" <?php if(!empty($viewcount)){ if($viewproduct[0]->prod_cat_type=='subcat'){ if($viewproduct[0]->	prod_category==$subview->subid){?> selected <?php } } } ?>> - <?php echo $subview->subcat_name;?></option>
                          <?php } } ?>
						  <?php } ?>
						  </select>
                          
                          
            
		  </div>
		
	</div>
	<div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.description') <span>*</span></label>
		    
            
            
             <textarea id="prod_desc" name="prod_desc" rows="6" placeholder="" class="form-control unicase-form-control txteditor validate[required]"><?php if(!empty($viewcount)){ echo $viewproduct[0]->prod_desc; } ?></textarea> 
		  </div>
		
	</div>
    
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.product_type') <span>*</span></label>
		    
            <select class="form-control unicase-form-control validate[required]"  name="prod_type" id="prod_type">
						  <option value=""></option>
						  <?php foreach($product_type as $type){?>
						  <option value="<?php echo $type;?>" <?php if(!empty($viewcount)){ if($viewproduct[0]->prod_type==$type){ ?> selected <?php } } ?>><?php echo $type;?></option>
						  <?php } ?>
						  </select>
            
              
		  </div>
		
	</div>
    
    
    
    
    <div class="col-md-6" id="price_container" <?php if(!empty($viewcount)){ if(!empty($viewproduct[0]->prod_external_url)){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.external_url') <span>*</span></label>
		    
            <input id="prod_external_url" class="form-control unicase-form-control validate[required]"  name="prod_external_url" value="<?php if(!empty($viewcount)){ if(!empty($viewproduct[0]->prod_external_url)){ echo $viewproduct[0]->prod_external_url; } } ?>" type="text">
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.price') (<?php echo $setts[0]->site_currency;?>)<span>*</span></label>
		    <input id="prod_price" class="form-control unicase-form-control validate[required]"  name="prod_price" value="<?php if(!empty($viewcount)){ echo $viewproduct[0]->prod_price; } ?>" type="text">
            
		  </div>
		
	</div>
    
	
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.offer_price') (<?php echo $setts[0]->site_currency;?>)<span>*</span></label>
		    
             <input id="prod_offer_price" class="form-control unicase-form-control validate[required]"  name="prod_offer_price" value="<?php if(!empty($viewcount)){ echo $viewproduct[0]->prod_offer_price; } ?>" type="text">
		  </div>
		
	</div>
    
</div>





















<div class="col-md-6 contact-form">
	<div class="col-md-12 contact-title text-right">
		<a  href="<?php echo $url;?>/my-product" class="btn-upper btn btn-primary">@lang('languages.view_my_products')</a>
	</div>
    
    <div class="height50 clearfix"></div>
    
	<div class="col-md-6 " id="notzipped" <?php if(!empty($viewcount)){ if($viewproduct[0]->prod_type!="digital"){?> style="display:block;" <?php } else { ?> style="display:none;" <?php } } ?>>
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.available_quantity') <span>*</span></label>
		    
            <input id="prod_available_qty" class="form-control unicase-form-control validate[required]"  name="prod_available_qty" value="<?php if(!empty($viewcount)){ echo $viewproduct[0]->prod_available_qty; } ?>" type="number">
		  </div>
		
	</div>
	
    
    <div id="notzipformat" <?php if(!empty($viewcount)){ if($viewproduct[0]->prod_type!="digital"){?> style="display:block;" <?php } else { ?> style="display:none;" <?php } }?>>
    
    <?php if(!empty($typer_admin_count)){?>
                 <?php foreach($typer_admin as $type){
				 $userid = Auth::user()->id;
				 $value_cnt = DB::table('product_attribute_value')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('attr_id','=',$type->attr_id)
					->orderBy('attr_value', 'asc')->count();
				 
				 $value = DB::table('product_attribute_value')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('attr_id','=',$type->attr_id)
					->orderBy('attr_value', 'asc')->get();	
				 ?>
                  <div class="col-md-6">
              <div class="form-group">
             <label class="info-title" for="exampleInputEmail1">@lang('languages.select') <?php echo $type->attr_name;?></label>
                <select multiple class="form-control unicase-form-control" name="attribute[]">
                  <?php if(!empty($value_cnt)){?>
                  <?php foreach($value as $values){?>
                  
                  
                  <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$viewproduct[0]->prod_attribute);
				  }
				   ?>
                  <option value="<?php echo $values->value_id;?>" <?php if(!empty($viewcount)){ if(in_array($values->value_id,$sel)){?> selected <?php } } ?>><?php echo $values->attr_value;?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              
            </div>  
            </div>
             <?php } } ?>         
                 
    </div>
    
    
    
    
     <?php
						  $viewimg_counter = DB::table('product_images')
		                              ->where('prod_token', '=' , $viewproduct[0]->prod_token)
				                      ->count();
									  
						  ?>
    
    
    
    
    
	
    
     <input type="hidden" name="prod_token" value="<?php echo $viewproduct[0]->prod_token;?>">
    
    
	
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.featured_product')</label>
		    
            
            
            <select class="form-control unicase-form-control"  name="prod_featured" id="prod_featured">
						  <option value=""></option>
						   <option value="yes" <?php if($viewproduct[0]->prod_featured=="yes"){?> selected <?php } ?>>Yes</option>
						  <option value="no" <?php if($viewproduct[0]->prod_featured=="no"){?> selected <?php } ?>>No</option>
						  
                          						  </select>
            
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">@lang('languages.images') <span>*</span></label>
		    <input type="file" placeholder="" name="image[]" class="form-control unicase-form-control <?php if(empty($viewimg_counter)){?>validate[required]<?php } ?>" accept="image/*" multiple>
						  @if ($errors->has('image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <div class="clearfix"></div>
                      <?php if(!empty($viewcount)){?>
                      
                      <?php
					  $viewimg_count = DB::table('product_images')
		                              ->where('prod_token', '=' , $viewproduct[0]->prod_token)
				                      ->count();
	
	                   
	
					  if(!empty($viewimg_count)){
					  $viewimg_get = DB::table('product_images')
		                              ->where('prod_token', '=' , $viewproduct[0]->prod_token)
				                      ->get();
					  foreach($viewimg_get as $gallery){?>
                      
                      <div class="col-md-3" style="margin-bottom:15px;">
                      <?php if(!empty($gallery->image)){?>
                      <img src="<?php echo $url;?>/local/images/media/<?php echo $gallery->image;?>" width="80" height="80" border="0" alt="">
                      <a href="<?php echo $url;?>/edit-product/delete/<?php echo $gallery->prod_img_id;?>/<?php echo base64_encode($gallery->image);?>" onClick="return confirm('Are you sure you want to delete');"><img src="<?php echo $url;?>/local/images/delete.png" width="24" border="0" alt=""></a>
                      </div>
                      
                      <?php } } } } ?>
            
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6" id="zipformat" <?php if(!empty($viewcount)){ if($viewproduct[0]->prod_type=="digital"){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">@lang('languages.upload_zip_file') <span>*</span></label>
		    <input type="file" placeholder="" name="zipfile" class="form-control unicase-form-control <?php if(empty($viewproduct[0]->prod_zipfile)){?>validate[required]<?php } ?>">
						  @if ($errors->has('zipfile'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('zipfile') }}</strong>
                                    </span>
                                @endif
                                <p><a href="<?php echo $url;?>/local/images/media/<?php echo $viewproduct[0]->prod_zipfile;?>" style="color:#FF0000;" download><?php echo $viewproduct[0]->prod_zipfile;?></a></p>
            
	<input type="hidden" name="save_zipfile" value="<?php echo $viewproduct[0]->prod_zipfile;?>">
    
    	  </div>
		
	</div>
    
    
    
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.tag_separate') <span>*</span></label>
		    <input id="prod_tags" class="form-control unicase-form-control validate[required]"  name="prod_tags" value="<?php echo $viewproduct[0]->prod_tags;?>" type="text">
            
		  </div>
		
	</div>
    
    
    <div class="col-md-12 outer-bottom-small m-t-20">
                                 <?php if(config('global.demosite')=="yes"){?><button type="submit" class="btn-upper btn btn-primary">@lang('languages.submit')</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                            <button id="send" type="submit" class="btn-upper btn btn-primary">@lang('languages.submit')</button>
								<?php } ?>   
                               </div>
                               
	
    
    
</div>
 </form>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            




			
		</div>
		

</div>
</div>

<div class="height30"></div>

 @include('footer')
 
 </body>
</html>