<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store_cart_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Store_cart_m() {
		parent::__construct();
	}
	
	function validateProduct($param=array()) {
		/* param :
		id_prod
		id_attrb
		qty
		*/
		
		$this->db->where('id', $param['id_prod']);
		$this->db->where('publish', 'y');
		$q = $this->db->get('store_product');
		// if product is exist
		if($q->num_rows() == 1){
			// if attrb not set
			if(!isset($param['id_attrb'])){
				if($q->row()->stock >= $param['qty'] && $q->row()->stock != 0){
					// product stock available
					$data['stock'] = $q->row()->stock;
					$data['status'] = 'on';
					$data['qty'] =  $param['qty'];
					$data['msg'] = 'a';
					return $data;
				}elseif($q->row()->stock <  $param['qty'] && $q->row()->stock != 0 ){
					// stock not enough
					$data['stock'] = $q->row()->stock;
					$data['status'] = 'min';
					$data['qty'] =  $param['qty'];
					$data['msg'] = 'b';
					return $data;
				}elseif($q->row()->stock == 0 ){
					// product stock not available
					$data['stock'] = $q->row()->stock;
					$data['status'] = 'off';
					$data['qty'] =  $param['qty'];
					$data['msg'] = 'b';
					return $data;
				}
				
			}
			// if attribute set
			else{
				$this->db->where('prod_id', $param['id_prod']);
				$this->db->where('id', $param['id_attrb']);
				$q2 = $this->db->get('store_product_attrb');
				// if attrb exist
				if($q2->num_rows() == 1){
					// if attrb stock avaiable
					if($q2->row()->stock >=  $param['qty'] ){
						$data['stock'] = $q2->row()->stock;
						$data['status'] = 'on';
						$data['qty'] = $param['qty'];
						$data['msg'] = 'c';
						$data['id_attrb'] = $q2->row()->id;
						return $data;	
					}
					// stock not enough
					elseif($q2->row()->stock <  $param['qty'] && $q2->row()->stock != 0){
						$data['stock'] = $q2->row()->stock;
						$data['status'] = 'min';
						$data['qty'] = $param['qty'];
						$data['msg'] = 'c';
						$data['id_attrb'] = $q2->row()->id;
						return $data;	
					}
					// if attrib stock not available
					elseif($q2->row()->stock == 0 ){
						$data['stock'] = $q2->row()->stock;
						$data['status'] = 'off';
						$data['qty'] = $param['qty'];
						$data['msg'] = 'd';
						$data['id_attrb'] = $q2->row()->id;
						return $data;
					}
				}
				// if attrb ot exist
				else{
					$data['status'] = 'off';
					$data['msg'] = 'no attrb';
					return $data;
				}
			}
		}else{
			// no product like that
			$data['status'] = 'off';
			$data['msg'] = 'no product';
			return $data;
			
		}
	}
	
	
	

}