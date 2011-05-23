<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Customer_m extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	//php 4 constructor
	function Customer_m() {
		parent::Model();
	}
	
	function getAll($param) {
		$q = $this->db->get('store_customer', $param['limit'], $param['start']);
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
		 
	}
	function getByID($id){
		
	}
	function edit($id){
		
	}
	function delete($id){
		
	}
	function getByEmail($email){
		$this->db->where('email' $email);
		$q = $this->db->get('store_customer');
		if($q->num_rows == 1){
			return $q->row();
		}else{
			return false;
		}
	}

}