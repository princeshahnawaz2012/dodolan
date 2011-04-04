<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->load->model('user/user_m');
	}
	
	//php 4 constructor
	function User() {
		parent::Controller();
	
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
			'mainLayer'=>'user/page/frontend_login_v',
			'mod_login' => modules::run('user/user_widget/login_mod_front'),
			'pT' => 'Login'
			);
		$this->theme->render($data);
	}
	function register(){
		$q = $this->db->get('store_country');
		$data = array(
			'mainLayer' => 'user/page/register_v',
			'pT' => 'Register',
			'countries' => $q->result(),
			);
		$this->theme->render($data);
		if($this->input->post('register')){
			$this->exe_register();
		}
	}
	function exe_register(){
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'gender' => $this->input->post('gender'),
			'birthday' => $this->input->post('birthday'),
			'address' => $this->input->post('address'),
			'country_id' => $this->input->post('country_id'),
			'province' => $this->input->post('province'),
			'city' => $this->input->post('city'),
			'city_code' => $this->input->post('city_code'),
			'zip' =>$this->input->post('zip'),
			'mobile' => $this->input->post('mobile'),
			'c_date' => date('Y-m-d H:i:s'),
			
			);
		$ins = $this->user_m->register($data);
		if($ins){
			return $ins;
		}else{
			return false;
		}
	}
	function exe_edit(){
		
	}
	function getCity(){
		if($this->input->post('city')){
		$json = $this->user_m->getCity($this->input->post('city'), 4);
		echo $json;}
	}

}?>