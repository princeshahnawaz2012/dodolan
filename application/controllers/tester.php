<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Tester extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Tester() {
		parent::__construct();
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
		$this->cart->destroy_data();
		$this->session->unset_userdata('order_id');
		
		redirect('store/checkout');
	}
	function test5(){
		$this->session->unset_userdata('order_id');
	}
	function test6(){
		$data = array('shipping_info' => array('carrier' => 'jne'));
		$this->cart->write_data($data);
	}
	function test7(){
		$q = 'b';
		$query = 'q='.$q.'&limit=5';
		$url = 'http://www.jne.co.id/tariff.php?'.$query;
		/*
		$handle = @fopen('yourfile...', "r");
		if ($handle) {
		   while (!feof($handle)) {
		       $lines[] = fgets($handle, 4096);
		   }
		   fclose($handle);
		}
		*/
	    $getSource = @fopen($url, 'r');
	    		
		//$handle = file($url);
		if($getSource){
			while(!feof($getSource)){
       			$line[] = fgets($getSource, 4096);
			}
        fclose($getSource);
		}
		foreach($line as $key=>$val){
				echo '<h3>'.$key.'</h3>';
				$single_data = explode('|', $val);
				echo $single_data[0].' = ';
				echo $single_data[1].'<hr/>';
		}
	}
	function test10(){
		$css = array('theme/back/css/admin-style.css', 'theme/back/css/admin-style.css');
		$this->dodol_theme->register_css($css);
		$this->dodol_theme->load_css();
	}
	function test11(){
			$this->dodol_theme->load_css();
	}
	function test12(){
		echo ('
		<form method="post">
			<input type="file" name="file" value="">
			<input type="submit" name="submit" value="submit" id="submit">
		</form>
		');
		if($this->input->post('file')){
			echo $this->input->post('file');
		}else{
			echo 'asuh';
		}
		
	}
	function test13(){
		$id = $this->uri->segment(3);
		echo $id;
	}
	function test14(){
		$parameter = array(101, 'payment_confirm', 'testing cron');
		$do_time = $this->dodol->datetime('+5 minutes');
		$cron = modules::run('cron/add', 'store/order/create_history_order', $parameter, $do_time );
	}
	function flip(){
		$render['mainLayer'] = 'flip_v';
		$this->dodol_theme->render($render);
	}
	function test15(){
		$this->db->where('nav_id', 1);
		$this->db->select_max('order', 'last_order');
		$q = $this->db->get('site_nav_item');
		if($q->row()->last_order != null){
			echo $q->row()->last_order;
		}else{
			echo 'asuh';
		}
	}
	function test16(){
		$input = array("a", "b", "c", "d", "e");
		echo implode('/',$input).'<br/>';
		echo implode('/',array_slice($input, 0, -2));      // returns "c", "d", and "e"
	
	}



}