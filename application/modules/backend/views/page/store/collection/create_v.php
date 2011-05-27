<div class="create_collection">
<div class="form-Ui">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="text" name="title" value="Title" class="text-input grid_500">
			
			<textarea name="description" id="text_editor" rows="8" cols="40"></textarea>
		<?$this->theme->load_text_editor('text_editor')?>
			<input type="file" name="img_file" value=""><br class="clear">
			<input type="submit" name="submit" value="Create Collection">
		</form>
</div>
</div>

<div class="clear"></div>