
<div class="all_widget left grid_650">
	
	<?if($mods):?>
<div class="list_widgets table-Ui">
		<table id="listMenu">
		 <thead>
		  	<tr >
			  	<td class="grid_150">Title</td>
			    <td class="grid_100">Spot</td>
			    <td class="grid_150">Type</td>
			    <td class="grid_50">State</td>
				<td class="grid_50">Action</td>
			  </tr>
		 </thead>
		 <tbody>

		<?foreach($mods as $wid):?>
		<?$detail = $this->dodol_widget->get_detail($wid->state, $wid->widget_name)?>
		<tr>
		  	<td><?=$wid->name?></td>
		    <td><?=$wid->spot?></td>
		    <td><?=element('name', $detail)?></td>
			<td><?=$wid->state?></td>
		    <td>Action</td>
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
	<span class="bold">Installed Widget</span>
		<div class="box2">
			
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