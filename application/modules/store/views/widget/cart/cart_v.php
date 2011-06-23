<div class="viewCartWidget widget">
	<?if($total_item == 0){?>
	<p>Your Cart Is Empty</p>
		<?}else{?>
	<p><span class="totalitems"><?=$total_item?></span> items, <span class="totalcartvalue"><?=$this->addon_store->show_price($total_price);?></span> | <a href="<?=site_url('store/cart/viewcart');?>"><span >View Cart</span></a> <a href="<?=site_url('store/checkout');?>"><span>checkout</span></a></p>
	<?}?>
</div>