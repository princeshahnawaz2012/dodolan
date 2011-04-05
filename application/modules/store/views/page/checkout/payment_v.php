<div class="payment_method">
<h3 class="left">Paymnet</h3><div class="right"><?=modules::run('store/checkout/checkoutmenu')?></div> 
<br class="clear"/>
	<?=$cart;?>
	<div class="checkout-step">
	
		<small>Please Choose One Payment Method you Desire</small>
		<br/></br>
		<script>
		$(document).ready(function(){
			$(".method_items .item").click(function () {
				$('.method_items .item').removeClass('checked');
			      $(this).toggleClass("checked");
					$(this).find('.choosen_paymnet').attr('checked', true);
			   });
		
		});
		</script>

		<div class="form-Ui">
		<form action="<?=current_url();?>" method="post">
			<div class="method_items">
				<div class="item left mr_10 grid_230">
					<div class="button_payment paypal grid_200 ctr">
						<div class="payment_img ctr"></div>
						<input type="radio" name="payment_method" value="paypal" class="choosen_paymnet hide">
					</div>
				</div>
				<div class="item left mr_10 grid_230">
					<div class="button_payment bca grid_200 ctr">
						<div class="payment_img ctr"></div>
						<input type="radio" name="payment_method" value="bca" class="choosen_paymnet hide">
					</div>
				</div>
				<div class="item left mr_10 grid_230">
					<div class="button_payment mandiri grid_200 ctr">
						<div class="payment_img ctr"></div>
						<input type="radio" name="payment_method" value="mandiri" class="choosen_paymnet hide">
					</div>
				</div>
			<div class="clear"></div>	
			<br/>
			</div>
			<div class="horline"></div>
			<input type="submit" class="button right" name="next" value="Next">
			<br class="clear"/>
		</form>
		</div>
	</div>
	
</div>