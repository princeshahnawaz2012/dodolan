<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Thumb extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Thumb() {
		parent::__construct();
	}
	
	function show() {
		$url = $this->uri->uri_string();
		$parameter = $this->uri->segment(3);
		$param = explode('-', $parameter);
		$w = $param[0];
		$h = $param[1];
		$c = $param[2];
		$source = strstr($url, '/dir/');
		$s = str_replace('/dir/', '',$source);
		$thumb = $this->load->library('PhpThumbFactory');
		$pre_source = explode('/', $s);
		$file_name = $pre_source[count($pre_source)-1];
		$dir_img_origin = './'.str_replace($file_name, '', $s );
		$dir_img_cache = $dir_img_origin.'thumb/'.$parameter.'/';
		$path_img_origin = './'.$s;
		$path_img_cache  = $dir_img_origin.'thumb/'.$parameter.'/'.$file_name;
		if (is_file($path_img_cache) && (filemtime($path_img_origin) > filemtime($path_img_cache))) {
        // if src file is newer than the cache file, delete cache
            unlink($path_img_cache);
            clearstatcache();
	        $image = $thumb->create($path_img_origin);
			if($c == 'crop'){
				$image->adaptiveResize($w, $h);
			}elseif($c == 'no'){
				$image->resize($w, $h);
			}
			if(is_dir($dir_img_cache)){
				$image->save($path_img_cache);
			}else{
				mkdir($dir_img_cache);
				$image->save($path_img_cache);
			}  
        	$image->show();
			
		}elseif(!is_file($path_img_cache)){
			$image = $thumb->create($path_img_origin);
			if($c == 'crop'){
				$image->adaptiveResize($w, $h);
			}elseif($c == 'no'){
				$image->resize($w, $h);
			}
			if(is_dir($dir_img_cache)){
				$image->save($path_img_cache);
			}else{
				mkdir($dir_img_cache);
				$image->save($path_img_cache);
			}  
			$image->show();
		}else{
        	$image = $thumb->create($path_img_cache);
        	$image->show();
        }

		
	}

}