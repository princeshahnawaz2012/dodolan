<div class="browseProduct">
<? if($prods){ foreach($prods as $prod){?>
<?=modules::run('store/product/prodSnap',$prod->p_id )?>
<?}?>
	<?=$this->barock_page->make_link();?>
<?}else{?>
	there aren't product in this category
<?}?>
<div class="clear">></div>
</div>