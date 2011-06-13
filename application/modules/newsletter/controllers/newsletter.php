<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Newsletter extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('newsletter/newsletter_m');
	}
	
	//php 4 constructor
	function Newsletter() {
		parent::__construct();
	}
	
	function addMember() {
		if($this->input->post('email') != null || $this->input->post('name') != null || $this->input->post('name') != 'name' || $this->input->post('email') != 'email' ){
			$q = $this->newsletter_m->add_member($this->input->post('email'), $this->input->post('name'));
			if(!isset($q['have_account'])){
				$data['status'] = 'success';
				$data['msg']    = 'Thanks for your subscription, we will contact soon when we ready to launch';
				echo json_encode($data);
			}elseif(isset($q['have_account'])){
				$data['status'] = 'failed';
				$data['msg']    = 'your email already list on our database';
				echo json_encode($data);
			}else{
				$data['status'] = 'failed';
				$data['msg']    = 'something wrong, please try again letter';
				echo json_encode($data);
			}
		}elseif($this->input->post('email') == null || $this->input->post('name') == null || $this->input->post('name') == 'name' || $this->input->post('email') == 'email' ){
			$data['status'] = 'failed';
			$data['msg']    = 'please fill the form correctly';
			echo json_encode($data);
		}
		
		
	}

}?>