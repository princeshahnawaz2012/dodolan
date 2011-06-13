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
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	function update($id, $passdata){
		$this->db->where('id', $id);
		$q = $this->db->update('page_category', $passdata);
		if($q){
			return $id;
		}else{
			return false;
		}
	}
	function delete($id){
		$this->db->where('id', $id);
		$q = $this->db->delete('page_category');
		if($q){
			return $id;
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->where('a.id', $id);
		$q = $this->db->get('page_category');
		if($q){
			return $q->row();
		}else{
			return false;
		}
	}
	function getAll(){
		$q =$this->db->get('page_category');
		if($q){
			return $q;
		}else{
			return false;
		}
	}
	function browse($param){
		
	}

}