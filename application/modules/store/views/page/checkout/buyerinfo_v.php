<script>
$(document).ready(function(){
		if($('input[name=different_address]').is (':checked')){
				$('.ship_to_info').show();
			}else{
				$('.ship_to_info').hide();
			
			}
			$('input[name=different_address]').click(function(){
		
			if($('input[name=different_address]').is (':checked')){
				$('.ship_to_info').show('drop');
			}else{
				$('.ship_to_info').hide('drop');
			
			}
		});
		
		
	});
</script>

<?if(!$this->session->userdata('login_data') && !$this->cart->customer_info){?>
<script type="text/javascript">
	$(document).ready(function(){
		
		if($('input[name=register]').is (':checked')){
			$('.register_info').show();
		//	$('.login_mod').hide();
			}else{
		//	$('.login_mod').show();
			$('.register_info').hide();
			}
		$('input[name=register]').click(function(){
		
			if($('input[name=register]').is (':checked')){
		//	$('.login_mod').hide('slide', {direction:'up'});
			$('.register_info').delay(500).show('slide', {direction:'up'});
			
			}else{
			$('.register_info').hide('slide', {direction:'up'});
		//	$('.login_mod').delay(500).show('slide', {direction:'up'});
			}
		});
	});
</script>
<?}?>
<div class="buyerinfo" id="buyerinfo" >
<?=$cart;?>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('.form_buyerinfo .email_customer').blur(function(){
            var email = $('.email_customer').val();
           $.ajax({
               url : '<?=site_url('store/checkout/ajax_checkmail');?>',
               type : 'POST',
               dataType : 'json',
               data : {email: email },
               success : function(data){},
               
           })
        });
    });
  </script>
    <div class="form_buyerinfo">
    <form action="<?=current_url();?>" method="post">
      <h4 class="noBold mb5">Contact Detail</h4>
      <div class="horline"></div>
     <? if(!$this->session->userdata('login_data') && !$this->cart->customer_info){;?>
         <script>
         $(document).ready(function(){
         	$('a.do_login').click(function(){
         		var dataPost = {email :$('input[name="log_email"]').val(), password:$('input[name="log_password"]').val(), red:'store/checkout/buyer/info'};
         		$.ajax({
         			type : "POST",
         			dataType : "json",
         			url : "<?=site_url()?>/user/auth/ajx_frontend_login",
         			data : dataPost,
         			success: function(data){					     
         						   	if(data.status == 'success'){
         						  	window.location.reload();
         						   	}else if(data.status == 'failed'){
         						   		$('.loginMod .ajax_loader_small').fadeOut();
         						   		$('.loginMod .ajx_msg-Ui').append(data.msg).fadeIn().delay(2000).fadeOut();
         						   	}
         					   },
         			})
         		return false;
         		});
         	});

         </script>
         	<div class="login_mod form-Ui relative hide">
           		<div class="login_form">
                <div class="w_30 left mr20">
           		<label for="log_email">Email</label><input type="text" name="log_email" value="">
           		</div>
           		<div class="w_30 left">
           		<label for="log_password">Password</label><input type="password" name="log_password" value="">
           		</div>
           	    <div class="w_20 left ml20 font70 relative">
                    <a href="#" class="do_login absolute" style="bottom:0px"><span class="button">Login</span></a>
                 </div>
                 <br class="clear"/>
                 </div>
           <?  //echo modules::run('user/user_widget/login_mod_front');?>
         	</div>
     <?}?>
     <div class="contact_detail">
        <div class="customer_email  padd10 left mr10 " style="border-right:1px solid #E4E4E4">
        <div class="grid_100 mr10 left">Your Mail</div><div class="left"><input type="text" name="email" class="email_customer grid_300 padd10" value="<?=$buyer_data['email'];?>"></div>
        <br class="clear"/>
        </div>
        <div class="login_confirm padd5 left grid_260 relative">
             <?if(!$this->session->userdata('login_data') && !$this->cart->customer_info){?>
                 <h4 class="noBold mb5 left mr10">Login</h4>
                    <div class="left mt10"><small>You can Login here, if you already register</small></div>
                <br class="clear"/>
            <?}?>
        </div>
        
        <br class="clear"/>
    </div>
    <div class="horline mb10"></div>
     
   <div class="form-Ui customer_info grid_370 left" style="background-color:#FFF;">
  <h4 class="noBold">Billing Infomation</h4>
   <div class="form-Info">
   <small>Fill This form completely</small>
   </div>
    	<div class="inputSet">
			<div class="label">
            	<span>First Name</span>
            </div>
			<div class="input">
				<input type="text" name="first_name" value="<?=$buyer_data['first_name'];?>">
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Last Name</span>
            </div>
			<div class="input">
				<input type="text" name="last_name" value="<?=$buyer_data['last_name'];?>">
			</div>
			<div class="clear"></div>
		</div>
          
        <div class="inputSet">
			<div class="label">
            	<span>Address</span>
            </div>
			<div class="input">
				<textarea  name="address"><?=$buyer_data['address'];?></textarea>
			</div>
			<div class="clear"></div>
		</div>
         <div class="inputSet">
			<div class="label">
            	<span>Country</span>
            </div>
			<div class="input">
				<select name="country_id">
                <option value="">Choose One</option>
                	<? foreach($countries as $country){
                	if(isset($buyer_data['country_id'])){
                		if($buyer_data['country_id'] == $country->country_id ){
                			$select = 'selected';
                		}else{
                			$select = '';
                		}
                	}else{
                		$select = '';
                	}	
                	;?>
                		
                    <option <?=$select;?> value="<?=$country->country_id;?>"><?=$country->country_name;?></option>
                    <? } ?>
                </select>
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Province</span>
            </div>
			<div class="input">
				<input type="text" name="province" value="<?=$buyer_data['province'];?>">
			</div>
			<div class="clear"></div>
		</div>
		<style>
			.ui-autocomplete {
				max-height: 150px;
				overflow-y: auto;
				/* prevent horizontal scrollbar */
				overflow-x: hidden;
				/* add padding to account for vertical scrollbar */
				padding-right: 5px;
			}
			/* IE 6 doesn't support max-height
			 * we use height instead, but this forces the menu to always be this tall
			 */
			* html .ui-autocomplete {
				height: 150px;
			}
			</style>
		
        <script>
		$(document).ready(function() {

            $(".city").autocomplete({
               
                minLength: 2,
                method: "POST",
                source: function(request, response) {
                $.ajax({
                  url: "<?=site_url('store/carrier_cont?cr=jne/ajax_getcity');?>",
                  data: {city: $('.city').val()},
                  dataType: "json",
                  type: "POST",
                  success: function(data){
                      response(data);
					if(data.city_code == null){
						$(this).autocomplete( "close" );
						}
                	}
                });
              	},
				/*
				search: function(event, ui) { 
					setTimeout(function() {
									$(this).autocomplete( "close" );
								}, 1000 );
					
				},
				*/
                select: function(event, ui) {
                    $('.city').val(ui.item.value);
                    $('.city_code').val(ui.item.city_code);
                }
            });
        });

		</script>
         <div class="inputSet  ui-widget">
			<div class="label">
            	<span>City</span>
            </div>
			<div class="input">
				<input type="text" class="city" name="city" value="<?=$buyer_data['city'];?>">
				<input type="hidden" class="city_code" name="city_code" value="<?=$buyer_data['city_code'];?>" >
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Zip</span>
            </div>
			<div class="input">
				<input type="text" name="zip" value="<?=$buyer_data['zip'];?>">
			</div>
			<div class="clear"></div>
		</div>
		 <div class="inputSet">
			<div class="label">
            	<span>Phone</span>
            </div>
			<div class="input">
				<input type="text" name="phone" value="<?=$buyer_data['phone'];?>">
			</div>
			<div class="clear"></div>
		</div>
         <div class="inputSet">
			<div class="label">
            	<span>Mobile</span>
            </div>
			<div class="input">
				<input type="text" name="mobile" value="<?=$buyer_data['mobile'];?>">
			</div>
			<div class="clear"></div>
		</div>	
		<?if(!$this->session->userdata('login_data') && !$this->cart->customer_info){?>
		  <div class="inputSet left  w_50">
    			Become a Member <br class="clear"/>
    			<input type="checkbox" name="register" value="1"><small>Creditial Info is Required</small>
    		</div>
		<?}?>
		<div class="inputSet left w_50">
			<? if($this->cart->shipto_info || $this->input->post('different_address')){
				$different = 'checked';
			}else{
				$different ='';
			}?>
			ship to different addres <br class="clear"/>
			<input type="checkbox" <?=$different;?> name="different_address" value="1">
			<div class="clear"></div>
		</div>
		<?if(!$this->session->userdata('login_data') && !$this->cart->customer_info){?>
		<div class="clear"></div>
		<div class="form-Ui  register_info hide">
        <h4 class="noBold">Register Information</h4>
         <div class="inputSet">
  			<div class="label">
              	<span>Password</span>
              </div>
  			<div class="input">
  				<input type="password" name="password" value="">
  			</div>
  			<div class="clear"></div>
  		</div>
  		 <div class="inputSet">
  			<div class="label">
              	<span>Retype Password</span>
              </div>
  			<div class="input">
  				<input type="password" name="re_password" value="">
  			</div>
  			<div class="clear"></div>
  		</div>
          <div class="inputSet">
  			<div class="label">
              	<span>Gender</span>
              </div>
  			<div class="input">
  				<select name="gender">
                 		 <option value="">Choose One</option>
                  	<option value="m">Male</option>
                      <option value="f">female</option>
                  </select>
  			</div>
  			<div class="clear"></div>
  		</div>
           <div class="inputSet">
  			<div class="label">
              	<span>Birthday</span>
              </div>
  			<div class="input ">
  				<input class="text-input grid_250"  type="text" name="birthday" value="yyyy-mm-dd">
  			</div>
  			<div class="clear"></div>
  		</div>
        </div>
		<?}?>
	
		
		
    </div>
        <div class="addOn_info right grid_300">
