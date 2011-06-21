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
	function api_reorder($string_order_state){
		$sorts = explode(',', $string_order_state);
		foreach($sorts as $key => $value){
			$data = array('sort' => $key+1);
			modules::run('modularizer/api_update', $value, $data);
		}
	
		return true;
	}

	function api_delete(int $id){
		return $this->mdl->delete($id);
	}
	function api_create( array $data) {
		return $this->mdl->create($data);
	}

	function api_update(int $id, array $data){
		return $this->mdl->update($id, $data);
	}
	
	function api_getall(){
		return $this->mdl->getall();
	}
	function api_browse($param){
		return $this->mdl->browse($param);
	}
	function api_getallspot(){
		return $this->mdl->getallspot();
	}
	function api_getbyspot($spot){
		return $this->mdl->getbyspot($spot);
	}
	function api_getbyid(int $id){
		return $this->mdl->getbyid($id);
		
	}

}
?>