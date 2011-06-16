<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Nav_item extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('nav/nav_item_m');
	}
	function index() {
		
	}
	// API 
	function exe_create($data){
		return $this->mdl->create($data);
	}
	function exe_update($id, $data){
		return $this->mdl->update($id, $data);
	}
	function exe_delete($id){
		return $this->mdl->delete($id);
	}
	function getall(){
		return $this->mdl->getall();
	}
	function getbyid($id){
		return $this->mdl->getbyid($id);
	}
	function getbypar($id_parent){
		return $this->mdl->getbypar($id_parent);
	}
	function getbynav($nav_id){
		return $this->mdl->getbynav($nav_id);
	}
}?>