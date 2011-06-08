<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Page extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->mod = $this->load->model('page/page_m');
		$this->mod_cat = $this->load->model('page/category_m');
	}
	
	//php 4 constructor
	function Page() {
		parent::Controller();
	}
	
	function index() {
		$page = modules::run('page/exe_getbyid', 1);
		echo $page->c_date;
		
		
	}
	
	
	// API ///

	// API MISC

	//F/ get list category function bundle
	function get_category_byparid($id){
		$this->db->where('parent_id', $id);
		$q = $this->db->get('page_category');
		if($q){
			return $q;
		}else{
			return false;
		}
	}
	function get_allcategory(){
		return $this->mod_cat->getAll();
	}
	// API EXE
	function exe_create($passdata){
		return $this->mod->create($passdata);
	}
	function exe_update($id, $passdata){
		return $this->mod->update($id, $passdata);
	}
	function exe_delete($id){
		return $this->mod->delete($id);
	}
	function exe_getbyid($id){
		return $this->mod->getbyid($id);
	}
	function exe_browse($param){
		return $this->mod->browse($param);
	}

}