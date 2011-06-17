<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Cron extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('cron/cron_m');
	}
	function index(){
	
	}
	function run(){
		if(	$all_task = $this->cron_m->call_all_task()):
			foreach($all_task as $task){
				$args = array();
				foreach($this->dodol->jsonToArray($task->parameter) as $prm){
					array_push($args, $prm);
				}
				$run = $this->exec($task->action, $args);
				if($run){
					$this->cron_m->set_done($task->id);
					echo 'success';
				}else{
					echo 'failed';
				}
			}
		endif;
	}
	private function exec($module, $args){
			$method = 'index';
			if(($pos = strrpos($module, '/')) != FALSE) {
				$method = substr($module, $pos + 1);		
				$module = substr($module, 0, $pos);
			}
			if($class = modules::load($module)) {
				if (method_exists($class, $method))	{
					ob_start();
					$output = call_user_func_array(array($class, $method), $args);
					$buffer = ob_get_clean();
					return ($output !== NULL) ? $output : $buffer;
				}
			}
			log_message('error', "Module controller failed to run: {$module}/{$method}");
	}
	function add($action, $parameter=false,$time){
		$data['action'] = $action;
		$data['do_time'] = $time;
		if($parameter){
			$data['parameter'] = $this->dodol->arrayToJson($parameter);
		}
		return $this->cron_m->add($data);
	}
	function test(){
		$var = 'its work';
		return $var;
	}
	
}