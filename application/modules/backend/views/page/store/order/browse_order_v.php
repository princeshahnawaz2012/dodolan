<table border="0" cellspacing="5" cellpadding="5">
	<thead>
	<tr>
		<td>Order No:</td>
		<td class="grid_300">Customer Name</td>
	</tr>
	
	</thead>
	<tbody>
<?if($orders){ foreach($orders as $order){?>
<?$data = modules::run('backend/store/b_order/getorder_byid', $order->id, 'object');
?> 	
		<tr>
			<td><h4><?=$order->id;?></h14></td>
			<td><?=$data->shipto_data->first_name .' '. $data->shipto_data->last_name;?></td>
		</tr>
	
<?}}?>

	</tbody>
	
</table>
<?=$this->barock_page->make_link();?>