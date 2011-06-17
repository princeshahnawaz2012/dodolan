<div class="ctr grid_300 text_center">


	<div class="grid_70 ctr">
		
	<?=$this->dodol_theme->ajax_loader(70, 'grid_70');?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	
		$('#payment').submit();
	
}); 
 </script>
	</div>
	<div id="form_payment">
	<?=$form?>
	</div>
	<br/>
	<p>
	please wait, You are currently redirect to paypal, for processing your payment
	</p>
</div>