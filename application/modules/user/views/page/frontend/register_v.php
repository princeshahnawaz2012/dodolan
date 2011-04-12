<div class="registerView">
	<div class="form-Ui grid_500">
		<form action="<?=current_url();?>" method="post">
    <h3><?=$pT;?></h3>
     <div class="inputSet">
			<div class="label">
            	<span>Email</span>
            </div>
			<div class="input">
				<input type="text" name="email" value="">
			</div>
			<div class="clear"></div>
		</div>
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
            	<span>First Name</span>
            </div>
			<div class="input">
				<input type="text" name="first_name" value="">
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Last Name</span>
            </div>
			<div class="input">
				<input type="text" name="last_name" value="">
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
			<div class="input grid_250">
				<script>
				$(document).ready(function(){

				$(".hasdate").datepicker({				
				dateFormat:"yy-mm-dd",
				changeMonth:true,
				changeYear:true,
				yearRange: 'c-90:c+0'
			
				});
			});
				</script>
				<input class="text-input hasdate"  type="text" name="birthday" value="yyyy-mm-dd">
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Address</span>
            </div>
			<div class="input">
				<textarea  name="address"></textarea>
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
                	<? foreach($countries as $country){;?>
                    <option value="<?=$country->country_id;?>"><?=$country->country_name;?></option>
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
				<input type="text" name="province" value="">
			</div>
			<div class="clear"></div>
		</div>
		<script>
		$(document).ready(function() {

            $(".city").autocomplete({
               
                minLength: 2,
                method: "POST",
                source: function(request, response) {
                $.ajax({
                  url: "<?=site_url('user/getcity');?>",
                  data: {city: $('.city').val()},
                  dataType: "json",
                  type: "POST",
                  success: function(data){
                      response(data);
                  }
                });
              	},
                select: function(event, ui) {
                    $('.city').val(ui.item.value);
                    $('.city_code').val(ui.item.city_code);
                },
                close: function(event, ui) {
                	
                 }

            });
        });

		</script>
         <div class="inputSet  ui-widget">
			<div class="label">
            	<span>City</span>
            </div>
			<div class="input">
				<input type="text" class="city" name="city" value="">
				<input type="hidden" class="city_code" name="city_code" >
			</div>
			<div class="clear"></div>
		</div>
        <div class="inputSet">
			<div class="label">
            	<span>Zip</span>
            </div>
			<div class="input">
				<input type="text" name="zip" value="">
			</div>
			<div class="clear"></div>
		</div>
         <div class="inputSet">
			<div class="label">
            	<span>Mobile</span>
            </div>
			<div class="input">
				<input type="text" name="mobile" value="">
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<input class="button" type="submit" name="register" value="register" id="register">
		</form>
    </div>

</div>