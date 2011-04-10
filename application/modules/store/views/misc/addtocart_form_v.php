	
	
	<script>
		$(document).ready(function(){
			$('#buyProd').submit(function(){
			var size= $('select[name="s"]');
			var color = $('select[name="c"]');
			var qty= $('input[name=qty]');
		
			if(size.val() == 'no' && color.val() == 'no'){
				$('.ajaxdialog').notice('warning','please choose color and size');
			}else if(size.val() != 'no' && color.val() == 'no'){
				$('.ajaxdialog').notice('warning','please choose color');
			}else if(size.val() == 'no' && color.val() != 'no'){
					$('.ajaxdialog').notice('warning','please choose size');
			}else if(qty.val() == 'QTY'){
				$('.ajaxdialog').notice('warning','please input the quantity');
				}
			else{
			var data = $(this).serialize();
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "<?=site_url()?>/store/cart/ajax_buyProd",
				data : data,
				success: function(data){					     
						if(data.status == 'on') {
							$('.smallcart').empty().append(data.new_cart);
							$('.ajaxdialog').notice('success','item successfully added to cart');
						}else if(data.status == 'min') {
							$('.ajaxdialog').notice('information','please input lower quantity');
						}else{
							
							$('.ajaxdialog').append(data.msg+'<div class="clear"></div>request restock update for this item ?');
						//	$('.ajaxdialog').notice('information', data.msg+'<div class="clear"></div>would request restock update for this item ?, we we will send you email, when this item available');
						
						$('.ajaxdialog').dialog({
									title : 'Request Restock Update',
									modal: true,
									buttons: {
										"Yes": function() {
												$( this ).dialog( "close" );
											
												$('.addToCart').hide('drop', {direction:'top'});
												$('.request_area').hide();
												$('.request_area').append(data.request_form);
												$('.request_area').delay(500).show('drop', {direction:'top'});
												
										},
										no: function() {
												$( this ).dialog( "close" );
											
										}
									},
									close: function(event, ui) {
										$(this).empty().dialog('destroy');
										}
								});
						
						/*
							$('.addToCart').fadeOut(1000)
							$('.request_area').hide();
							$('.request_area').append(data.request_form);
							$('.request_area').delay(1000).fadeIn('slow');
							*/
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
		<?/*
		
		//next version task
		$index_attrb = $this->cart->extractAttrib($a);
		foreach($index_attrb as $attrb){
			$new_sort[$attrb] = $this->cart->loadAttrib($a, $attrb);
		;?>
		<select name="<?=$attrb;?>">
			<option value="no"><?=$attrb;?></option>
			<? foreach($new_sort[$attrb] as $value){?>
				<option value="<?=$value;?>"> <?=$value;?> </option>
			<?
			}
			?>
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