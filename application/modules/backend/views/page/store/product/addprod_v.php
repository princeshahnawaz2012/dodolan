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
		<li><a href="#tab_5">Product Association</a></li>
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
						<div class="label"><span>Stock</span></div>
						<div class="input left"><input type="text" name="global_stock" ></div>
						<div class="clear"></div>
					</div>
					<div class="inputSet">
						<div class="label"><span>Publish</span></div>
						<div class="input left"><input type="checkbox" value="y" name="p_publish"></div>
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
						<?$this->dodol_theme->load_text_editor('p_desc')?>
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
        <div id="tab_5" class="item">
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
	
					var delayer = delayTimer(1000);
					$('#product_rel').live('keyup',function(event){
							delayer(function(){
								var q = $('#product_rel').val();						
								if(get_rel_array() != false){
								var except = get_rel_array();
								}else{
								var except = null;	
								}
								$('.src_r').empty().hide('slide', {direction: 'up'});
								$.ajax({
										type: "POST",
										dataType : "json",
										data : {'rel_search' : q, 'except' : except},	
										url: "<?=site_url('backend/store/b_product/ajax_prod_search_rel')?>",
										success: function(data){					     
											   	if(data.status != false){
												$('.src_r').append(data.prods);
												$('.src_r').show('slide', {direction: 'up'});
												add_rel();
											   	}else{
											   	$('.src_r').append('nothing found');
												$('.src_r').show('slide', {direction: 'up'});
											   	}
										   }
									});
							});
			
					});
					function delayTimer(delay){
					     var timer;
					     return function(fn){
					          timer=clearTimeout(timer);
					          if(fn)
					               timer=setTimeout(function(){
					               fn();
					               },delay);
					          return timer;
					     }
					}
					function add_rel(){
						$('.src_r .rel_item').live('click', function(event){
							var suspect = $(this);
							var id = suspect.attr('id');
							$.ajax({
									type: "POST",
									dataType : "json",
									data : {'id_prod' : id},	
									url: "<?=site_url('backend/store/b_product/ajax_get_prodrel')?>",
									success: function(data){					     
										   	if(data.status != false){
											if($('.rel_items .msg').size() > 0){
												$('.rel_items .msg').remove();
												
											}
											
											suspect.hide('drop', {direction: 'right'});
											$('.rel_items').append(data.prod);
								
										   	}
									   }
								});
						});
					}
					function get_rel_array(){
						var array_rel = '';
				
						$('.rel_items .item').each(function(){
							var suspect = $(this),
							id = suspect.attr('id');
							array_rel += id+',';
						});
						return 	array_rel.substr(0,array_rel.length - 1);
				
					}
					// put the rel to the input field
					$('input[name="submit"]').click(function(){
						if(get_rel_array() != false){
						var rel_list = get_rel_array();
						}else{
						var rel_list = '';	
						}
						$('input[name="product_rel"]').val(rel_list);
					
					});
				
					$('.pre_del').click(function(){
						var suspect  = $(this).parent().parent().parent();
						suspect.hide('fade').remove();
					});
				
			
			});
			</script>
			<div id="product_assoc">
					<div class="box2 grid_270 left">
						<input type="text" name="product_rel" value="Type SKU or Name Product" id="product_rel" class="text-input grid_260">
						<div class="clear"></div>
						<div class="src_r mt10">
						
						</div>
					</div>
					<div class="rel_items left ml20 grid_300">
						
						<div class="msg">This product have no Association</div>
					</div>
					<input type="hidden" name="product_rel" value="">
					<div class="clear"></div>
			</div>
		
        </div>
	</div>
	</form>
</div>