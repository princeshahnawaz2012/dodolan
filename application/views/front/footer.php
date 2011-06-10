<small>Debug</small>
	<div class="horline"></div>
	<?=$this->bug->show();?>

	<br class="clear"/>
Page rendered in {elapsed_time} seconds
	</div>

	<div id="front_ajaxdialog" class="ajaxdialog hide msg-Ui">
		
	</div>
	<script type="text/javascript" charset="utf-8">
		$('.mainComp').hide();
		$(document).ready(function(){
				$('.mainComp').show('fade', 1000);
		});
		$(document).unload(function(){
				$('.mainComp').hide('fade', 1000);
		});
	</script>
</body>
</html>
