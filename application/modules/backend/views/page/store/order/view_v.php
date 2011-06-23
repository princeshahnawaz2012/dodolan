<div class="order_detail">
	<div class="left_pane grid_250 left">
		<div class="box2 customer_data">
			<div class="left photo_user grid_60 mr10">
				aadad
			</div>
			<div class="left data_user grid_130">
			<p>
				<span class="bold"><?echo $data_personal->first_name.' '.$data_personal->last_name;?></span>
				<br/>
				<span><?echo $data_personal->mobile;?></span>
				<br/>
				<span><?echo $data_personal->email;?></span>
			</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="mt20 billing">
			<h3 class="bold">Billing Address</h3>
			<p>
				<?echo $data_personal->first_name.' '.$data_personal->last_name;?><br/>
				<?= $data_personal->address;?><br/>
				<?= $data_personal->zip?>, <?= $data_personal->city?><br/>
				<?= $data_personal->province?><br/>
				<?=modules::run('store/getCountry', $data_personal->country_id)?>
			</p>
		</div>
		<div class="mt20 shipping">
			<h3 class="bold">Shipping Address</h3>
			<p>
				<?echo $data_shipto->first_name.' '.$data_shipto->last_name;?><br/>
				<?= $data_shipto->address;?><br/>
				<?= $data_shipto->zip?>, <?= $data_shipto->city?><br/>
				<?= $data_shipto->province?><br/>
				<?=modules::run('store/getCountry', $data_shipto->country_id)?>
			</p>
		</div>
	</div>
	<div class="main_pane right grid_650">
		<div class="box2 payment_shipping mb20">
			<h3>Payment Method</h3>
			<span class="left"><?=$data_order->payment_method?></span>
			<span class="right"><?=$this->cart->show_price($data_order->total_amount);?></span>
			<br class="clear"/>
			<div class="horline"></div>
			<h3>Shipping Method</h3>
			<span class="left"><?=strtoupper($data_order->ship_carrier)?> | <?=$data_order->ship_carrier_service?></span>
			<span class="right"><?=$this->cart->show_price($data_order->ship_fee)?></span>
			<br class="clear">
		</div>
		<div class="table-Ui order_items">
			<table>
				<thead>
					<tr>
						<td>SKU</td>
						<td>Name</td>
						<td>Price</td>
						<td>Qty</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>
				
			<?foreach($data_prodsold as $item):?>
					<tr>
						<td><?=$this->load->model('store/product_m')->getbyid($item->id_prod, false, 'sku', false)->sku;?></td>
						<td><?=$item->name;?></td>
						<td><?=$this->cart->show_price($item->price)?></td>
						<td><?=$item->qty?></td>
						<td class="text_right"><?=$this->cart->show_price($item->price*$item->qty);?></td>
					</tr>
			<?endforeach;?>
					<tr>
						<td colspan="4" class="text_right">Subtotal</td>
						<td class="text_right"><?=$this->cart->show_price($data_order->sub_amount)?></td>
					</tr>
					<tr>
						<td colspan="4" class="text_right">Shipping</td>
						<td class="text_right"><?=$this->cart->show_price($data_order->ship_fee)?></td>
					</tr>
					<tr class="final_total">
						<td colspan="4" class="text_right"><span class="bold">Total</span></td>
						<td class="text_right"><?=$this->cart->show_price($data_order->total_amount)?></td>
					</tr>
			</tbody>
			</table>
		</div>
		<?if($data_order->customer_note != null):?>
		<div class="customer_note">
			<h3>Customer Note :</h3>
			<div class="box2">
				<?=$data_order->customer_note?>
			</div>
			
		</div>
		<?endif?>
	
		<?if($order_history):?>
		
		<div class="order_history mt20">
		<h3>Order Feed</h3>
			<ul>
		<?foreach($order_history->result() as $item):?>
			<li class="">
				<div class="feed_item">
					<span class="date"><?=$this->dodol->custom_time($item->c_date)?></span> |
					<span class="bold <?=$item->type;?>"><?=$item->type;?></span>
				</div>
			</li>
		<?endforeach?>
			</ul>
		</div>
		<?endif;?>
	</div>
	<div class="clear"></div>
</div>