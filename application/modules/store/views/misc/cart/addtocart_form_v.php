	
	
	<script>
		$(document).ready(function(){
		   	function destroy(){
    			    	$('.confirmation_msg').remove();
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
				$.jGrowl('Please the Quantity', {position: 'center', header: 'warning', theme: 'warning' });
			}else{
		
			var data = $(this).serialize();
			$('input[name="addcart"]').val('adding..')
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "<?=site_url()?>/store/cart/ajax_buyProd",
				data : data,
				complete :function(){
				    $('input[name="addcart"]').val('Add To Cart');
				},
				success: function(data){					     
						if(data.status == 'on') {
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