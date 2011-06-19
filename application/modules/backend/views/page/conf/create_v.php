<div class="grid_500 ctr">
	<div class="form-Ui box2">
		<form action="" method="post" accept-charset="utf-8">
			<div class="inputSet">	
					<div class="label"><span>Configuration Name</span></div>
					<div class="input"><input name="name" type="text" value="" /></div>
					<div class="clear"></div>
			</div>
				<div class="inputSet">	
						<div class="label"><span>Description</span></div>
						<div class="input"><textarea name="description"></textarea></div>
						<div class="clear"></div>
				</div>
			<div class="horline"></div>
			
			<div class="item_conf mt10">
				<small>Start Type name item n Push + button</small>
				<div class="form_add">
				<br class="clear"/>
				<div class="left grid_370">
					<div class="grid_150 left mr10">
					<input  type="text" name="item_name" value="item name"  class="text-input">
					</div>
					<div class="grid_200 left">
					<input type="text" name="item_value" value="item value" class="text-input" >
					</div>
					<div class="clear"></div>
				</div>
				<div class="right mb10"><span class="button addto add-button-Ui">Add</span></div>
				<br class="clear"/>
				<div class="horline"></div>
				</div>
				
				<div class="itemList mt20">
					
				</div>
			
			</div>
			
			<br class="clear"/>
			<div class="ctr">
			<input type="submit" class="button" name="create"value="Continue &rarr;">
			</div>
			
			<br class="clear"/>
		</form>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		var store_object = [];
		$('.addto').live('click',function(){
			var  new_name = $('input[name="item_name"]').val();
			var  new_value = $('input[name="item_value"]').val();
			var field_name = 'obj_'+$.trim(new_name).replace(" ", "_");
			if(new_name == 'item name' && $.inArray(field_name, store_object) > -1 ){
				return false;	
			}else{
				$('input[name="item_name"]').val('item name');
				$('input[name="item_value"]').val('item value ');
				var  new_item_el = '<div class="item"><div class="inputSet left grid_400"><div class="label"><span>'+new_name+'</span></div><div class="input"><input class="object_name" name="'+field_name+'" type="text" value="'+new_value+'" /></div><div class="clear"></div></div><div class="right"><span class="button del_obj_item">Delete</span></div><div class="clear"></div></div>';
				$(new_item_el).hide().appendTo('.itemList').show('slide', {direction : "up"});
				store_object.push(field_name);
		}
			
		});
		$('.del_obj_item').live('click', function(){
			var parrent = $(this).parent().parent();
			var value = parrent.find('.object_name');
			parrent.hide('slide', {direction : "up"}, 500, function(){
				$(this).remove();
			});
			
		});
	});
</script>