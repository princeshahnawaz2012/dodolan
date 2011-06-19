<div class="widget_form grid_500 ctr form-Ui box2">
	<form action="" method="post" accept-charset="utf-8">
		<div class="main_info mb10">
			<span class="bold">Widget Detail</span><br/>
		<div class="inputSet">	
				<div class="label"><span>Widget Name</span></div>
				<div class="input"><input name="name" type="text" value="<?=$widget->name;?>" /></div>
				<div class="clear"></div>
		</div>
		<div class="inputSet">	
				<div class="label"><span>Spot</span></div>
				<div class="input"><input name="spot" type="text" value="<?=$widget->spot;?>" /></div>
				<div class="clear"></div>
		</div>
		<div class="inputSet">	
				<?$check = ($widget->publish == 'y') ? 'checked' : '' ;?>
				<div class="label"><span>Publish</span></div>
				<div class="input"><input type="checkbox" name="publish" <?=$check?> value="y" ></div>
				<div class="clear"></div>
		</div>
		<div class="inputSet">
					<?$mod_param = json_decode($widget->mod_param, true);?>
					<?$check = (element('hide_title', $mod_param) == 'y') ? 'checked' : '' ;?>
					<div class="label"><span>Hide Title</span></div>
					<div class="input"><input type="checkbox" name="mod_par_hide_title" <?=$check?> value="y" ></div>
					<div class="clear"></div>
		</div>
		</div>
		<div class="horline mb10"></div>
		<br class="clear"/>
		<div class="module_self_parameter">
			<span class="bold">Widget Parameter</span><br/>
	<?=widget_helper::run($widget->state.'/'.$widget->widget_name.'/'.$widget->widget_name.'/update',json_decode($widget->parameter, true))?>
		</div>
		<p><input type="submit" name="create" class="button" value="Continue &rarr;"></p>
	</form>
</div>