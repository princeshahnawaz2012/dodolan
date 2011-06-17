<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Collection extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mod = $this->load->model('store/collection_m');
	}
	
	//php 4 constructor
	function Collection() {
		parent::__construct();
	}
	/// FRONT FUNCTION //////
	function index(){
			
		$coll = $this->exe_browse();
		$data['pT'] = 'collections';
		$data['colls'] = $coll;
		$data['mainLayer'] = 'store/page/collection/index_v';
		$this->dodol_theme->render($data);
	}
	function detail(){
		$id = $this->uri->segment(4);
		$q = modules::run('store/collection/exe_getById', $id);
		$coll = $q['main'];
		$data['coll'] = $coll ;
		$data['pT'] = $coll->name;
		$data['items'] = $q['ref'];
		$data['mainLayer'] = 'store/page/collection/detail_v';
		$this->dodol_theme->render($data);
		
	}
	
	
	
	
	
	/////////// API /////////
	function exe_create($data) {
		if($data['img_file']){
			$config['file_name']  = $data['name'];
			$config['upload_path'] = './assets/collection_img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '10000';
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
			if(isset($data['img_file'])){
				$config['file_name']  = $data['name'];
				$config['upload_path'] = './assets/collection_img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '10000';
				$up = $this->load->library('upload', $config);
				if($up->do_upload($data['img_file'])){
					$updata = $up->data();
					$main['img_path'] = $updata['file_name'];
				}
			}
			$main['name'] = $data['name'];
			$main['description'] = $data['description'];
			$main['p_date'] = $data['p_date'];
			$store_data= $main;
			$q = $this->mod->update($id, $store_data);
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
	
	
	function exe_browse($param=false){
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