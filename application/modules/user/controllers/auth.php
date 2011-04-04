<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Auth extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->load->model('user/auth_m');
	}
	
	
	
	// misc function
	function backend_login(){
		$data['pt'] = 'Back end Login';
		$data['mainLayer'] = 'user/page/backend_login_v';
		$this->theme->render($data,'back');
		
		if($this->input->post('login')){
			$q = $this->auth_m->checkCombination($this->input->post('email'), $this->input->post('password'));
			if($q){
				$this->messages->add('anda berhasil login', 'success');
				redirect('backend');
			}else{
				$this->messages->add('combination failed', 'warning');
				return false;
			}	
		}
		
	}
	function ajx_backend_login(){
			$q = $this->auth_m->checkCombination($this->input->post('email'), $this->input->post('password'));
			if($q){
				$data['status'] = 'success';
				echo json_encode($data);
			}else{
				$data['status'] = 'failed';
				$data['msg'] = 'combinasi salah';
				echo json_encode($data);
			}	
		
	}
	function userRoleCheck($role=false){
		$backend_sess = $this->session->userdata('login_data'); 
		if($role){
			if($role == $backend_sess['role'] && $backend_sess['login'] == true && $backend_sess['user_id'] != null ){
				return true;
			}else{
				redirect('backlogin');
			}
		}else{
			if($backend_sess['login'] == true && $backend_sess['user_id'] != null ){
				return true;
			}else{
				redirect('backlogin');
			}
		}
	}
	function backend_logout(){
		$this->session->unset_userdata('login_data');
		$this->messages->add('your succesfully logout', 'success');
		redirect('backlogin');
	}
	function backAuthorize($role, $content){
		$backend_sess = $this->session->userdata('login_data'); 
		if($backend_sess['role']  == $role){
			return $content;
		}else{
			return false;
		}
	}
	
	// next revision
	function frontendLogCheck($role=false){
		if($role){
			if($role == $this->session->userdata('backend_role' && $this->session->userdata('login') == true && $this->session->userdata('backend_user_id') != null)){
				return true;
			}else{
				redirect('backlogin');
			}
		}else{
			if($this->session->userdata('login') == true && $this->session->userdata('backend_user_id') != null){
				return true;
			}else{
				redirect('backlogin');
			}
		}
	}
	function ajx_frontend_login(){
			$q = $this->auth_m->checkCombination($this->input->post('email'), $this->input->post('password'));
			if($q){
				$data['status'] = 'success';
				$data['redirect'] = site_url($this->input->post('red'));
				echo json_encode($data);
			}else{
				$data['status'] = 'failed';
				$data['msg'] = 'combinasi salah';
				echo json_encode($data);
			}	
		
	}
	function frontlogout(){;
		$this->session->unset_userdata('login_data');
		$this->session->unset_userdata('customer_info');
		$this->session->unset_userdata('ship_to_info');
		$this->session->unset_userdata('shipping_info');
		$this->session->unset_userdata('checkout_step');
		redirect('/');
	}
	


}?>