<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Category_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Category_m() {
		parent::__construct();
	}
	
	function getAllCat() {
		$q = $this->db->get('store_category');
		return $q->result();
		
	}
	function getCatByPar($par) {
		$this->db->select('name, id, parent_id');
		$this->db->where('parent_id', $par);
		$this->db->order_by('name', 'desc');
		$q = $this->db->get('store_category');
		if($q->num_rows() > 0){
		return $q->result();
		}else{
			return false;
		}
	}
	function getcatbyid($id){

		$this->db->where('id', $id);
		$q = $this->db->get('store_category');
		if($q->num_rows() > 0){
			return $q->row();
		}
	}
	function addcat($data){
		$q = $this->db->insert('store_category', $data);
		if($q){
			return true;
		}else{
			return false;
		}
	}
	function editcat($data, $id){
		$this->db->where('id', $id);
		$q = $this->db->update('store_category', $data);
		if($q){
			return true;
		}else{
			return false;
		}
	}
	function deletecat($id){
		$this->db->where('parent_id', $id);
		$check_depend = $this->db->get('store_category');
		if($check_depend->num_rows()>0){
			return false;
		}else{
			$this->db->where('id', $id);
			$q = $this->db->delete('store_category');
			if($q){
				return true;
			}else{
				return false;
			}
		}
	}
	

}?>