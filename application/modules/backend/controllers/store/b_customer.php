<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class b_customer extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->mod = $this->load->model('store/customer_m');
	}
	
	//php 4 constructor
	function b_customer() {
		parent::Controller();
	}
	
	function index() {
		redirect('backend/store/b_customer/getAll');
	}
	function browse(){
		redirect('backend/store/b_customer/getAll');
	}
	function getAll(){
		$param = array();
		$param['start'] = 0;
		$param['limit'] = 10;
		$q = $this->mod->getAll($param);
		$data['mainlayer'] = 'backend/page/store/customer/getAll_v';
		$this->theme->render($data, 'back');
	}
	function getByID($id){
		
	}
	function edit($id){
		
	}
	function delete($id){
		
	}

}