<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_order extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/order_m');
		modules::run('user/auth/userRoleCheck', 'owner');
	}
	
	//php 4 constructor
	function B_order() {
		parent::__construct();
	}
	
	function index() {
		$data['directLayer'] = 'this is halaman order';
		$this->dodol_theme->render($data, 'back');
	}
	
	function browse(){
		$this->load->library('barock_page');
		$limit = 20;
		$param = $this->uri->uri_to_assoc();
		if(!isset($param['page'])){
			$param['page'] = 0;
		}
		if(!isset($param['status'])){
			$param['status'] = false;
		}
		if(!isset($param['q'])){
			$param['q'] = false;
		}
		
		if($param['page']){
			$start = ($param['page'] - 1)* $limit;
		}else{
			$start = 0;
		}
		
		$conf = array(
			'start' 	=> $start,
			'end'   	=> $limit,
			'status' 	=> $param['status'],
			'query' 	=> $param['q'],
			);
		
		//$prods = $this->product_m->getListProd($conf);
		$query = $this->order_m->browse_order($conf);
		if($query){
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		$confpage = array(
			'target_page' 	=> $target_url,
			'num_records' 	=> $query['number_rec'],
			'num_link'	  	=> 5,
			'per_page'   	=> $limit,
			'cur_page'   	=> $param['page']
			);
			
		$this->barock_page->initialize($confpage);
		}
		$data['orders']    	= $query['orders'];
		$data['pT']     	= $query['number_rec'];
		$data['mainLayer'] 	='backend/page/store/order/browse_order_v';
		$data['asuh'] 		= $query['number_rec'];
		$this->dodol_theme->render($data, 'back');
		
	}
	function test_browse(){
		$this->load->library('barock_page');
		$url = $this->uri->uri_to_assoc();
		$limit = ($limit = element('limit', $url)) ? $limit : 20;
		$page  = ($page = element('page', $url)) ? $page : 1;
		$start = ($page == false) ? ($page-1)*$limit : 0 ;
		$q_conf = array('start' => $start, 'limit' => $limit);
		if($query = $this->order_m->browse($q_conf)):
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		$confpage = array(
			'target_page' 	=> $target_url,
			'num_records' 	=> $query['num_rec'],	
			'num_link'	  	=> 5,
			'per_page'   	=> $limit,
			'cur_page'   	=> $page
			);
			
		$this->barock_page->initialize($confpage);
		endif;
		$data['orders']    	= $query['result'];
		$data['pT']     	= $query['num_rec'];
		$data['mainLayer'] 	='backend/page/store/order/browse_order_v';
		$this->dodol_theme->render($data, 'back');
		
	}
	function view(){
		$id = $this->uri->segment(5);
		$data = modules::run('backend/store/b_order/getorder_byid', $id);
		$order  = $data['order_data'];
		$render['data_personal'] = $data['personal_data'];
		$render['data_order'] = $order;
		$render['data_prodsold'] = $data['prodsold_data'];
		$render['data_shipto'] = $data['shipto_data'];
		$render['order_history'] = $this->order_m->get_history_by($id);
		$render['pageTool'] = modules::run('backend/store/b_order/updater_form', $order->id, $order->status);
		$render['pH'] = 'Order No. '.$order->id;
		$render['mainLayer'] 	='backend/page/store/order/view_v';
		$this->dodol_theme->render($render, 'back');
	}
	function updater_form($id_order, $current){
		$render['id'] = $id_order;
		$render['current'] = $current;
		$this->load->view('backend/page/store/order/updater_form_v', $render);
		if ($this->input->post('update_status')){
			$update = modules::run('store/order/update_status', $id_order, $this->input->post('new_status'));
			$this->messages->add('Success Update Order #'.$id_order.' Status to '.$this->input->post('new_status'), 'success');
			redirect(current_url());
		}
	}
	function delete(){
		$id = $this->uri->segment(5);
		if($this->order_m->delete($id)):
		$this->messages->add('Success Delete Order with number '.$id, 'success');
		redirect('backend/store/b_order/browse');
		else:
		$this->messages->add('failed Delete Order with number '.$id, 'error');
		redirect('backend/store/b_order/browse');
		endif;
		
	}
	function getorder_byid($id){
		$order = $this->order_m->getall_orderdata($id);
		if($order){
			return $order;
		}else{
			return false;
		}
		
	}
	

}