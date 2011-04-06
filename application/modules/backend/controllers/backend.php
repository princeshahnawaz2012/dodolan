<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Backend extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		modules::run('user/auth/userRoleCheck', 'owner');
	}
	
	//php 4 constructor
	function Backend() {
		parent::Controller();
	}
	function index() {
		$u = modules::run('user/profiledata', $this->session->userdata['login_data']['user_id']);
		$data['pt'] = 'Dodolan';
		$data['mainLayer'] = 'backend/sample_view_admin';
		$data['u_name'] = $u->first_name.' '.$u->last_name;
		$this->theme->render($data, 'back');
	}
	function store_back(){
		$data = array(
		'directLayer' => 'this is index of Store banck end',
		'pt' => 'Store'
			);
		$this->theme->render($data, 'back');
	}
	

}?>