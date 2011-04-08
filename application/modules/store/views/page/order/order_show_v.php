<?
$items = $data['prodsold_data'];
$order_data =  $data['order_data'];
$personal_data = $data['personal_data'];
$shipto_data = $data['shipto_data'];
?>

<div class="font80">
					<div class="cartView_v">
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
						    <td class="text_center"><?=modules::run('store/order/orderprice', $order_data->id, $item->price)?></td>
						    <td class="qty text_center grid_120">
								<?=$item->qty?>		 	</td>
						    <td class="text_right subtotal"><?=modules::run('store/order/orderprice', $order_data->id, $item->price*$item->qty)?></td>

							</tr>
<?$i++;}?>

						 		<tr class="dark">
							<td align="right" colspan="4">Subtotal :</td>
							<td class="text_right totalcartvalue"> <?=modules::run('store/order/orderprice', $order_data->id, $order_data->sub_amount)?></td>
						</tr>

						<tr>
						<td colspan="4">
							<strong>Shpping Fee and Package:</strong><br>
								<small><?=$order_data->ship_carrier.' - '.$order_data->ship_carrier_service. ' | '.$shipto_data->city;?></small>

							</td>

							<td class="text_right shipping_fee"><?=modules::run('store/order/orderprice', $order_data->id, $order_data->ship_fee)?></td>
						</tr> 
								<tr class="dark">
							<td align="right" colspan="4">Total</td>
							<td class="text_right final_total">
												 <?=modules::run('store/order/orderprice', $order_data->id, $order_data->total_amount)?>			</td>
						</tr>
						</tbody>
						</table>
					</div>
					</div>
					<div class="customer_info grid_320 left">
					<h4>Personal Information</h4>
						<div class="data_rowSet">
						<div class="label">Name </div>
						<div class="data"><?=$personal_data->first_name .' '. $personal_data->last_name?></div>
						<div class="clear"></div>
					</div>

					<div class="data_rowSet">
						<div class="label">Email </div>
						<div class="data"><?=$personal_data->email?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Address </div>
						<div class="data"><?=$personal_data->address?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Country </div>
						<div class="data"><?=modules::run('store/getCountry', $personal_data->country_id)?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Province </div>
						<div class="data"><?=$personal_data->province?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">First Name </div>
						<div class="data"><?=$personal_data->city?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Zip </div>
						<div class="data"><?=$personal_data->zip?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Phone </div>
						<div class="data"><?=$personal_data->phone?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">mobile</div>
						<div class="data"><?=$personal_data->mobile?></div>
						<div class="clear"></div>
					</div>

					</div>
					<div class="customer_info grid_320 right">
					<h4>Shipping Address</h4>
						<div class="data_rowSet">
						<div class="label">Aimed to </div>
						<div class="data"><?=$shipto_data->first_name .' '. $shipto_data->last_name?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Address </div>
						<div class="data"><?=$shipto_data->address?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Country </div>
						<div class="data"><?=modules::run('store/getCountry', $shipto_data->country_id)?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Province </div>
						<div class="data"><?=$shipto_data->province?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">City </div>
						<div class="data"><?=$shipto_data->city?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Zip </div>
						<div class="data"><?=$shipto_data->zip?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Phone </div>
						<div class="data"><?=$shipto_data->phone?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Mobile </div>
						<div class="data"><?=$shipto_data->mobile?></div>
						<div class="clear"></div>
					</div>

					</div>
					<div class="clear"></div>
					<div class="shipping_and_payment">
									<h4>Shipping and Payment</h4>
						<div class="data_rowSet">
							<div class="label">Payment Method </div>
							<div class="data"><?=$order_data->payment_method?></div>
							<div class="clear"></div>
						</div>
						<div class="data_rowSet">
								<div class="label">Shipping Carrier </div>
								<div class="data"><?=$order_data->ship_carrier.' - '.$order_data->ship_carrier_service. ' | '.$shipto_data->city;?></div>
								<div class="clear"></div>
						</div>

					</div>
				</div>