<?if($prod){?>
<div class="productSnap">
	<div class="productImg">
		<? if($media){ ?>
		<img src="<?=base_url()?>/assets/product-img/<?=$media->path;?>" alt="<?=$media->name?>">
		<?}?>
	</div>
	<div class="productDetail">
		<a href="<?=site_url('store/product/view/'.$prod->id);?>"><span class="productame"><?=$prod->name?></span></a>
		<?$price = modules::run('store/product/prod_price', $prod->id)?>
		<span class="productPrice"><?=$price['formated']?></span>
		<div class="clear"></div>
	</div>
</div>
<?}?>