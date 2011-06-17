<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Order extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/order_m');
	}
	
	//php 4 constructor
	function Order() {
		parent::__construct();
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
		$this->dodol_theme->render($order);
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
	function update_status($id, $new_status){
		$q = $this->order_m->update_status_order($id, $new_status);
		if($q){
			$information = 'set new status as <span>'.$new_status.'</span>';
			$this->create_history_order($id,'update_status',$information);
			$this->notify($id);
			return true;
		}else{
			return false;
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
	function confirm_payment(){
		$render['pH'] = 'Confirmation Order Payment';
		$render['mainLayer'] = 'store/page/order/confirm_payment_v';
		$this->dodol_theme->render($render);
		if($this->input->post('submit')):
			$information = '
			Order <span class="bold">#'.$this->input->post('order_number').'</span><br/>
			Payment Method 		: '.$this->input->post('payment_method').'<br/>
			Payed Amount 		: '.$this->input->post('payed_amount').'<br/>
			Date Payment 		: '.$this->input->post('date_payment').'<br/>
			Acount Name 		: '.$this->input->post('acount_name').'<br/>
			';
			$history = $this->create_history_order($this->input->post('order_number'), 'payment_confirm', $information);
			$customer_data = $this->order_m->get_personal_data($this->input->post('order_number'));
			
			// prepare send email data
			$for_customer = 'Thanks For your Payment Confirmation, we just recieved it, we will Process it soon
					<div class="horline"></div>';
			$body = array('mailmsg' => $for_customer.'<p>'.$history->row()->information.'</p>');
			$this->load->library('mailer');
			$this->mailer->to = $customer_data->email;
			$this->mailer->subject = 'Payment Confirmation,  order #'.$history->row()->order_id;
			$this->mailer->body = $body;
			$this->mailer->send();
			
			// email to owner
			$body = array('mailmsg' => '<p>'.$history->row()->information.'</p>');
			$this->load->config('store');
			$this->load->library('mailer');
			$this->mailer->to = $this->config->item('owner_email');
			$this->mailer->subject = 'Payment Confirmation,  order #'.$history->row()->order_id;
			$this->mailer->body = $body;
			$this->mailer->send();
		endif;
	}
	// ORDER HISTORY API //
	function create_history_order($id,$type,$information){
		return $this->order_m->create_history($id,$type,$information);
	}
	function mark_read_history($id){
		return $this->order_m->mark_read_history($id);
	}
	
	

}