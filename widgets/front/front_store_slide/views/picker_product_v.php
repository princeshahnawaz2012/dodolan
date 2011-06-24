
<script src="<?=base_url();?>application/widgets/front/front_store_slide/assets/jac.js" type="text/javascript" charset="utf-8"></script>
<div class="product_list picker_product">
<?foreach($ids as $prod):?>
<?$prod = modules::run('store/product/api_getbyid', $prod , array('media'), 'l_desc');?>
	<div class="item">
		<div class="item_img">
			<img src="<?=site_url('thumb/show/310-320-crop/dir/assets/product-img/'.element('media', $prod)->path);?>" alt="<?=element('product', $prod)->name?>">
		</div>
		<div class="item_detail">
			<h3 class="name"><?=element('product', $prod)->name?></h3>
			<small><?=element('product', $prod)->category_name?></small>
			<?=html_word_limiter(element('product', $prod)->l_desc, 30)?>
		</div>
	</div>
<?endforeach;?>
<div class="clear"></div>
</div>
<style>
.picker_product { margin-bottom:10px}
.picker_product .item { float:left; width: 310px; height:320px; position:relative; margin:0px 3px; overflow:hide;}
.picker_product .item .item_detail {height:100px;background:red; width: 290px; padding:10px;}
</style>

