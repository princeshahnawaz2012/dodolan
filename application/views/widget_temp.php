<?if($widgets):?>

	
	<?foreach($widgets['q'] as $widget):?>
	<div class="modularizer">
		<?$mod_param = $this->dodol->jsonToArray($widget->mod_param)?>
		<?if($mod_param['hide_title'] != 'y'):?>
			<h3><?=$widget->name?></h3>
		<?endif?>
	<?=widget_helper::exec($widget->state.'/'.$widget->widget_name.'/'.$widget->widget_name, $this->dodol->jsonToArray($widget->parameter))?>
	</div>
	<?endforeach;?>

<?endif;?>