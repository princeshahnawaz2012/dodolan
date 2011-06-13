<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Analytic extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Analytic() {
		parent::__construct();
	}
	
	function ga_chart_req(){	
		$data['email'] = $this->config->item('ga_account');
		$data['password'] = $this->config->item('ga_pass');
		$ga = $this->load->library('gapi',$data);
		$ga->requestReportData(17866436,array('date'),array('newVisits'), array('-date'),  $filter=null, $start_date=null, $end_date=null, $start_index=1, $max_results=5, 'ori');
		echo $ga->ori_data;
		return $ga->getDataArray();
		
	}
	function ga_chart_json(){
		$date = date_create_from_format('Ymd', '20110527');
	
		echo $date->format('l, F j,  Y')
		
	}

}