<div class="grid_500 box2 ctr">
	<div class="form-Ui">
		<form action="<?=current_url()?>" method="post">
		<div class="inputSet">	
			<div class="label"><span>Name Category</span></div>
			<div class="input"><input name="name" type="text" value="<?=$category->name;?>"/></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
			<div class="label"><span>Don't Publish</span></div>
			<? if($category->publish == 'n'){
				$checked = 'checked';
				}else{
				$checked = ''	;
				}?>
			<div class="input"><input name="publish" <?=$checked?> type="checkbox" value="n"/></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">	
			<div class="label"><span>Description</span></div>
			<div class="input"><textarea name="desc"><?=$category->desc;?></textarea></div>
			<div class="clear"></div>
		</div>
		
		<div class="inputSet">	
			<div class="label"><span>Parent Category</span></div>
			<div class="input">
		<select name="parent_id">
						<option value="0">as root</option>
					<? $cats = modules::run('store/category/showAllCat');
						foreach($cats as $cat){
						if ($cat->id == $category->parent_id) {
							$select = 'selected';
						} else {
						$select = '';
					}
						;?>	
							<option <?=$select; ?> value="<?=$cat->id?>"><?=$cat->name;?></option>
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