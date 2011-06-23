<div class="clear"></div>
<div class="list_order">
	<?if($orders):?>
	<div class="table-Ui">
		<table>
			<thead>
				<tr>
					<td class="grid_100">No.Order</td>
					<td class="grid_150">Date</td>
					<td class="grid_200">Place By</td>
					<td>Status</td>
					<td>Total</td>
					<td>Action</td>
				</tr>
			</thead>
			<?foreach($orders as $order):?>
			<?
			$data = modules::run('backend/store/b_order/getorder_byid', $order->id, 'object');
			$data_personal = $data['personal_data'];
			$data_order = $data['order_data'];
			?>
				<tr>
					<td>#<?=$data_order->id?></td>
					<td><?=$this->dodol_theme->show_date($data_order->c_date)?></td>
					<td><?echo $data_personal->first_name.' '.$data_personal->last_name;?></td>
					<td><?=$data_order->status?></td>
					<td><span class="bold"><?=$this->cart->show_price($data_order->total_amount)?></span></td>
					<td class="action">
							<a href="<?=site_url('backend/store/b_order/view/'.$data_order->id);?>"><span class="act view"></span></a>
						<a href="<?=site_url('backend/store/b_order/delete/'.$data_order->id);?>"><span class="act del"></span></a>
					</td>
				</tr>
			<?endforeach;?>
		</table>
	</div>
	<div class="pagination right"><?=$this->barock_page->make_link();?></div>
	<div class="clear"></div>
	<?else:?>
	there's no order yet
	<?endif;?>
</div>