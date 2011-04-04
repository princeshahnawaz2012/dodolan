<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class WP extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function WP() {
		parent::Controller();
	}
	
	function index() {
		$q = $this->db->get('wp_posts');
		foreach($q->result() as $post){
			$this->db->where('comment_post_ID', $post->ID);
			$q2 = $this->db->get('wp_comments');
			echo '<h1>'.$q2->num_rows().'</h1>';
			echo $post->post_title.'<hr/>';
			$data = array(
				'comment_count' => $q2->num_rows(),
			);
			$this->db->where('ID', $post->ID);
			$this->db->update('wp_posts', $data);
		}
		
	}

}