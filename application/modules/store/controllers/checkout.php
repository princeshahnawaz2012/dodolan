<?php 


if (! defined('BASEPATH')) exit('No direct script access');
/**
 * Checkout Class Controller, 
 *
 * @package store
 * @author Zidni Mubarock
 */
class Checkout extends Controller {

	//php 5 constructor

	function __construct() {
		parent::Controller();
		$this->load->library('cart');
		$this->load->library('jne');
	$this->step = $this->session->userdata('checkout_step');
	if($this->cart->total_items() == 0){
		redirect('store/cart/viewcart');
	}
	}
	
	//php 4 constructor
	
	function Checkout() {
		parent::Controller();
	}
	
	function index() {
		redirect('store/checkout/buyerinfo');
	}

	/**
	 * Buyer info Page
	 *
	 * @return Void : Page
	 * @author Zidni Mubarock
	 */		
	function buyerinfo(){
	
		if($this->cart->total_items() != 0){
			// this only get true if the cart is not empty
			$q = $this->db->get('store_country');
			$login_data = $this->session->userdata('login_data');
			if($login_data && !$this->cart->customer_info){
				// if user have login, and never fill the customer_info form  
				// for this transaction set the customer info session from user database
				$list_fields = 'first_name, id, last_name, email, address, country_id, province, city, zip, city_code, zip, mobile, phone';
				$userdata = modules::run('user/userdata', $login_data['user_id'], $list_fields);
				//	$this->cart->customer_info = $userdata;
				//	$this->cart->write_data($this->cart->customer_info) 
				//	$this->session->set_userdata($customer_info);			
				$customer_info = array('customer_info' => $userdata);
				$this->cart->write_data($customer_info);
			}
			$data = array(
				'mainLayer' => 'store/page/checkout/buyerinfo_v',
				'pT' => 'chekout - Customer Information' ,
				'cart' => modules::run('store/store_widget/smallcart'),
				'countries' => $q->result(),
				'buyer_data' => $this->cart->customer_info,
				'ship_data'  => $this->cart->shipto_info,
				'loadSide' => false,
				//'loadSide' => false
				);
			$this->theme->render($data);
			if($this->input->post('submit')){
				$this->load->library('form_validation');
				// serialize customer information
					$this->form_validation->set_rules('first_name', 'first name', 'required');
					$this->form_validation->set_rules('email', 'email', 'required');
					$this->form_validation->set_rules('country_id', 'Country', 'required');
					$this->form_validation->set_rules('city', 'City', 'required');
					$this->form_validation->set_rules('zip', 'Zip Code', 'required');
					$this->form_validation->set_rules('address', 'Address', 'required');
				if($this->input->post('register')){
					$this->form_validation->set_rules('password', 'Password', 'required');	
				}
				if($this->input->post('different_address')){
					$this->form_validation->set_rules('ship_first_name', 'first name', 'required');
					$this->form_validation->set_rules('ship_country_id', 'Country', 'required');
					$this->form_validation->set_rules('ship_city', 'City', 'required');
					$this->form_validation->set_rules('ship_zip', 'Zip Code', 'required');
					$this->form_validation->set_rules('ship_address', 'Address', 'required');
				}
				if($this->form_validation->run() == FALSE){
					$this->messages->add( validation_errors('', ''), 'warning');
					//redirect('store/checkout/buyerinfo');
					return false;
				}else{
					$this->exe_buyerinfo();
				}
				
			}
			
		}else{
				redirect('store/cart/viewcart/');
		}
		
		
		
	}
	/**
	 * Exe_buyerinfo; an execution function for buyerinfo page
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function exe_buyerinfo(){
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name'  => $this->input->post('last_name'),
			'email'      => $this->input->post('email'),
			'address'    => $this->input->post('address'),
			'country_id' => $this->input->post('country_id'),
			'province'   => $this->input->post('province'),
			'city'       => $this->input->post('city'),
			'city_code'  => $this->input->post('city_code'),
			'zip'        => $this->input->post('zip'),
			'mobile'     => $this->input->post('mobile'),
			'phone'      => $this->input->post('phone'),
			);
		//serialize shipping addres information
		$ship_to_info = array(
			'first_name' => $this->input->post('ship_first_name'),
			'last_name'  => $this->input->post('ship_last_name'),
			'address'    => $this->input->post('ship_address'),
			'country_id' => $this->input->post('ship_country_id'),
			'province'   => $this->input->post('ship_province'),
			'city'       => $this->input->post('ship_city'),
			'city_code'	 => $this->input->post('ship_city_code'),
			'mobile'	 =>	$this->input->post('ship_mobile'),
			'phone'      => $this->input->post('ship_phone'),
			'zip'        => $this->input->post('ship_zip'),
			);
		
	if(!$this->input->post('register') || $this->input->post('register') == null ){
			// if user surely they have login
			// put the data from user personal info from database to "custumer_info" session
			$ins_data = array('customer_info' => $data);
			//$this->cart->customer_info = $data;
			$this->cart->write_data($ins_data);
			
			if($this->input->post('different_address') != 1 || !$this->input->post('different_address') || $this->input->post('different_address') == null ){
				// Everything DONE !!
				// So Go to the next step "SHIPPING METHOD"
				//$this->cart->check_step['custumer_info'] = true;
				$this->cart->check_step['custumer_info'] = true;
				$this->cart->write_data();
				redirect('store/checkout/shipping_method');
			}else{
				$ship_to_data = array('shipto_info' => $ship_to_info);
				$this->cart->write_data($ship_to_data);
				// Everything DONE !!
				// So Go to the next step "SHIPPING METHOD"
				$this->session->userdata['checkout_step']['custumer_info'] = true;
				$this->session->sess_write();
				redirect('store/checkout/shipping_method');
			}
	}elseif($this->input->post('register') == 1 && !$this->session->userdata('login_data') ){
		// if user choose to register, So do the registration
		// and user absolutey not login
		$reg = modules::run('user/exe_register');
		if($reg){
			// if register success
			// fecting user data from database
			$list_fields = 'first_name, last_name, email, address, country_id, province, city, zip, city_code, zip, mobile, phone';
			$user = modules::run('user/userdata', $reg, $list_fields);
			if($user){
				// if fecthing success, system will automatically do login for this user
				$this->load->model('user/auth_m');
				$log = $this->auth_m->checkCombination($this->input->post('email'), $this->input->post('password'));
				if($log){
				// if login success so put the  userdata fecting to "customer_info" session
				$ins_data = array('customer_info' => $user);
				$this->session->set_userdata($ins_data);
				
					if($this->input->post('different_address') != 1 || !$this->input->post('different_address') || $this->input->post('different_address') == null ){
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						redirect('store/checkout/shipping_method');
					}else{
						// if the custumer choose to ship the order to different address
						// so put ship form inputed data to "ship_to_info" session
						$ship_to_data = array('shipto_info' => $ship_to_info );
						$this->session->set_userdata($ship_to_data);

						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						$this->session->userdata['checkout_step']['custumer_info'] = true;
						$this->session->sess_write();
						redirect('store/checkout/shipping_method');	
					}

				}
			}
			
		}
		else{
			$this->messages->add('this email already registered', 'warning');
			// if register not success ussualy cause;
			redirect('store/checkout/buyerinfo');
		}
	}
	
	}
	
	/**
	 * shipping_method ;
	 *
	 * @return void : page shipping_method	
	 * @author Zidni Mubarock
	 */
	function shipping_method(){	
	// only can accessed if already have customer_info data or shito_info data
	$this->bug->send(json_encode($this->cart->shipping_info));
	$this->bug->send(json_encode($this->cart->shipto_info));
	if($this->cart->customer_info || $this->cart->shipto_info){
		if($this->cart->shipto_info){
			$buyer_info = $this->cart->shipto_info;
		}else{
			$buyer_info = $this->cart->customer_info;
		}
		// if already have shipping_info fee, but customer_info city, country id change
		// and unmacth with city,country on shipping info, so delete it, and create new one;
		if($this->cart->shipping_info){
			if($this->cart->shipping_info['city'] != $buyer_info['city'] || $this->cart->shipping_info['country'] != $buyer_info['country_id']){
				$this->cart->destroy_data('shipping_info');
			}
			
		}
		
		
		$rates = false;
		// if order send to indonesia; jne will apply
		if($buyer_info['country_id'] == 100 && $buyer_info['city_code'] != null){
			$rates = modules::run('store/shipping/jne');
				/*// not really need
				if(!$this->session->userdata('shipping_info')){
					$ship_info = array('shipping_info' => array('carrier' => 'JNE',),);
					$this->cart->write_data($ship_info);
					} 
				*/
		}
		// do else here 
		$data['buyer_info'] = $buyer_info;
		$data['shipping_rates'] = $rates;
		$data['cart'] = modules::run('store/store_widget/smallcart');
		$data['mainLayer'] = 'store/page/checkout/shipping_method_v';
		
		$this->theme->render($data);
		if($this->input->post('next')){
			$this->exe_shipping_method();
		}
	}else{
		redirect('store/checkout/buyerinfo');
	}
	}
	/**
	 * exe_shipping_method
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function exe_shipping_method(){
			if($this->cart->shipto_info){
				$buyer_info = $this->cart->shipto_info;
			}else{
				$buyer_info = $this->cart->customer_info;
			}
			if(!$this->session->userdata('shipping_info') || $this->input->post('id_ship_rate')){
			$id_rate = $this->input->post('id_ship_rate');
			$shipping_rate = modules::run('store/shipping/jne', $id_rate);
				if($shipping_rate){
					redirect('store/checkout/payment');
				}else{
					return false;
				}
			}elseif(!$this->session->userdata('shipping_info') && !$this->input->post('id_ship_rate')){
				return false;
			}elseif($this->session->userdata('shipping_info') && !$this->input->post('id_ship_rate')){
				redirect('store/checkout/payment');
			}
	}
	/**
	 * payment page
	 *
	 * @return void : page
	 * @author Zidni Mubarock
	 */	
	function payment(){
	$this->bug->send(json_encode($this->cart->shipping_info));
	$this->bug->send(json_encode($this->cart->shipto_info));
	if($this->cart->shipping_info){
		$data= array(
			'mainLayer' => 'store/page/checkout/payment_v',
			'pT'        => 'Checkout - Payment Method',
			'cart'      => modules::run('store/store_widget/smallcart'),
		);
		$this->theme->render($data);
		if($this->input->post('next')){
			$this->exe_payment();
		}
		
	}else{
		redirect('store/checkout/shipping_method');
	}
	}
	/**
	 * execution for payment page
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function exe_payment(){
		$method = $this->input->post('payment_method');
		if($method || !$this->cart->payment_info ){
			$data = array(
				'method' => $method,
				 );
			$ins = array('payment_info' => $data);
			$this->cart->write_data($ins);
			//$this->session->userdata['checkout_step']['payment_info'] = true;
			//$this->session->sess_write();
			redirect('store/checkout/summary');
		
		}elseif(!$method && $this->session->userdata('payment_info')){
				redirect('store/checkout/summary');
		}else{
			return false;
		}
	}
	
	/**
	 * summary page;
	 * only can accessed when all steep of checkout passed
	 * @return void
	 * @author Zidni Mubarock
	 */
	function summary(){
		if($this->cart->payment_info){
			$rendered = array(	
				'mainLayer' => 'store/page/checkout/summary_v',
				'pT'        => 'Checkout - Order Summary',
				'cart'      => modules::run('store/store_widget/smallcart'),
				);
			$this->theme->render($rendered);
			if($this->input->post('process')){
			  $this->process();
			}
		}else{
			redirect('store/checkout/payment');
		}
		
	}
	
