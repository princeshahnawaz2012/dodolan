<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Payment extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Payment() {
		parent::__construct();
	}
	
	function index() {
		if($this->cart->payment_info){
			
		}else{
			redirect('store/chcekout/payment');
		}
		
	}

}