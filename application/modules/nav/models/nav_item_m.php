<?php if (! defined('BASEPATH')) exit('No direct script access');

class Nav_item_m extends CI_Model  {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	// API ///
	function create($data) {
		$this->db->where('nav_id', 1);
		$this->db->select_max('sort', 'last_order');
		$q = $this->db->get('site_nav_item');
		if($q->row()->last_order != null){
			$data['sort'] = $q->row()->last_order+1;
		}else{
			$data['sort'] = 1;
		}
				
		$q = $this->db->insert('site_nav_item', $data);
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
			$q = $this->db->update('site_nav_item', $data);
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
			$q = $this->db->delete('site_nav_item');
			if($q){
				return $pre;	
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function getbypar($id_parent){
	$this->db->order_by('sort', 'ASC');
	$this->db->where('parent_id', $id_parent);
	$q = $this->db->get('site_nav_item');
		if($q->num_rows() > 0){
				return $q->result();
		}else{
				return false;
		}
	}
	function getbynav($nav_id){
		$this->db->order_by('sort', 'ASC');
		$this->db->where('nav_id', $nav_id);
		$q = $this->db->get('site_nav_item');
			if($q->num_rows() > 0){
					return $q->result();
			}else{
					return false;
			}
		
	}
	function getall(){
		$this->db->order_by('sort', 'ASC');
		$q = $this->db->get('site_nav_item');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->order_by('sort', 'ASC');
		$this->db->where('id', $id);
			$q = $this->db->get('site_nav_item');
			if($q->num_rows() == 1){
				return $q->row();
			}else{
				return false;
			}
		}
			function browse($param){

			}

		}?>