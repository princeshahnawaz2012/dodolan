<div class="form-Ui addPage">
<form action="" method="post" accept-charset="utf-8">
	<input type="text" name="title" value="Title" class="text-input">
	<br/>
	<br/>
	<textarea id="page_content" name="content"></textarea>
	<?$this->dodol_theme->load_text_editor('page_content')?>
	<br/>
	<select name="category_id" id="category_id">
		<option value="">Select Category</option>
		<? $cats = modules::run('page/get_allcategory');
		foreach($cats->result() as $cat):?>
		
	
		
		<option value="<?=$cat->id;?>"><?=$cat->name?></option>
		
		<?endforeach?>
		
		
	</select>
	<p><input type="submit" value="Continue &rarr;" name="submit" class="button"></p>
</form>
</div>