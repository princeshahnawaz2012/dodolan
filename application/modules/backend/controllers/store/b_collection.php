<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_collection extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function B_collection() {
		parent::Controller();
	}
	
	function index() {
		
	}
	function create(){
		$passdata = array();
		//$q = modules::run('store/collection/exe_create', $passdata);
		$data['mainLayer'] = 'backend/page/store/collection/create_v';
		$data['pH']   		= 'Create New Collection';
		$this->theme->render($data, 'back');
		if($this->input->post('submit')){
			$passdata['name'] = $this->input->post('title');
			$passdata['description'] = $this->input->post('description');
			$passdata['img_file'] = 'img_file';
			$passdata['p_date'] =date('Y-m-d H:i:s');
			$q = modules::run('store/collection/exe_create', $passdata);
		}
	}
	function detail(){
		$id = $this->uri->segment(5);
		$q = modules::run('store/collection/exe_getById', $id);
		$data['mainLayer'] = 'backend/page/store/collection/detail_v';
		$this->theme->render($data, 'back');
	}
	function browse(){
		$data['pH'] = 'Collection';
		$data['mainLayer'] = 'backend/page/store/collection/browse_v';
		$this->theme->render($data, 'back');
	}
	function delete(){
		$id = $this->uri->segment(5);
	}
	function edit(){
		$id = $this->uri->segment(5);
		$q = modules::run('store/collection/exe_update', $id);
		$data['mainLayer'] = 'backend/page/store/collection/detail_v';
		$this->theme->render($data, 'back');
		
	}

}