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
function load_text_editor($id){
	$this->_ci->load->helper('url');
	$this->_ci->load->helper('ckeditor');
	//Ckeditor's configuration
	$config = array(
	//ID of the textarea that will be replaced
				'id' 	=> 	$id,
				'path'	=>	'assets/global_js/ckeditor',

				//Optionnal values
				'config' => array(
					'toolbar' 	=> 	"Full", 	//Using the Full toolbar
					'width' 	=> 	"100%",	//Setting a custom width
					'height' 	=> 	'200px',	//Setting a custom height

				),

				//Replacing styles from the "Styles tool"
				'styles' => array(

					//Creating a new style named "style 1"
					'style 1' => array (
						'name' 		=> 	'Blue Title',
						'element' 	=> 	'h2',
						'styles' => array(
							'color' 	=> 	'Blue',
							'font-weight' 	=> 	'bold'
						)
					),

					//Creating a new style named "style 2"
					'style 2' => array (
						'name' 	=> 	'Red Title',
						'element' 	=> 	'h2',
						'styles' => array(
							'color' 		=> 	'Red',
							'font-weight' 		=> 	'bold',
							'text-decoration'	=> 	'underline'
						)
					)				
				)
			);
		
		echo display_ckeditor($config);

		}


}
