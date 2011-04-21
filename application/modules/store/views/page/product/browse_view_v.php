<div class="browseProduct">
    <script type="text/javascript" charset="utf-8">
	  $(document).ready(function(){
	      $('.productSnap .productImg').hover(function(){
      	       var tool = $(this).find('.snap_tool');
      	       tool.show('slide',{direction:'down'}, 200);
      	   }, function(){
      	       var tool = $(this).find('.snap_tool');
         	       tool.hide('slide',{direction:'down'}, 200);
      	   });   
	  });
	   
	</script>
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