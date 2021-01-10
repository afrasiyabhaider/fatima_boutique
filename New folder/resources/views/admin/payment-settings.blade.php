<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
	
    
  </head>

  
  
   <body>
  
  
  @include('admin.top')
<!--close-top-serch-->
<!--sidebar-menu-->
@include('admin.menu')
  
  
  <div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Payment Settings</h1>
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
            <h5>Payment Settings</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $url = URL::to("/"); ?> 
            <form class="form-horizontal" method="post" action="{{ route('admin.payment-settings') }}" enctype="multipart/form-data" name="basic_validate" id="formID" novalidate="novalidate">
              {{ csrf_field() }}
              
              
              
               
						
                        
                        <div class="control-group">
                <label class="control-label">Payment Option</label>
                <div class="controls">
                        
						<?php 
						
						
						$array_payment =  explode(',', $settings[0]->payment_option);
						
						
						foreach($payment as $draw){?>
						<input type="checkbox" name="payment_opt[]" class="validate[required]" value="<?php echo $draw;?>" <?php  if(in_array($draw,$array_payment)){?> checked <?php } ?> > <?php echo $draw;?> <?php if($draw=="razorpay"){?> ( Indian Rupees - INR only support )<?php } ?><br/>
						<?php } ?>
						</div>
						
						</div>
                        
                        
                        
                        
                        <div class="control-group">
                <label class="control-label">Withdraw Option</label>
                <div class="controls">
                        
						<?php 
						
						
						$array =  explode(',', $settings[0]->withdraw_option);
						
						
						foreach($withdraw as $draw){?>
						<input type="checkbox" name="withdraw_opt[]" class="validate[required]" value="<?php echo $draw;?>" <?php  if(in_array($draw,$array)){?> checked <?php } ?> > <?php echo $draw;?><br/>
						<?php } ?>
						</div>
						
						</div>
                        
              
              <input type="hidden" name="bank_payment" value="<?php echo $settings[0]->bank_payment; ?>">
              <?php /*?><div class="control-group">
                <label class="control-label">Your Bank Payment Info</label>
                <div class="controls">
              
             
                          <textarea id="bank_payment" name="bank_payment" class="span8" style="min-height:150px;"><?php echo $settings[0]->bank_payment; ?></textarea>
						  
                        </div>
                      </div><?php */?>
              
              
              <div class="control-group">
                <label class="control-label">Paypal Id</label>
                <div class="controls">
             	
			<input id="paypal_id" type="text" name="paypal_id" value="<?php echo $settings[0]->paypal_id; ?>"  class="validate[required] span8">
                 		  		  		  
                </div>
              </div>   
                      
                      
                     
                      <div class="control-group">
                <label class="control-label">Paypal site Mode</label>
                <div class="controls">
             	
			
                 		
                     <select name="paypal_url" id="paypal_url" class="validate[required] span8">
						<option value="">Select</option>
									<option value="https://www.sandbox.paypal.com/cgi-bin/webscr" <?php { if($settings[0]->paypal_url=="https://www.sandbox.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Test</option>
									<option value="https://www.paypal.com/cgi-bin/webscr" <?php { if($settings[0]->paypal_url=="https://www.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Live</option>
								</select>   
                          		  		  
                </div>
              </div> 
              
              
              
             
                        
                        <div class="control-group">
                <label class="control-label">Stripe site Mode</label>
                <div class="controls">
                        
						
						<select name="stripe_mode" id="stripe_mode" class="validate[required] span8">
						<option value="">Select</option>
									<option value="test" <?php { if($settings[0]->stripe_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($settings[0]->stripe_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
              
              
              
              
              
              
             
                        
                        
                        <div class="control-group" id="stripe_test_publish" <?php if($settings[0]->stripe_mode!="test"){?>style="display:none;"<?php } ?>>
                <label class="control-label">Stripe Test Publishable key</label>
                <div class="controls">
                        
                        
                          <input id="test_publish_key" type="text" name="test_publish_key" value="<?php echo $settings[0]->test_publish_key; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div>
					  
                      
                      <div class="control-group" id="stripe_test_secret" <?php if($settings[0]->stripe_mode!="test"){?>style="display:none;"<?php } ?>>
                <label class="control-label">Stripe Test Secret key</label>
                <div class="controls">
					  
					  
                          <input id="test_secret_key" type="text" name="test_secret_key" value="<?php echo $settings[0]->test_secret_key; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div>
					  
                      
                      
                      
                      
                      
                      
                     
                      
                       
                        <div class="control-group" id="stripe_live_publish" <?php if($settings[0]->stripe_mode!="live"){?>style="display:none;"<?php } ?>>
                <label class="control-label">Stripe Live Publishable key</label>
                <div class="controls">
                       
                       
                          <input id="live_publish_key" type="text" name="live_publish_key" value="<?php echo $settings[0]->live_publish_key; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div>
					  
                      
                      
                      <div class="control-group" id="stripe_live_secret" <?php if($settings[0]->stripe_mode!="live"){?>style="display:none;"<?php } ?>>
                <label class="control-label">Stripe Live Secret key</label>
                <div class="controls">
					  
					   
                          <input id="live_secret_key" type="text" name="live_secret_key" value="<?php echo $settings[0]->live_secret_key; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div>
					  
                      
                      
                      
                      
                      
                      
                      
              
              
              
              <div class="control-group">
                <label class="control-label">Payhere site Mode</label>
                <div class="controls">
                        
						
						<select name="payhere_mode" id="payhere_mode" class="validate[required] span8">
						<option value="">Select</option>
									<option value="test" <?php { if($settings[0]->payhere_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($settings[0]->payhere_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
                
                
                
                
                <div class="control-group">
                <label class="control-label">Payhere Merchant Id</label>
                <div class="controls">
                
                
						
                          <input id="payhere_merchant_id" type="text" name="payhere_merchant_id" value="<?php echo $settings[0]->payhere_merchant_id; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div> 
              
              
              
              
              
                <div style="display:none;">
              
               <div class="control-group">
                <label class="control-label">Ccavenue Merchant Id</label>
                <div class="controls">
             	
			<input id="ccavenue_merchant_id" type="text" name="ccavenue_merchant_id" value="<?php echo $settings[0]->ccavenue_merchant_id; ?>"  class="validate[required] span8">
                 		  		  		  
                </div>
              </div>   
              
                
              <div class="control-group">
                <label class="control-label">Ccavenue Working Key</label>
                <div class="controls">
             	
			<input id="ccavenue_working_key" type="text" name="ccavenue_working_key" value="<?php echo $settings[0]->ccavenue_working_key; ?>"  class="validate[required] span8">
                 		  		  		  
                </div>
              </div>   
              
              
              
              <div class="control-group">
                <label class="control-label">Ccavenue Access Code</label>
                <div class="controls">
             	
			<input id="ccavenue_access_code" type="text" name="ccavenue_access_code" value="<?php echo $settings[0]->ccavenue_access_code; ?>"  class="validate[required] span8">
                 		  		  		  
                </div>
              </div>  
               
              </div>
              
              
              
              
              
              <div class="control-group">
                <label class="control-label">Razorpay Key Id</label>
                <div class="controls">
             	
			<input id="razorpay_key_id" type="text" name="razorpay_key_id" value="<?php echo $settings[0]->razorpay_key_id; ?>"  class="validate[required] span8">
                 		  		  		  
                </div>
              </div> 
              
              
              
              <div class="control-group">
                <label class="control-label">Razorpay Key Secret</label>
                <div class="controls">
             	
			<input id="razorpay_key_secret" type="text" name="razorpay_key_secret" value="<?php echo $settings[0]->razorpay_key_secret; ?>"  class="validate[required] span8">
                 		  		  		  
                </div>
              </div> 
              
              
              
               
              
					
                        
                        <div class="control-group">
                <label class="control-label">Commission Mode</label>
                <div class="controls">
                        
						
						<select name="commission_mode" id="commission_mode" class="validate[required] span8">
									<option value="fixed" <?php { if($settings[0]->commission_mode=="fixed") echo "selected='selected'"; }?>>Fixed</option>
									<option value="percentage" <?php { if($settings[0]->commission_mode=="percentage") echo "selected='selected'"; }?>>Percentage</option>
								</select>
						
                          
                        </div>
                      </div>
						
						
                         <div class="control-group">
                <label class="control-label">Enter Amout / percentage</label>
                <div class="controls">
                
                
						
                          <input id="commission_amt" type="text" name="commission_amt" value="<?php echo $settings[0]->commission_amt; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div> 
                      
                      
                      
                      
                       <div class="control-group">
                <label class="control-label">Minimum Withdraw Amount</label>
                <div class="controls">
                
                
                     
                          <input id="withdraw_amt" type="text" name="withdraw_amt" value="<?php echo $settings[0]->withdraw_amt; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      
                       <?php /*?><div class="control-group">
                <label class="control-label">Days Before Withdraw</label>
                <div class="controls">
                      
                      
                     
                          <input id="day_before_withdraw" type="text" name="day_before_withdraw" value="<?php echo $settings[0]->day_before_withdraw; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div><?php */?>
                      
                      <input type="hidden" name="day_before_withdraw" value="<?php echo $settings[0]->day_before_withdraw; ?>">
                      
                      
                      
                      
                      <div class="control-group">
                <label class="control-label">Processing Fee</label>
                <div class="controls">
                
                
                     
                          <input id="processing_fee" type="text" name="processing_fee" value="<?php echo $settings[0]->processing_fee; ?>"  class="validate[required] span8">
						  
                        </div>
                      </div>
					  
					
              
              <div class="form-actions">
                        <div class="span8">
                         <a href="<?php echo $url;?>/admin/payment-settings" class="btn btn-primary">Cancel</a>
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
