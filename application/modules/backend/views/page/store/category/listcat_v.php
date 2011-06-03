<div class="listprod_v">
<div class="table-Ui">
	
<table>
 <thead>
  <tr>
  	<td>no</td>
    <td>Name</td>
    <td>Publish</td>
    <td>Parent</td>
     <td>Action</td>
    

  </tr>
 </thead>
 <tbody>

<?
if($cats){
	foreach($cats as $cat){?>
 <tr>
 	<td><?=$cat->id?></td>
    <td><?=$cat->name;?></td>
    <td><?=$cat->publish;?></td>
    <td>
    	<?  if($cat->parent_id != 0){ $parent = $this->category_m->getcatbyid($cat->parent_id);
    	echo $parent->name;
	}
    ?>
    	
    </td>
    <td class="action">
		<a href="#"><span class="act view"></span></a>
		<a href="<?=site_url('backend/store/b_category/editcat/'.$cat->id);?>"><span class="act edit"></span></a>
		<a href="<?=site_url('backend/store/b_category/deletecat/'.$cat->id);?>"><span class="act del"></span></a>
	</td>
	</tr>
<?}}else{
	echo 'there are not category to show';
	}?>
  

 
</tbody>
</table>
<div class="horline"></div>
 <div class="clear"></div>
		</div>	
</div>