	/**
	 * process
	 * processor order into database and payment process
	 * @return void
	 * @author Zidni Mubarock
	 */
	function process(){
		if(!$this->cart->payment_info){
			redirect('store/checkout/summary');
		}
		if($this->session->userdata('currency')){
			$currency = $this->session->userdata('currency');
		}else{
			$currency = $this->config->item('currency');
		}
		if(!$this->session->userdata('order_id')){
		$order_id = modules::run('store/order/create_order');
		}else{
		$order_id= $this->session->userdata('order_id');
		}
		$order_data = array(
			'c_date' => date('Y-m-d H:i:s'),
			'payment_method' => $this->cart->payment_info['method'],
			'total_amount' => $this->cart->total()+$this->cart->shipping_info['fee'],
			'sub_amount' => $this->cart->total(),
			'currency' => $this->cart->currency(),
			'ship_carrier' => $this->cart->shipping_info['carrier'],
			'ship_carrier_service' => $this->cart->shipping_info['type'],
			'ship_fee' => $this->cart->shipping_info['fee'],
			'customer_note' => $this->input->post('customer_note'),
		);
		if($this->session->userdata('login_data')){
			$order_data['user_id'] = $this->session->userdata['login_data']['user_id'];
		}
		
		// serialize for order_personal_data
		$personal_data = $this->cart->customer_info;
		$personal_data['order_id'] = $order_id ;
		// serialize for order_shipto_data
		if(!$this->cart->shipto_info){
			$shipto_data = $this->cart->customer_info;
			$shipto_data['order_id'] = $order_id;
			unset($shipto_data['email']);
		}else{
			$shipto_data = $this->cart->shipto_info;
			$shipto_data['order_id'] = $order_id;	
		}
		// serialize product_sold_data
		$index = 0;
		foreach($this->cart->contents() as $item){
			$product_sold_data[$index]['id_prod'] = $item['id'];
			if(isset($item['id_attrb'])){
			$product_sold_data[$index]['id_attrb_prod'] = $item['id_attrb'];
			$product_sold_data[$index]['options'] = json_encode($item['options']);
			}
			$product_sold_data[$index]['qty'] = $item['qty'];
			$product_sold_data[$index]['order_id'] = $order_id;
			$product_sold_data[$index]['name'] = $item['name'];
			$product_sold_data[$index]['price'] = $item['price'];
			$index++;
		}
		$param = array(
			'order_data' => $order_data,
			'personal_data' => $personal_data,
			'shipto_data' => $shipto_data,
			'product_sold_data' => $product_sold_data
		);
		if(!$this->session->userdata('order_id')){
		$insert_order = modules::run('store/order/create_order', $param, $order_id);
		}else{
		$insert_order = true;	
		}
		if($insert_order){
			$data = array('order_id' => $order_id);
			$this->cart->write_data($data);
			if($this->cart->payment_info['method'] != 'paypal'){
				redirect('store/checkout/success');
			}else{
				$send = modules::run('store/order/send_order_data', $order_id);
				redirect('store/payprocessing');
			}
		
			
		}
	
	}
	/**
	 * success page
	 * will delet all extra data and cart, because order already successfully placed,
	 * @return void
	 * @author Zidni Mubarock
	 */
	function success(){
		if($this->session->userdata('order_id')){
			$order_id = $this->session->userdata('order_id');
			$send = modules::run('store/order/send_order_data', $order_id);
			if($send){
				$data['status_email'] = 'send';
			}else{
				$data['status_email'] = 'not send';
			}
			$data['mainLayer'] = 'store/page/checkout/success_v';
			$data['pT'] = 'Thank You';
			$this->session->unset_userdata('order_id');
			$this->cart->destroy_data();
			$this->cart->destroy();
			$this->theme->render($data);
		
		}else{
			redirect('store/checkout/summary');
		}
	}
	/**
	 * checkout menu, show on checkout page only
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function checkoutmenu(){
		$this->load->view('store/widget/checkout/checkout_menu');
		
	}
	
	
}	
	

