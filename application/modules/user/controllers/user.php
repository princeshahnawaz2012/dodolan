<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('user/user_m');
	}
	
	//php 4 constructor
	function User() {
		parent::__construct();
	
	}
	
	function index() {
		
	}
	function profiledata($id=false){
		$this->db->where('id', $id);
		$q = $this->db->get('user');
		return $q->row();
		
	}
	function userdata($id , $select=false){
		$q = $this->user_m->get_userdata($id, $select);
		if($q){
			return $q['user'];
		}else{
			return false;;
		}
	}
	function frontend_login(){
		$data = array(
			'mainLayer'=>'user/page/frontend/frontend_login_v',
			'mod_login' => modules::run('user/user_widget/login_mod_front'),
			'pT' => 'Login'
			);
		$this->dodol_theme->render($data);
	}
	function register(){
		$q = $this->db->get('store_country');
		$data = array(
			'mainLayer' => 'user/page/frontend/register_v',
			'pT' => 'Register',
			'countries' => $q->result(),
			);
		$this->dodol_theme->render($data);
		if($this->input->post('register')){
			$this->exe_register();
		}
	}
	function exe_register($passdata){
	
		// encrypt, password inputed
		$password = md5($passdata['password']);
		// unset password from passdata.
		unset($passdata['password']);
		// serialize $passdata to $data;
		$data = $passdata;
		// set password to $data, with encrypted one;
		$data['password']  	= $password;
		// assign current datetime
		$data['c_date'] 	= date('Y-m-d H:i:s');
		// passing the $data to model
		$ins = $this->user_m->register($data);
		return $ins;

	}
	function exe_edit($passdata, $id){
		$passdata['m_date'] = date('Y-m-d H:i:s');
		$q = $this->user_m->update($passdata, $id);
		return $q;
	}
	function getCity(){
		if($this->input->post('city')){
		$json = $this->user_m->getCity($this->input->post('city'), 4);
		echo $json;}
	}

}?>