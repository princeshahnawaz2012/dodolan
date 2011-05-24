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
		$q = 
$this->db->get('store_customer', $param['limit'], $param['start']);
		if($q->num_rows() > 0){
			return $q->result();
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
		if($pre->num_rows() == 0){
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
		$this->db->where('id', $id);
		$q = $this->db->update('store_customer', $passdata);
		if($q){
			return true;
		}else{
			return false;
		}
	}

}