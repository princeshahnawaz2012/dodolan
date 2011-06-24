<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Theme Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : Theme.php
**/

class Dodol_theme
{
var $_ci 			=  '';
var $core_js      	= array();
var $core_css 		= array();
var $front_js 		= array();
var $front_css 		= array();
var $back_js 		= array();
var $back_css 		= array();
function Dodol_theme(){
	$this->_ci =& get_instance();
	$this->front_theme = 'front';
	$this->back_theme = 'back';
	$this->theme_path = './themes';
	/*
	$this->core_css = array(
		array('global_css/reset.css'),
		array('global_css/ui-style.css'),
		array('global_css/text.css'),
		array('global_css/grid.css'),
		array('global_css/font_face.css'),
		*/
	$this->core_js = array(
		array('global_js/jquery.min.js'),
		array('global_js/jquery_ui/jquery-ui.min.js'),
		array('global_js/jquery_ui/jquery-ui-timepicker-addon.js'),
		array('global_js/dodolan_js_lib.js'),
		array('global_js/jgrowl/jquery.jgrowl.js'),
	);
	
	$this->call_assets('./assets/global_css/', 'css', './assets/', 'core_css');
	$this->call_assets('./assets/theme/front/js/', 'js', './assets/', 'front_js');
	$this->call_assets('./assets/theme/front/css/', 'css', './assets/', 'front_css');
	
	$this->_ci->carabiner->group('core_assets', array('js'=>$this->core_js , 'css' => $this->core_css) );
	$this->_ci->carabiner->group('front_assets', array('js'=>$this->front_js , 'css' => $this->front_css) );
	
	

}

function render($data, $mode=false, $layer=false){
	parse_str($_SERVER['QUERY_STRING'], $_GET); 
	$this->_ci->input->_clean_input_data($_GET); 
	$tpl = $this->_ci->input->get('tpl');
	$tpl_file = ($mode != 'back' && $mode == null) ? $this->theme_path.'/front_end/'.$this->front_theme.'/tpl/'.$tpl : $this->theme_path.'/backend_end/'.$this->back_theme.'/tpl/'.$tpl;
	
	if(!$tpl){
		$layer = 'index';
	}elseif($tpl){
		$layer = 'tpl/'.$this->_ci->input->get('tpl');
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
function call_assets($dir, $extension, $root, $push ) {
	if(is_dir($dir)) {
		if($dh = opendir($dir)){
			while($file = readdir($dh)){
				if($file != '.' && $file != '..'){
					if(is_dir($dir . $file)){
					//	echo $dir . $file.'<br/>';
						// since it is a <strong class="highlight">directory</strong> we recurse i
						$this->call_assets($dir . $file . '/', $extension, $root, $push);
					}else{
						if(strpos($file, '.'.$extension) !== false){
							array_push($this->$push, array(str_replace($root, '', $dir . $file)));
						}	
						

			 		}
				}
	 		}
		}
 		closedir($dh);         
     	}
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
						'toolbar' => 'Basic',
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