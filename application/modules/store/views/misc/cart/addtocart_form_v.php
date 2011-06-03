	
	
	<script>
		$(document).ready(function(){
		   	function destroy(){
    			    	$('.confirmation_msg').remove();
    		}
    		function reverse(){
    		     $('input[name="addcart"]').val('Add To Cart');
    		}
    		function delNotif(){
    		    $('.notif').remove();
    		}
			$('#buyProd').submit(function(){
			var size= $('select[name="s"]');
			var color = $('select[name="c"]');
			var qty= $('input[name=qty]');
			if(size.val() == 'no' && color.val() == 'no'){
				$.jGrowl('Please Choose size and color', {position: 'center', header: 'warning', theme: 'warning' });
			}else if(size.val() != 'no' && color.val() == 'no'){
				$.jGrowl('Please Choose color', {position: 'center', header: 'warning', theme: 'warning' });
			}else if(size.val() == 'no' && color.val() != 'no'){
				$.jGrowl('Please Choose size', {position: 'center', header: 'warning', theme: 'warning' });
			}else if(qty.val() == 'QTY'){
				$.jGrowl('Please enter the Quantity', {position: 'center', header: 'warning', theme: 'warning' });
			}else{
		
			var data = $(this).serialize();
			$('input[name="addcart"]').val('adding..').animate({backgroundColor : '#000', color: '#fff'}, 1000);
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "<?=site_url()?>/store/cart/ajax_buyProd",
				data : data,
				success: function(data){
				    	$('input[name="addcart"]').delay(1000).animate({backgroundColor : '#DDDDDD', color: '#7B7979'}, 1000, reverse);
						if(data.status == 'on') {
						    $('input[name="addcart"]').after('<br class="clear"/><div class="notif hide"><small>success add to cart</small></div>');
						    $('.notif').show('fade').delay(2000).hide('fade', delNotif);
						    $('.smallcart').empty().append(data.new_cart);
						}else if(data.status == 'min'){
						    $.jGrowl('Please enter lower number for the quatity', {position: 'center', header: 'warning', theme: 'warning' });			
						}else if(data.status == 'off'){
						$('.request_area').hide();
						$('.confirmation_msg').hide();
						$('.addToCart').hide('drop', {direction : 'right'});
						$('.request_area').before(data.msg);
						$('.confirmation_msg').delay(500).show('drop', {direction:'left'});
				    	$('.confirm .yes').click(function(){
    					     $('.confirmation_msg').hide('drop', {direction :'right'}, destroy);
    					     $('.request_area').delay(1000).append(data.request_form).show('drop', {direction:'left'});
    					});
    					$('.confirm .no').click(function(){
				             $('.confirmation_msg').hide('drop', {direction :'left'}, destroy);
				    	    $('.addToCart').delay(1000).show('drop', {direction : 'right'});
    					});

						}
					}
				
				});
				}
			return false;
			
		});
			});
		</script>

<div class="addToCartForm">
<div class="request_area">
</div>
<div class="addToCart">
	<form method="post" id="buyProd" action="<?=current_url();?>">
		<div class="attrbProd">
			
	<? if($a){?>
		<?/* next task, for next version
		// I think its, pretty simpler.. heheheh
		$attributes = $this->cart->extractAttrib($a);
			foreach($attributes['attribute'] as $index => $value){;?>
				<select name="<?=$index?>">
					<option value="nope"><?=$index?></option>
					<?foreach($value as $v){?>
						<option value="<?=$v;?>"><?=$v?></option>
			<?}?>
				</select>
		<?}*/?>
		
		
	<?
	$colors = $this->cart->loadAttrib($a, 'c');
	$sizes = $this->cart->loadAttrib($a, 's');
	?>
		<select name="s">
			<option value="no">size</option>
		<? foreach($sizes as $size){?>
			<option value="<?=$size?>"><?=$size?></option>
		<?}?>
		</select>
		<select name="c">
			<option value="no">Color</option>
		<? foreach($colors as $color){?>
			<option value="<?=$color?>"><?=$color?></option>
		<?}?>
		</select>
		<input type="hidden" name="have_attrb" value="y">
	<?}else{?>
		<input type="hidden" name="have_attrb" value="n">
	<?}?>	
		<input type="text" name="qty" class="text-input grid_50" value="QTY"/>
		</div>
		<div class="clear"></div>
		<br/>
		<input type="hidden" value="<?=$p->id;?>" name="id_prod"/>
		<input type="submit" name="addcart" value="Add to Cart" class="button"/>
		
		
	</form>
    </div>
	</div>
	

	
	</div>