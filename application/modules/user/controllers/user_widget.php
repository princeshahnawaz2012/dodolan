<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User_widget extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function User_widget() {
		parent::__construct();
	}
	
	function login_mod_front() {
		$url = $this->uri->uri_string();
		$red = strstr($url, '/red/');
		$redi = str_replace('/red/', '', $red);
		$cururl = str_replace(site_url(), '', current_url());
		if($red || $red!=null ){
			$data['redirect'] =  $redi;
		}else{
			$data['redirect'] = $cururl;
		}
		$this->load->view('user/widget/login_mod_front_v', $data);
	}
	function user_mod(){
		$this->load->view('user/widget/user_mod_v');
	}

}