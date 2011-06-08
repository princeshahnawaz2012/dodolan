<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_page extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function B_page() {
		parent::Controller();
	}
	
	function index() {
		
	}
	function create(){

		$render['mainLayer'] = 'backend/page/page/create_v';
		$this->theme->render($render, 'back');
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
				redirect('backend/page/browse');
			}else{
				$this->messages->add('Something Wrong, Please tray again latre', 'warning');
				redirect('backend/page/browse');
			}
		endif;
	}
	function update(){
		
	}
	function delete(){
		
	}
	function view(){
		
	}
	function browse(){
		
	}

}