<script>
$(document).ready(function(){
			$('.req_restock_form form').submit(function(){
			var data = $(this).serialize();
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "<?=site_url()?>/store/ajax_requestRestock",
				data : data,
				success: function(data){					     
						if(data.status == 'on') {
							$('.ajaxdialog').notice('information',data.msg);
							$('.req_restock_form').hide('drop', {direction:'right'});
							$('.addToCart').delay(500).show('drop', {direction:'right'});
						}else{
							$('.ajaxdialog').notice('information',data.msg);
							$('.req_restock_form').hide('drop', {direction:'right'});
							$('.addToCart').delay(500).show('drop', {direction:'right'});
							
						}
					}
				
				});
			return false;
			
		});
			});
</script>
<div class="req_restock_form grid_300">
<div class="form-Ui">
	<form method="post" action="<?=current_url();?>">
		 <div class="inputSet">
			<div class="label">
            	<span>Name</span>
            </div>
			<div class="input">
				<input type="text" name="name" value="">
			</div>
			<div class="clear"></div>
		</div>
		 <div class="inputSet">
			<div class="label">
            	<span>email</span>
            </div>
			<div class="input">
				<input type="text" name="email" value="">
			</div>
			<div class="clear"></div>
		</div>
		<input type="hidden" name="id_prod" value="<?=$id_prod;?>">
		<?if(isset($id_attrb)){?>
		<input type="hidden" name="id_attrb" value="<?=$id_attrb;?>">
		<?}?>
		<?if(isset($attrb_key)){?>
		<input type="hidden" name="attrb_key" value="<?=$attrb_key;?>">
		<?}?>
		<input type="submit" class="button" name="submit" value="request">
	</fomr>
</div>
</div>