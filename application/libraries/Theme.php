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

function render($data, $mode=false){
	if($mode != 'back' && $mode == null ){
	$rend = $this->_ci->load->view('front/index', $data);
	return $rend;
	}
	else{
	$rend = $this->_ci->load->view('back/index', $data);
	return $rend;	
	}
}
function ajax_loader($width=50, $class="loader"){
	$loader = '<img class="'.$class.'" src="'.base_url().'/assets/gen_img/loader.gif" alt="loader" width="'.$width.'">';
	return $loader;
}

}
