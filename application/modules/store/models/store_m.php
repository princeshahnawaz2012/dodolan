<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Store_m() {
		parent::__construct();
	}
	
	function add_request_restock($param=array()) {
		$this->db->where('email', $param['email']);
		$this->db->where('id_prod', $param['id_prod']);
		if(isset($param['id_attrb'])){
			$this->db->where('id_attrb', $param['id_attrb']);
		}
		$q = $this->db->get('store_waiting_restock');
		if($q->num_rows() > 0){
			return false;
		}else{
			$this->db->insert('store_waiting_restock', $param);
			return true;	
		}
		
		
	}
	function get_country($id){
		$this->db->where('country_id', $id);
		$q = $this->db->get('store_country');
		if($q->num_rows() ==1){
			return $q->row()->country_name;
		}else{
			$country = 'uninitialize';
			return $country;
		}
	}

}