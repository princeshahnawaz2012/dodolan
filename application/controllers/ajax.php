<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Ajax extends MX_Controller {

	function __construct() {
		parent::__construct();
	
	}
	function post() {
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->input->_clean_input_data($_GET);
		$exe = $this->input->get('exe');
 		echo modules::run($exe);
	}
	function loadmsg(){
	$render['msg'] = $this->messages->get();
		if(is_array($render['msg'])){
			$data['status'] = 'on';
			$data['msg']   = $render['msg'];
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
						var msg = data.msg
						$.each(msg, function(index, value){	
							if(value.length > 0){
								if(value.length > 1 ){
										var content = '';
										$.each(value, function(key, val){
											content += val+'<br/>';
										});
								}
								else{
									var content = value;
								}
								$.jGrowl(content, {position: 'center', header: index, theme: index });
							}
						});
								
					}	
				},
				global : false,
				
			});
			}
			function retrive_msg(){
				$(document).ajaxStop(function(){
					loadmsg();
				});
			}
			$(document).ready(function(){
				retrive_msg();
				loadmsg();
			});
	
		</script>
		");
	}

}
