<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_conf extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		
	}
	function index() {
		
	
	}
	function create(){
		$menuSource = array(array('anchor' => 'All Configuration', 'link' => site_url('backend/conf/b_conf/browse')));
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['mainLayer'] = 'backend/page/conf/create_v';
		$render['pT'] = 'Create Configuration';
		$render['pH'] = 'Create Configuration';
		$this->dodol_theme->render($render, 'back');
		if($this->input->post('create')){
			$final_object = array();
			$data['name'] = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			foreach($_POST as $obj_name => $obj_val ){
				if(strpos($obj_name, 'obj_') !== false){
					$obj_name = str_replace('obj_', '',$obj_name);
					$final_object[$obj_name] = $obj_val;
				}
			}
			$data['config_object'] = json_encode($final_object);
			if($ins = modules::run('conf/exe_create', $data)){
				$this->messages->add('Success Create Configuration with name '.$ins->name, 'success');
				redirect('backend/conf/b_conf/browse');
			}else{
				$this->messages->add('Something Wrong', 'warning');
				redirect('backend/conf/b_conf/browse');
			}
		}
		
	}
	function update(){
		$menuSource = array(array('anchor' => 'All Configuration', 'link' => site_url('backend/conf/b_conf/browse')), array('anchor' => 'New Configuration', 'link' => site_url('backend/conf/b_conf/create')));
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['mainLayer'] = 'backend/page/conf/update_v';
		$id = $this->uri->segment(5);
		$conf = modules::run('conf/getbyid', $id);
		$render['pT'] = 'Update Configuration -'.$conf->name;
		$render['pH'] = 'Update Configuration -'.$conf->name;
		$render['conf'] = $conf;
		$this->dodol_theme->render($render, 'back');
		if($this->input->post('update')){
			$final_object = array();
			$data['name'] = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			foreach($_POST as $obj_name => $obj_val ){
				if(strpos($obj_name, 'obj_') !== false){
					$obj_name = str_replace('obj_', '',$obj_name);
					$final_object[$obj_name] = $obj_val;
				}
			}
			$data['config_object'] = json_encode($final_object);
			if($ins = modules::run('conf/exe_update', $id, $data)){
				$this->messages->add('Success Update Configuration with name '.$ins->name, 'success');
				redirect('backend/conf/b_conf/browse');
			}else{
				$this->messages->add('Something Wrong', 'warning');
				redirect('backend/conf/b_conf/browse');
			}
		}
	}
	function Browse(){
		$menuSource = array(array('anchor' => 'New Configuration', 'link' => site_url('backend/conf/b_conf/create')));
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['mainLayer'] = 'backend/page/conf/browse_v';
		$render['pT'] = 'List Configuration';
		$render['confs'] = modules::run('conf/getall');
		$render['pH'] = 'List Configuration';
		$this->dodol_theme->render($render, 'back');
	}
	function delete(){
		$id = $this->uri->segment(5);
		if($ins = modules::run('conf/exe_delete', $id))
		{
			$this->messages->add('Success Delete Configuration with name '.$ins->name, 'success');
			redirect('backend/conf/b_conf/browse');
		}else{
			$this->messages->add('Something Wrong', 'warning');
			redirect('backend/conf/b_conf/browse');
		}
	}
	
}?>