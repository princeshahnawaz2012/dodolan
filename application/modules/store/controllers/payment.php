<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Payment extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function Payment() {
		parent::Controller();
	}
	
	function index() {
		if($this->cart->payment_info){
			
		}else{
			redirect('store/chcekout/payment');
		}
		
	}

}