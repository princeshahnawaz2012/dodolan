<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Conf_m extends CI_Model  {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function create($data) {
		$this->db->where('name', $data['name']);
		if($this->db->get('site_conf')->num_rows() > 0){
			return false;
		}else{
			$data['c_date'] = date('Y-m-d H:i:s');
			$this->db->insert('site_conf', $data);
			return $this->getbyid($this->db->insert_id());
		}
	}
	function update($id, $data){
		if($this->getbyid($id)){
			$data['m_date'] = date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('site_conf', $data);
			return $this->getbyid($id);
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('site_conf');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function getbyname($name){
		$this->db->where('name', $name);
		$q = $this->db->get('site_conf');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function getall(){
		$q = $this->db->get('site_conf');
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return false;
			}
	}
	function delete($id){
		if($temp = $this->getbyid($id)){
			$this->db->where('id', $id);
			$q = $this->db->delete('site_conf');
			if($q){
				return $temp;
			}else{
				return false;
			}
		}
	}

}?>