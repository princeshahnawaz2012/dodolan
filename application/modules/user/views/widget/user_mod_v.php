<script>
$(document).ready(function(){
	$('.show_logMod').click(function(){
		$('.logModModal').toggle('slide', {direction : 'up'});
		return false;
	})
});
</script>
<div class="user_mod widget">
				<p>
<? $login_data = $this->session->userdata('login_data');					
if($login_data){?>
	<a href="<?=site_url('logout')?>">Logout</a>
<?}else{?>
					<a href="<?=site_url('login/red/'.$this->uri->uri_string());?>" class="show_logMod" title="Register">Sing In</a> 
					<?}?>| <a href="<?=site_url('store/order/track');?>" title="track order">Track Order</a> |</p>
					<div class="clear"></div>
					<div class="logModModal absolute hide" style="background:#ccc; padding:10px 20px 10px 10px;">
						<?=modules::run('user/user_widget/login_mod_front')?>
						<div class="clear"></div>
					</div>
</div>