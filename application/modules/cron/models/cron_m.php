<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Cron_m extends CI_Model  {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function add($data =array()){
		// check that, there isn't task have create with specify parameter and time passed
		if(isset($data['parameter'])){
			$this->db->where('action', $data['action']);
			$this->db->where('parameter', $data['parameter']);
			$preq = $this->db->get('cron_task');
			if($preq->num_rows() == 0){
				$q = $this->db->insert('cron_task', $data);
				if($q){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			$q = $this->db->insert('cron_task', $data);
			if($q){
				return true;
			}else{
				return false;
			}
		}
		
		
	}
	function extract($id){
		$this->db->where('id', $id);
		$this->db->where('do_time <=', date('Y-m-d H:i:s'));
		$this->db->where('have_done', 'y');
		$q = $this->db->get('cron_task');
		if($q->num_rows() == 1){
			return $q->row();
		}
		
	}
	function call_all_task(){
		$this->db->where('do_time <=', $this->dodol->datetime());
		$this->db->where('have_done !=', 'y' );
		$q = $this->db->get('cron_task');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function set_done($id){
		$data = array(
			'have_done' => 'y'
		);
		$this->db->where('id',$id);
		$this->db->update('cron_task', $data);
		return true;
		
	}

	
}