<?if($prod){?>
	<?$price = modules::run('store/product/prod_price', $prod->id)?>
<div class="productSnap">
	<div class="productImg">
		<? if($media){ ?>
		<img src="<?=site_url('thumb/show/240-320-crop/dir/assets/product-img/'.$media->path);?>" alt="<?=$media->name?>">
		<?}?>
		<div class="w_50 ctr snap_tool">
		  <div class="triangle ctr"></div>
		  <h3 class="prod_name"><?=$prod->name?></h3>
		<div class="product_detail">
			<div class="left"><a href="<?=site_url('store/product/view/'.$prod->id.'/'.$this->dodol_theme->nice_strlink($prod->name));?>"><span class="productame">View Detail</span></a></div>
			<div class="right"><span class="finalPrice"><?=$price['formated']?></span></div>
			<div class="clear"></div>
		</div>
		
		</div>
		
	</div>

	
</div>
<?}?>