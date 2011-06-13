<div class="updater_form">
	<form action="" method="POST" accept-charset="utf-8">
	<span>Update the Order Status</span>
	<select name="new_status">
		<? $statuses = $this->load->model('store/order_m')->status_type;
		
			foreach($statuses as $status){
			if($status == $current){
				$select = 'selected';
			}else{
				$select = '';
			}
			
			?>
			<option <?=$select?> value="<?=$status?>"><?=$status?></option>
	
		<?}?>
		
	
	</select>
	<input type="submit" class="button" name="update_status" value="Update" id="update_status">
	</form>

</div>
