<div class="summary_cart">
	<div class="itemlist left grid_500">
	
		
		<?foreach($items as $item ):?>
		 <div class="item left mr10 grid_240">
			<div class="img_item left">
				<?$img=modules::run('store/product/prodImg', $item['id'])?>
	    	<img src="<?=site_url('thumb/show/60-70-crop/dir/assets/product-img/'.$img->path);?>">
			</div>
			<div class="item_detail left">
				<h6 class="font_myriad"><?=element('name', $item)?><small class="right"><?=element('id', $item)?></small></h6>
				<small class=""><? echo element('qty', $item).' x '.$this->cart->show_price(element('price', $item)) ?></small>
				<br class=""/>
				<small class="bold"><?=$this->cart->show_price(element('subtotal', $item));?></small>
				
			</div>
			<div class="clear"></div>
		 </div>

		<?endforeach;?>
		<div class="clear"></div>
	</div>
	<div class="total_amout right grid_230">
		<h1 class="font_myriad"><?=$this->cart->show_price($this->cart->total())?></h1>
	</div>
	
	<div class="clear"></div>
	<div class="horline"></div>
</div>