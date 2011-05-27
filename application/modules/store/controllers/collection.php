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
		if($data['img_file']){
			$config['file_name']  = $data['name'];
			$config['upload_path'] = './assets/collection_img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$up = $this->load->library('upload', $config);
			if($up->do_upload($data['img_file'])){
				$updata = $up->data();
				$main['img_path'] = $updata['file_name'];
			}
		}
		$main['name'] = $data['name'];
		$main['description'] = $data['description'];
		$main['p_date'] = $data['p_date'];
		$store_data['main'] = $main;
		$q = $this->mod->create($store_data);
		if($q){
			$return['id'] = $q;
			if(isset($main['img_path'])){
				$return['img_status'] = true;
			}else{
				$return['img_status'] = false;
			}
		}else{
			$return = false;
		}
		return $return;
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