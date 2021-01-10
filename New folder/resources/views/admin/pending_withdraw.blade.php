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
    <h1>Pending Withdraw</h1>
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
           

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Pending Withdraw</h5>
          </div>
          
          
          <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table" id="datatable-responsive">
              <thead>
                <tr>
                                           
                          
          
                        
                          <th>SNo</th>
											<th>Amount</th>
											<th>Payment Type</th>
											<th>Paypal Id</th>
                                            <th>Stripe Id</th>
                                            <th>Bank Account No</th>
                                            <th>Bank Info</th>
                                            <th>IFSC Code</th>
                                            
                                            <th>Action</th>
                                            
                         
                         
                         
                         
                         
                         
              </thead>
              <tbody>
             <?php if(!empty($pending_count)){?>
                                        <?php 
										$i=1;
										foreach($pending_view as $view_withdraw){?>	
    
						
                        <tr>
											<td><?php echo $i;?></td>
											<td><?php echo $view_withdraw->withdraw_amount.' '.$site_setting[0]->site_currency;?></td>
											<td><?php echo $view_withdraw->withdraw_payment_type;?></td>	
											<td><?php echo $view_withdraw->paypal_id;?></td>	
												
											<td><?php echo $view_withdraw->stripe_id;?></td>											
											<td><?php echo $view_withdraw->bank_account_no;?></td>
                                            <td><?php echo $view_withdraw->bank_info;?></td>
                                            <td><?php echo $view_withdraw->bank_ifsc;?></td>
                                           
                                            <td>
                          <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-success btndisable">Mark as complete</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/pending_withdraw/<?php echo base64_encode($view_withdraw->wid);?>" class="btn btn-success">Mark as complete</a>
				  <?php } ?>
                          </td>
										</tr>
                        <?php $i++;} ?>
                        <?php } ?>	
                                
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
