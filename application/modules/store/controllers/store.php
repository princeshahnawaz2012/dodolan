<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/store_m');
	}
	
	//php 4 constructor
	function Store() {
		parent::__construct();
	}
	
	function index() {
		$data['loadSide'] = false;
		$data['data'] = 'asuh';
		$this->dodol_theme->render($data);
	}

	function request_restock($data=array()){
		$this->load->view('store/misc/store/request_restockform_v', $data);
	}
	function exe_requestRestock(){
		$data = array(
			'email'=>$this->input->post('email'),
			'name'=> $this->input->post('name'),
			'id_prod' => $this->input->post('id_prod'),
				);
		if($this->input->post('id_attrb')){
		$data['id_attrb'] = $this->input->post('id_attrb');
		}
		$q = $this->store_m->add_request_restock($data);
		if($q){
			$this->messages->add('your request successfully added', 'success');
		}else{
			$this->messages->add('you seem already request restock from this product');
		}
	}
	function ajax_requestRestock(){
		if($this->input->post('email')){
		$ins_data = array(
			'email'=>$this->input->post('email'),
			'name'=> $this->input->post('name'),
			'id_prod' => $this->input->post('id_prod'),
			'c_date' => date('Y-m-d H:i:s'),
				);
		if($this->input->post('id_attrb')){
		$ins_data['id_attrb'] = $this->input->post('id_attrb');
		}
		$q = $this->store_m->add_request_restock($ins_data);
		if($q){
			$data['status'] = 'on';
			$data['msg']    = 'your request successfully added';
			echo json_encode($data);
		}else{
			$data['status'] = 'off';
			$data['msg']    = 'you seem already request restock from this product';
			echo json_encode($data);
		}
	}
	}
	function getCountry($id){
	return	$this->store_m->get_country($id);
	}
	function payprocessing(){
		$id = $this->session->userdata('order_id');
		$data['form'] = modules::run('paypal/generate_form', $id);
		$data['loadSide'] = false;
		$data['mainLayer'] = 'store/page/checkout/payProcessing_v';
		$this->dodol_theme->render($data);
	}
	function carrier_cont(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->input->_clean_input_data($_GET);
		$state = $this->input->get('cr');
		$this->load->helper('store/carrier');
		return carrier_helper::load($state);
	}

}?>