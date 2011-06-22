
	<div id="front_ajaxdialog" class="ajaxdialog hide msg-Ui">
		
	</div>
	
	<script type="text/javascript" charset="utf-8">
		$('.component_layer').hide();
		$(document).ready(function(){
				$('.component_layer').show('fade', 1000);
		});
		$(document).unload(function(){
				$('.component_layer').hide('fade', 1000);
		});
	</script>
	<div class="box2 ctr grid_920 hide">
		Render  Time : {elapsed_time} <br/>
		Memory Alocation : {memory_usage} 
	</div>
</body>
</html>
