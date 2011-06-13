<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class shipping extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function shipping() {
		parent::__construct();
	}
	
	function index() {
	}
	function noshipping(){
		$this->cart->meta_transaction['no_shpping'] = true;
		$this->cart->write();
	}
	function shipping_mod($shipping){
		if($shipping != false){
			return $shipping;
		}else{
			return false;
		}
	}
	function jne($id_fee = false){
		if($this->cart->shipto_info){
			$buyer_info = $this->cart->shipto_info;
		}else{
			$buyer_info = $this->cart->customer_info;
		}
		$weight = modules::run('store/store_cart/getAllWeight');
		
		if($id_fee == false){
			$fee_list = $this->jne->getRate($buyer_info['city_code'], $weight);
			if($fee_list){
				return $fee_list['data'];
			}else{
				return false;
			}
		}else{
			$rate = $this->jne->choosenRate($buyer_info['city_code'], $weight, $id_fee);
			if($rate){
				$data = array('shipping_info' => array(
					'fee' => $rate['rate'],
					'carrier' => 'jne',
					'rate_id' => $id_fee,
					'country' => $buyer_info['country_id'],
					'city'    => $buyer_info['city'],
					'type'    => $this->jne->service($rate['type']),
				));
				$this->cart->write_data($data);
				return true;
			}else{
				return false;
			}
		
		}
	}

}?>