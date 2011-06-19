<script type="text/javascript" charset="utf-8">

</script>
<?=$this->dodol_theme->partial('header');?>

	<div class="wrapper">
		<div class="wrapper_inner grid_950 ctr">
			<div class="header">
				<div class="toppest_spot">
				<div class="logo_spot left"><h1 clas="myriad"><?=$this->config->item('site_name')?></h1></div>
				<div class="resource_spot right grid_300">
					<div class="user_menu right">
                    	<?=load_widget('pre_topright');?>
						<span><a href="">Login</a><span> | <span><a href=""></a>Track Order</span>  | <span class="cart_item">cart (0 item)<span>
					</div>
					<div class="clear"></div>
					
				</div>
				<div class="clear"></div>
				</div>
				<div class="navigation">
					<div class="main_menu left">
					<?=load_widget('topmenu');?>
					</div>
					<div class="search_mod right">
						<form>
					<input type="text" name="search" class="text-input" value="search..." id="search">
						</form>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="main_comp">
					<? if($loadSide == true): $mainComp = '';?>	
                        <div class="sidebar grid_210 left">
						<?=load_widget('left');?>
						<?=modules::run('store/store_widget/currency');?>
						</div>
					<? else: $mainComp = '_fullWidth'; endif?>
					<div class="main_inner<?=$mainComp?> right">
					<? if(isset($directLayer)){ echo $directLayer ;}?>
					<? if(isset($mainLayer)){ echo $this->load->view($mainLayer) ;}?>
					</div>
					<div class="clear"></div>
					
			</div>
			<div class="footer">
				<div class="resource_bottom">	
					<div class="resource_left left grid_650">
					<?=load_widget('bottom_left_resource');?>
					</div>
					<div class="resource_right right grid_280">
                    <?=load_widget('bottom_right_resource');?>
						<div class="front_resource_menu">
							<ul>
								<li><a href="">about us</a></li>
								<li><a href="">store policies</a></li>
								<li><a href="">privacy</a></li>
								<li><a href="">contact</a></li>
								<li><a href="">blog</a></li>
							</ul>
						<div class="clear"></div>
						</div>
						<div class="news_letter_form">
							<p>keep in touch with us, and recieve our update</p>
							<form action="index_submit" method="get" accept-charset="utf-8">
								<div class="form_spot">
								<input type="text" value="youmail@site.com, your name" class="required">
								<input type="submit" name="signup_me" value="Submit" class="trigger" id="signup_me">
								<div class="clear"></div>
								</div>
							</form>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="closing_spot">
					<div class="site_copyright left mr10">
						<p>&copy; OlineWorkrobe.com all right reserved</p>
					</div>
					<div class="bottom_menu left">
							<?=load_widget('bottom_left');?>
					</div>
					<div class="deleloper_watermark right">
						<p>Design and Develop by BarockProject<p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
<?=$this->dodol_theme->partial('footer');?>
