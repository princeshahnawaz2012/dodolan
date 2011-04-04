<div class="shipping_method">
	<?=$cart;?>
	 <h4 class="noBold">Shipping Method</h4>
	 <? 	
	if(!$this->session->userdata('ship_to_info')){
		$buyer_info = $this->session->userdata('customer_info'); 
	}else{	
		$buyer_info = $this->session->userdata('ship_to_info'); 
	}
	
	 ?>
	<? if($shipping_rates){?>
	 <form method="post" action="">
	<div class="table-Ui">	 	
<table>
 <thead>
  <tr>
    <td>Carrier</td>
     <td>Type</td>
     <td>Deskription</td>
    <td>Fee</td>

  </tr>
 </thead>
 <tbody>

 <?foreach($shipping_rates as $rate){?>			
 <tr>
    <td>
	<input type="radio" class="ship_id" name="id_ship_rate" value="<?=$rate['id_rate'];?>" />
	JNE</td>
     <td><?=$this->jne->service($rate['type']);?></td>
     <td><?=$buyer_info['city'];?> - <?=modules::run('store/store_cart/getAllWeight');?> Kg</td>
    <td><?=$rate['formated_rate'];?></td>
 </tr>
 <?};?>
 </tbody>
</table>
</div>
<input type="submit" name="next" value="next" class="button">
	 </form>
	<?}else{;?>
	 	There'somthing wrong, we can't determine you shipping cost option
	 <?}?>
</div>