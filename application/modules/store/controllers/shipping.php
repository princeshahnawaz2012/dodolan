<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class shipping extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function shipping() {
		parent::Controller();
	}
	
	function index() {
	}
	function noshipping(){
		$this->cart->meta_transaction['no_shpping'] = true;
		$this->cart->write();
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
				return $rate;
			}else{
				return false;
			}
		
		}
	}

}?>