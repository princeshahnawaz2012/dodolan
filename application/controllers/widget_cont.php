<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Widget_cont extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function go() {
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->input->_clean_input_data($_GET);
		$exe = $this->input->get('w');
 		echo widget_helper::run($exe);
	}
}?>