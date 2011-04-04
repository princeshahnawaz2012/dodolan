<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Newsletter_m extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	//php 4 constructor
	function Newsletter_m() {
		parent::Model();
	}
	
	function add_member($email, $name) {
		$this->db->where('email', $email);
		$q = $this->db->get('newsletter_member');
		if($q->num_rows() == 0){
			$data =array(
				'email' => $email,
				'name' => $name
				);
			$q = $this->db->insert('newsletter_member', $data);
			if($q){
				return true;
			}else{
				return false;
			}
		}else{
			$data['have_account'] = true;
			return $data;
		}
		
	}

}?>