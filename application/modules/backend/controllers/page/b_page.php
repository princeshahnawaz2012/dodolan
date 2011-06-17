<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_page extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function B_page() {
		parent::__construct();
	}
	
	function index() {
		
	}
	function create(){

		$render['mainLayer'] = 'backend/page/page/page/create_v';
		$this->dodol_theme->render($render, 'back');
		// EXECUTION
		if($this->input->post('submit')):
			$datapass = array(
				'title' 		=> $this->input->post('title'),
				'content' 		=> $this->input->post('content'),
				'category_id' 	=> $this->input->post('category_id'),
				);
			$q = modules::run('page/exe_create', $datapass);
			if($q){
				$this->messages->add('You success create Page with Name <strong>'.$this->input->post('title').'</strong>', 'success');
					redirect('backend/page/b_page/browse');
			}else{
				$this->messages->add('Something Wrong, Please tray again later', 'warning');
					redirect('backend/page/b_page/browse');
			}
		endif;
	}
	function update(){
		$id = $this->uri->segment(5);
		/// QUERY Execution
		if($this->input->post('submit')):
			$datapass = array(
				'title' 		=> $this->input->post('title'),
				'content' 		=> $this->input->post('content'),
				'category_id' 	=> $this->input->post('category_id'),
				);
			$q = modules::run('page/exe_update', $id, $datapass);
			if($q){
				$this->messages->add('You success update Page with Name <strong>'.$this->input->post('title').'</strong>', 'success');
				redirect('backend/page/b_page/browse');
			}else{
				$this->messages->add('Something Wrong, Please try again later', 'warning');
				redirect('backend/page/b_page/browse');
			}

		endif;
		
		
		/// QUERY Fecth
		$q = modules::run('page/exe_getbyid', $id);
		$render['page'] = $q;
		
		$render['pT'] = 'Update Page - '.$q->title;
		$render['pH'] = 'Update Page - '.$q->title;
		$render['mainLayer'] = 'backend/page/page/page/update_v';
		$this->dodol_theme->render($render, 'back');
		
	}
	function delete(){
		$id = $this->uri->segment(5);
		$q = modules::run('page/exe_delete', $id);
		if($q){
			$this->messages->add('Success Delete Page with id '.$id, 'success');
			redirect('backend/page/b_page/browse');
		}else{
			$this->messages->add('Something Wrong', 'warning');
			redirect('backend/page/b_page/browse');
		}
	}
	function view(){
		
	}
	function browse(){
		$menuSource = array(
				array(
					'anchor' => 'Create Page', 'link' => site_url('backend/page/b_page/create')),
				array('anchor' => 'Page Category', 'link' => site_url('backend/page/b_page_category/browse')),
			);
		$menu = $this->dodol_theme->menu_rend($menuSource);
		$render['pT'] = 'Brwose Page';
		$render['pH'] = 'Browse Page';
		$render['pageMenu'] = $menu;
		$render['mainLayer'] = 'backend/page/page/page/browse_v';
		/// QUERY
		$render['pages'] = modules::run('page/exe_browse');
		$this->dodol_theme->render($render, 'back');
		
	}

}