<?
if($menus):
	$source = array();
	foreach($menus as $item){
		$menu_item = array(
			'anchor' => $item->name,
			'link' => site_url($item->anchor),
		);
		array_push($source, $menu_item);
	}
	$out = '<ul class="'.$param['type'].'">';
	foreach($source as $s){
		$out .= '<li><a href="'.$s['link'].'">'.$s['anchor'].'</a></li>';
	}
	$out .= '<div class="clear"></div></ul>';
	echo $out;
	
endif;
?>