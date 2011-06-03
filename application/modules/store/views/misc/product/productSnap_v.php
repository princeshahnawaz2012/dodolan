<?if($prod){?>
<div class="productSnap">
	<div class="productImg">
		<? if($media){ ?>
		<img src="<?=site_url('thumb/show/240-320-crop/dir/assets/product-img/'.$media->path);?>" alt="<?=$media->name?>">
		<?}?>
		<div class="w_100 snap_tool">
		    <p>
		    <span class="detail">Details</span>
		    <span class="buy">Buy</span></p>
		</div>
	</div>

	<div class="productDetail">
		<a href="<?=site_url('store/product/view/'.$prod->id.'/'.$this->theme->nice_strlink($prod->name));?>"><span class="productame"><?=$prod->name?></span></a>
		<?$price = modules::run('store/product/prod_price', $prod->id)?>
		<div class="productPrice"><span class="finalPrice"><?=$price['formated']?></span></div>
		<div class="clear"></div>
	</div>
</div>
<?}?>