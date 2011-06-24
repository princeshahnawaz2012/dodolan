<?if($widgets):?>

	
	<?foreach($widgets['q'] as $widget):?>
	<?$mod_param = $this->dodol->jsonToArray($widget->mod_param)?>
	<div class="modularizer <?=element('css_suffix', $mod_param);?>">
	
		<?if(element('hide_title', $mod_param) == 'y'):?>
		<?else:?>
		<h3><?=$widget->name?></h3>
		<?endif?>
	<?=widget_helper::placed($widget->state.'/'.$widget->widget_name.'/'.$widget->widget_name, $this->dodol->jsonToArray($widget->parameter))?>
	</div>
	<?endforeach;?>

<?endif;?>