<? if($prod){?>

<div class="viewProduct">
<?
	$p = $prod['product'];
	$m = $prod['medias'];
	$a = $prod['attributes'];	
?>
	<div class="detailProd mr10">
	<h1 class="prod_name"><?=$p->name;?></h1>

	<div class="detailprice">
	<p><? $price = modules::run('store/product/prod_price', $p->id);
		echo $price['formated'];
	?></p>
	</div>

	<div class="descProd">
		 <?=$p->l_desc;?>
	</div>
	<?=modules::run('store/store_cart/addToCartForm', $a, $p);?>
	
	<div class="mediaProd">
		<script>
		$(document).ready(function(){
			$('a.cloud-zoom-gallery').click(function(){
				var title = $(this).attr('title');
				$('img.zoom_curent_img').attr('title', title);
			});
		});
		</script>
		
		<div class="currentImg">
			<?$defimg = modules::run('store/product/prodImg', $p->id);?>
	<a href='<?=site_url('thumb/show/600-800-crop/dir/assets/product-img/'.$defimg->path);?>' class = 'cloud-zoom' id='zoom1'
            rel="position: 'inside' ,tint: '#ffffff',tintOpacity:0.5 ,smoothMove:10,zoomWidth:300,zoomHeight:400">
            <img class="zoom_curent_img" src="<?=site_url('thumb/show/400-500-crop/dir/assets/product-img/'.$defimg->path);?>" alt='' title="<?=$defimg->name;?>" />
        </a>

		</div>
		<div class="clear"></div>
		<?if($m){?>
		<div class="otherImg">
			<?foreach($m as $med){?>
		<a href='<?=site_url('thumb/show/600-800-crop/dir/assets/product-img/'.$med->path);?>' class='cloud-zoom-gallery' title='<?=$med->name;?>'
        	rel="useZoom: 'zoom1', smallImage: '<?=site_url('thumb/show/400-500-crop/dir/assets/product-img/'.$med->path);?>' ">
        <img class="mr5 left grid_70" src="<?=site_url('thumb/show/70-70-crop/dir/assets/product-img/'.$med->path);?>" alt ="<?=$med->name;?>"/></a>
		
			
		<?}?>
		<div class="clear"></div>	
		</div>
		<?}?>
		
	</div>
	<div class="clear"></div>

	<?if($rels = element('relations', $prod)):?>
	<div class="relation_product">
		<h3 class="font_myriad">Similiar Products</h3>
		<?foreach($rels as $item):?>
			<?=$item->p_rel?>
		<?endforeach?>
	</div>
	<?endif?>
	
</div>
<?}?>