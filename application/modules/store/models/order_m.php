<?php 

if (! defined('BASEPATH')) exit('No direct script access');



class Order_m extends CI_Model {
	var $history_type = array('payment_confirm', 'update_status');
	var $status_type = array('pending', 'confirm', 'process', 'cancel','shipped', 'refund');
	//php 5 constructor
	function __construct() {
		parent::__construct();
	
	}
	
	//php 4 constructor
	function Order_m() {
		parent::__construct();
	}
	
	// Group Function Admin Order
	/////////////////////////////
	
	/**
	 * browse order
	 *
	 * @param array $param 
	 *			    'query', 'status', 'start', 'end', limit
	 * @return void
	 * @author Zidni Mubarock
	 */
	function browse_order($param=array()){
		//defaul param
		//$start = 0; $end = 10;	
		if(isset($param['start'])){
		$start = $param['start'] ;
		}
		if(isset($param['end'])){
		$end  = $param['end'] ;	
		}

		$this->db->select('a.id');
		$this->dodol->db_calc_found_rows();
		$this->db->from('store_order as a');
		if(isset($param['query'])){
			$term = array(
				'b.first_name' => $param['query'], 
				'b.last_name' => $param['query'], 
				'b.email' => $param['query'], 
				'c.first_name' => $param['query'],
				'c.last_name' => $param['query']
			);
			$this->db->join('store_customer as b', 'b.id=a.customer_id' );
			$this->db->join('store_order_shipto_data as c', 'c.order_id=a.id' );
			$this->db->or_like($term);
		}
		// if order id set
		if(isset($param['order_id'])){
			$this->db->where('a.id', $param['order_id']);
		}
		// if search by order_status
		if(isset($param['status'])){
			$this->db->where('a.status', $param['status']);
		}
		$this->db->order_by('a.id', 'DESC');
		$q = $this->db->get('', $end, $start);
	
		if($q->num_rows() < 1){
			return false;
		}else{
			$data['orders'] = $q->result();
			$data['number_rec'] = $this->dodol->db_found_rows();
			return $data; 
		}
		
	}
	//  end of Group Function Admin Order
	/////////////////////////////////////
	
	
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
		
