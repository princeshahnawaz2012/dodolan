<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		function redi(){
		<?if($redi != false){
			$redi = $redi;
			}else{
			$redi = 'backend/index/first';
		};?>
			var url = '<?=site_url()?>/<?=$redi;?>';
			$(location).attr('href', url);
		}
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
						   	$('.mainGrid').hide('fade','slow', redi);
						   	}else if(data.status == 'failed'){
						   		$('.loginMod .ajax_loader_small').fadeOut();
						   		$('.loginMod .ajx_msg-Ui').hide().append(data.msg).delay(1000).fadeIn().delay(2000).fadeOut();
						   	}
					   }

			});
			return false;
			
		});
		$('.mainGrid').hide();
		$('.mainGrid').show('fade','slow' );
	});
</script>
<div class="grid_960 ctr">
	
<br/>
<br/>
<br/>
<br/>
<br/>

<div class="grid_420 ctr mt20 login_page mainGrid ui-corner-all">
     <div class="heading_page  def_grad">
		<h4><?=$this->config->item('site_name');?> Backend Login</h4>
		</div>
	<div class="form-Ui loginMod padd20">
	   
		<form action="<?=current_url();?>" method="post">
			<div class="mb20">
				<div class="left grid_100 text_right mr10">
					Email 
				</div>
				<div class="grid_260 left">
				<input type="text" class="text-input" name="email" value="email">
				</div>
				<br class="clear"/>
			</div>
			<div class="">
				<div class="left grid_100 text_right mr10">
					Password 
				</div>
				<div class="grid_260 left">
				<input type="password" class="text-input" name="password" value="password">
				</div>
				<br class="clear"/>
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
</div>