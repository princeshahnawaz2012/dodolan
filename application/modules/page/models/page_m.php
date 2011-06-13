<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Page_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Page_m() {
		parent::__construct();
	}
	
	// API ///
	function create($passdata=array()) {
	
	$passdata['c_date'] = date('Y-m-d H:i:s');
		$q = $this->db->insert('page', $passdata);
		if($q){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	function update($id, $passdata){
		$passdata['m_date'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$q = $this->db->update('page', $passdata);
		if($q){
			return $id;
		}else{
			return false;
		}
	}
	function delete($id){
		$this->db->where('id', $id);
		$q = $this->db->delete('page');
		if($q){
			return $id;
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->where('a.id', $id);
		$this->db->select('a.*', false);
		$this->db->select('b.*', false);
		$this->db->join('page_category b', 'a.category_id=b.id');
		$q = $this->db->get('page a');
		if($q){
			return $q->row();
		}else{
			return false;
		}
	}
	function browse($param =false){
		$this->db->select('a.*', false);
		$this->db->select('b.*', false);
		$this->db->select('a.id as page_id, b.id as cat_id');
		$this->db->join('page_category b', 'a.category_id=b.id');
		$q = $this->db->get('page a');
		if($q){
			return $q;
		}else{
			return false;
		}
		
	}

}