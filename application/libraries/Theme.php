<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Theme Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : Theme.php
**/
class Theme
{
var $_ci 		=  '';
function theme(){
	$this->_ci =& get_instance();
}

function render($data, $mode=false, $layer=false){
	if($layer == false){
		$layer = 'index';
	}else{
		$layer = $layer;
	}
	
	if($mode != 'back' && $mode == null ){
	$rend = $this->_ci->parser->parse('front/'.$layer, $data);
	return $rend;
	}
	else{
	$rend = $this->_ci->parser->parse('back/'.$layer, $data);
	return $rend;	
	}
}
function ajax_loader($width=50, $class="loader"){
	$loader = '<img class="'.$class.'" src="'.base_url().'/assets/gen_img/loader.gif" alt="loader" width="'.$width.'">';
	return $loader;
}

}
