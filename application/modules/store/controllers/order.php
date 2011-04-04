<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Order extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->load->model('store/order_m');
	}
	
	//php 4 constructor
	function Order() {
		parent::Controller();
	}
	
	function create_order($data=false, $id=false) {
		// create order id first
		
if(!$data){
			$order_id = $this->order_m->open_order();
			return $order_id;
		}
		// insert complete data after get the id order
		else{
			$insert = $this->order_m->insert_order($data, $id);
			return $insert;
		}
	}
	function showorder($id=false){
		if($id == false){
		$id = $this->uri->segment(4);
		}
		$order = $this->getorder($id);
		if($order){
		$this->theme->render($order);
		}
	}
	function getorder($id){
	$order = $this->order_m->getall_orderdata($id);
	
	if ($order){
		$data['data'] = $order;
		$data['mainLayer'] = 'store/page/order/order_show_v';
		return $data;
	}else{
		return false;
	}
	
	}
	function orderprice($id, $num){
		$order = $this->order_m->getOrder($id);
		if($order->currency != $this->addon_store->currency()){
			$rate = $this->yh_conv->conv($order->currency, $this->addon_store->currency());
			$new_num = $this->addon_store->show_price($num*$rate, $order->currency);
		}else{
			$new_num = $this->addon_store->show_price($num);
		}
		return $new_num;
	}
	function send_order_data($id){
		//$id = $this->uri->segment(4);
		$data = $this->getorder($id);
		$data['template'] = $data['mainLayer'];
		$order = $data['data']['order'];
		$personal_data = $data['data']['personal_data'];
		$this->load->library('mailer');
		$this->mailer->to = $personal_data->email;
		$this->mailer->subject = 'order no- '.$order->id;
		$this->mailer->body = $data;
		$send = $this->mailer->send();
		echo $send['debug'];
	}
	function test(){
		$id = $this->uri->segment(4);
		modules::run('store/order/send_order_data', $id);
	}

}?>