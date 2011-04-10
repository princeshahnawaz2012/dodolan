					<div class="table-Ui">
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
<?$i = 1 ;foreach($items as $item){?>

					 <tr>
							<td align="center"><?=$i?></td>
						    <td>
						    	<div class="left mr5 itemImg">
						    	
									<?$img=modules::run('store/product/prodImg', $item->id_prod)?>
						    		<img src="<?=site_url('thumb/show/50-50-crop/dir/assets/product-img/'.$img->path);?>">

						    	</div>
						    	<div class="itemDetail left">
						    	<strong><a href="<?=site_url('store/product/view/'.$item->id_prod);?>" alt="<?=$item->name?>"><?=$item->name?></a></strong>
						    	<?if($item->options != null){$option = json_decode($item->options);?>
								<div class="horline"></div>
						    			    <?foreach($option as $op=>$v){
							echo $op .':'. $v .', ';
						}?>
								</div>
								<?}?>
						    	<div class="clear"></div>
							</td>
						    <td class="text_center"><?=modules::run('store/order/orderprice', $item->order_id, $item->price)?></td>
						    <td class="qty text_center grid_120">
								<?=$item->qty?>		 	</td>
						    <td class="text_right subtotal"><?=modules::run('store/order/orderprice', $item->order_id, $item->price*$item->qty)?></td>

							</tr>
<?$i++;}?>
</tbody>
</table>