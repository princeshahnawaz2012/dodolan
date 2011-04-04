<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Auth_m extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	//php 4 constructor
	function Auth_m() {
		parent::Model();
	}
	
	function checkCombination($email, $pass) {
		$this->db->where('email', $email);
		$this->db->where('password', md5($pass));
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data = array('login_data' => array(
				'login' => true,
				'role' => $q->row()->role,
				'user_id' => $q->row()->id
				));
			$this->session->set_userdata($data);
			$this->session->unset_userdata('customer_info');
			$this->session->unset_userdata('ship_to_info');
			return true;
		}
		else{
			return false;
		}
		
	}


}?>