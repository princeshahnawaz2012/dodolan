<div class="collection detail">
	<h1><?=$coll->name?></h1>
	<img src="<?=site_url('thumb/show/730-200-crop/dir/assets/collection_img/'.$coll->img_path);?>" />
	<div class="coll_desc">
		<?=$coll->description;?>
	</div>
</div>



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
<? if($items->num_rows() > 0){ foreach($items->result() as $prod){?>
<?=modules::run('store/product/prodSnap',$prod->product_id )?>
<?}?>
<div class="clear"></div>
<?}else{?>
	there aren't product in this Collection
<?}?>
<div class="clear">></div>
</div>