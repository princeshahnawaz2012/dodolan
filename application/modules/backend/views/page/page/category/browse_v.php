<div class="listprod_v">
<?if($cats):;?>
<div class="table-Ui">

<table>
 <thead>
  <tr>
  	<td>no</td>
    <td>Name</td>
    <td>Parent</td>
     <td>Action</td>
    

  </tr>
 </thead>
 <tbody>

<?foreach($cats->result() as $cat){?>
 <tr>
 	<td><?=$cat->id?></td>
    <td><?=$cat->name;?></td>
    <td>
    	<?  if($cat->parent_id > 0){ 
		$parent = modules::run('page/page_category/get_byid', $cat->parent_id);
    	echo $parent->name;
		}
    	?>
    	
    </td>
    <td class="action">
		<a href="#"><span class="act view"></span></a>
		<a href="<?=site_url('backend/page/b_page_category/update/'.$cat->id);?>"><span class="act edit"></span></a>
		<a href="<?=site_url('backend/page/b_page_category/delete/'.$cat->id);?>"><span class="act del"></span></a>
	</td>
	</tr>
<?}?>
  

 
</tbody>
</table>
<div class="clear"></div>

</div>	
<div class="pagination right"><?=$this->barock_page->make_link('p');?></div>
	<div class="clear"></div>
<?else: echo 'there are not category to show'; endif?>
</div>