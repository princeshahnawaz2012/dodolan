<?
$coll = $data['main'];
$items = $data['ref'];
?>
<div class="mainData grid_550 left">
	<div class="collection_img">
		<img width="550" src="<?=site_url('thumb/show/550-100-crop/dir/assets/collection_img/'.$coll->img_path);?>">
	</div>
	<div class="collection_desc mt20">
		<?=$coll->description?>
	</div>
		
</div>
<div class="items grid_340 right">
	<div class="itemList box2">
<?if($items->num_rows() > 0):?>
	<?foreach($items->result() as $item):?>
		<?
		// initialize product by product_id
		$param = array(
			'id' => $item->product_id,
			);	
		$q = modules::run('store/product/detProd', $param);
		$p = $q['prod'];
		$img = modules::run('store/product/prodImg', $item->product_id);
		?>
		<div class="coll_item mb10">
			<div class="img_prod left mr5"><img src="<?=site_url('thumb/show/70-30-crop/dir/assets/product-img/'.$img->path)?>"/></div>
			<div class="detail_prod left">
			<?=$p->name;?>
			</div>
			<div class="clear"></div>
			<div class="horline"></div>
			<div class="clear"></div>
		</div>
	<?endforeach?>
	<div class="clear"></div>
<?else:?>
	<span>This Collection have no Item, <br/>Maybe you want to choose one :)</span>
<?endif?>
	</div>
	<script type="text/javascript" charset="utf-8">
		
		
	
		$(document).ready(function(){
		
			$('.search_r').hide();
			var delayer = delayTimer(500);
			$('#q_prod').keyup(function(){
					delayer(function(){
						var q = $('#q_prod').val();
						var coll_id = <?=$coll->id?>;

						if(q.length >= 3){
						$('.search_r').empty().hide('slide', {direction: 'up'});
						$.ajax({
								type: "POST",
								dataType : "json",
								data : {'q_post' : q, 'coll_id' : coll_id},	
								url: "<?=site_url('backend/store/b_collection/ajax_search_prod')?>",
								success: function(data){					     
									   	if(data.status != 'failed'){
										$('.search_r').append(data.prods);
										$('.search_r').show('slide', {direction: 'up'});
										$('div.search_r > div.coll_item').click(function(){
											var coll_id = <?=$coll->id?>;
											var prod_id = $(this).attr('id');
											addcoll_item(prod_id, coll_id)
										});
									   	}else{
									   	$('.search_r').append('nothing found');
										$('.search_r').show('slide', {direction: 'up'});
									   	}
								   }
							});


						}
					})
			});	
			function addcoll_item(idProd, idColl){
				var datapost = {
					'idProd' : idProd,
					'idColl' : idColl
				}
				$.ajax({
					type: "POST",
					dataType : "json",
					data : datapost,	
					url: "<?=site_url('backend/store/b_collection/ajx_addItem')?>",
					success: function(data){					     
						   	if(data.status != 'failed'){
								$('.itemList').append(data.prod);
						   	}
					   }
				});
			}
			function delayTimer(delay){
			     var timer;
			     return function(fn){
			          timer=clearTimeout(timer);
			          if(fn)
			               timer=setTimeout(function(){
			               fn();
			               },delay);
			          return timer;
			     }
			}
			
			
		
		});
	
	</script>
	<span class="asuh"><span class="koe button">Ngilang</span></span>
	 <div class="addItem_coll form-Ui mt10 box2">
	 	<form action="" method="POST" accept-charset="utf-8">
	 	<input type="text" class="text-input" name="q_prod" value="Start Search product to add" id="q_prod">
		
	 	</form>
		<div class="search_r mt10" style="min-height:30px">
			
		</div>
	 </div>
</div>


<div class="clear"></div>