<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('.loginMod form').submit(function(){
			var data = $(this).serialize();
			$('.loginMod .ajx_msg-Ui').empty();
			$('.loginMod .ajx_msg-Ui').append('<div class="ajax_loader_small"></div>');
			$.ajax({
				 type: "POST",
					   dataType : "json",	
					   url: "<?=site_url()?>/user/auth/ajx_backend_login",
					   data: data ,
					   success: function(data){					     
						   	if(data.status == 'success'){
						   	window.location = "<?=site_url()?>/backend"; 	
						   	}else if(data.status == 'failed'){
						   		$('.loginMod .ajax_loader_small').fadeOut();
						   		$('.loginMod .ajx_msg-Ui').append(data.msg).fadeIn().delay(2000).fadeOut();
						   	}
					   }

			});
			return false;
			
		});
	});
</script>

<div class="grid_420 right">
	<div class="form-Ui loginMod">
		<h3 class="formName">Login</h3>
		<form action="<?=current_url();?>" method="post">
			<div class="grid_200 left">
				<input type="text" class="text-input" name="email" value="email">
			</div>
			<div class="grid_200 right">
				<input class="text-input" type="password" name="password" value="password">
			</div>
			<div class="clear"></div>
			<br>
			<div class="left grid_280 ajx_msg-Ui">
				
			</div>
			<div class="right">
				<input type="submit" class="button login" name="login" value="login">
			</div>
			<div class="clear"></div>
		</form>
	</div>
</div>
<div class="clear"></div>