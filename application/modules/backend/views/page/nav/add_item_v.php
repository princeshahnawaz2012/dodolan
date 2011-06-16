<div class="grid_500 ctr box2">
	<div class="form-Ui">
		<form action="<?=current_url()?>" method="post">
		<div class="inputSet">	
			<div class="label"><span>Name Menu</span></div>
			<div class="input"><input name="name" type="text" value="" /></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
				<div class="label"><span>Route</span></div>
				<div class="input"><input name="route" type="text" value="" /></div>
				<div class="clear"></div>
		</div>
		<div class="inputSet">	
			<div class="label"><span>Anchor</span></div>
			<div class="input"><input name="anchor" type="text" value="" /></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
				<div class="label"><span>Parent menu</span></div>
				<div class="input">
					<select name="parent_id">
						<option value="0">As root</option>
						<?
						if($exist =modules::run('nav/nav_item/getbynav', $nav->id)):
							foreach($exist as $par ):
							?>
							<option value="<?=$par->id;?>"><?=$par->name;?></option>
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
			<input type="submit" name="create" value="Submit" class="button save-button-Ui">
		</div>
		<div class="clear"></div>
		</form>
	</div>
		
</div>