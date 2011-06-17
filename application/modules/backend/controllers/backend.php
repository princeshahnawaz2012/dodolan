<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Backend extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		modules::run('user/auth/userRoleCheck', 'owner');
	}
	
	
	function index() {
		$url = $this->uri->segment(4);
		$u = modules::run('user/profiledata', $this->session->userdata['login_data']['user_id']);
		$data['pT'] = 'Backend';
		$data['mainLayer'] = 'backend/sample_view_admin';
		$data['u_name'] = $u->first_name.' '.$u->last_name;
		$this->dodol_theme->render($data, 'back');
	}
	function store_back(){
		$data = array(
		'directLayer' => 'this is index of Store banck end',
		'pt' => 'Store'
			);
		$this->dodol_theme->render($data, 'back');
	}
	
	

}?>