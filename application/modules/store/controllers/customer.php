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
	function getByEmail($email){
		$q = $this->mod->getByEmail($email);
		return $q;
	}
	function getAll(){
		$param = array();
		$param['start'] = 0;
		$param['limit'] = 10;
		$q = $this->mod->getAll($param);
	//	$data['mainLayer'] = ''
		
		
	}
	function getByID($id){
		
	}
	function edit($id){
		
	}
	function delete($id){
		
	}

}