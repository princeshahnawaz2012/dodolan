<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Nav_m extends CI_Model  {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	// API ///
	function create($data) {
		$q = $this->db->insert('site_nav', $data);
		if($q){
			return $this->getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function update($id, $data){
		$pre = $this->getbyid($id);
		if($pre){
			$this->db->where('id', $id);
			$q = $this->db->update('site_nav', $data);
			if($q){
				return $this->getbyid($id);
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	function delete($id){
		$pre = $this->getbyid($id);
		if($pre){
			$this->db->where('id', $id);
			$q = $this->db->delete('site_nav');
			if($q){
				return $pre;	
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function getall(){
		$q = $this->db->get('site_nav');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('site_nav');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function browse($param){
		
	}
	
}?>