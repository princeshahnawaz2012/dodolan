<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Tester extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function Tester() {
		parent::Controller();
	}
	function index(){
		echo 'just tester';
	}
	
	function testUpload() {
		$this->load->helper('form');
		echo form_open_multipart(current_url());
		echo form_upload('file');
		echo form_submit('upload', 'upload');
		echo form_close();
		if($this->input->post('upload')){
		$this->load->library('upload');
		$config['upload_path'] = './assets/product-img/';
		$config['allowed_types'] = 'rar|gif|jpg|png|zip';
		$config['max_size']	= '100000';
		$config['overwrite'] = false;
		$this->upload->initialize($config);
		$this->upload->do_upload('file');
		}
	}
	function test(){
		$this->load->library('mailer');
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('cs@bajubatik.com', 'Bajubatik.com');
		$this->email->to('zidmubarock@gmail.com');
		$this->email->subject('Order');
		$this->email->message($this->mailer->test()); 
		$this->email->send();
		echo $this->email->print_debugger();
	}
	function test2(){
		$data = array('template' => 'msg', 'mailmsg' => 'from $mailMsg');
		$this->load->library('mailer');
		$this->mailer->to = 'zidmubarock@gmail.com';
		$this->mailer->subject = 'Oredr Was Recieve';
		$this->mailer->from = 'alent.alzid@gmail.com';
		$this->mailer->name_from = 'your darling';
		//$this->mailer->send();
		//$this->mailer->test();
		$this->mailer->body = $data;
		$this->mailer->send();
	}
	function test3(){
		$send = modules::run('store/order/send_order_data', $this->session->userdata('order_id'));
		
	}
	function test4(){
		$this->cart->destroy_data('shipping_info');
		redirect('store/checkout');
	}
	function test5(){
		$this->session->unset_userdata('order_id');
	}
	function test6(){
		$data = array('shipping_info' => array('carrier' => 'jne'));
		$this->cart->write_data($data);
	}


}