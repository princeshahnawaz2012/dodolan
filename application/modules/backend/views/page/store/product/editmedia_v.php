<div class="grid_800 ctr box2">
	<div class="form-Ui">
	<form action="<?=current_url();?>" method="post" enctype="multipart/form-data">
		<div class="grid_480 left">
			<div class="inputSet">
			<div class="label"><span>Name</span></div>
			<div class="input"><input type="text" name="name" value="<?=$media->name;?>"></div>
			<div class="clear"></div>
			</div>
			<div class="inputSet">
			<div class="label"><span>New Image</span><br/><small>* the current image will deleted</small></div>
			<div class="input">
				<input type="file" name="media_file" ></div>
			<div class="clear"></div>
			</div>
			
			<div class="grid_400">
			<div class="horline"></div>
				<div class="grid_200 left">
					<label>Publish</label>
					<?
					if($media->publish == 'y'){
						$publish = 'checked';
					}else{
						$publish = '';
					}
					?>
					
					<input type="checkbox" <?=$publish;?> name="publish" value="y">
				</div>
				<div class="grid_200 left">
					<label>Default</label>
					<?
					if($media->default == '1'){
						$default = 'checked';
					}else{
						$default = '';
					}
					?>
					<input type="checkbox" <?=$default;?> name="default" value="1">
				</div>
				<div class="clear"></div>
			<div class="horline"></div>
			</div>
			
			<div class="left">
				<br/>
				<input type="hidden" name="id-media" value="<?=$media->id;?>" >
				<input type="submit" name="submit" class="button save-button-Ui" value="save media">
				<a class="button" href="<?=site_url('backend/store/b_product/editprod/'.$media->prod_id);?>"><span>Back to Detail Product</span></a>
			</div>
			<div class="clear"></div>
			
			
			</div>
		<div class="grid_300 right">
			<img class="grid_280" src="<?=base_url()?>/assets/product-img/<?=$media->path;?>">
		</div>
		<div class="clear"></div>
		
		
	</form>
	</div>
</div>