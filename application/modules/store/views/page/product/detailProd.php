<? if($prod){?>
<div class="viewProduct">
	<?
	$p = $prod['prod'];
	$m = $prod['media'];
	$a = $prod['attrb'];
	
	
?>
	<div class="detailProd left mr10">
	<h1><?=$p->name;?></h1>
	<div class="horline"></div>
	<div class="detailprice">
	<? $price = modules::run('store/product/prod_price', $p->id);
		echo $price['formated'];
	?>
	</div>
	<div class="horline"></div>
	<div class="descProd">
		 <?=$p->l_desc;?>
	</div>
	<?=modules::run('store/addToCartForm', $a, $p);?>
	
	<div class="mediaProd right">
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
            <img class="zoom_curent_img" src="<?=site_url('thumb/show/300-400-crop/dir/assets/product-img/'.$defimg->path);?>" alt='' title="<?=$defimg->name;?>" />
        </a>

		</div>
		<div class="clear"></div>
		<?if($m){?>
		<div class="otherImg">
			<?foreach($m as $med){?>
		<a href='<?=site_url('thumb/show/600-800-crop/dir/assets/product-img/'.$med->path);?>' class='cloud-zoom-gallery' title='<?=$med->name;?>'
        	rel="useZoom: 'zoom1', smallImage: '<?=site_url('thumb/show/300-400-crop/dir/assets/product-img/'.$med->path);?>' ">
        <img class="mr5 left grid_70" src="<?=site_url('thumb/show/70-70-crop/dir/assets/product-img/'.$med->path);?>" alt ="<?=$med->name;?>"/></a>

				
			
			<?}?>
		<div class="clear"></div>	
		</div>
		<?}?>
		
	</div>
	<div class="clear"></div>

</div>
<?}?>