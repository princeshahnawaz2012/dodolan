<div class="browseProduct">
<? if($prods){ foreach($prods as $prod){?>
<?=modules::run('store/product/prodSnap',$prod->p_id )?>
<?}?>
<div class="clear"></div>
<div class="pagination right">
	<?=$this->barock_page->make_link();?>
</div>
<div class="clear"></div>
<?}else{?>
	there aren't product in this category
<?}?>
<div class="clear">></div>
</div>