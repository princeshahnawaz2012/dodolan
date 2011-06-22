<div class="payment_method">

	<?=$cart;?>
	<div class="checkout-step">
		<script>
		$(document).ready(function(){
			var item = $('.choosen_payment:checked');
			var item_val = item.val();
			if(item){
				item.parents('.item').addClass('checked');
				$('.payment_information .'+item_val).show().addClass('active');
			}
			$(".method_items .item").click(function () {
				$('.payment_information .active').hide().removeClass('active');
				$('.method_items .item').removeClass('checked');
			      $(this).toggleClass("checked");
					var choosen = $(this).find('.choosen_payment');
					var ch_val = choosen.val();
					choosen.attr('checked', true);
					$('.payment_information .'+ch_val).delay(300).show().addClass('active');
					
			});
		
		});
		</script>
		<?if($this->cart->payment_info){ $checked = 'checked=checked'; }else{ $checked = '';}?>
		
		<div class="form-Ui">
		<form action="<?=current_url();?>" method="post">
			<div class="method_items">
				<div class="item left mr_10 grid_230">
					<div class="button_payment paypal grid_200 ctr">
						<div class="payment_img ctr"></div>
						<input type="radio" <?if($this->cart->payment_info['method'] == 'paypal'){ echo $checked ;}?> name="payment_method" value="paypal" class="choosen_payment hide">
					</div>
				</div>
				<div class="item left mr_10 grid_230">
					<div class="button_payment bca grid_200 ctr">
						<div class="payment_img ctr"></div>
						
						<input type="radio" <?if($this->cart->payment_info['method'] == 'bca'){ echo $checked ;}?> name="payment_method"  value="bca" class="choosen_payment hide">
					</div>
				</div>
				<div class="item left mr_10 grid_230">
					<div class="button_payment mandiri grid_200 ctr ">
						<div class="payment_img ctr"></div>
						<input type="radio" <?if($this->cart->payment_info['method'] == 'mandiri'){ echo $checked ;}?> name="payment_method" value="mandiri" class="choosen_payment hide">
					</div>
				</div>
			<div class="clear"></div>
	
			<br/>
			</div>
			<div class="horline"></div>
			<div class="payment_information left">
				<div class="item paypal">
					You will charge 4% from your mount tottal, after you complete this order, you will redirect to paypal to do payment
				</div>

				<div class="item mandiri">
					Transfer to Rekening Bank Mandiri / Lurence Muljono / 1099778888
				</div>

				<div class="item bca">
					Transfer to Rekening Bank BCA / Lurence Muljono / 1099778888
				</div>
			</div>
			<input type="submit" class="button right" name="next" value="Next">
			<br class="clear"/>
		</form>
		</div>
	</div>
	
</div>