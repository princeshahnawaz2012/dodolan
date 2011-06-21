<div class="form-Ui box2 mb10"><form action="<?=current_url();?>" method="post" accept-charset="utf-8">
<!--div class="grid_100 left mr10"><input type="text" name="filt_s" value="type keyword" class="text-input"></div-->
<div class="left"><select name="filt_spot">
	<option>spot</option>
	<?foreach(modules::run('modularizer/api_getallspot') as $spot):?>	
		<option value="<?=$spot->spot;?>"><?=$spot->spot;?></option>
	<?endforeach;?>
</select>
<select name="filt_state" >
	<option>state</option>
	<option value="admin">admin</option>
	<option value="front">front</option>
</select>
<select name="filt_publish">
	<option>publish</option>
	<option value="y">Yes</option>
	<option value="n">no</option>
</select>

	<input type="submit" class="button" name="filter" value="filter &rarr;">
</div>
<br class="clear"/>
</form>
</div>
