<div class="form-Ui addPage">
<form action="" method="post" accept-charset="utf-8">
	<input type="text" name="title" value="Title" class="text-input">
	<textarea id="page_content" name="content"></textarea>
	<?$this->theme->load_text_editor('page_content')?>
	
	<p><input type="submit" value="Continue &rarr;" name="submit"></p>
</form>
</div>