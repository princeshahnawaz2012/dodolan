<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Nav extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('nav/nav_m');
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
	function render_nav($id){
		if($items = modules::run('nav/nav_item/getbynav', $id)){
			$source = array();
			foreach($items as $item){
				$menu_item = array(
					'anchor' => $item->name,
					'link' => site_url($item->anchor),
				);
				array_push($source, $menu_item);
			}
			echo $this->dodol_theme->menu_rend($source);
		}
	}
}?>