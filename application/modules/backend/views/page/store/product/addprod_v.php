<div class="addprod_v">
	<form enctype="multipart/form-data" method="post" action="<?=current_url()?>">
		
		<script type="text/javascript" charset="utf-8">
			$(function() {
					$( "#addProdTab" ).tabs();
				});
		</script>
	<div class="tab-Ui" id="addProdTab">
		<div class="right" style="margin-bottom:-40px"><input type="submit" name="submit" value="save" class="button save-button-Ui" style="margin-right:5px;"/><a href="<?=site_url();?>backend/store"><button class="button cancel-button-Ui" >Cancel</button></a></div>	
		<br class="clear"/>
		
	<ul class="nav">
		<li><a href="#tab_1">Main Info</a></li>
		<li><a href="#tab_2">Inventory and Stock</a></li>
		<li><a href="#tab_3">S.E.O Setup</a></li>
		<li><a href="#tab_4">Product Media</a></li>
		
	</ul>
	
		<div id="tab_1" class="item">
		<div class="form-Ui productInfo">
					<div class="inputSet">
						<div class="label"><span>Product Name</span></div>
						<div class="input">
							
							<input type="text" name="p_name" >
							
						</div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Product SKU</span></div>
						<div class="input"><input type="text" name="p_sku" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Price</span></div>
						<div class="input left"><input type="text" name="p_price" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Weight</span></div>
						<div class="input left"><input type="text" name="p_weight" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Publish</span></div>
						<div class="input left"><input type="checkbox" value="1" name="p_publish"></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Category</span></div>
						<div class="input left">
						<select name="p_cat_id">
						<option value="">Choose one</option>
						<?
						$cats = modules::run('store/category/showAllCat');
						foreach($cats as $cat){;?>	
							<option value="<?=$cat->id?>"><?=$cat->name;?></option>
						<?}?>
						</select>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="inputSet">
						<div class="label"><span>Description</span></div>
						<div class="input"><textarea name="p_desc" style="height:150px;"></textarea></div>
						<div class="clear"></div>
					</div>
					
			
		</div>
		</div>
		
		<div id="tab_2" class="item">
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
			<div class="fieldSet relative clone-Item">
				<div class="grid_200 left">
				<label>Attribute</label>
				<input type="text" name="attribute[]" >
				</div>
				<div class="grid_200 left">
				<label>Price Opt</label>
				<input type="text" name="price_opt[]" >
				</div>
				<div class="grid_200 left">
				<label>Stock</label>
				<input type="text"  name="stock[]">
				</div>
				<!--div class="left">
					<span class="button min-button-Ui clone-Min absolute"></span>
				</div-->
				<div class="clear"></div>
			</div>
			
				
		</div>
		</div>
	
		<div id="tab_3" class="item">
			<div class="form-Ui metaDesc">
					<div class="inputSet">
						<div class="label"><span>Meta Description</span></div>
						<div class="input"><textarea name="p_meta_desc" style="height:70px;"></textarea></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Meta Keyword</span></div>
						<div class="input"><textarea name="p_meta_key" style="height:70px;"></textarea></div>
						<div class="clear"></div>
					</div>
			</div>
		</div>
		<div id="tab_4" class="item">
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
			<span class="button clone-Add right add-button-Ui">More</span>
			<div class="clear"></div>
			<div class="fieldSet relative clone-Item">
				<div class="grid_200 left">
				<label>Name</label>
				<input type="text" name="p_media_name[]" >
				</div>
				<div class="grid_100 left">
				<label>don't Publish</label><br/>
				<input type="checkbox" value="n" name="p_media_publish[]" >
				</div>
				<div class="grid_100 left">
				<label>Set as Default</label><br>
				<input type="checkbox" value="1"  name="p_media_default[]">
				</div>
				<div class="grid_200 left">
				<label>File</label>
				<input type="file" name="p_media_file_1" >
				</div>
				<!--div class="left">
					<span class="button min-button-Ui clone-Min absolute"></span>
				</div-->
				<div class="clear"></div>
			</div>
			
				
		</div>
		</div>

	
	</form>
</div>