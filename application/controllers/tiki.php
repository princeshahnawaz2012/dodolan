<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Tiki extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function Tiki() {
		parent::Controller();
	}
	
	function tester() {
		$url = 'http://www.jne.co.id/tariff.php?ind=o&q=ban&limit=20';
		$handle = file($url);
	    $alldata = implode(";", $handle );
	    $list = explode(';', $alldata);
	    $index = 0;
	 	foreach($list as $item){
	 		$itemdata = explode('|', $item);
	 		$data[$index]['city_name'] = $itemdata[0];
	 		$data[$index]['city_code'] = preg_replace('/\r\n|\r/', "", $itemdata[1]);
	 		$index++;
	 	}
	 	echo json_encode($data);
		
	}
	function test2(){
		$index = 0;
		$q = $this->db->get('store_country');
		foreach($q->result() as $item){
	 	
	 		$data[$index]['key'] = $item->country_name;
	 		$data[$index]['value'] =$item->country_id;
	 		$index++;
	 	}
		echo json_encode($data);
	}
	function test(){
	/*	
		$data_customer = $this->session->userdata('buyer_info');
		$data = array(
			'cart_additional_content' => array(
				'shiping_info' => array(
					'code_city' => '657656576',
					'city' => 'jakarta', ),
				'customer_info' => $data_customer,),
			);
		$this->session->set_userdata($data);
	*/	
		$data = $this->session->userdata('cart_additional_content');
		echo $data['customer_info']['first_name'].'<br/>';
		echo $data['customer_info']['last_name'].'<br/>';
		echo $this->session->userdata['cart_additional_content']['customer_info']['first_name'];
		
	}
	function reset_value(&$arrRef){
    foreach ($arrRef as $key=>$val) {
        if (is_array($val)) {
            $this->Array_Dimensional_Reset($val);
            reset($arrRef[$key]);
        }
    
		}
	}
	function test_reset(&$arrRef){
		
		foreach ($arrRef as $key=>$val) {
        if (is_array($val)) {
            $this->test_reset($val);
            $this->session->set_userdata(reset($arrRef[$key]));
        	}
    	}
		
	}
	function test_3(){
		$data = $this->session->userdata['cart_additional_content'];
		//$data['customer_info']['first_name'] = 'ajnginasah';
		$this->session->userdata['cart_additional_content']['customer_info']['first_name'] = 'fsdsdfsdfsd';
		$this->session->sess_write();
	
	}
	










}