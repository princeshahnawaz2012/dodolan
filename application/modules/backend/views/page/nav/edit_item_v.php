<div class="grid_500 ctr box2">
	<div class="form-Ui">
		<form action="<?=current_url()?>" method="post">
		<div class="inputSet">	
			<div class="label"><span>Name Menu</span></div>
			<div class="input"><input name="name" type="text" value="<?=$item->name;?>" /></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
				<div class="label"><span>Route</span></div>
				<div class="input"><input name="route" type="text" value="<?=$item->route;?>" /></div>
				<div class="clear"></div>
		</div>
		<div class="inputSet">	
			<div class="label"><span>Anchor</span></div>
			<div class="input"><input name="anchor" type="text" value="<?=$item->anchor;?>" /></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
				<div class="label"><span>Parent menu</span></div>
				<div class="input">
					<select name="parent_id">
						<option value="0">As root</option>
						<?
						if($exist =modules::run('nav/nav_item/getbynav', $item->nav_id)):
							foreach($exist as $par ):
							$selected = '';
							if($par->id == $item->parent_id){
								$selected = 'selected';
							}
							?>
							<option <?=$selected;?> value="<?=$par->id;?>"><?=$par->name;?></option>
							<?
							endforeach;
						else:
						
						endif;
						?>
					</select>
				</div>
				<div class="clear"></div>
		</div>
		<div class="right">
			<input type="submit" name="update" value="Submit" class="button save-button-Ui">
		</div>
		<div class="clear"></div>
		</form>
	</div>
		
</div>