<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Page_category extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('page/page_category_m');
	}
	
	
	
	
	
	
	// API //
	function get_all(){
		return 	$this->mdl->getAll();
	}
	function get_byid($id){
		return 	$this->mdl->getbyid($id);
	}
	function get_bypar($idpar){
		return $this->mdl->getbypar($idpar);
	}
	function exe_create($data){
		return 	$this->mdl->create($data);
	}
	function exe_update($id, $data){
		return 	$this->mdl->update($id, $data);
	}
	function exe_delete($id){
		return 	$this->mdl->delete($id);
	}
	function exe_browse($param){
		return $this->mdl->browse($param);
	}
	
}