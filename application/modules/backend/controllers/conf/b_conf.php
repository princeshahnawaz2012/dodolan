<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_conf extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function index() {
		
	
	}
	function create(){
		$render['mainLayer'] = 'backend/page/conf/create_v';
		$render['pT'] = 'Create Configuration';
		$render['pH'] = 'Create Configuration';
		$this->dodol_theme->render($render, 'back');
	}
	function update(){
		$render['mainLayer'] = 'backend/page/conf/create_v';
		$render['pT'] = 'Update Configuration';
		$render['pH'] = 'Update Configuration';
		$this->dodol_theme->render($render, 'back');
	}
	function Browse(){
		$render['mainLayer'] = 'backend/page/conf/create_v';
		$render['pT'] = 'List Configuration';
		$render['pH'] = 'List Configuration';
		$this->dodol_theme->render($render, 'back');
	}
	
}?>