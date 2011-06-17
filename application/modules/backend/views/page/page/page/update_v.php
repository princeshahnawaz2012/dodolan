<div class="form-Ui updPage">
<form action="" method="post" accept-charset="utf-8">
	<input type="text" name="title" value="<?=$page->title;?>" class="text-input">
	<br/>
	<br/>
	<textarea id="page_content" name="content"><?=$page->content;?></textarea>
	<?=$this->dodol_theme->load_text_editor('page_content')?>
	<br/>
	<select name="category_id" id="category_id">
		<option value="">Select Category</option>
		<? $cats = modules::run('page/get_allcategory');
		foreach($cats->result() as $cat):?>
		
		<?if($cat->id == $page->category_id):
		$selected = true;
		else:
		$selected = false;
		endif;?>
		
		<option selected="<?=$selected?>" value="<?=$cat->id;?>"><?=$cat->name?></option>
		
		<?endforeach?>
		
		
	</select>
	<p><input type="submit" value="Continue &rarr;" name="submit" class="button"></p>
</form>
</div>