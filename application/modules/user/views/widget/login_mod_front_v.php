<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('.login_mod_front form').submit(function(){
			var data = $(this).serialize();
			$('.loginMod .ajx_msg-Ui').empty();
			$('.loginMod .ajx_msg-Ui').append('<div class="ajax_loader_small"></div>');
			$.ajax({
				 type: "POST",
					   dataType : "json",	
					   url: "<?=site_url()?>/user/auth/ajx_frontend_login",
					   data: data ,
					   success: function(data){					     
						   	if(data.status == 'success'){
						  window.location = data.redirect; 	
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

 <div class="widget login_mod_front widget">
 	<div class="form-Ui">
    <form action="" method="post">
     <h4 class="noBold">Login</h4>
       <div class="inputSet">
			<div class="label">
            	<span>Email</span>
            </div>
			<div class="input">
				<input type="text" name="email" value="">
			</div>
			<div class="clear"></div>
		</div>
       <div class="inputSet">
			<div class="label">
            	<span>Password</span>
            </div>
			<div class="input">
				<input type="password" name="password" value="">
			</div>
			<div class="clear"></div>
		</div>
		<input type="hidden" name="red" value="<?=$redirect;?>">
        <input type="submit" name="login" value="login" class="button" />
        </form>
        </div>
    </div>