<div class="browse_config_v">
<?if($confs):;?>
<div class="table-Ui">

<table>
 <thead>
  <tr>
  	<td>no</td>
    <td>Name</td>
    <td>Description</td>
     <td>Action</td>
    

  </tr>
 </thead>
 <tbody>

<?foreach($confs as $conf){?>
 <tr>
 	<td><?=$conf->id?></td>
    <td><?=$conf->name;?></td>
    <td><?=$conf->description;?></td>
    <td class="action">
		<a href="<?=site_url('backend/conf/b_conf/update/'.$conf->id);?>"><span class="act edit"></span></a>
		<a href="<?=site_url('backend/conf/b_conf/delete/'.$conf->id);?>"><span class="act del"></span></a>
	</td>
	</tr>
<?}?>
  

 
</tbody>
</table>
<div class="clear"></div>

</div>	
<div class="clear"></div>
<?else: echo 'there are not category to show'; endif?>
</div>