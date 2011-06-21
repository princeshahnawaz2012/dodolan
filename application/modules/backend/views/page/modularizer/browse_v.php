<script type="text/javascript">
$(document).ready(function() {
    // Initialise the table
	if($('span.spot').text() != ''){
		reorder();
	}else{
		return false;
	}

	function reorder(){
		$("#listWidget").tableDnD({
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
								data : {'sort_state' : order_state},	
								url: "<?=site_url('backend/modularizer/b_modularizer/reorder')?>",
						});
						
			}
		});
	}
	
    
	
		
});
</script>
<div class="all_widget  left grid_650">
	
	
<?if($mods):?>
<?$spot = element('spot', $this->uri->uri_to_assoc())?>
<span class="spot hide"><?=$spot?></span><br class="clear"/>

<div class="list_widgets table-Ui">
		<table id="listWidget">
		 <thead>
		  	<tr >
			  	<td class="grid_200">Title</td>
				<td class="grid_50">Publish</td>
			    <td class="grid_100">Spot</td>
			    <td class="grid_100">Type</td>
			    <td class="grid_50">State</td>
				<td class="grid_50">Action</td>
			  </tr>
		 </thead>
		 <tbody>

		<?foreach($mods as $wid):?>
		<?$detail = $this->dodol_widget->get_detail($wid->state, $wid->widget_name)?>
		<tr id="<?=$wid->id;?>">
		  	<td><?=$wid->name?></td>
			<td><?=$wid->publish?></td>
		    <td class="spot"><?=$wid->spot?></td>
		    <td><?=element('name', $detail)?></td>
			<td><?=$wid->state?></td>
		    <td>
				<a href="<?=site_url('backend/modularizer/b_modularizer/update/'.$wid->id);?>"><span class="act edit"></span></a>
				<a href="<?=site_url('backend/modularizer/b_modularizer/delete/'.$wid->id);?>"><span class="act del"></span></a></td>
		  </tr>
	 
		<?endforeach;?>
		</tbody>
		</table>
	</div>
	<div class="pagination right"><?=$this->barock_page->make_link();?></div>
	<div class="clear"></div>

	<?else:?>
		There's no widget yet , Active
	<?endif?>
	
</div>
<div class="available_widget grid_280 right">
	
		<div class="box2">
			<span class="bold">Installed Widget</span><div class="horline"></div>
			
			<?foreach($installed as $item):?>
			<div class="item">
				<div class="detail left">
				<span class="bold"><?=element('name', $item)?></span><br class="clear"/>
				<div class="desc"><?=element('description', $item)?></div>
				</div>
				<div class="right font80">
					
				<a class="button" href="<?=site_url('backend/modularizer/b_modularizer/create?st='.element('state', $item).'&wm='.element('file_name', $item));?>">new</a>
				</div>
				<br class="clear"/>
			</div>
			<?endforeach;?>
		</div>
</div>

<div class="clear"></div>