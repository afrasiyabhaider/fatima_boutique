<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
    @include('admin.table-style')
    
  </head>

  <body>
  @include('admin.top')

@include('admin.menu')
<?php $url = URL::to("/"); ?>





<div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Product Orders</h1>
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



                 <?php /*?><div align="right">
                
                  
                  
				 <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Product</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add_product" class="btn btn-primary">Add Product</a>
				  <?php } ?>
                 </div><?php */?>
<div class="widget-box">
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Product Orders</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                         <th>Sno</th>
                         
                          <th>Order Id</th>
                          
                          
						  
                          <th>Username</th>
                          
                          <th>Email</th>
                          
                          <th>Phone</th>
                          
                         
                          
                          <th>Vendors Amount<br/>(subtotal + shipping)</th>
                          
                          <th>Admin Amount<br/>(processing fee + commission)</th>
                          
                           <th>Total</th>
                          
                          <th>Payment Type</th>
                          
                          <th>Payment Approve?</th>
                          
                          <th>Status</th>
                          
                        <th>View More</th>  
                         
                         
                         
                         
                         
              </thead>
              <tbody>
					  <?php
					  if(!empty($productt_count)){ 
					  $i=1;
					  foreach ($productt as $product) { 
					  $vendor_amt = $product->shipping_price + $product->subtotal;
					  
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $vendor_amt) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($product->total < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   
				   
				   
				   $vendor_commission = $vendor_amt - $commission_amount;
				   
				   $admin_commission = $product->processing_fee + $commission_amount;
					  
					    ?>
    
						
                        <tr>
                        
                        
						 <td><?php echo $i;?></td>
                         
                         <td><?php echo $product->purchase_token;?></td>
                         
                         
                         
                         <?php
						 
						 $user_count = DB::table('users')
		                              ->where('id', '=' , $product->user_id)
				                      ->count();
						 if(!empty($user_count))
						 {
						 $user = DB::table('users')
		                              ->where('id', '=' , $product->user_id)
				                      ->get();
						$username = $user[0]->name;
						$email = $user[0]->email;
						$phone = $user[0]->phone;
						}
						else
						{
						  $username = "";
						  $email = "";
						  $phone = "";
						}			  
						 
						 ?>
                         <td><?php echo $username;?></td>
                          <td><?php echo $email;?></td>
                         <td><?php echo $phone;?></td>
                         
                         
                         
						 
                         
                         
                         
                          
                           <td>
						   <?php if(empty($product->vendor_amount)){?>
						   
						   <?php echo $setts[0]->site_currency.' '.number_format($vendor_commission,2);?>
                           
                           <?php } else { ?>
                           
                           <?php echo $setts[0]->site_currency.' '.number_format($product->vendor_amount,2);?>
                           
                           <?php } ?>
                           </td>
                          
                         <td>
						 <?php if(empty($product->admin_amount)){?>
						 
						 <?php echo $setts[0]->site_currency.' '.number_format($admin_commission,2);?>
                         
                         <?php } else { ?>
                           
                           <?php echo $setts[0]->site_currency.' '.number_format($product->admin_amount,2);?>
                           
                           <?php } ?>
                         </td>
                          
                        <td><?php echo $setts[0]->site_currency.' '.number_format($product->total,2);?></td>
                          
                          <td><?php echo $product->payment_type;?></td>
                          
                          <td>
						  <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
                   <?php } else { ?>
						  <?php if($product->payment_status=="completed"){ if($product->payment_approval==0){ ?><a href="<?php echo $url;?>/admin/orders/<?php echo $product->purchase_token;?>/<?php echo $admin_commission;?>/<?php echo $vendor_commission;?>" class="btn btn-success">Waiting For Approval</a><?php } else{ ?><span style="color:#00CC33;">Approved</span><?php } } ?>
                           <?php } ?>
                          
                          </td>
                          
                          
                          
                          <?php if($product->payment_status=="completed"){ $clr = "#115D11"; } else { $clr = "#D3140E"; } ?>
                          <td style="color:<?php echo $clr;?>"><?php echo $product->payment_status;?></td>
                          
                          
                          <td>
                          <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/view_orders/<?php echo $product->purchase_token;?>" class="btn btn-primary">View More</a>
				  <?php } ?>
                          </td>
                          
                          
                          
                          
                          
                          <?php /*?><td>
                          
                           <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/product/action/{{ $product->prod_id }}/{{ $sid }}/{{ $product->user_id }}" class="<?php echo $btn;?>"><?php echo $text;?></a>
						  
				  <?php } ?>
                          
                          
                          </td><?php */?>
                          
                          
                          
                          
                          
						  
						 
                        </tr>
                        <?php $i++;} } ?>
                       
                      </tbody>
            </table>
           
          </div>
          
        </div>
  
  
  
  
   
		 </div>
         </div>
         </div>
         
         
         </div>
         
         
         
  

    
	@include('admin.footer')
  </body>
</html>
