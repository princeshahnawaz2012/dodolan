<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store_widget extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/category_m');
	}
	
	//php 4 constructor
	function Store_widget() {
		parent::__construct();
	}
	function index(){
		
	}
	function categoryMenu($id=0){
		$q = modules::run('store/category/catlistmenu', $id);
		$data['menu'] = $q;
		$this->load->view('store/widget/category/categoryMenu_v', $data);
	}
	function currency(){
		if($this->router->class != 'checkout'){
		if($this->input->post('currency')){
			if($this->input->post('currency') != $this->config->item('currency')){
			  $from   = $this->config->item('currency'); /*change it to your required currencies */
	        $to     = $this->input->post('currency');
	        $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
	        $handle = @fopen($url, 'r');
	        if ($handle) {
	            $result = fgets($handle, 4096);
	            fclose($handle);
	        }
	        $allData = explode(',',$result); /* Get all the contents to an array */
	        $rate = $allData[1];
	        if($result){
	        	
	        
			$data = array('currency' => $this->input->post('currency'), 'rate' => $rate);
			$this->session->set_userdata($data);
			}
			}else{
				$this->session->unset_userdata('currency');
				$this->session->unset_userdata('rate');
			}
			modules::run('store/store_cart/refresh_cart');
			redirect(current_url());
		}
		
		$this->load->view('store/widget/cart/currency_v');
	}
	}
	function cart(){
		
		$this->load->library('cart');
		$data = array(
			'total_price' => $this->cart->total(),
			'total_item' => $this->cart->total_items()
			);
		$this->load->view('store/widget/cart/cart_v', $data);
		
	}
	function smallcart(){
		$this->load->library('cart');
		$data = array(
			'items' => $this->cart->contents(),
			'shipping_info' => $this->session->userdata('shipping_info')
			);
		if(!$this->session->userdata('ship_to_info')){
			$data['buyer_info'] = $this->session->userdata('customer_info');
		}else{
			$data['buyer_info'] = $this->session->userdata('ship_to_info');
		}
		$this->load->view('store/widget/cart/smallcart_v', $data);
	}


}