<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_order extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->load->model('store/order_m');
	}
	
	//php 4 constructor
	function B_order() {
		parent::Controller();
	}
	
	function index() {
		$data['directLayer'] = 'this is halaman order';
		$this->theme->render($data, 'back');
	}
	
	function browse(){
		$this->load->library('barock_page');
		$limit = 5;
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
			'start' => $start,
			'end'   => $limit,
			'status' => $param['status'],
			'query' => $param['q'],
			);
		
		//$prods = $this->product_m->getListProd($conf);
		$query = $this->order_m->browse_order($conf);
		if($query){
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		$confpage = array(
			'target_page' => $target_url,
			'num_records' => $query['number_rec'],
			'num_link'	  => 5,
			'per_page'   => $limit,
			'cur_page'   => $param['page']
			);
			
		$this->barock_page->initialize($confpage);
		}
		$data['orders'] = $query['orders'];
		$data['pT'] = $query['number_rec'];
		$data['mainLayer'] ='backend/page/store/order/browse_order_v';
		$data['asuh'] = $query['number_rec'];
		$this->theme->render($data, 'back');
		
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