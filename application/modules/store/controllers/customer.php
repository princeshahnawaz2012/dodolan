<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Customer extends Controller {

	var $mod; 
	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->mod = $this->load->model('store/customer_m');
	}
	
	//php 4 constructor
	function Customer() {
		parent::Controller();
	}
	
	function index() {
		
	}
	function getByUser($id, $select=false){
		$q = $this->mod->getByUser($id, $select);
		return $q;
	}
	function getById($id, $select=false){
		$q = $this->mod->getById($id, $select);
		return $q;
	}
	function exe_create($passdata){
		$data = $passdata;
	
		$data['c_date'] = date('Y-m-d H:i:s');
		if(isset($passdata['user_id'])){
			$data['user_id'] = $passdata['user_id'];
		}
		$q = $this->mod->create($data);
		return $q;
	}

	function exe_updateById($id, $passdata){
		$data = array(
			'first_name' => $passdata['first_name'],
			'last_name'  => $passdata['last_name'],
			'email'      => $passdata['email'],
			'address'    => $passdata['address'],
			'country_id' => $passdata['country_id'],
			'province'   => $passdata['province'],
			'city'       => $passdata['city'],
			'city_code'  => $passdata['city_code'],
			'zip'        =>	$passdata['zip'],
			'mobile'     => $passdata['mobile'],
			'm_date'     => date('Y-m-d H:i:s'),	
		);
		$q = $this->mod->updateById($id, $data);
		return $q;
	}
	function getAll(){
		$param = array();
		$param['start'] = 0;
		$param['limit'] = 10;
		$q = $this->mod->getAll($param);
	//	$data['mainLayer'] = ''
		
	}
	

}