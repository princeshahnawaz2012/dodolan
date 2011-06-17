<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class b_customer extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mod = $this->load->model('store/customer_m');
	}
	
	//php 4 constructor
	function b_customer() {
		parent::__construct();
	}
	
	function index() {
		redirect('backend/store/b_customer/browse');
	}

	function browse(){
		$this->load->library('barock_page');
		$limit = 2;
		$param = $this->uri->uri_to_assoc();
		if(!isset($param['page'])): $param['page'] = 0; endif;
		if(!isset($param['q'])): $param['q'] = false; endif;
		if(!isset($param['reg'])):$param['reg'] = false; endif;
		if($param['page']): $start = ($param['page'] - 1)* $limit; else :$start = 0; endif;

		
		$param['start'] = $start;
		$param['end']   = $limit;
		$param['query'] = $param['q'];
		
		$query = $this->mod->browse($param);
		if($query){
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		$confpage = array(
			'target_page' => $target_url,
			'num_records' => $query['num_rec'],
			'num_link'	  => 5,
			'per_page'   => $limit,
			'cur_page'   => $param['page']
			);
			
		$this->barock_page->initialize($confpage);
		}
		//module filter
		$filter_mod = '<div class="box2 grid_400 mb20 right">
			<form action="'.current_url().'" method="POST">
			<input type="text" name="q" value="Type a Name or Email to start Search" class="text-input grid_300 mr10"> <input type="submit" name="submit" value="Search" id="submit" class="button">
			</form>
		</div>';
		
		$data['lists'] = $query['result'];
		$data['mainLayer'] = 'backend/page/store/customer/browse_v';
		$data['pH'] = 'Customer' ;
		$data['pageTool'] = $filter_mod;
		$this->dodol_theme->render($data, 'back');
		
		// serach action 
		if($this->input->post('q')):
			if($this->input->post('q') != 'Type a Name or Email to start Search'){
				$filter['q'] = $this->input->post('q');
			}
			$outputFilter = $this->uri->assoc_to_uri($filter);
			redirect('backend/store/b_customer/browse/'.$outputFilter);
		endif;


	}
	function getByID($id){
		
	}
	function edit($id){
		
	}
	function delete($id){
		
	}

}