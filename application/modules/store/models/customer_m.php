<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Customer_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Customer_m() {
		parent::__construct();
	}
	
	
	function browse($param){
		$this->db->select('id');
		
		if($param['query']){
			$term = array(
				'email' => $param['query'],
				'first_name' => $param['query'],
				'last_name'  => $param['query']
			);
			$this->db->or_like($term);
		}
		if($param['reg'] == 'y'){
			$this->db->where('user_id >', 0);
		}elseif($param['reg'] == 'n'){
			$this->db->where('user_id', 0);
		}
		
		$q = $this->db->get('store_customer', $param['end'], $param['start']);
		$this->db->select('id');
		if(isset($param['query'])){
			$term = array(
				'email' => $param['query'],
				'first_name' => $param['query'],
				'last_name'  => $param['query']
			);
			$this->db->or_like($term);
		}
		$q2 = $this->db->get('store_customer');
		
		if($q->num_rows() > 0){
			$data['result'] = $q->result();
			$data['num_rec'] = $q2->num_rows();
			return $data;
			
		}else{
			return false;
		}
	}
	function getByUser($id , $select =false){
		if($select){
			$this->db->select($select);
		}
		$this->db->where('user_id', $id);
		$q = $this->db->get('store_customer');
		if($q->num_rows() == 1){
			return $q->row_array();;
		}else{
			return false;
		}
		
	}
	function getById($id , $select =false){
		if($select){
			$this->db->select($select);
		}
		$this->db->where('id', $id);
		$q = $this->db->get('store_customer');
		if($q->num_rows() == 1){
		
				return $q->row_array();;
		
		}else{
			return false;
		}
		
	}
	function create($data){
		$this->db->where('email', $data['email']);
		$pre = $this->db->get('store_customer');
		if(isset($data['user_id'])){
			$numrows = 0;
		}else{
			$numrows = $pre->num_rows();
		}
		
		
		if($numrows == 0 ){
		$q = $this->db->insert('store_customer', $data);
			if($q){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	function updateById($id, $passdata){
		$current_data = $this->getById($id);
		
		// check, that there is other customer with email inputed
		$this->db->where('email', $passdata['email']);
		$this->db->where('id !=', $id);
		$pre = $this->db->get('store_customer');
		// check, that there is no user register with email inputed
		$this->db->where('email', $passdata['email']);
		$this->db->where('id !=', $current_data['user_id']);
		$pre2 = $this->db->get('user');
		
		// if all pre qualify, update the data;
		if($pre->num_rows() == 0 && $pre2->num_rows() == 0):
			$this->db->where('id', $id);
			$q = $this->db->update('store_customer', $passdata);
			if($q){
				return true;
			}else{
				return false;
			}
		else:
			return false;
		endif;
	}
	function getByEmail($email){
		$this->db->where('email', $email);
		$q = $this->db->get('store_customer');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	
	
	function _getbyid($id, $select = false){
		if($select == true):
			$this->db->select($select);
		endif;
		$this->db->where('id', $id);
		$q = $this->db->get('store_customer');
		if($q->num_rows() == 1):
			return $q->row();
		else:
			return false;
		endif;
	}
}