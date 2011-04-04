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
		$content = '<div class="topMenu absolute right">
				<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">Store</a>
			<ul>
				<li><a href="'.site_url('backend/store/b_product/addprod').'">Add Product</a></li>
				<li><a href="'.site_url('backend/store/b_product/listprod').'">List Product</a></li>
			</ul>
			</li>
			<li><a href="#">Article</a></li>
			<li><a href="#">Report</a></li>
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
	}
	else{
		return false;
		}
	}

}?>