<div class="prodFilter right">
	<small>Product filter</small><br/>
	
	<form action="<?=current_url();?>" method="post">
	<div class="form-Ui right">
		<div class="grid_150 left mr5">
			<input type="text" class="text-input" name="keyword" value="keyword">
		</div>
		
		<div class="left mr5">
			<select name="publish">
				<option value="">Publish</option>
				<option value="y">Yes</option>
				<option value="n">No</option>
			</select>
		</div>
		<div class="mr5 left">
		<select name="cat_id">
						<option value="">Choose one</option>
						<?
						$cats = modules::run('store/category/showAllCat');
						foreach($cats as $cat){
									
							;?>	
							
							<option value="<?=$cat->id?>"><?=$cat->name;?></option>
						<?}?>
						</select>
		</div>
		<div class="left">
			<input type="submit" class="button" name="submitfilter" value="submit">
		</div>
		<br/>
		<div class="clear"></div>
	</div>
	</form>
	
</div>

<div class="clear"></div>
<div class="listprod_v mt10">
	<?if($prods){?>
	   
<div class="table-Ui">
	
<table class="prodList">
 <thead>
  <tr>
  	<td>no</td>
    <td>Product Name</td>
    <td>Category</td>
     <td>publish</td>
    <td>Action</td>

  </tr>
 </thead>
 <tbody>

<?
foreach($prods as $prod){
	$param = array(
		'id' => $prod->p_id,
		'select' => 'sku, name, publish, id, cat_id',
		);	
	$q = modules::run('store/product/detProd', $param);
	$p = $q['prod'];
	$c = $q['cat']
	?>
 <tr>
 	<td><?=$p->sku?></td>
    <td><?=$p->name;?></td>
    <td><?=$c->name;?></td>
    <td><?=$p->publish;?></td>
    <td class="action">
		<a href="#"><span class="act view"></span></a>
		<a href="<?=site_url('backend/store/b_product/editprod/'.$p->id);?>"><span class="act edit"></span></a>
		<a href="#"><span class="act del"></span></a>
	</td>
	</tr>

  <?}?>

 
</tbody>
</table>
<div class="horline"></div>
 <div class="pagination right">
  	<?=$this->barock_page->make_link();?>
  </div>
  <div class="clear"></div>
		</div>	
		<?}else{
			echo 'there are no product to show';
			}?>
</div>