<div class="addprod_v">
	<form enctype="multipart/form-data" method="post" action="<?=current_url()?>">
	<div class="tab-Ui" id="addProdTab">
	<div class="nav">
		<div class="item" rel="1">Main Info</div>
		<div class="item" rel="2">Attribute and Stock</div>
		<div class="item" rel="3">S.E.O Setup</div>
		<div class="item" rel="4">Product Media</div>
		<div class="right"><input type="submit" name="submit" value="save" class="button save-button-Ui" style="margin-right:5px;"/><a href="<?=site_url();?>backend/store"><button class="button cancel-button-Ui" >Cancel</button></a></div>
		<div class="clear"></div>
		
	</div>
	<div class="comp">
		<div no="1" class="item">
		<div class="form-Ui productInfo">
					<div class="inputSet">
						<div class="label"><span>Product Name</span></div>
						<div class="input">
							
							<input type="text" value="<?=$prod->name; ?>" name="p_name" >
							
						</div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Product SKU</span></div>
						<div class="input"><input type="text"  value="<?=$prod->sku; ?>" name="p_sku" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Price</span></div>
						<div class="input left"><input type="text"  value="<?=$prod->price; ?>" name="p_price" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Weight</span></div>
						<div class="input left"><input type="text"  value="<?=$prod->weight; ?>" name="p_weight" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Publish</span></div>
						<?if ($prod->publish=='y') {
							$check = 'checked';
						} else {
							$check = '';
						}
						?>
						<div class="input left"><input type="checkbox" <?=$check;?> value="y" name="p_publish"></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Category</span></div>
						<div class="input left">
						<select name="p_cat_id">
						<option value="">Choose one</option>
						<?
						$cats = modules::run('store/category/showAllCat');
						foreach($cats as $cat){
							if ($cat->id==$prod->cat_id) {
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
					
					<div class="inputSet">
						<div class="label"><span>Description</span></div>
						<div class="input"><textarea name="p_desc" style="height:150px;"><?=$prod->l_desc; ?></textarea></div>
						<div class="clear"></div>
					</div>
					
			
		</div>
		</div>
		
		<div no="2" class="item">
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
					$('#attrib_prod .clone-Add').click(function(){
						$('#attrib_prod .clone-Item:last-child').clone().appendTo('#attrib_prod');
						$('#attrib_prod .clone-Item:last-child input').attr('value', '');
						$('#attrib_prod .clone-Item:last-child').hide();
						$('#attrib_prod .clone-Item:last-child').slideDown();
					});
					$('#attrib_prod .clone-Item .clone-Min').click(function(){
						$(this).css('display','').parent().parent().slideUp().remove();
					});
				});
			</script>
		<div class="form-Ui attr_n_stock clone-Ui" id="attrib_prod">
			<span class="button clone-Add right add-button-Ui">More</span>
			<div class="clear"></div>
			<?if($attrb){foreach ($attrb as $atr) {; ?>
			<div class="fieldSet relative clone-Item">
				
				<div class="grid_200 left">
				<label>Attribute</label>
				<input type="text" value="<?= $atr->attribute; ?>" name="attribute[]" >
				</div>
				<div class="grid_200 left">
				<label>Price Opt</label>
				<input type="text" value="<?= $atr->price_opt; ?>" name="price_opt[]" >
				</div>
				<div class="grid_200 left">
				<label>Stock</label>
				<input type="text" value="<?=$atr->stock; ?>" name="stock[]">
				</div>
				<input type="hidden" value="<?=$atr->id; ?>" name="attr_id[]">
				<!--div class="left">
					<span class="button min-button-Ui clone-Min absolute"></span>
				</div-->
				<div class="clear"></div>
			</div>
			<?}}else{?>
			
			
			<div class="fieldSet relative clone-Item">
				
				<div class="grid_200 left">
				<label>Attribute</label>
				<input type="text" name="attribute[]"  style="">
				</div>
				<div class="grid_200 left">
				<label>Price Opt</label>
				<input type="text" name="price_opt[]"  style="">
				</div>
				<div class="grid_200 left">
				<label>Stock</label>
				<input type="text" name="stock[]"  style="">
				</div>
				<input type="hidden" name="attr_id[]">
				<!--div class="left">
					<span class="button min-button-Ui clone-Min absolute"></span>
				</div-->
				<div class="clear"></div>
			</div>
				<?}?>
		</div>
		</div>
	
		<div no="3" class="item">
			<div class="form-Ui metaDesc">
					<div class="inputSet">
						<div class="label"><span>Meta Description</span></div>
						<div class="input"><textarea name="p_meta_desc" style="height:70px;"><?= $prod->meta_desc; ?></textarea></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Meta Keyword</span></div>
						<div class="input"><textarea name="p_meta_key" style="height:70px;"><?= $prod->meta_key; ?></textarea></div>
						<div class="clear"></div>
					</div>
			</div>
		</div>
		<div no="4" class="item">
			<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	
	$('#media_prod .clone-Add').click(function(){
		var yourclass="#media_prod .clone-Item";  //The class you have used in your form
		var clonecount = $(yourclass).length;	//how many clones do we already have?
		var newid = Number(clonecount) + 1;		//Id of the new clone   
		
		$(yourclass+":first").fieldclone({		//Clone the original elelement
			newid_: newid,						//Id of the new clone, (you can pass your own if you want)
			target_: $("#media_prod"),			//where do we insert the clone? (target element)
			insert_: "append",					//where do we insert the clone? (after/before/append/prepend...)
			limit_: 4							//Maximum Number of Clones
		});
		return false;
	});



});			
			</script>
		<div class="form-Ui attr_n_stock clone-Ui relative" id="media_prod">
			<?if($media){?>
				<?foreach ($media as $med) {;?>
					<div class="media_item left grid_150">
						<img src="<?=base_url()?>/assets/product-img/<?=$med->path;?>" class="grid_140 ctr"><br/>
						<small><?=$med->name;?></small><a href="<?=site_url('backend/store/b_product/editmedia/'.$med->id);?>"<span class="right act edit"></span></a>
						<div class="clear"></div>
						
					</div>
					
					
			<?}?>
				<div class="clear"></div>
			
				<?}else{
					echo 'this product have no media yet, could you upload one?';
					}?>
			<span class="button clone-Add right add-button-Ui">More</span>
			<div class="clear"></div>
			
				<div class="fieldSet relative clone-Item">
				<div class="grid_200 left">
				<label>Name</label>
				<input type="text" name="p_media_name[]"  style="">
				</div>
				
				<input type="hidden" value="50" name="p_id_media[]">
				<div class="grid_100 left">
				<label>don't Publish</label><br>
								<input type="checkbox" name="p_media_publish[]" value="n" >
				</div>
				<div class="grid_100 left">
				<label>Set as Default</label><br>
								
				<input type="checkbox" name="p_media_default[]" value="1" >
				</div>
				<div class="grid_200 left">
				<label>File</label>
				<input type="file" name="p_media_file_1">
				</div>
				<!--div class="left">
					<span class="button min-button-Ui clone-Min absolute"></span>
				</div-->
				<div class="clear"></div>
			</div>
			
			
				
		</div>
		</div>
	</div>
	
	</form>
</div>