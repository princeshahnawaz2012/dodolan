
<?=$this->dodol_theme->partial('header');?>
	<div class="wrapper">
		<div class="wrapper_inner grid_950 ctr">
			<div class="header">
				<div class="toppest_spot">
				<div class="logo_spot left"><a href="<?=site_url()?>"><h1 clas="myriad"><?=$this->config->item('site_name')?></a></h1></div>
				<div class="resource_spot right grid_300">
					<div class="user_menu right">
                    	<?=load_widget('pre_topright');?>
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
				
					<div class="main_inner component_layer">
					<? if(isset($directLayer)){ echo $directLayer ;}?>
					<? if(isset($mainLayer)){ echo $this->load->view($mainLayer) ;}?>
					</div>
					<div class="clear"></div>
					
			</div>
			<div class="footer">
				
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
