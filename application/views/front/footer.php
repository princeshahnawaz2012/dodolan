
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
