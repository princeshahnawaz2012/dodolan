<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Customer extends MX_Controller {

	var $mod; 
	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mod = $this->load->model('store/customer_m');
	}
	
	//php 4 constructor
	function Customer() {
		parent::__construct();
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
		
		$passdata['m_date'] =date('Y-m-d H:i:s');
		$q = $this->mod->updateById($id, $passdata);
		return $q;
	}
	function getAll(){
		$param = array();
		$param['start'] = 0;
		$param['limit'] = 10;
		$q = $this->mod->getAll($param);
	//	$data['mainLayer'] = ''
		
	}
	function browse(){
		$q = $this->mod->browse();
		$data['lists']  = $q;
		$data['mainLayer'] = 'store/page/customer/browse_v';
		$data['pT'] = 'Browse Customer';
		$this->dodol_theme->render($data);
		
	}
	

}