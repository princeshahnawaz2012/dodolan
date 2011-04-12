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
								$(parent).animate({ backgroundColor: "#fffae7", color: "#3b3b3b" }, 1000).animate({ backgroundColor: "white", color:"#7B7979" }, 1000);
								;
						 		$(parent).find('.subtotal').empty().append(data.new_subtotal);
								$('.totalcartvalue').empty().append(data.new_total);
								$('.totalitems').empty().append(data.new_total_item	);
								if(data.new_ship_fee){
								$('.shipping_fee').empty().append(data.new_ship_fee);
								}
								$('.final_total').empty().append(data.new_final_total);
						   	}else if(data.status == 'off'){
								$(parent).find('.input_qty').val(data.new_qty);
						   		alert(data.msg);
						   	}else if(data.new_qty == 0 && data.status == 'on' && data.new_total_item != 0){
								$(parent).hide('drop');
								$('.totalcartvalue').empty().append(data.new_total);
								$('.totalitems').empty().append(data.new_total_item	);
									if(data.new_ship_fee){
									$('.shipping_fee').empty().append(data.new_ship_fee);
									}
							}else if(data.new_qty == 0 && data.status == 'on' && data.new_total_item == 0){
								window.location = "<?=site_url('store/cart/viewcart')?>";
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
	<td align="center">No</td>
    <td>Product Name</td>
     <td>Price</td>
     <td>qty</td>
    <td>Total</td>

  </tr>
 </thead>
 <tbody>
	
<?$no = 1 ; foreach($items as $item){?>
 <tr>
	<td align="center"><?=$no++?></td>
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
    <td class="qty grid_120">
    	
    	<div class="update_form ctr">
    	<input type="text" class="grid_50 input_qty" name="qty" value="<?=$item['qty'];?>"/>
    	<input type="hidden" name="rowid" class="input_rowid" value="<?=$item['rowid'];?>"/>
    	<a href="" class="button update_button">update</a>
    	</div>
 	</td>
    <td class="text_right subtotal"><?=$this->addon_store->show_price($item['subtotal'])?></td>

	</tr>


 <? } ?>
<tr class="dark">
	<td colspan="4" align="right">Subtotal :</td>
	<td class="text_right totalcartvalue"> <?=$this->addon_store->show_price($this->cart->total());?></td>
</tr>
<?if(isset($this->cart->shipping_info['fee'])){?>
<tr>
<td colspan="4" >
	<strong>Shpping Fee and Package:</strong><br/>
	<small><?=$this->cart->shipping_info['carrier']?> - <?=$this->jne->service($this->cart->shipping_info['type'])?> | <?=$this->cart->shipping_info['city']?> </small>
	
	</td>
	
	<td class="text_right shipping_fee"><?=$this->addon_store->show_price($this->cart->shipping_info['fee']);?> </td>
</tr> 
<?}?>
<tr class="dark">
	<td colspan="4" align="right">Total</td>
	<td class="text_right final_total">
		<? 
		if(!isset($shipping_info['fee'])){
		$final_total = $this->cart->total();
		}else{
		$final_total = $this->cart->total() + $this->session->userdata['shipping_info']['fee'];
		}	
		?>
		 <?=$this->addon_store->show_price($final_total);?>
	</td>
</tr>
</tbody>
</table>


<div class="cartTool">
	<a href="<?=site_url('store/cart/destroy_cart');?>"><span class="button">Remove Cart</span></a>
	
</div>
 <div class="clear"></div>
<br/><br/>
</div>
		<?}else{?>
			<p>Your Cart is Empty</p>
		<?}?>
</div>