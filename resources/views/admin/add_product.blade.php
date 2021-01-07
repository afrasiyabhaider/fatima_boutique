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
    <h1>Add Product</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      @if(Session::has('error'))
      <div class="alert alert-error">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
              {{ Session::get('error') }}
              </div>
      @endif
      
      @if(Session::has('success'))

	           
        <div class="alert alert-success">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
               {{ Session::get('success') }}
              </div>

	@endif

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product</h5>
          </div>
          <div class="widget-content nopadding">
          
              
               <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.add_product') }}" enctype="multipart/form-data" id="formID">
                     {{ csrf_field() }}       
                     
              
              
              
                        
                        
                         <div class="control-group">
                <label class="control-label">Product Name <span class="required">*</span></label> 
                <div class="controls">
                        
                          <input id="product_name" class="validate[required] span8"  name="product_name" value="" type="text">
                         @if ($errors->has('product_name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>That product name is already exists</strong>
                                    </span>
                                @endif
					   </div>
                      </div>
              
              
              
              
                        
                        <div class="control-group">
                <label class="control-label">URL Slug <span class="required">*</span></label> 
                <div class="controls">
                        
                          <input id="prod_slug" class="validate[required] span8"  name="prod_slug" value="" type="text">
                         
					   </div>
                      </div>
                      
                      
                      
                      
                      <div class="control-group">
                <label class="control-label">Select Category <span class="required">*</span></label>
                <div class="controls">
                    
                                
                   <select class="validate[required] span8"  name="cat_id">
						  <option value=""></option>
						  <?php foreach($category as $service){?>
						  <option value="<?php echo $service->id;?>_cat"><?php echo $service->cat_name;?></option>
                          <?php 
						  $subcount = DB::table('subcategory')
							->where('delete_status','=','')
							->where('cat_id','=',$service->id)
							->orderBy('subcat_name', 'asc')->count();
							if(!empty($subcount)){
							$subcategory = DB::table('subcategory')
							->where('delete_status','=','')
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
                      
                      
                                           
                        
                         <div class="control-group">
                <label class="control-label">Description <span class="required">*</span></label> 
                <div class="controls">
                                             
                        <textarea id="prod_desc" name="prod_desc" placeholder="" class="txteditor validate[required] span8"></textarea> 
                         
                         
					   </div>
                      </div>
                      
                      
                      
                      
                       <div class="control-group">
                <label class="control-label">Product Type <span class="required">*</span></label>
                <div class="controls">
                    
                                
                   <select class="validate[required] span8"  name="prod_type" id="prod_type">
						  <option value=""></option>
						  <?php foreach($product_type as $type){?>
						  <option value="<?php echo $type;?>"><?php echo $type;?></option>
						  <?php } ?>
						  </select>                       
                  
                </div>
              </div>
              
              
              
              
              <div class="control-group">
                <label class="control-label">Price <span class="required">*</span></label> 
                <div class="controls">
                        
                        
                          <input id="prod_price" class="validate[required] span8"  name="prod_price" value="" type="number">
                         
					   </div>
                      </div>
              
                   
                   
                   
                    <div class="control-group">
                <label class="control-label">Offer Price <span class="required">*</span></label> 
                <div class="controls">
                        
                        
                          <input id="prod_offer_price" class="validate[required] span8"  name="prod_offer_price" value="" type="number">
                         
					   </div>
                      </div>
                      
                      
                      
                      <div class="control-group">
                <label class="control-label">Available Quantity <span class="required">*</span></label> 
                <div class="controls">
                        
                        
                          <input id="prod_available_qty" class="validate[required] span8"  name="prod_available_qty" value="" type="number">
                         
					   </div>
                      </div>
                      
                 
                 
                 
                 
                 <div id="price_container" style="display:none;">     
                      
                      <div class="control-group">
                <label class="control-label">External Url <span class="required">*</span></label> 
                <div class="controls">
                        
                        
                          <input id="prod_external_url" class="validate[required] span8"  name="prod_external_url" value="" type="text">
                         
					   </div>
                      </div>

                      
                 </div> 
                 
                 
                 <?php if(!empty($typer_count)){?>
                 <?php foreach($typer as $type){
				 
				 
				 $value_cnt = DB::table('product_attribute_value')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('attr_id','=',$type->attr_id)
					->orderBy('attr_value', 'asc')->get();	
				 ?>
                 <div class="control-group">
              <label class="control-label">Select <?php echo $type->attr_name;?></label>
              <div class="controls">
                <select multiple >
                  <option>First option</option>
                  <option selected>Second option</option>
                  <option>Third option</option>
                  <option>Fourth option</option>
                  <option>Fifth option</option>
                  <option>Sixth option</option>
                  <option>Seventh option</option>
                  <option>Eighth option</option>
                </select>
              </div>
            </div>    
             <?php } } ?>         
                      
                      
                      
                      
                      
                      
                       <div class="control-group">
                <label class="control-label">Images <span class="required">*</span></label> 
                <div class="controls">
                        
                        
                          <input type="file" placeholder="" name="image[]" class="validate[required] span8" accept="image/*" multiple>
						  @if ($errors->has('image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                         
					   </div>
                      </div>
                      
                      
                      
                      
                 </div>     
                      
                      
                      
                      
                  
                      
                    
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                        <div class="span8">
                          
                          
                        <a href="<?php echo $url;?>/admin/product" class="btn btn-primary">Cancel</a>
                       
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>



</div>






     @include('admin.footer')
	
  </body>
</html>
