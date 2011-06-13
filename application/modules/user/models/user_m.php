<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function User_m() {
		parent::__construct();
	}
	
	function register($data=array()) {
		$this->db->where('email', $data['email']);
		$q = $this->db->get('user');
		$this->db->where('email', $data['email']);
		$q2 = $this->db->get('store_customer');
		if($q->num_rows() == 0 && $q2->num_rows() == 0){
			$ins = $this->db->insert('user', $data);
			if($ins){
				$id = $this->db->insert_id();
				return $id;
			}
		}else{
			return false;
		}
	}
	function update($data, $id_user){
		$this->db->where('email', $data['email']);
		$this->db->where('id !=', $id_user);
		$q = $this->db->get('user');
		if($q->num_rows() == 0){
			$this->db->where('id', $id_user);
			$upd = $this->db->update('user', $data);
			if($upd){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}	
	}
	
	// this function fecthing from jne.co.id, its important for next to determine the shipping cost
	function getCity($q, $limit){
		$this->load->library('jne');
		$json = $this->jne->getDestination($q, $limit);
		if($json){
			return $json;
		}else{
			return false;
		}
		
		
	}
	function get_userdata($id, $select=false){
		if($select){
		$this->db->select($select);
		}
		$this->db->where('id', $id);
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data['user'] = $q->row_array();
			return $data;
		}else{
			return false;
		}
	}
	function get_userdata_by_email($email, $select=false){
		if($select){
		$this->db->select($select);
		}
		$this->db->where('email', $email);
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data['user'] = $q->row_array();
			return $data;
		}else{
			return false;
		}
	}

}