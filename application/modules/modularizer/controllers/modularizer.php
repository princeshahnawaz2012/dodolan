<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Modularizer extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('modularizer/modularizer_m');
	}
	function index() {
	}
	function load($data){
		$data['widgets'] = $this->api_browse($data);
		$this->load->view('widget_temp', $data);	
	}
	
	
	// API //
	function api_reoreder($string_order_state){
		$sorts = explode(',', $string_order_state);
		foreach($sorts as $key => $value){
			$data = array('sort' => $key+1);
			modules::run('modularizer/api_update', $key, $data);
		}
		return true;
	}
	function api_create($data) {
		return $this->mdl->create($data);
	}
	function api_update($id, $data){
		return $this->mdl->update($id, $data);
	}
	function api_delete($id){
		return $this->mdl->delete($id);
	}
	function api_getall(){
		return $this->mdl->getall();
	}
	function api_browse($param){
		return $this->mdl->browse($param);
	}
	function api_getbyspot($spot){
		return $this->mdl->getbyspot($spot);
	}
	function api_getbyid($id){
		return $this->mdl->getbyid($id);
	}

}
?>