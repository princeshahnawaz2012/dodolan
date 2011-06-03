<?=$this->load->view('front/header');?>

	<div class="mainGrid">
	
	<div class="header relative">
		<h1 class="logoText absolute"><?=$this->config->item('site_name')?></h1>
		<div class="sideTop">
	       <div class="smallcart">
			<?=modules::run('store/store_widget/cart');?>
			</div>
			<?=modules::run('user/user_widget/user_mod');?>	
			<div class="clear"></div>
		</div>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$('.topMenu a').hover(
				function(){
					$(this).animate({backgroundColor : '#eaeaea', color: '#767676'}, 300);
				},
				function(){
					$(this).animate({backgroundColor : '#ffffff', color: '#7B7979'}, 300);
				}
				);
			});
		</script>
		<div class="topMenu right">
		<ul class="left">
			<li><a href="<?=site_url('store/collection');?>">Collection</a></li>
			<li><a href="#">Sale</a></li>
			<li><a href="#">New Arrival</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Help & FAQ</a></li>
			<div class="clear"></div>
		</ul>
		<div class="mod_search left">
			<form action="" method="post">
			<input type="text" name="site_search" value="search" id="site_search" class="ml10 text-input">
			</form>
		</div>
		<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="grid_960 ctr" id="mainLayer">
		<? if(!isset($loadSide) ){
			$mainComp = '';
			?>	
			<div class="sidebar grid_210 left">
			<?=modules::run('store/store_widget/categoryMenu');?>
			<br class="clear"/>
			   <?=modules::run('store/store_widget/currency');?>
			</div>
			
		<?}else{
			$mainComp = 'fullWidth';
			}?>
	
	<div class="mainComp <?=$mainComp?> right">

	<? if(isset($directLayer)){ echo $directLayer ;}?>
	<? if(isset($mainLayer)){ echo $this->load->view($mainLayer) ;}?>
	</div>
	<div class="clear"></div>
	</div>
	<div class="footerWrap">
	
	</div>

	<?=$this->load->view('front/footer');?>
	