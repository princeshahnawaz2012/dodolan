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
		<div id="<?=$item->id;?>" class="coll_item mb10">
			<div class="img_prod left mr5"><img src="<?=site_url('thumb/show/70-30-crop/dir/assets/product-img/'.$img->path)?>"/></div>
			<div class="detail_prod left">
			<?=$p->name;?>
			</div>
			<div class="right tool">
				<a href="<?=site_url('backend/store/b_product/editprod/'.$item->product_id);?>"><span class="edit act"></span></a>
				<a href="<?=site_url('store/product/view/'.$item->product_id);?>"><span class="view act"></span></a>
				<a href="#"><span class="delete_ajx act"></span></a>
			</div>
			<div class="clear"></div>
			<div class="horline"></div>
			<div class="clear"></div>
		</div>
	<?endforeach?>
	<div class="clear"></div>
<?else:?>
	<span class="msg">This Collection have no Item, <br/>Maybe you want to choose one :)</span>
<?endif?>
	</div>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
		
			$('.search_r').hide();
			var delayer = delayTimer(1000);
			$('#q_prod').live('keyup',function(event){
					delayer(function(){
						var q = $('#q_prod').val();
						var coll_id = <?=$coll->id?>;

						
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
										exe_additem();
									   	}else{
									   	$('.search_r').append('nothing found');
										$('.search_r').show('slide', {direction: 'up'});
									   	}
								   }
							});


						
					});
			});	
			$('.coll_item a .delete_ajx').click(function(){
				var dom_el = $(this).parent().parent().parent();
				var id_ref = dom_el.attr('id');
			    deleteItem(id_ref, dom_el);
			
			
			});
			function exe_additem(){
				$('div.search_r > div.coll_item').live('click',function(event){
					var coll_id = <?=$coll->id?>;
					var prod_id = $(this).attr('id');
					addcoll_item(prod_id, coll_id);
					$(this).remove();
				});
			}
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
							if($('.itemList .msg').size() > 0){
								$('.itemList .msg').hide('fade').remove();
							}
								$('.itemList').append(data.prod);
						   	}
					   }
				});
			}
			function deleteItem(id_ref, dom_el){
				var datapost = {
					'id_ref': id_ref
				};
				var dom_el = dom_el;
				$.ajax({
					type: 'POST',
					dataType : 'json',
					data: datapost,
					url : "<?=site_url('backend/store/b_collection/ajax_deleteItem');?>",
					success: function(data){
						if(data.status != 'failed'){
							dom_el.hide('slide', {'direction' : 'up'})
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
	 <div class="addItem_coll form-Ui mt10 box2">
	 	<form action="" method="POST" accept-charset="utf-8">
	 	<input type="text" class="text-input" name="q_prod" value="Start Search product to add" id="q_prod">
		
	 	</form>
		<div class="search_r mt10" style="min-height:30px">
			
		</div>
	 </div>
</div>


<div class="clear"></div>