	if($order){
		// insert shipto_data
		$shipto_data = $this->insert_shipto_data($param['shipto_data']);
		// insert product_sold_data
		$product_sold_data = $this->insert_product_sold_data($param['product_sold_data']);
		return true;
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
	function update_status_order($id, $new_status){
		$data = array('status' => $new_status, 'm_date' => date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$q = $this->db->update('store_order', $data);
		if($q){
			return $data;
		}else{
			return false;
		}
	}
	// end of Group Function CREATE ORDER
	////////////////////////////////////
	
	
	// General Function Order
	////////////////////////////////////
	function getall_orderdata($id){
		$order = $this->getOrder($id);
		if($order){
				$data['order_data'] = $order;
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
		$this->db->select('customer_id');
		$this->db->where('id', $id_order);
		$q = $this->db->get('store_order');
		$this->db->where('id', $q->row()->customer_id);
		$q2 =  $this->db->get('store_customer');
		
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
	function getorderbycustomer($id){
		$this->db->where('customer_id', $id);
		$q = $this->db->get('store_order');
		if($q->num_rows() > 0){
			return $q;
		}else{
			return false;
		}
	}
	
	function create_history($idorder, $type, $information){
		$data =array(
		'order_id' => $idorder,
		'type' => $type,
		'information' => $information,
		'c_date' => date('Y-m-d H:i:s')
		);
		$q = $this->db->insert('store_order_history', $data);
		if($q){
			return $this->get_history_byid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function mark_read_history($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_history');
		if($q->num_rows() == 1 && $q->row()->read != 'y'){
			$data = array('read' => 'y');
			$this->db->where('id', $id);
			$q2 = $this->db->update('store_order_history', $data);
		}
	}
	function get_history_by($id_order=false, $type = false, $read = false){
		// get by order
	
		if($id_order){
			$this->db->where('order_id', $id_order);
		}
		// get by type
		if($type){
			$this->db->where('type', $type);
		}
		// get by status read
		if($read){
			$this->db->where('read', $read);
		}
		$this->db->where('order_id', $id_order);
		$q = $this->db->get('store_order_history');
		if($q->num_rows() > 0){
			return $q;
		}else{
		
			return false;
		}
	}
	function get_history_byid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_history');
		if($q->num_rows() == 1){
			return $q;
		}else{
			return false;
		}
	}
	
	
	//--------------------------------//
	// 				API V.02 
	//--------------------------------//
	
	// ORDER
	function create($data){
		if($this->db->insert('store_orde', $data)):
			return $this->getbyid($this->db->insert_id());
		else:
			return false;
		endif;
	}
	function update($id, $data){
		$this->db->where('id', $id);
		if($this->db->update('store_order', $data)){
			return $this->getbyid($id);
		}else{
			return false;
		}
	}
	function delete($id){
		if($pre = $this->getbyid($id)):
			$this->db->where('id', $id);
			if($this->db->delete('store_order')):
				return $pre;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	function getbyid($id, $depend = false){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order');
		$return = array();
		if($q->num_rows() == 1):
			$return['order'] = $q->row();
			if($depend == true):
				$return['customer'] = $this->load->model('store/customer_m')->_getbyid($q->row()->customer_id);
				$return['shipping_info'] = $this->getshipping_info($q->row()->id);
				$return['product_sold'] = $this->getproduct_sold($q->row()->id);
			endif;
			return $return;
		else:
			return false;
		endif;
	}
	function browse($param){
	$start = ($start = element('start', $param)) ? $start : 0;
	$limit = ($limit = element('limit', $param)) ? $start : 20;
	
	$this->db->select('order_data.id as order_number');
	if(element('search', $param)) :
		$search = array(
			'order-data.id' => element('search', $param),
			'customer.name' => element('search', $param),
			'shipping_info.name' => element('search', $param),
		); 
		$this->db->or_like($search);
	endif;
	if(element('status', $param)):
		$this->db->where('status', element('status', $param));
	endif;
			$this->dodol->db_calc_found_rows();
		$this->db->join('store_customer customer', 'customer.id=order_data.customer_id');
		$this->db->join('store_order_shipping_info shipping_info', 'shipping_info.order_id=order_data.id');

		$q = $this->db->get('store_order order_data', $limit, $start);
		if($q->num_rows() > 0):
			return array('result'=> $q->result(), 'num_record' => $this->dodol->db_found_rows());
		else:
			return false;
		endif;
		
	}
	// PRODUCT SOLD
	function getproduct_sold($id_order){
		$this->db->where('order_id', $id_order);
		$pre = $this->db->get('store_order_product_sold');
		if($pre->num_rows() > 0){
			return $pre->result();
		}else{
			return false;
		}
	}
	// PRODUCT SOLD OPERATION
	function product_sold_create($data){
		if($q = $this->db->insert('store_order_product_sold', $data)){
			return $this->product_sold_getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function product_sold_udpate($id, $data){
		if($this->product_sold_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->update('store_order_product_sold', $data)){
				return $this->product_sold_getbyid($id);
			}else{
				return false;
			}
		}
	}
	function product_sold_delete($id){	
		if($del = $this->product_sold_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->delete('store_order_product_sold')){
				return $del;
			}else{
				return false;
			}
		}
	}
	function product_sold_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_product_sold');
		if($q->num_rows() ==1 ){
			return $q->row();
		}else{
			return false;
		}
	}
	
	// SHIPPING INFORMATION
	function getshipping_info($id_order){
		$this->db->where('order_id', $id_order);
		$pre = $this->db->get('store_order_shipping_info');
		if($pre->num_rows() > 0){
			return $pre->result();
		}else{
			return false;
		}
	}
	// SHIPPING INFORMATION OPERATION
	function shipping_info_create($data){
		if($q = $this->db->insert('store_order_shipping_info', $data)){
			return $this->shipping_info_getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function shipping_info_udpate($id, $data){
		if($this->product_sold_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->update('store_order_shipping_info', $data)){
				return $this->shipping_info_getbyid($id);
			}else{
				return false;
			}
		}
	}
	function shipping_info_delete($id){	
		if($del = $this->shipping_info_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->delete('store_order_shipping_info')){
				return $del;
			}else{
				return false;
			}
		}
	}
	function shipping_info_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_shipping_info');
		if($q->num_rows() ==1 ){
			return $q->row();
		}else{
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
}