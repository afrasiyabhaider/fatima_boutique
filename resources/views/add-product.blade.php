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
				<li class='active'>@lang('languages.add_product')</li>
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
    
		
			
            
            
            <form class="register-form" role="form" method="POST" action="{{ route('add-product') }}" id="formID" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
            
            
            
				<div class="col-md-6 contact-form">
	<div class="col-md-12 contact-title">
		<div class="heading-title" style="border-bottom:none !important;">@lang('languages.add_product')</div>
	</div>
    
    <div class="height50 clearfix"></div>
    
	<div class="col-md-6 ">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.product_name') <span>*</span></label>
		    
            <input type="text" name="product_name" id="product_name" class="form-control unicase-form-control validate[required]">
		  </div>
		
	</div>
	<div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.url_slug') <span>*</span></label>
		    <input type="text" name="url_slug" id="url_slug" class="form-control unicase-form-control validate[required]">
            
		  </div>
		
	</div>
	<div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">@lang('languages.category') <span>*</span></label>
		    <select class="form-control unicase-form-control validate[required]"  name="cat_id">
						  <option value=""></option>
						  <?php foreach($category as $service){?>
						  <option value="<?php echo $service->id;?>_cat"><?php echo $service->cat_name;?></option>
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
                          
                          <option value="<?php echo $subview->subid;?>_subcat"> - <?php echo $subview->subcat_name;?></option>
                          <?php } } ?>
						  <?php } ?>
						  </select>
                          
                          
            
		  </div>
		
	</div>
	<div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.description') <span>*</span></label>
		    
            
            
             <textarea id="prod_desc" name="prod_desc" rows="6" placeholder="" class="form-control unicase-form-control txteditor validate[required]"></textarea> 
		  </div>
		
	</div>
    
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.product_type') <span>*</span></label>
		    
            <select class="form-control unicase-form-control validate[required]"  name="prod_type" id="prod_type">
						  <option value=""></option>
						  <?php foreach($product_type as $type){?>
						  <option value="<?php echo $type;?>"><?php echo $type;?></option>
						  <?php } ?>
						  </select>
            
              
		  </div>
		
	</div>
    
    
    
    
    <div class="col-md-6" id="price_container" style="display:none;">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.external_url') <span>*</span></label>
		    
            <input id="prod_external_url" class="form-control unicase-form-control validate[required]"  name="prod_external_url" value="" type="text">
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.price') (<?php echo $setts[0]->site_currency;?>)<span>*</span></label>
		    <input id="prod_price" class="form-control unicase-form-control validate[required]"  name="prod_price" value="" type="text">
            
		  </div>
		
	</div>
    
	
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">@lang('languages.offer_price') (<?php echo $setts[0]->site_currency;?>)<span>*</span></label>
		    
             <input id="prod_offer_price" class="form-control unicase-form-control validate[required]"  name="prod_offer_price" value="" type="text">
		  </div>
		
	</div>
    
</div>





















<div class="col-md-6 contact-form">
	<div class="col-md-12 contact-title text-right">
		<a  href="<?php echo $url;?>/my-product" class="btn-upper btn btn-primary">@lang('languages.view_my_products')</a>
	</div>
    
    <div class="height50 clearfix"></div>
    
	<div class="col-md-6" id="notzipped" style="display:none;">
		
       
        
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">@lang('languages.available_quantity') <span>*</span></label>
		    
            <input id="prod_available_qty" class="form-control unicase-form-control validate[required]"  name="prod_available_qty" value="" type="number">
		  </div>
		
	</div>
	
    
    
    
    
    
    
    
    
    <div id="notzipformat" style="display:none;">
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
                  <option value="<?php echo $values->value_id;?>"><?php echo $values->attr_value;?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              
            </div>  
            </div>
             <?php } } ?>         
                 
    </div>
    
    
    
    
    
    
    
    
    
    
	
    
     <input type="hidden" name="prod_token" value="<?php echo uniqid();?>">
    
    
	
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.featured_product')</label>
		    
            
            
            <select class="form-control unicase-form-control"  name="prod_featured" id="prod_featured">
						  <option value=""></option>
						  
						  <option value="yes">Yes</option>
						  <option value="no">No</option>
						  </select>
            
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">@lang('languages.images') <span>*</span></label>
		    <input type="file" placeholder="" name="image[]" class="form-control unicase-form-control validate[required]" accept="image/*" multiple>
						  @if ($errors->has('image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
            
		  </div>
		
	</div>
    
    
    
    <div class="col-md-6" id="zipformat" style="display:none;">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">@lang('languages.upload_zip_file') <span>*</span></label>
		    <input type="file" placeholder="" name="zipfile" class="form-control unicase-form-control validate[required]">
						  @if ($errors->has('zipfile'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('zipfile') }}</strong>
                                    </span>
                                @endif
            
		  </div>
		
	</div>
    
    
    
    
    
    <div class="col-md-6">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">@lang('languages.tag_separate') <span>*</span></label>
		    <input id="prod_tags" class="form-control unicase-form-control validate[required]"  name="prod_tags" value="" type="text">
            
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