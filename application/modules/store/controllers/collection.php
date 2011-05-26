<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Collection extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->mod = $this->load->model('store/collection_m');
	}
	
	//php 4 constructor
	function Collection() {
		parent::Controller();
	}
	
	
	/////////// API /////////
	function exe_create($data) {
		return $this->mod->create($data);
	}
	function exe_update($id, $data){
		return $this->mode->update($id, $data);
	}
	function exe_browse($param){
		return $this->mod->browse($param);
	}
	function exe_getById($id){
		return $this->mod->getById($id);
	}
	function exe_delete($id){
		return $this->mod->delete($id);
	}
	function exe_additem($coll_id, $prod_id){
		return $this->mod->additem($coll_id, $prod_id);
	}
	function exe_deleteitem($id){
		return $this->mod->deleteitem($id);
	}
}