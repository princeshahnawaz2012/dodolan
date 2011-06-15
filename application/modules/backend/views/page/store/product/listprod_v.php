
<div class="clear"></div>
<div class="listprod_v mt10">
	<?if($prods){?>
	   
<div class="table-Ui">
	
<table class="prodList">
 <thead>
  <tr>
  	<td class="grid_120"></td>
    <td class="grid_250">Product Name</td>
    <td>Invetory</td>
	<td class="grid_100"><span class="bold">TOTAL</span></td>
    <td>Action</td>

  </tr>
 </thead>
 <tbody>

<?
foreach($prods as $prod){
	$param = array(
		'id' => $prod->p_id,
		'attr' => true
		);	
	$q = modules::run('store/product/detProd', $param);
	$p = $q['prod'];
	$c = $q['cat'];
	$attrs = $q['attrb'];
	$img = modules::run('store/product/prodImg', $prod->p_id);
	$stock = $p->stock;
	?>
 <tr>
 	<td><img src="<?=site_url('thumb/show/100-50-crop/dir/assets/product-img/'.$img->path)?>"></td>
    <td class="vTop">
		<div class="prodDet">
			<span class="left"><?=$p->name?></span><span class="right"><?=$p->sku?></span>
			<br class="clear">
			<div class="horline"></div>
			<p>Publish : <?=$p->publish?> | Category : <?=$c->name;?></p>
		</div>
	</td>
    <td>
    	<div class="list_attr">
    		<?if($attrs):
				foreach($attrs as $attr):
				$stock =$stock+$attr->stock;
				?>
				<div class="item_attr"><?=$attr->attribute;?></div>
				<?endforeach;
			endif?>
    	</div>
    </td>
    <td class="text_center"><?=$stock?></td>
    <td class="action">
		<a href="<?=site_url('store/product/view/'.$p->id);?>"><span class="act view"></span></a>
		<a href="<?=site_url('backend/store/b_product/editprod/'.$p->id);?>"><span class="act edit"></span></a>
		<a href="<?=site_url('backend/store/b_product/deleteprod/'.$p->id);?>"><span class="act del"></span></a>
	</td>
	</tr>

  <?}?>

 
</tbody>
</table>
<div class="pagination right"><?=$this->barock_page->make_link();?></div>
<div class="clear"></div>
		</div>	
		<?}else{
		echo 'there are no product to show';
		}?>
</div>