<script>
$(document).ready(function(){
	$('input[name=different_address]').click(function(){
		$('.ship_to_info input , .ship_to_info select , .ship_to_info textarea').val('').removeAttr('selected');
	});
});
</script>
      <div class="form-Ui  ship_to_info hide">
      <h4 class="noBold">Shipping Address</h4>	
      <div class="form-Info">
      <small>Fill this form if you want to send to different address</small>
      </div>
    	<div class="inputSet">
			<div class="label">
            	<span>First Name</span>
            </div>
			<div class="input">
				<input type="text" name="ship_first_name" value="<?=$ship_data['first_name'];?>">
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Last Name</span>
            </div>
			<div class="input">
				<input type="text" name="ship_last_name" value="<?=$ship_data['last_name'];?>">
			</div>
			<div class="clear"></div>
		</div>
          
        <div class="inputSet">
			<div class="label">
            	<span>Address</span>
            </div>
			<div class="input">
				<textarea  name="ship_address"><?=$ship_data['address'];?></textarea>
			</div>
			<div class="clear"></div>
		</div>
         <div class="inputSet">
			<div class="label">
            	<span>Country</span>
            </div>
			<div class="input">
				<select name="ship_country_id" class=" grid_300">
                <option value="">Choose One</option>
                	<? foreach($countries as $country){
                	if(isset($ship_data['country_id'])){
                		if($ship_data['country_id'] == $country->country_id ){
                			$select = 'selected';
                		}else{
                			$select = '';
                		}
                	}else{
                		$select = '';
                	}	
                	;?>
                		
                    <option <?=$select;?> value="<?=$country->country_id;?>"><?=$country->country_name;?></option>
                    <? } ?>
                </select>
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Province</span>
            </div>
			<div class="input">
				<input type="text" name="ship_province" value="<?=$ship_data['province'];?>">
			</div>
			<div class="clear"></div>
		</div>
		<style>
			.ui-autocomplete {
				max-height: 150px;
				overflow-y: auto;
				/* prevent horizontal scrollbar */
				overflow-x: hidden;
				/* add padding to account for vertical scrollbar */
				padding-right: 5px;
			}
			/* IE 6 doesn't support max-height
			 * we use height instead, but this forces the menu to always be this tall
			 */
			* html .ui-autocomplete {
				height: 150px;
			}
			</style>
		
        <script>
		$(document).ready(function() {

            $(".ship_city").autocomplete({
               
                minLength: 2,
                method: "POST",
                source: function(request, response) {
                $.ajax({
                  url: "<?=site_url('user/getcity');?>",
                  data: {city: $('.ship_city').val()},
                  dataType: "json",
                  type: "POST",
                  success: function(data){
                      response(data);
					if(data.city_code == null){
						$(this).autocomplete( "close" );
						}
                	}
                });
              	},
				/*
				search: function(event, ui) { 
					setTimeout(function() {
									$(this).autocomplete( "close" );
								}, 1000 );
					
				},
				*/
                select: function(event, ui) {
                    $('.ship_city').val(ui.item.value);
                    $('.ship_city_code').val(ui.item.city_code);
                }
            });
        });

		</script>
         <div class="inputSet  ui-widget">
			<div class="label">
            	<span>City</span>
            </div>
			<div class="input">
				<input type="text" class="ship_city" name="ship_city" value="<?=$ship_data['city'];?>">
				<input type="hidden" class="ship_city_code" name="ship_city_code" value="<?=$ship_data['city_code'];?>" >
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Zip</span>
            </div>
			<div class="input">
				<input type="text" name="ship_zip" value="<?=$ship_data['zip'];?>">
			</div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label">
            	<span>Phone</span>
            </div>
			<div class="input">
				<input type="text" name="ship_phone" value="<?=$ship_data['phone'];?>">
			</div>
			<div class="clear"></div>
		</div>
         <div class="inputSet">
			<div class="label">
            	<span>Mobile</span>
            </div>
			<div class="input">
				<input type="text" name="ship_mobile" value="<?=$ship_data['mobile'];?>">
			</div>
			<div class="clear"></div>
		</div>
		
      </div>
</div>
		<div class="clear"></div>

    <div class="right">
    <input class="button" type="submit" name="submit" value="Next" id="register">
   </div>
<div class="clear"></div>
    </form>
    </div>

    <div class="clear"></div>
</div>
