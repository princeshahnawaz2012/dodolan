<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Page_category_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Category_m() {
		parent::__construct();
	}
	
	
	// API //
	function create($passdata=array()) {
		$q = $this->db->insert('page_category', $passdata);
		if($q){
			return $this->getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function update($id, $passdata){
		$this->db->where('id', $id);
		$q = $this->db->update('page_category', $passdata);
		if($q){
			return $this->getbyid($id);
		}else{
			return false;
		}
	}
	function delete($id){
		$cat = $this->getbyid($id);
		$this->db->where('id', $id);
		$q = $this->db->delete('page_category');
		if($q){
			return $cat;
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('page_category');
		if($q){
			return $q->row();
		}else{
			return false;
		}
	}
	function getbypar($id){
		$this->db->where('parent_id', $id);
		$q = $this->db->get('page_category');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function getall(){
		$q =$this->db->get('page_category');
		if($q){
			return $q;
		}else{
			return false;
		}
	}
	function browse($param){
		$this->db->order_by('id', 'DESC');
		$this->dodol->db_calc_found_rows();	
		if($param['q']){
			$this->db->like('name', $param['q']);
		}
		$q = $this->db->get('page_category', $param['limit'], $param['start']);
		if($q){
			$data['q'] = $q;
			$data['total'] = $this->dodol->db_found_rows();
			return $data;	
		}else{
			return false;
		}
	}
}