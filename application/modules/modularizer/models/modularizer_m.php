<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Modularizer_m extends CI_Model  {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function create($data) {
		$this->db->where('state', $data['state']);
		$this->db->where('spot', $data['spot']);
		$this->db->select_max('sort', 'last_sort');
		$q = $this->db->get('modularizer');
		if($q->row()->last_sort != null){
			$data['sort'] = $q->row()->last_sort+1;
		}else{
			$data['sort'] = 1;
		}
		if($this->db->insert('modularizer', $data)){
			return $this->getbyid($id);
		}else{
			return false;
		}
	}
	function update($id, $data){
		if($this->getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->update('modularizer', $data)){
				return $this->getbyid($id);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function delete($id){
		if($del = $this->getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->delete('modularizer')){
				return $del;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function getall(){
		$q = $this->db->get('modularizer');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
		
	}
	function browse($param){
		$limit = (isset($param['limit'])) ? $param['limit'] : 20;
		$start = (isset($param['start'])) ? $param['start'] : 0;
	$this->db->select('*');
		if(element('spot', $param)){
			$this->db->where('spot', $param['spot']);
		}
		if(element('state', $param) == 'front' || element('state', $param) == 'admin'){
			$this->db->where('state', $param['state']);
		}
		if(isset($param['publish'])){
			$this->db->where('publish', $param['publish']);
		}
		if(isset($param['order_by'])){
			$order = explode(',', $param['order_by']);
			$this->db->order_by($order[0], $order[1]);
		}
		$this->db->order_by('sort', 'ASC');
		if(element('s', $param)){
			$like = array('name' => element('s', $param), 'widget_name' => element('s', $param));
			$this->db->or_like($like);
		}
		$this->dodol->db_calc_found_rows();
		$q = $this->db->get('modularizer', $limit, $start);
		if($q->num_rows()> 0){
			$data = array('q' => $q->result(), 'q_total_rows' => $this->dodol->db_found_rows());
			return $data;
		}else{
			return false;
		}
		
	}
	function getallspot(){
		$this->db->select('spot');
		$this->db->group_by('spot');
		$q = $this->db->get('modularizer');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function getbyspot($spot){
		$this->db->where('spot', $spot);
		$q = $this->db->get('modularizer');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('modularizer');
		if($q->num_rows() ==1){
			return $q->row();
		}else{
			return false;
		}
	}
}?>