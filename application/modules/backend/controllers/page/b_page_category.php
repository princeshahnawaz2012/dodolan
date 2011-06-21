<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_page_category extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function index(){
		
	}
	function create(){
		$menuSource = array(
						array(
						'anchor' => 'Browse Category', 'link' => site_url('backend/page/b_page_category/browse')),
					);
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['pH'] = 'Create Page Category';
		$render['pT'] = 'Create Page Category';
		$render['mainLayer'] = 'page/page/category/create_v';
		$this->dodol_theme->render($render, 'back');
		
		if($this->input->post('create')):
			$insert_data = array(
				'name' => $this->input->post('name'),
				'parent_id' => $this->input->post('parent_id'),
			);
			if($ins = modules::run('page/page_category/exe_create', $insert_data)):
				$this->messages->add('Success Create Category With Name '.$ins->name, 'success');
				redirect('backend/page/b_page_category/browse');
			else:
				$this->messages->add('Something Wrong You Can Try again Later', 'success');
				redirect('backend/page/b_page_category/browse');
			endif;
		
		endif;
	}
	function update(){
		$id = $this->uri->segment(5);
		$menuSource = array(
						array(
						'anchor' => 'Browse Category', 'link' => site_url('backend/page/b_page_category/browse')),
					);
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['category'] = $cat = modules::run('page/page_category/get_byid', $id);
		$render['pH'] = 'Update Page Category '.$cat->name;
		$render['pT'] = 'Update Page Category '.$cat->name;
		$render['mainLayer'] = 'page/page/category/update_v';
		$this->dodol_theme->render($render, 'back');
		if($this->input->post('update')):
			$insert_data = array(
				'name' => $this->input->post('name'),
				'parent_id' => $this->input->post('parent_id'),
			);
			if($ins = modules::run('page/page_category/exe_update',$id, $insert_data)):
				$this->messages->add('Success Create Category With Name '.$ins->name, 'success');
				redirect('backend/page/b_page_category/browse');
			else:
				$this->messages->add('Something Wrong You Can Try again Later', 'warning');
				redirect('backend/page/b_page_category/browse');
			endif;
		
		endif;
	}
	function browse(){
		$this->load->library('barock_page');
		$limit = 20;
		$param = $this->uri->uri_to_assoc();
		if(!isset($param['p'])): $param['p'] = 0; endif;
		if(!isset($param['q'])): $param['q'] = false; endif;
		if($param['p']): $start = ($param['p'] - 1)* $limit; else :$start = 0; endif;

		$param['start'] = $start;
		$param['limit'] = $limit;
		
		$query = modules::run('page/page_category/exe_browse',$param );
		$q = $query['q'];
		$target_url = str_replace('/p/'.$param['p'] , '', current_url());
		$confpage = array(
				'target_page' => $target_url,
				'num_records' => $query['total'],
				'num_link'	  => 5,
				'per_page'   => $limit,
				'cur_page'   => $param['p']
				);
		$this->barock_page->initialize($confpage);
		$menuSource = array(
						array(
						'anchor' => 'Create Category', 'link' => site_url('backend/page/b_page_category/create')),
					);
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['cats'] = $q;
		$render['mainLayer'] = 'page/page/category/browse_v';
		
		$this->dodol_theme->render($render, 'back');
	}
	function delete(){
		if($del = modules::run('page/page_category/exe_delete',$this->uri->segment(5) )):
			$this->messages->add('Success Delete Category With Name '.$del->name, 'success');
			redirect('backend/page/b_page_category/browse');
		else:
			$this->messages->add('Something Wrong You Can Try again Later', 'warning');
			redirect('backend/page/b_page_category/browse');
		endif;
	}
}