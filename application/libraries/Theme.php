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
	$this->_ci->firephp->setEnabled(true);
    $this->_ci->firephp->info(get_defined_vars());
    $this->_ci->firephp->info($this->_ci->session->userdata);
	$rend = $this->_ci->load->view('front/'.$layer, $data);
	return $rend;
	}
	else{
	$this->_ci->firephp->setEnabled(true);
	$this->_ci->firephp->info(get_defined_vars());
	$rend = $this->_ci->load->view('back/'.$layer, $data);
	return $rend;	
	}
}
function ajax_loader($width=50, $class="loader"){
	$loader = '<img class="'.$class.'" src="'.base_url().'/assets/gen_img/loader.gif" alt="loader" width="'.$width.'">';
	return $loader;
}
function menu_rend($source){
	$out = "<ul>";
	foreach($source as $s){
		$out .= '<li><a href="'.$s['link'].'">'.$s['anchor'].'</a></li>';
	}
	$out .= '<div class="clear"></div></ul>';
	return $out;
	
	
}

}
