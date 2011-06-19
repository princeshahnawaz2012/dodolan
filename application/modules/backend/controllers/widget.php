<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Widget extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Widget() {
		parent::__construct();
	}
	
	function topmenu() {
		$content = '<div class="topMenu">
				<ul>
			<li><a class="ui-corner-top" href="'.site_url('backend').'">Dashboard</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_order/browse/').'">Order</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_product/listprod/').'">Product</a>	</li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_category/browse/').'">Product Category</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_collection/browse').'">Collection</a>	</li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_customer/browse/').'">Customer</a></li>

			<li><a class="ui-corner-top" href="'.site_url('backend/page/b_page/browse').'">Page</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/nav/b_nav/browse').'">Navigation</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/conf/b_conf/browse').'">Configuration</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/modularizer/b_modularizer/browse').'">Widget</a></li>
			<div class="clear"></div>
				</ul>
		
		</div>';
		$print = modules::run('user/auth/backAuthorize', 'owner', $content);
		return $print;
	}
	function backUserWid(){
		if($this->session->userdata('login_data') && isset($this->session->userdata['login_data']['role']) == 'owner'){
			$user = modules::run('user/profiledata',$this->session->userdata('backend_user_id'));
			$content ='<div class="grid_250 right">
					<div class="backUserWid">
						<div class="u_image left">
						<img src="http://a0.twimg.com/profile_images/1102581020/image_reasonably_small.jpg" height="32" alt="'.$user->f_name.'" />
						</div>
						<div class="u_info left">
						<span>'.$user->f_name.'</span> | <span>Setting</span> | <span>'.anchor('user/auth/backend_logout', 'logout').'</span>
						</div>
						<div class="clear"></div>
			
					</div>
				</div>';
			return $content;
		}else{
			return false;
		}
	}
	
	//widget main statictic site 
	
	function main_statistic(){
		// get the total order
		$this->db->select('id');
		$q = $this->db->get('store_order');
		$num_order = $q->num_rows();
		
		// get the total amount order
		// set to get the only order which have been ship
		// $this->db->where('order_status');
		
		$this->db->select_sum('sub_amount');
		$this->db->where('c_date <' , date("Y-m-d"));
		$this->db->where('c_date >=' , date("Y-m-d", strtotime("-1 weeks")));
		$week = $this->db->get('store_order');
		$lastweek = $week->row()->sub_amount;
		
		$this->db->select_sum('sub_amount');
		$this->db->where('c_date <' , date("Y-m-01"));
		$this->db->where('c_date >=' , date("Y-m-01", strtotime("-1 months")));
		$month = $this->db->get('store_order');
		$lastmonth = $month->row()->sub_amount;
		
		$this->db->select_sum('sub_amount');
		$this->db->where('c_date <' , date("Y-m-d"));
		$this->db->where('c_date >=' , date("Y-m-d", strtotime("-1 days")));
		$yester = $this->db->get('store_order');
		$yesterday = $yester->row()->sub_amount;
		
		$this->db->select_sum('sub_amount');
		$this->db->where('c_date >=' , date("Y-m-d"));
		$this->db->where('c_date <=' , date("Y-m-d 23:59:59"));
		$day = $this->db->get('store_order');
		$today = $day->row()->sub_amount;
		
		$this->db->select_sum('sub_amount');
		$q = $this->db->get('store_order');
		$total = $q->row()->sub_amount;
		
		$data['num_order'] = $num_order;
		$data['test'] = date("Y-m-d", strtotime("-1 months"));
		$data['omzet'] = array(
			'lastmonth' => $this->cart->show_price($lastmonth),
			'lastweek' => $this->cart->show_price($lastweek),
			'yesterday' => $this->cart->show_price($yesterday),
			'today' => $this->cart->show_price($today),
			'total' => $this->cart->show_price($total),
		);
		
		$this->load->view('backend/widget/main_statistic_v', $data);
	}
	
	//widget google analytics
	function ga_chart()
	{
		$this->load->view('backend/widget/ga_chart_v');
	}
	function ga_chart_visit_req(){
		if($this->input->post('type')){
		$ga = $this->load->library('gapi');
		$req = $ga->requestReportData(array('date'),array('visitors', 'newVisits'), array('-date'),  $filter=null, $start_date=null, $end_date=null, $start_index=1, $max_results=50, 'ori');
			if($req){
				$data = $this->ga_data_extractor($ga->getDataArray());
				$data_ext = array('status' => 'true');
			}else{
				$data = array('status' => 'error');
			}
			echo json_encode($data);
		}
	}
	
	function ga_data_extractor($gadata){
		$visitors =  array();
		$newVisits = array();
		// visitors
		foreach($gadata as $dt => $datval){
			list($year, $month, $day) = sscanf($dt, '%04d%02d%02d');
			$date = new DateTime($year.'-'.$month.'-'.$day);

			$str_date = $date->format('l, F j,  Y');
			//$date = date_create_from_format('Ymd', $dt);
			//$str_date = $dt;
			$v = array('date' => $str_date, 'value' => $datval['ga:visitors']);
			$nv = array('date' => $str_date, 'value' => $datval['ga:newVisits']);
			array_push($visitors, $v);
			array_push($newVisits, $nv);	
		}
		$return['visitors'] = $visitors;
		$return['newVisits'] = $newVisits;
		return $return;
	}
		

}