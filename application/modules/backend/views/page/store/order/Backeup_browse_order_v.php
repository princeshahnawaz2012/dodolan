	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('.updateTrigger .trigger').click(function(){
					var form = $(this).parent().parent().find('.update_form');
					form.show();
				});
			$('.update_form .trigger').click(function(){
				var form = $(this).parent().parent()
				form.hide();
			});
								
			$('.update_form .inner ul li').click(function(){
				var new_val = $(this).html();
				var form    = $(this).parent().parent().parent();
				var other =  form.find('li.active');
				var field = form.find('.main_field');
				other.removeClass('active')
				$(this).addClass('active');
				field.val(new_val);
			});
			
			$('.update_form .inner span.button').click(function(){
				var form = $(this).parent().parent();
				var id = form.find('input[name="order_id"]').val();
				var new_status = form.find('input[name="new_status"]').val();
				var notify = form.find('input[name="notify_user"]:checked').val();
				var data = {order_id:id, new_status:new_status, notify_user:notify};
				$.ajax({
					type:"POST",
					dataType : "json",
					url : "<?=site_url('store/order/update_status/ajax')?>",
					data : data ,
					success: function(data){
						if(data.msg!='failed'){
							$('#orderid_'+data.id+' .modified_date').empty().append(data.time);
							$('#orderid_'+data.id+' .status').empty().append(data.new_status);
							form.hide();
						}
						
					}
				});
				
			});
			
			$('.order .show_item').click(function(){
				$('.items_order:visible').hide('slide');
				var orderid = $(this).attr('orderid');
				var data ={order_id:orderid}
				$.ajax({
					type :"POST",
					dataType : "json",
					url : "<?=site_url('store/order/getorder_item/ajax');?>",
					data: data,
					success:function(data){
						if(data.msg!='failed'){
							$('.items_order .inner').empty();
							$('.items_order .inner').append(data.content);
							$('.items_order').show('slide');
						}
						
					}
				}) 
			});
	
	
		});
		
	</script>
<?if($orders){?>
<div class="grid_600 mt10 left relative">

<div  class="table-Ui list_order grid_600"  >
	<div class="items_order hide grid_350 relative" style="top:0px;right:-600px;">
		<div class="inner fixed grid_350" style=" background:white"></div>
	</div>	
<table border="0" cellspacing="5" cellpadding="5" class="relative" style="z-index:auto; background:white">
	<thead>
	<tr class="dark">
		<td class="grid_70"><small>Order No:</small></td>
		<td >Order Detail</td>
	</tr>
	
	</thead>
	<tbody>
<? foreach($orders as $order){?>
<?$data = modules::run('backend/store/b_order/getorder_byid', $order->id, 'object');
$data_personal = $data['personal_data'];
$data_order = $data['order_data'];
$data_prodsold = $data['prodsold_data'];
$data_shipto = $data['shipto_data'];
?> 	
		<tr id="orderid_<?=$order->id;?>" class="order">
			<td class="text_center"><small><?=$order->id;?></small><br/> <span class="show_item font70" orderid="<?=$order->id;?>">show items</span></td>
			<td class="vTop font90">
			<div class="left w_50">
			<div class="data_rowSet">
				<div class="label">Bill to</div>
				<div class="data"><?=$data_personal->first_name .' '. $data_personal->last_name;?></div>
				<br class="clear"/>
			</div>
			<div class="data_rowSet">
				<div class="label">Ship To</div>
				<div class="data"><?=$data_shipto->first_name .' '. $data_shipto->last_name?></div>
				<br class="clear"/>
			</div>

			<div class="data_rowSet noBorder">
							<div class="label">Last Modified</div>
							<div class="data modified_date"><?=$this->dodol->custom_time($data_order->m_date, 'never')?></div>
							<br class="clear"/>
						</div>
			</div>
			<div class="right w_50">
				<div class="data_rowSet">
					<div class="label">Amount</div>
					<div class="data"><?=$this->cart->show_price($data_order->total_amount);?></div>
					<br class="clear"/>
				</div>
				<div class="data_rowSet">
							<div class="label">Shipping Fee</div>
							<div class="data"><?=$this->cart->show_price($data_order->ship_fee);?></div>
							<br class="clear"/>
				</div>
				<div class="data_rowSet noBorder">
				
					
					<div class="label">Status</div>
					<div class="data relative"><span class="absolute status right updateTrigger w_100"><?=$data_order->status?><span class="trigger absolute ">Show</span></span>
							<div class="absolute left hide update_form w_100">
								<div class="inner">
									<span class="trigger absolute ">Hide</span>
								<ul>									
									<? $statuses = modules::run('store/order/status_list');
										foreach($statuses as $status){
										?>
										<li><?=$status?></li>
									<?}?>
								</ul>
								<input type="hidden" class="main_field" name="new_status" value="">
								<input type="hidden" name="order_id" value="<?= $data_order->id ?>">
									<br/>
								<div class="horline"></div>
								<input type="checkbox" name="notify_user" class="mr5" value="1">Notify User
								<div class="horline"></div>
								<br/>
								<span class="button font80">Update</span>
								<div class="clear"></div>
								<br/>		
								</div>
							</div>

						</div>
					<br class="clear"/>
				</div>
			</div>
			<div class="clear"></div>
			</td>
		</tr>
	
<?}?>

	</tbody>
	
</table>

</div>

<br class="clear"/>
<div class="pagination"><?=$this->barock_page->make_link()?></div>
</div>
<?}else{
	echo 'There arnt, order to show';
}?>
<div class="order_search_tool right grid_250 mt5">
	<form action="<?=current_url();?>" method="post">
		<h3 class="mb5">Search Order</h3>
		<div class="horline"></div>
		<script>
			$(function() {
				var dates = $( "#from, #to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					onSelect: function( selectedDate ) {
						var option = this.id == "from" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
			});
			</script>
			
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
				$('.show').click(function(){
						var form = $('.form')
						form.toggle();
					});
				
				});
			</script>
			<span class="show">Show</span><br/>
			<div class="hide form padd20">
				asdasdyhi <br/>
				asdaisd aisd<br/>
			</div>
		<label>Keyword :</label><br/>
		<input type="text" name="q" value="type name or order number" class="text-input w_100" id="q">
		<br clas="clear"/>
		
		<div class="left w_50">
			From :<br/>
			<input type="text" class="w_100"  name="start" value="" id="from">
		</div>
		<div class="right w_50">
			To : <br/>
			<input type="text" class="w_100" name="end" value="" id="to">
		</div>
		<br class="clear"/>

		<div class="left">
		Status <br/>
			<select name="status" id="status">
				<? $statuses = modules::run('store/order/status_list');
				foreach($statuses as $status){
				?>
				<option value="<?=$status?>"><?=$status?></option>
				<?}?>
			</select>
		</div>
		<br class="clear"/>
	
	</form>
</div>
<br class="clear">

