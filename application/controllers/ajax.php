<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Ajax extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function Ajax() {
		parent::Controller();
	}
	
	function index() {
		
	}
	function loadmsg($segment = 'front'){
	$render['msg'] = $this->messages->get();
		if(is_array($render['msg'])){
			$data['status'] = 'on';
			$data['msg']   = $this->load->view($segment.'/msg',$render, true);
			echo json_encode($data);
		}else{
			$data['status'] = 'off';
			echo json_encode($data);	
		}
	}
	function js_showmsg(){
		echo ("
		<script>
			function loadmsg(){
			$.ajax({
			  url: '".site_url('ajax/loadmsg')."',
			  dataType: 'json',
			  success: function(data){
				if(data.status == 'on'){
					$('body').prepend(data.msg);
				}
			}
			});
			}

		setInterval('loadmsg()', 5000);
		</script>
		");
	}

}