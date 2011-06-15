
<div class="clear"></div>
<div class="grid_220 customer_filter left">
	<div class="mod_head">Customer Filter</div>
	<ul>
		<li><h3><a href="">All Customer</a></h3></li>
		<li><h3><a href="">Accept Marketing</a></h3></li>
		<li><h3><a href="">Registered</a></h3></li>
		<li><h3><a href="">Not Registered</a></h3></li>
		<li><h3><a href="">Outside Indonesia</a></h3></li>
		<li><h3><a href="">Repeat Customer</a></h3></li>
		<li><h3><a href="">Prospects</a></h3></li>
	</ul>
</div>
<?if($lists):?>

<div class="table-Ui grid_700 right">
	
<table class="customer_list">
 <thead>
  <tr class="ui-corner-top">
  	<td>Name (First, Last)</td>
    <td>Location</td>
    <td>Money Spend</td>
	<td>Order</td>
    <td>Last Order</td>
  </tr>
 </thead>
 <tbody>	
<?
// looping start here
foreach($lists as $cus):?>
<?
	$customer  = $this->dodol->arrayObject(modules::run('store/customer/getById', $cus->id));
	$orders    = modules::run('store/order/getorderbycustomer', $customer->id);
?>
<tr>
	<td><?echo $customer->first_name.', '.$customer->last_name?></td>
    <td><?echo $customer->city.', '.modules::run('store/getCountry', $customer->country_id);?></td>
    <td><?echo $this->cart->show_price($orders['mount']); ?></td>
	<td><?echo $orders['count'];?></td>
    <td>Last Order</td>
</tr>


<?
// looping end here
endforeach?>
</tbody>
</table>
<br class="clear"/>
<div class="pagination"><?=$this->barock_page->make_link()?></div>
</div>

<?else:?>
	<div class="customer_list right">
	there is nothing to show
	</div>
<?endif?>

<br class="clear">