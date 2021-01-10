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

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container-fluid">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="<?php echo $url;?>">@lang('languages.home')</a></li>
				<li class='active'>@lang('languages.my_attribute_value')</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content outer-top-xs">
	<div class="container-fluid">
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
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
                <div class="col-md-6"><div class="heading-title" style="border-bottom:none !important;">@lang('languages.my_attribute_value')</div></div>
                <div class="col-md-6 text-right"><a class="btn-upper btn btn-primary" href="<?php echo $url;?>/add-attribute-value">@lang('languages.add_value')</a></div>
                
                <div class="height20 clearfix"></div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="item">@lang('languages.attribute_value')</th>
					<th class="item">@lang('languages.attribute_type')</th>
					<th class="item">@lang('languages.action')</th>
					
                    
				</tr>
			</thead><!-- /thead -->
			
			<tbody>
            
            <?php if(!empty($attribute_value_cnt)){?>
                                <?php foreach ($attribute_value as $value) { 
					  $user_id = Auth::user()->id;
					  $attribute_type_cnt = DB::table('product_attribute_type')
		                                ->where('delete_status','=','')
										->where('attr_id','=',$value->attr_id)
										
					                    ->count();
					  if(!empty($attribute_type_cnt))
					  {					
					  $attribute_type = DB::table('product_attribute_type')
		                                ->where('delete_status','=','')
										->where('attr_id','=',$value->attr_id)
										
					                    ->get();
										
					  $att_name = $attribute_type[0]->attr_name;
					  }
					  else
					  {
					  $att_name = "";
					  }
								
								 
								
								?>
            
                    <tr>
					
					<td class="cart-product-name-info">
                    						
                       <?php echo $value->attr_value;?>
                                                        
                                                        
                       
                                                                                
					</td>
                    
                                                                        
					<td class="cart-product-name-info">
                    						
                       <?php echo $att_name;?>
                                                        
                                                        
                       
                                                                                
					</td>
                    
					
					<td class="cart-product-grand-total">
                    
                    
                     <a href="<?php echo $url;?>/edit-attribute-value/<?php echo $value->value_id;?>"><img src="<?php echo $url;?>/local/images/edit.png" alt="" border="0"></a>
                                                        <a href="<?php echo $url;?>/attribute-value/<?php echo $value->value_id;?>" onClick="return confirm('@lang('languages.are_you_sure')');"><img src="<?php echo $url;?>/local/images/delete.png" alt="" border="0"></a>
                    </td>
                    
                    
                    
                    
				</tr>
                <?php } } ?>
								
								
							</tbody><!-- /tbody -->
		</table><!-- /table -->
	</div>
</div>

</div>
		</div> 
        
        </div>
</div>


<div class="height30"></div>

@include('footer')

</body>
</html>
