<?php 


if (! defined('BASEPATH')) exit('No direct script access');
/**
 * Checkout Class Controller, 
 *
 * @package store
 * @author Zidni Mubarock
 */
class Checkout extends MX_Controller {

	//php 5 constructor

	function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('jne');
		$this->step = $this->session->userdata('checkout_step');
	
		if($this->cart->total_items() == 0){
			redirect('store/cart/viewcart');
		}
	}
	
	//php 4 constructor
	
	function Checkout() {
		parent::__construct();
	}
	
	function index() {
		redirect('store/checkout/buyerinfo?tpl=checkout');
	}
	function summary_cart(){
	

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
			$this->load->view('store/misc/checkout/summary_cart_v', $data);
		
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
				$list_fields = 'first_name, id, last_name, email, address, country_id, province, city, zip, city_code, zip, mobile, phone';
				$userdata = modules::run('store/customer/getByUser', $login_data['user_id'], $list_fields);
				$customer_info = array('customer_info' => $userdata);
				$this->cart->write_data($customer_info);
			}
			$data = array(
				'mainLayer' => 'store/page/checkout/buyerinfo_v',
				'pT' => 'chekout - Customer Information' ,
				'cart' => modules::run('store/checkout/summary_cart'),
				'countries' => $q->result(),
				'buyer_data' => $this->cart->customer_info,
				'ship_data'  => $this->cart->shipto_info,
				//'loadSide' => false
				);
			$this->dodol_theme->render($data);
		
			if($this->input->post('submit')){
				/*
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
				*/
					$this->exe_buyerinfo();
				//}
				
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
	
		// case 1
		// user is defenitely LOGIN
		if($this->session->userdata('login_data') ){
		
			// FLOW OPERATION : all input data from field personal info 
			// will update the customer_store base on current logged_in user
			
			$login_data = $this->session->userdata('login_data');
			$getId = modules::run('store/customer/getByUser', $login_data['user_id']);
			$update = modules::run('store/customer/exe_updateById', $getId['id'], $data);
			//if update store_customer succes, fect back it, and put to cusomer_info session
			if($update == true){
				$list_fields = 
				'first_name, last_name, email, id, address, country_id, province, city, zip, city_code, zip, mobile, phone';
				$customer_data = modules::run('store/customer/getById', $getId['id'], $list_fields);
				$ins_data = array('customer_info' => $customer_data);
				$this->cart->write_data($ins_data);
				if($this->input->post('different_address') != 1 || !$this->input->post('different_address') || $this->input->post('different_address') == null ){
					// Everything DONE !!
					// So Go to the next step "SHIPPING METHOD"
					//$this->cart->check_step['custumer_info'] = true;
					$this->cart->check_step['custumer_info'] = true;
					$this->cart->write_data();
					redirect('store/checkout/shipping_method?tpl=checkout');
				}else{
					$ship_to_data = array('shipto_info' => $ship_to_info);
					$this->cart->write_data($ship_to_data);
					// Everything DONE !!
					// So Go to the next step "SHIPPING METHOD"
					$this->session->userdata['checkout_step']['custumer_info'] = true;
					$this->session->sess_write();
					redirect('store/checkout/shipping_method?tpl=checkout');
				}
				
			}
			// if unsuccess, it's caused by, already other registerd user or customer with email inputed
			else{
				$this->messages->add('you cannot use <strong>'.$data['email'].'</strong>, it\'s already registered ', 'warning');
				// if register not success ussualy cause;
				redirect('store/checkout/buyerinfo?tpl=checkout');
			}
			
			
			
		}
		// case 2
		// user not login and choose to register
		elseif(!$this->session->userdata('login_data') && $this->input->post('register') == 1){
			// FLOW OPERATION 
			// 1. User will Register with inputed data
			// 2. create store_customer data for this new user
			// 3. do login
			$data['password'] = $this->input->post('password');
			$data['gender']   = $this->input->post('gender');
			$data['birthday'] = $this->input->post('birthday');
			$reguser = modules::run('user/exe_register', $data);
			// if register success
			if($reguser){
				// do login
				$auth = $this->load->model('user/auth_m');
				$auth->checkCombination($data['email'], $data['password']);
				// unset unused data, kep clean the array $data;
				unset($data['password']);
				unset($data['gender']);
				unset($data['birthday']);
				$data['user_id'] = $reguser;
				// create store_customer data for this user
				$new_customer = modules::run('store/customer/exe_create',$data);
				if($new_customer){
					// fecth back the new_customer
					$list_fields = 
					'first_name, last_name, email, id, address, country_id, province, city, zip, city_code, zip, mobile, phone';
					$customer_data = modules::run('store/customer/getById', $new_customer, $list_fields);
					$ins_data = array('customer_info' => $customer_data);
					$this->cart->write_data($ins_data);
					if($this->input->post('different_address') != 1 || !$this->input->post('different_address') || $this->input->post('different_address') == null ){
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						//$this->cart->check_step['custumer_info'] = true;
						$this->cart->check_step['custumer_info'] = true;
						$this->cart->write_data();
						redirect('store/checkout/shipping_method?tpl=checkout');
					}else{
						$ship_to_data = array('shipto_info' => $ship_to_info);
						$this->cart->write_data($ship_to_data);
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						$this->session->userdata['checkout_step']['custumer_info'] = true;
						$this->session->sess_write();
						redirect('store/checkout/shipping_method?tpl=checkout');
					}
				}
				
			}
			// if unsuccess, alredy email registerd
			else{
				$this->messages->add('you cannot use <strong>'.$data['email'].'</strong>, it\'s already registered ', 'warning');

				redirect('store/checkout/buyerinfo?tpl=checkout');
			}
			
			
		}
		//case 3
		//user not login and not choose to register
		elseif(!$this->session->userdata('login_data') && $this->input->post('register') != 1 ){
		// FLOW OPERATION
		// 1. check the email, is there on user table 
		// 2. check the email, is there on store_customer table
		
		$u_m = $this->load->model('user/user_m');
		$c_m = $this->load->model('store/customer_m');	
		$is_user = $u_m->get_userdata_by_email($data['email']);
		$is_customer = $c_m->getByEmail($data['email']);
		// if email already registered
		if($is_user){
			$this->messages->add('email '.$data['email'].' is already registered, have you register here before ? why you don\'t try to sign in', 'warning');
			redirect('store/checkout/buyerinfo?tpl=checkout');
		}
		// if the email is not registered
		else{
			// if the email is already taken by other customer
			if($is_customer){
					// update the customer data;
					$upd_data = modules::run('store/customer/exe_updateById', $is_customer->id, $data);
					$list_fields = 
					'first_name, last_name, email, id, address, country_id, province, city, zip, city_code, zip, mobile, phone';
					$customer_data = modules::run('store/customer/getById', $is_customer->id, $list_fields);
					$ins_data = array('customer_info' => $customer_data);
					$this->cart->write_data($ins_data);
					
					if($this->input->post('different_address') != 1 || !$this->input->post('different_address') || $this->input->post('different_address') == null ){
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						//$this->cart->check_step['custumer_info'] = true;
						$this->cart->check_step['custumer_info'] = true;
						$this->cart->write_data();
						redirect('store/checkout/shipping_method?tpl=checkout');
					}else{
						$ship_to_data = array('shipto_info' => $ship_to_info);
						$this->cart->write_data($ship_to_data);
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						$this->session->userdata['checkout_step']['custumer_info'] = true;
						$this->session->sess_write();
						redirect('store/checkout/shipping_method?tpl=checkout');
					}
			}
			// if the email not yet taken by other customer
			else{
				$new_customer = modules::run('store/customer/exe_create',$data);
				if($new_customer){
					// fecth back the new_customer
					$list_fields = 
					'first_name, last_name, email, id, address, country_id, province, city, zip, city_code, zip, mobile, phone';
					$customer_data = modules::run('store/customer/getById', $new_customer, $list_fields);
					$ins_data = array('customer_info' => $customer_data);
					$this->cart->write_data($ins_data);
					if($this->input->post('different_address') != 1 || !$this->input->post('different_address') || $this->input->post('different_address') == null ){
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						//$this->cart->check_step['custumer_info'] = true;
						$this->cart->check_step['custumer_info'] = true;
						$this->cart->write_data();
						redirect('store/checkout/shipping_method?tpl=checkout');
					}else{
						$ship_to_data = array('shipto_info' => $ship_to_info);
						$this->cart->write_data($ship_to_data);
						// Everything DONE !!
						// So Go to the next step "SHIPPING METHOD"
						$this->session->userdata['checkout_step']['custumer_info'] = true;
						$this->session->sess_write();
						redirect('store/checkout/shipping_method?tpl=checkout');
					}
				}
			}
		}

		}
		// case 4
		// common error
		else{
			
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
		}
		// do else here 
		$data['pT'] = 'Checkout - Shipping Method';
		$data['buyer_info'] = $buyer_info;
		$data['shipping_rates'] = $rates;
		$data['cart'] = modules::run('store/checkout/summary_cart');
		$data['mainLayer'] = 'store/page/checkout/shipping_method_v';
		
		$this->dodol_theme->render($data);
		if($this->input->post('next')){
			$this->exe_shipping_method();
		}
	}else{
		redirect('store/checkout/buyerinfo?tpl=checkout');
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
					redirect('store/checkout/payment?tpl=checkout');
				}else{
					return false;
				}
			}elseif(!$this->session->userdata('shipping_info') && !$this->input->post('id_ship_rate')){
				return false;
			}elseif($this->session->userdata('shipping_info') && !$this->input->post('id_ship_rate')){
				redirect('store/checkout/payment?tpl=checkout');
			}
	}
	/**
	 * payment page
	 *
	 * @return void : page
	 * @author Zidni Mubarock
	 */	
	function payment(){

	if($this->cart->shipping_info){
		$data= array(
			'mainLayer' => 'store/page/checkout/payment_v',
			'pT'        => 'Checkout - Payment Method',
			'cart'      => modules::run('store/checkout/summary_cart'),
		);
		$this->dodol_theme->render($data);
		if($this->input->post('next')){
			$this->exe_payment();
		}
		
	}else{
		redirect('store/checkout/shipping_method?tpl=checkout');
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
			redirect('store/checkout/summary?tpl=checkout');
		
		}elseif(!$method && $this->session->userdata('payment_info')){
				redirect('store/checkout/summary?tpl=checkout');
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
	
		$this->load->library('recaptcha');
		if($this->cart->payment_info){
				$this->bug->send(json_encode($this->cart->customer_info));
				$this->bug->send(json_encode($this->cart->shipto_info));
			$rendered = array(	
				'mainLayer' => 'store/page/checkout/summary_v',
				'pT'        => 'Checkout - Order Summary',
				'cart'      => modules::run('store/checkout/summary_cart'),
				);
			$this->dodol_theme->render($rendered);
			if($this->input->post('process') && $this->recaptcha->validate()){
			  $this->process();
			}
		}else{
			redirect('store/checkout/payment?tpl=checkout');
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
			redirect('store/checkout/summary?tpl=checkout');
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
			'customer_id' => $this->cart->customer_info['id'],
			'payment_method' => $this->cart->payment_info['method'],
			'total_amount' => $this->cart->total()+$this->cart->shipping_info['fee'],
			'sub_amount' => $this->cart->total(),
			'currency' => $this->cart->currency(),
			'ship_carrier' => $this->cart->shipping_info['carrier'],
			'ship_carrier_service' => $this->cart->shipping_info['type'],
			'ship_fee' => $this->cart->shipping_info['fee'],
			'customer_note' => $this->input->post('customer_note'),
			'status' => 'pending',
			'uniq_id' => md5(uniqid(mt_rand(), true)),
			
		);
		if($this->session->userdata('login_data')){
			$order_data['user_id'] = $this->session->userdata['login_data']['user_id'];
		}
		// serialize for order_shipto_data
		if(!$this->cart->shipto_info){
			$shipto_data = $this->cart->customer_info;
			$shipto_data['order_id'] = $order_id;
			unset($shipto_data['email']);
			unset($shipto_data['id']);
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
			$this->dodol_theme->render($data);
		
		}else{
			redirect('store/checkout/summary?tpl=checkout');
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
		
	}/**
	 * This Function, to check that email which user input, allready on site database or not
	 *
	 * @return json
	 * @author Zidni Mubarock
	 */
	function ajax_checkmail(){
	    if($this->input->post('email')){
	        $email = $this->input->post('email');
     	    $this->db->where('email', $email);
    	    $q = $this->db->get('user');
    	    if($q->num_rows() > 0){
    	        $data['hv_user'] = true;
    	        echo json_encode($data);
    	    }else{
    	        $data['hv_user'] = false;
        	    echo json_encode($data);
    	    }
        }
	}
	
	
}	
	

