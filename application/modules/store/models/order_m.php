<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Order_m extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	//php 4 constructor
	function Order_m() {
		parent::Model();
	}
	// Group Function CREATE ORDER
	//////////////////////////////
	function open_order(){
		$data = array('c_date' => date('Y-m-d H:i:s'));
		$q = $this->db->insert('store_order', $data);
		return $this->db->insert_id();
	}
	// $param = {order_data, personal_data, shipto_data, product_sold_data}
	function insert_order($param=array(), $id){
		// insert store_order, which actally update the record with complete data;
		$this->db->where('id', $id);
		$order = $this->db->update('store_order', $param['order_data']);
		// insert personal data
	if($order){
		$personal_data = $this->insert_personal_data($param['personal_data']);
		// insert shipto_data
		$shipto_data = $this->insert_shipto_data($param['shipto_data']);
		// insert product_sold_data
		$product_sold_data = $this->insert_product_sold_data($param['product_sold_data']);
		return $id;
	}else{
		return false;
	}
		
	}
	function insert_personal_data($data){
		$q = $this->db->insert('store_order_personal_data', $data);
		return true;
		
	}
	function insert_shipto_data($data){
		$q = $this->db->insert('store_order_shipto_data', $data);
		return true;
	}
	function insert_product_sold_data($data){
		$i = 0;
		foreach($data as $d){
			$q = $this->db->insert('product_sold_data', $d);
			$id[$i] = $this->db->insert_id();
			$i++;
		}
		if(count($data) == count($id)){
			return true;
		}else{
			return false;
		}
	}
	// end of Group Function CREATE ORDER
	////////////////////////////////////
	
	function getall_orderdata($id){
		$data['order'] = $this->getOrder($id);
		if($data['order']){
			$data['personal_data'] = $this->get_personal_data($id);
			$data['shipto_data'] = $this->get_shipto_data($id);
			$data['prodsold_data'] = $this->get_prodsold_data($id);
			return $data;
		}else{
			return false;
		}
	
	}
	
	
	function getOrder($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order');
		if($q->num_rows() == 1){
			$order = $q->row();
		}else{
			$order = false;
		}
		return $order;
	}
	
	function get_personal_data($id_order){
		$this->db->where('order_id', $id_order);
		$q2 = $this->db->get('store_order_personal_data');
		if($q2->num_rows() == 1){
			$personal_data = $q2->row();
		}else{
			$personal_data = false;
		}
		return $personal_data;
	}

	function get_shipto_data($id_order){
		$this->db->where('order_id', $id_order);
		$q3 = $this->db->get('store_order_shipto_data');
		if($q3->num_rows() == 1){
			$shipto_data = $q3->row();
		}else{
			$shipto_data = false;
		}
		return $shipto_data;
	}
	function get_prodsold_data($id_order){
		$this->db->where('order_id', $id_order);
		$q4 = $this->db->get('product_sold_data');
		if($q4->num_rows() >0 ){
			$product_sold_data = $q4->result();
		}else{
			$product_sold_data = false;
		}
		return $product_sold_data;
	}
	
	function function_name() {
		
	}

}?>