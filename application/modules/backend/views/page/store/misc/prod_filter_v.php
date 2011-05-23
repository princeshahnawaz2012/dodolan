<div class="prodFilter right">
	<small>Product filter</small><br/>
	
	<form action="<?=current_url();?>" method="post">
	<div class="form-Ui right">
		<div class="grid_150 left mr5">
			<input type="text" class="text-input" name="keyword" value="keyword">
		</div>
		
		<div class="left mr5">
			<select name="publish">
				<option value="">Publish</option>
				<option value="y">Yes</option>
				<option value="n">No</option>
			</select>
		</div>
		<div class="mr5 left">
		<select name="cat_id">
						<option value="">Choose one</option>
						<?
						$cats = modules::run('store/category/showAllCat');
						foreach($cats as $cat){
									
							;?>	
							
							<option value="<?=$cat->id?>"><?=$cat->name;?></option>
						<?}?>
						</select>
		</div>
		<div class="left">
			<input type="submit" class="button" name="submitfilter" value="submit">
		</div>
		<br/>
		<div class="clear"></div>
	</div>
	</form>
	
</div>
