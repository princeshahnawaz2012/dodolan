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
				$('#q_prod').keyup(function(){
					
					$.ajax({
						type: "POST",
						dataType : "json",
						data : {'type' : 'json'},	
						url: "<?=site_url('backend/widget/ga_chart_visit_req')?>",
						success: function(data){					     
							   	if(data.status != 'error'){
								allVisits = ga_data_extract(data.visitors),
								newVisitors = ga_data_extract(data.newVisits),
								options.series[0].data = allVisits;
								options.series[1].data = newVisitors;

								chart = new Highcharts.Chart(options);
							   	}else{
							   		alert('somthing wrong');
							   	}
						   }
					});
				});	
		});
	
	</script>
	 <div class="addItem_coll form-Ui mt10 box2">
	 	<form action="" method="POST" accept-charset="utf-8">
	 	<input type="text" class="text-input" name="q_prod" value="Start Search product to add" id="q_prod">
		
	 	</form>
	 </div>
</div>


<div class="clear"></div>