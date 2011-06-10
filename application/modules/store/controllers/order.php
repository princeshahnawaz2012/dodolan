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
	function index(){
		echo 'index';
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
	function showorder($id){
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
	function getorderbycustomer($user_id){
		$q = $this->order_m->getorderbycustomer($user_id);
		
		if($q){
			$mount = 0;
			foreach($q->result() as $order){ $mount = $mount+$order->total_amount;}
			
			$data['orders'] = $q->result();
			$data['count']  = $q->num_rows();
			$data['mount'] = $mount;
		}else{
			$data['orders'] = false;
			$data['count']  = 0;
			$data['mount']  = 0;
		}
		
		return $data;
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
		$order = $data['data']['order_data'];
		$personal_data = $data['data']['personal_data'];
		$this->load->library('mailer');
		$this->mailer->to = $personal_data->email;
		$this->mailer->subject = 'order no- '.$order->id;
		$this->mailer->body = $data;
		$send = $this->mailer->send();
		echo $send['debug'];
	}
	
	function count_qty_order($id){
		$data = $this->order_m->get_prodsold_data($id);
		$qty = array();
		$i = 0;
		foreach($data as $item){
			$qty[$i] = $item->qty; 
		}
		return array_sum($qty);
		
	}
	function status_list(){
		return array('pending', 'confirm', 'process', 'cancel','shipped', 'refund');
	}
	function update_status(){
		$new_status =  $this->input->post('new_status');
		$id = $this->input->post('order_id');
		$q = $this->order_m->update_status_order($id, $new_status);
		$notify = $this->input->post('notify_user');
		if($q){
			if($notify == 1){
				$this->notify($id);
			}
			if($this->uri->segment(4)=='ajax'){
				$return_data = array('msg'=> 'success', 'new_status' => $q['status'], 'time' => $this->misc->custom_time($q['m_date']), 'id' => $id);
				echo json_encode($return_data);
			}else{
				return true;
			}
			
				
			
		}else{
			if($this->uri->segment(4)=='ajax'){
				$return_data = array('msg' => 'failed');
				echo json_encode($return_data);
			}else{
				return false;
			}
		}
	}
	function getorder_item($id){
		if($this->uri->segment(4) == 'ajax'){
			$id = $this->input->post('order_id');
		}else{
			$id = $id;
		}
		
		$items = $this->order_m->get_prodsold_data($id);
		if($items){
			if($this->uri->segment(4) == 'ajax'){
				$render['items'] = $items;
				$data['content'] = $this->load->view('store/page/order/ajax_getorder_items_v', $render, true);
				$data['msg'] = 'success';
				echo json_encode($data);
			}else{
			return $items	;
			}
		}else{
			if($this->uri->segment(4) == 'ajax'){
				$data['msg'] = 'failed';
				echo json_encode($data);
			}else{
				return false;
			}
		}
	}
	function notify($id){
			$order = $this->order_m->getall_orderdata($id);
			$person = $order['personal_data'];
			$data  = $order['order_data'];
			$body = array('person'=> $person, 'data' => $data, 'template' => 'store/misc/order/mail_order_notify_v');
			
			$this->load->library('mailer');
			$this->mailer->to = $person->email;
			$this->mailer->subject = 'Update Order Status Notification,  order no- '.$data->id;
			$this->mailer->body = $body;
			$this->mailer->send();
	}
	function test_getorder()
	{
		$id = $this->uri->segment(4);
		$order = $this->order_m->getall_orderdata($id);
		$person = $order['personal_data'];
		$data  = $order['order_data'];
		$body = array('person'=> $person, 'data' => $data, 'template' => 'store/misc/order/mail_order_notify_v');
		
		$this->load->library('mailer');
		$this->mailer->to = 'zidmubarock@gmail.com';
		$this->mailer->subject = 'Update Order Status Notification,  order no- '.$data->id;
		$this->mailer->body = $body;
		$this->mailer->send();
		
		
	}

}