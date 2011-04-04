<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Theme Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : asset.php
**/
class Asset
{
	var $_ci 		=  '';

	function asset(){
		$this->_ci =& get_instance();
	}
	function theme($type, $mode, $file){
		if($mode == 'back'){
			$path = base_url().'assets/theme/'.$mode.'/'.$type.'/'.$file;
			return $path;
		}
		elseif($mode == 'front'){
			$path = base_url().'assets/theme/'.$mode.'/'.$type.'/'.$file;
			return $path;
		}
	}



}
