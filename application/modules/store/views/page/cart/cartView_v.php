<div class="cartView_v">
	<?if($items){?>
	<div class="table-Ui">
	<script>
		$(document).ready(function(){
			$('.update_button').click(function(){
			var parent = $(this).parent().parent().parent();
			var qty = parent.find('.input_qty').val();
			var rowid = parent.find('.input_rowid').val();
			var data = {qty:qty, rowid:rowid};
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "<?=site_url()?>/store/cart/ajax_updateCart",
				data : data,
				 success: function(data){					     
						   	if(data.status == 'on' && data.new_qty != 0 ){
						 		$(parent).find('.subtotal').empty().append(data.new_subtotal);
								$('.totalcartvalue').empty().append(data.new_total);
								$('.totalitems').empty().append(data.new_total_item	);
						   	}else if(data.status == 'off'){
								$(parent).find('.input_qty').val(data.new_qty);
						   			$.jGrowl(data.msg, {position: 'center', header: 'warning', theme: 'warning' });
						   	}else if(data.new_qty == 0 && data.status == 'on'){
								$(parent).slideUp('slow');
								$('.totalcartvalue').empty().append(data.new_total);
								$('.totalitems').empty().append(data.new_total_item	);
							}else if(data.new_total_item == 0){
								window.location = "<?=site_url('store/cart/view/cart')?>";
							}
					   }
				
				});
			return false;
			
		});
			});
		</script>
<table>
 <thead>
  <tr>
    <td>Product Name</td>
     <td>Price</td>
     <td>qty</td>
    <td>Total</td>

  </tr>
 </thead>
 <tbody>
<?foreach($items as $item){?>
 <tr>
    <td>
    	<div class="left mr5 itemImg">
    		<?$img=modules::run('store/product/prodImg', $item['id'])?>
    		<img src="<?=site_url('thumb/show/50-50-crop/dir/assets/product-img/'.$img->path);?>">
    		
    	</div>
    	<div class="itemDetail left">
    	<strong><a href="<?=site_url('store/product/view/'.$item['id']);?>" alt="<?=$item['name']?>" ><?=$item['name']?></a></strong>
    	<?if ($this->cart->has_options($item['rowid']) == true){?>
    	<div class="horline"></div>
    	<?echo 'color : '.$item['options']['c'].', size :'.$item['options']['s'];?>

    	<?}?>
    	</div>
    	<div class="clear"></div>
	</td>
    <td class="text_center"><?=$this->addon_store->show_price($item['price'])?></td>
    <td class="qty grid_150">
    	
    	<div class="update_form left">
    	<input type="text" class="grid_50 input_qty" name="qty" value="<?=$item['qty'];?>"/>
    	<input type="hidden" name="rowid" class="input_rowid" value="<?=$item['rowid'];?>"/>
    	<a href="" class="button update_button">update</a>
    	</div>
<div class="right padd5">
		<a href="<?=site_url('store/cart/delete_cartitem/'.$item['rowid']);?>"><span class="act del"></span></a>
		</div>
		<div class="clear"></div>
 	</td>
    <td class="text_right subtotal grid_150"><?=$this->addon_store->show_price($item['subtotal'])?></td>

	</tr>


 <? } ?>
<tr>
	<td colspan="3"><strong>Total</strong></td>
	<td class="text_right totalcartvalue"> <?=$this->addon_store->show_price($this->cart->total());?></td>
</tr> 
</tbody>
</table>


<div class="cartTool">
	<a href="<?=site_url('store/cart/destroy_cart');?>"><span class="button">Remove Cart</span></a>
	
</div>
 <div class="clear"></div>

</div>
		<?}else{?>
			<p>Your Cart is Empty</p>
		<?}?>
</div>