<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bug {
	
	var $msg = array();
	
	function bug (){
		$this->_ci =& get_instance();
	}
	function send($msg=false){
		if($msg!=false){
			$this->msg[] = $msg;
		}else{
			return false;
		}
	}
	function show(){
		if(count($this->msg) > 0){
			$i= 1;
			foreach($this->msg as $msg){
				echo '<div class=""><h4 class="left mr20">'.$i.'</h4>'.$msg.'</div><br class="clear"><div class="horline"></div>';
				$i++;
			}
		}else{
			return false;
		}
		
	}
	
}