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
   @include('admin.top')

@include('admin.menu')






<div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>View Product</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      
      <h4>User Details</h4><br/>
      
      <?php
							$user = DB::table('users')
		                              ->where('id', '=' , $product[0]->user_id)
				                      ->get();
									  
							?>	
      <div class="row-fluid">
                            <div class="span2"><strong>User Name</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            	  
                            
                            
                            <div class="span2"><?php echo $user[0]->name;?></div>
                            <div class="span7"></div>
                      </div>
      
      <div class="row-fluid">
                            <div class="span2"><strong>Email</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            	  
                            
                            
                            <div class="span2"><?php echo $user[0]->email;?></div>
                            <div class="span7"></div>
                      </div>
      <div class="row-fluid">
                            <div class="span2"><strong>Phone</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            	  
                            
                            
                            <div class="span2"><?php echo $user[0]->phone;?></div>
                            <div class="span7"></div>
                      </div>
      
      <br/>
      
      <h4>Product Details</h4><br/>
      
          <div class="row-fluid">
                            <div class="span2"><strong>Product Name</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <div class="span2"><?php echo $product[0]->prod_name;?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                      
                            
        
        <div class="row-fluid">
                            <div class="span2"><strong>Category</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <?php
							
							if($product[0]->prod_cat_type=="cat")
													{
													  $product_catcount = DB::table('category')
																	->where('id','=',$product[0]->prod_category)
																	->count();
													  if(!empty($product_catcount))
													  {				
													  $product_cat = DB::table('category')
																	->where('id','=',$product[0]->prod_category)
																	->get();				
													  
													  $category_name = $product_cat[0]->cat_name;
													  }
													  else
													  {
													    $category_name = "";
													  }	
													  
													}
													else if($product[0]->prod_cat_type=="subcat")
													{
													   $subcount = DB::table('subcategory')
																	->where('subid','=',$product[0]->prod_category)
																	->count();
																	if(!empty($subcount))
																	{
																	$subcategory = DB::table('subcategory')
																	               ->where('subid','=',$product[0]->prod_category)
																	               ->get();
																	$category_name = $subcategory[0]->subcat_name;
																	}
																	else
																	{
																	  $category_name = "";
																	}		   
																				   
							
													
													
													
													}			
													
							
							
							?>
                            
                            
                            <div class="span2"><?php echo $category_name;?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                      
                      
                       <div class="row-fluid">
                            <div class="span2"><strong>Description</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <div class="span2"><?php echo $product[0]->prod_desc;?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                       <div class="row-fluid">
                            <div class="span2"><strong>Price</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <div class="span2"><?php if(!empty($product[0]->prod_offer_price)){?><span style="text-decoration:line-through; color:#FF0000;"><?php echo $setts[0]->site_currency.' '.number_format($product[0]->prod_price,2).' ';?></span> <span> <?php echo $setts[0]->site_currency.' '.number_format($product[0]->prod_offer_price,2);?></span> <?php } else { ?> <span><?php echo $setts[0]->site_currency.' '.number_format($product[0]->prod_price,2);?></span> <?php } ?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                      <div class="row-fluid">
                            <div class="span2"><strong>Product Type</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <div class="span2"><?php echo $product[0]->prod_type;?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                      <?php if(!empty($product[0]->prod_external_url)){?>
                      <div class="row-fluid">
                            <div class="span2"><strong>External Url</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <div class="span2"><?php echo $product[0]->prod_external_url;?></div>
                            <div class="span7"></div>
                      </div>
                      <?php } ?>
                      
                      
                      <div class="row-fluid">
                            <div class="span2"><strong>Attributes</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <?php 
							$attri = $product[0]->prod_attribute; 
							
							$id = explode(",", $attri);
							$view_attri = "";
                            foreach ($id as $id_value) 
							{
							  $query = DB::table('product_attribute_value')
         							 ->where("value_id",'=',$id_value)
									 
                                     ->get();
									 
								$view_attri .= $query[0]->attr_value.',';	 
							
							}
							
							
									 
							?>
                            
                            
                            <div class="span2"><?php echo rtrim($view_attri,',');?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                      
                      <div class="row-fluid">
                            <div class="span2"><strong>Quantity</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            
                            <div class="span2"><?php echo $product[0]->prod_available_qty;?></div>
                            <div class="span7"></div>
                      </div>
                      
                      
                      
                       <div class="row-fluid">
                            <div class="span2"><strong>Images</strong></div>
                            
                            <div class="span1"><strong>:</strong></div>
                            <?php
							 $viewimg_get = DB::table('product_images')
		                              ->where('prod_token', '=' , $product[0]->prod_token)
				                      ->get();
					  ?>
                      
                      
					  
                      
                      
							
                            <div class="span5"><?php  foreach($viewimg_get as $gallery){ if(!empty($gallery->image)){?>
                      <img src="<?php echo $url;?>/local/images/media/<?php echo $gallery->image;?>" width="80" height="80" border="0" alt="">
                      <?php } } ?></div>
                            <div class="span4"></div>
                      </div>
                      
                      <br/><br/>
                      
         <div class="row-fluid">             
        <div class="span12"><a href="<?php echo $url;?>/admin/product" class="btn btn-primary">&lsaquo;&lsaquo; Back</a> </div>
        </div>
        
        
      </div>
    </div>
    
  </div>
</div>



</div>






     @include('admin.footer')
	
  </body>
</html>
