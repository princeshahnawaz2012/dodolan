<div class="create_collection">
<div class="form-Ui">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="text" name="title" value="Title" class="text-input grid_500">
			
			<textarea name="description" id="text_editor" rows="8" cols="40"></textarea>
		<?$this->dodol_theme->load_text_editor('text_editor')?>
				<script>
				$(document).ready(function(){

				$(".hasTime").datetimepicker({
					dateFormat:"yy-mm-dd",
					timeFormat: 'hh:mm:ss'
					});
				});
				</script>
				<br/>
				<div class="grid_250 mr20 left">
					<input type="text" name="p_date" value="<?=date('Y-m-d');?>" class="hasTime">
				</div>
				<div class="grid_250 left">
					<input type="file" name="img_file" value=""><br class="clear">
				</div>

				<div class="clear"></div>
							<br/>
					<input type="submit" name="submit" value="create Collection" class="button">
		</form>
</div>
</div>

<div class="clear"></div>