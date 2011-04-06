<?=$this->load->view('front/header');?>
	
	<div class="mainGrid">
		<?=$this->load->view('front/msg');?>
	<div class="header relative">
		<h1 class="logoText absolute">CultureUpdate<small> Beta 0.1</small></h1>
		<div class="sideTop">
       <div class="smallcart">
		<?=modules::run('store/store_widget/cart');?>
		</div>
		<?=modules::run('user/user_widget/user_mod');?>	
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="grid_960 ctr">
    	<div class="right">
         <?=modules::run('store/store_widget/currency');?>
        </div>
        <div class="clear"></div>
		
		<? if(!isset($loadSide) ){
			$mainComp = '';
			?>	
			<div class="sidebar grid_210 left">
			<?=modules::run('store/store_widget/categoryMenu');?>
			
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