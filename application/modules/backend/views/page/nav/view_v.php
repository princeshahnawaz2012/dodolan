<script type="text/javascript">
$(document).ready(function() {
    // Initialise the table
    $("#listMenu").tableDnD({
	 	onDrop: function(table, row) {
		            var rows = table.tBodies[0].rows;
		            var debugStr = "";
		            for (var i=0; i<rows.length; i++) {
		                debugStr += rows[i].id+",";
		            }
					var order_state = debugStr.substr(0,debugStr.length - 1);
					$.ajax({
							type: "POST",
							dataType : "json",
							data : {'order_state' : order_state},	
							url: "<?=site_url('backend/nav/b_nav/reorder_item')?>",
					});
		}
	});
	
		
});
</script>
<div class="debugArea"></div>
<div class="navigation_detail">
	<div class="description">
		<?=$nav->description?>
	</div>
</div>
<div class="list_items">
	<?if($items):?>

	<div class="items table-Ui">
		<table id="listMenu">
		 <thead>
		  <tr>
		  	<td>Name</td>
		    <td>Parent</td>
		    <td>Link</td>
		    <td>Action</td>
		  </tr>
		 </thead>
		 <tbody>
		
		<?foreach($items as $item):?>
		 <tr id="<?=$item->id;?>">
		  	<td><?=$item->name?></td>
		    <td><?if($item->parent_id != 0): echo modules::run('nav/nav_item/getbyid', $item->parent_id)->name;endif;?></td>
		    <td><?=$item->anchor?></td>
		    <td class="action">
				<a href="<?=site_url('backend/nav/b_nav/edit_item/'.$item->id);?>"><span class="act edit"></span></a>
				<a href="<?=site_url('backend/nav/b_nav/delete_item/'.$item->id);?>"><span class="act del"></span></a>
			</td>
		  </tr>
		 </thead>
		
		
		<?endforeach;?>
		

		</tbody>
		</table>
		<div class="clear"></div>
	</div>
	
	<?else:?>
	<span>there no menu item yet</span>
	<?endif;?>
</div>
<div class="clear"></div>