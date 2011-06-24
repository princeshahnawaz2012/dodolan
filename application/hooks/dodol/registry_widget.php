<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registry_widget{
	var $CI ;
	function Registry_widget(){
		$this->CI =& get_instance();
	}
	function refresh(){
		if($this->CI->session->userdata('loaded_widget')):
			$this->CI->session->unset_userdata('loaded_widget');
			$data = array('loaded_widget' => array()); $this->CI->session->set_userdata($data);
		else:
			$data = array('loaded_widget' => array()); $this->CI->session->set_userdata($data);
		endif;
	}
	function register(){
		// TODO :: create function to load all used widget asset 
		
	}
	
	

}

?>