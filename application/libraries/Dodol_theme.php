<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Theme Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : Theme.php
**/

class Dodol_theme
{
var $_ci 		=  '';
var $css 		= array(
					// global css
					array('route' => 'global', 'file' => 'global_css/grid.css'),
					array('route' => 'global', 'file' => 'global_css/reset.css'),
					array('route' => 'global', 'file' => 'global_css/text.css'),
					array('route' => 'global', 'file' => 'global_css/ui-style.css'),
					array('route' => 'global', 'file' => 'global_js/jquery_ui/theme/Aristo/jquery-ui-1.8.7.custom.css'),
					
					//back css
					array('route' => 'back', 'file' => 'theme/back/css/admin-style.css'),
					array('route' => 'back', 'file' => 'theme/back/css/page_style.css'),
					// front css
					array('route' => 'front', 'file' => 'theme/front/css/front-style.css'),
					array('route' => 'front', 'file' => 'theme/front/css/page_style.css'),
					array('route' => 'front', 'file' => 'theme/front/css/cloud_zoom.css'),
					

);       
var $js			= array(
					// global js
					array('route' => 'global', 'file' => 'global_js/dodolan_js_lib.js'),
					array('route' => 'global', 'file' => 'global_js/jquery.min.js'),
					);


function Dodol_theme(){
	$this->_ci =& get_instance();
	$this->front_theme = 'front';
	$this->back_theme = 'back';
	
}
function render($data, $mode=false, $layer=false){
	parse_str($_SERVER['QUERY_STRING'], $_GET); 
	$this->_ci->input->_clean_input_data($_GET); 
	if(!$this->_ci->input->get('tpl')){
		$layer = 'index';
	}elseif($this->_ci->input->get('tpl')){
		$layer = $this->_ci->input->get('tpl');
	}

	if(!isset($data['loadSide'])){
		$data['loadSide'] = true;
	}
	if($mode != 'back' && $mode == null ){
	$rend = $this->view('front_end/'.$this->front_theme.'/'.$layer, $data);
	return $rend;
	}else{
	$rend =  $this->view('back_end/'.$this->back_theme.'/'.$layer, $data);
	}
}

function isAjax() {
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
		($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
	}
function partial($layer, $data = false, $mode=false, $return = FALSE){
	if($mode != 'back' && $mode == null ){
		$rend = $this->view('front_end/'.$this->front_theme.'/'.$layer, $data);
		return $rend;
	}else{
		$rend =  $this->view('back_end/'.$this->back_theme.'/'.$layer, $data);
		return $rend;	
	}
}
function ajax_loader($width=50, $class="loader"){
	$loader = '<img class="'.$class.'" src="'.base_url().'/assets/gen_img/loader.gif" alt="loader" width="'.$width.'">';
	return $loader;
}
function menu_rend($source, $type = 'menu_hor' ){
	$out = '<ul class="'.$type.'">';
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
						'toolbar' 	=> 	"Basic", 	//Using the Full toolbar
						'width' 	=> 	"100%",	//Setting a custom width
						'height' 	=> 	'200px',	//Setting a custom height

					),

						//Replacing styles from the "Styles tool"
						'styles' => array(
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
	public function register_css($array=array())
	{
	
		if(is_array($array)){
			foreach($array as $a){
				$data = array(
					'file' => $a,
					'route' => $this->_ci->router->class.'_'.$this->_ci->router->method
				);
				array_push($this->css, $data);
			}
		}else{
			array_push($this->css, $array);
		}
	}
	public function load_css($route = 'front')
	{
		foreach($this->css as $css){
			$current_route = $this->_ci->router->class.'_'.$this->_ci->router->method;
			$css_route = $css['route'];
			if($route != 'front'){
				if($css_route == 'back' || $css_route == 'global' || $css_route == $current_route ){
					echo ('<link rel="stylesheet" href="'.base_url().'/assets/'.$css['file'].'" type="text/css">');		
				}	
			}else{
				if($css_route == 'front' || $css_route == 'global' || $css_route == $current_route ){
					echo ('<link rel="stylesheet" href="'.base_url().'/assets/'.$css['file'].'" type="text/css">');		
				}
			}
		

		}
	}
	public function register_js($array=array())
	{
	
		if(is_array($array)){
			foreach($array as $a){
				$data = array(
					'file' => $a,
					'route' => $this->_ci->router->class.'_'.$this->_ci->router->method
				);
				array_push($this->css, $data);
			}
		}else{
			array_push($this->css, $array);
		}
	}
	public function load_js()
	{
		foreach($this->js as $js){
			$current_route = $this->_ci->router->class.'_'.$this->_ci->router->method;
			$css_route = $css['route'];
			if($current_route == $css_route){
				echo ('<script type="text/javascript" src="'.base_url().'/assets/'.$js['file'].'"></script>');		
			}
		

		}
	}
	public function show_date($date){
	
			$date= new DateTime($date);
	
	//		$date = date_create_from_format('Y-m-d H:i:s', $date);
			$str_date = $date->format('l, F j,  Y');
			return $str_date;
	}
	public function nice_strlink($string)
	{
		$new_string = strtolower(str_replace(' ', '-', $string));
		return $new_string;
	}
	function copy_this_link($string, $anchor = 'copy this' ){
		$object = '<span class="toClipBoard button" alt="'.$string.'">'.$anchor.'</span>';
		return $object;
	}

	function view($view, $vars = array(), $return = FALSE){
		$this->_ci->load->set_view_path('./themes/');
		return $this->_ci->load->_ci_load(array(
			'_ci_view' 		=> $view, 
			'_ci_vars' 		=> $this->_ci->load->_ci_object_to_array($vars), 
			'_ci_return' 	=> $return)
			);
	}


}