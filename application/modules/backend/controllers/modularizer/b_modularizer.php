<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_modularizer extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function index() {
		
	}
	function create(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->input->_clean_input_data($_GET);
		$st = $this->input->get('st');
		$wm = $this->input->get('wm');
		
		$render['widget'] = $this->dodol_widget->get_detail($st, $wm);
		$menuSource = array(array('anchor' => 'All Widget', 'link' => site_url('backend/modularizer/b_modularizer/browse')));
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['mainLayer'] = 'backend/page/modularizer/create_v';
		$render['pT'] = 'Create Widget';
		$render['pH'] = 'Create Widget';
		$this->dodol_theme->render($render, 'back');
		// EXEC
		if($this->input->post('create')):
		$data = array(
			'state' => $st, 'widget_name' => $wm
		);
			$wi_param  = array();
			foreach($_POST as $name=>$val):
				if(strpos($name, 'wi_par_') !== FALSE):
					$wi_param[str_replace('wi_par_','',$name)] = $val;
				endif;
			endforeach;
			$mod_param  = array();
			foreach($_POST as $name=>$val):
				if(strpos($name, 'mod_par_') !== FALSE):
					$mod_param[str_replace('mod_par_','',$name)] = $val;
				endif;
			endforeach;
			
			$data['publish'] = ($this->input->post('publish') != 'y' ) ? 'n' : 'y';
			$data['name'] = $this->input->post('name');
			$data['spot'] = $this->input->post('spot');
			$data['parameter'] = json_encode($wi_param);
			$data['mod_param'] = json_encode($mod_param);
			if($ins = modules::run('modularizer/api_create', $data)):
				$this->messages->add('Success Create Widget with name '.$ins->name, 'success');
				redirect('backend/modularizer/b_modularizer/browse');
			else:
			
			endif;
			
			
		endif;
		
		
		
		
	}
	function delete(){
		$id = $this->uri->segment(5);
		if($ins = modules::run('modularizer/api_delete', $id))
		{
			$this->messages->add('Success Delete Widget with name '.$ins->name, 'success');
			redirect('backend/modularizer/b_modularizer/browse');
		}else{
			$this->messages->add('Something Wrong', 'warning');
			redirect('backend/modularizer/b_modularizer/browse');
		}
	}
	function update(){
		$id = $this->uri->segment('5');
		$render['widget'] = modules::run('modularizer/api_getbyid', $id);
		$menuSource = array(array('anchor' => 'All Widget', 'link' => site_url('backend/modularizer/b_modularizer/browse')),array('anchor' => 'New Widget', 'link' => site_url('backend/modularizer/b_modularizer/create')));
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['mainLayer'] = 'backend/page/modularizer/Update_v';
		$render['pT'] = 'Update Widget';
		$render['pH'] = 'Update Widget';
		$this->dodol_theme->render($render, 'back');
	}
	function browse(){
		$this->load->library('barock_page');
		$limit = 20;
		$param = $this->uri->uri_to_assoc();
		if(!isset($param['page'])){ $param['page'] = 1;}
		$param['start'] = ($param['page']) ? ($param['page'] - 1) * $limit : 0;
		$param['limit'] = $limit;
		$query = false;
		$render['mods'] = ($query = modules::run('modularizer/api_browse', $param)) ? $query['q'] : false;
		$total_row = ($render['mods']!=false)? $query['q_total_rows'] : 0;
		if($total_row > 0){
			$target_url = str_replace('/page/'.$param['page'] , '', current_url());
			$confpage = array(
				'target_page' 	=> $target_url,
				'num_records' 	=> $total_row,
				'num_link'	  	=> 5,
				'per_page'   	=> $param['limit'],
				'cur_page'   	=> $param['page']
				);
			$this->barock_page->initialize($confpage);
		}
		
	
		$render['mainLayer'] = 'backend/page/modularizer/browse_v';
		$render['pT'] = 'List Widget';
		$render['pH'] = 'List Widget';
		$render['pageTool'] = modules::run('backend/modularizer/b_modularizer/filter');
		$render['installed'] = $this->dodol_widget->list_all();
		$this->dodol_theme->render($render, 'back');
		
	}
	function filter(){
		if($this->input->post('filter')):
			if($filter = ddl_post_filter('filt_')):
				if(element('state', $filter) == 'state'): unset($filter['state']);endif;
				if(element('spot', $filter) == 'spot'): unset($filter['spot']);endif;
				if(element('publish', $filter) == 'publish'): unset($filter['publish']);endif;
				redirect(site_url('backend/modularizer/b_modularizer/browse/'.$this->uri->assoc_to_uri($filter)));
			else:
redirect(site_url('backend/modularizer/b_modularizer/browse/'));
			endif;
			
		endif;
		$this->load->view('backend/page/modularizer/misc/filter_v');
		
	}
	
	function reorder(){
		if($state = $this->input->post('sort_state')):
		modules::run('modularizer/api_reorder', $state);
		endif;
	}
}?>