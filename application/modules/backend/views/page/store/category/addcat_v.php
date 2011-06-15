<div class="grid_500 ctr box2">
	<div class="form-Ui">
		<form action="<?=current_url()?>" method="post">
		<div class="inputSet">	
			<div class="label"><span>Name Category</span></div>
			<div class="input"><input name="name" type="text" /></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
			<div class="label"><span>Don't Publish</span></div>
			<div class="input"><input name="publish" type="checkbox" value="n"/></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
			<div class="label"><span>Description</span></div>
			<div class="input"><textarea name="desc"></textarea></div>
			<div class="clear"></div>
		</div>
		
		<div class="inputSet">	
			<div class="label"><span>Parent Category</span></div>
			<div class="input">
			<select name="parent_id">
						<option value="">Choose one</option>
						<?
						$cats = modules::run('store/category/showAllCat');
						foreach($cats as $cat){
							
														
							;?>	
							
							<option value="<?=$cat->id?>"><?=$cat->name;?></option>
						<?}?>
						</select>
			</div>
			<div class="clear"></div>
		</div>
		<div class="right">
			<input type="submit" name="submit" value="Submit" class="button save-button-Ui">
		</div>
		<div class="clear"></div>
		</form>
	</div>
		
</div>