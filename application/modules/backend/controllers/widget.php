<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Widget extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function Widget() {
		parent::Controller();
	}
	
	function topmenu() {
		$content = '<div class="topMenu">
				<ul>
			<li><a class="ui-corner-top" href="'.site_url('backend').'">Dashboard</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_order/browse/').'">Order</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_product/listprod/').'">Product</a>	</li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_collection/browse').'">Collection</a>	</li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_customer/browse/').'">Customer</a></li>
			<li><a class="ui-corner-top" href="'.site_url('backend/store/b_category/browse/').'">Category</a></li>
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
	
	//widget google analytics
	function ga_chart()
	{
		$this->load->view('backend/widget/ga_chart_v');
	}
	function ga_chart_visit_req(){
		if($this->input->post('type')){
		$ga = $this->load->library('gapi');
		$req = $ga->requestReportData(array('date'),array('visitors', 'newVisits'), array('-date'),  $filter=null, $start_date=null, $end_date=null, $start_index=1, $max_results=30, 'ori');
			if($req){
				$data = $this->ga_data_extractor($ga->getDataArray());
				$data_ext = array('status' => 'true');
				echo json_encode($data);
			}else{
				$data = array('status' => 'error');
				echo json_encode($data);
			}
			
		}
	}
	function ga_data_extractor($gadata){
		
		$visitors =  array();
		$newVisits = array();
		// visitors
		foreach($gadata as $dt => $datval){
			$date = date_create_from_format('Ymd', $dt);
			$str_date = $date->format('l, F j,  Y');
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