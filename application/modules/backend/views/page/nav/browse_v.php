<div class="listprod_v">
<?if($navs):?>
<div class="table-Ui">
<table>
 <thead>
  <tr>
  	<td>no</td>
    <td>Name</td>
    <td>Action</td>
  </tr>
 </thead>
 <tbody>

<?foreach($navs as $nav){?>
 <tr>
 	<td><?=$nav->id?></td>
    <td><?=$nav->name;?></td>
    <td class="action">
		<a href="<?=site_url('backend/nav/b_nav/view/'.$nav->id);?>"><span class="act view"></span></a>
		<a href="<?=site_url('backend/nav/b_nav/update/'.$nav->id);?>"><span class="act edit"></span></a>
		<a href="<?=site_url('backend/nav/b_nav//delete/'.$nav->id);?>"><span class="act del"></span></a>
	</td>
	</tr>
<?}?>
  

 
</tbody>
</table>
<div class="clear"></div>

</div>	
<div class="pagination right"></div>
	<div class="clear"></div>
<?else: echo 'there are not Navigation to show'; endif?>
</div>