<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_collection extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function B_collection() {
		parent::__construct();
	}
	
	function index() {
		
	}
	function create(){
		$passdata = array();
		//$q = modules::run('store/collection/exe_create', $passdata);
		$data['mainLayer'] = 'backend/page/store/collection/create_v';
		$data['pH']   		= 'Create New Collection';
		$this->dodol_theme->render($data, 'back');
		if($this->input->post('submit')){
			$passdata['name'] = $this->input->post('title');
			$passdata['description'] = $this->input->post('description');
			$passdata['img_file'] = 'img_file';
			$passdata['p_date'] = $this->input->post('p_date');
			$q = modules::run('store/collection/exe_create', $passdata);
			if($q){
				$this->messages->add('Success Create collection with name '.$passdata['name'], 'success');
				redirect('backend/store/b_collection/detail/'.$q['id']);
			}else{
				$this->messages->add('Failed Create collection with name '.$passdata['name'], 'warning');
				redirect('backend/store/b_collection/browse');
			}
		}
	}
	function detail(){
		$id = $this->uri->segment(5);
		$q = modules::run('store/collection/exe_getById', $id);
		if(!$q){
			//redirect to not found;
		}
		$data['data'] = $q;
		$coll_data = $q['main'];
		$data['pH'] = 'collection : ' .$coll_data->name;
		$data['mainLayer'] = 'backend/page/store/collection/detail_v';
		$this->dodol_theme->render($data, 'back');
	}
	// dependecy for function detail
	function ajax_search_prod(){
		$this->load->model('store/product_m');
		$q_post = $this->input->post('q_post');
		$coll_id = $this->input->post('coll_id');
		$final_item ='';
		if($q_post){
		// exception item initialize
		$coll = modules::run('store/collection/exe_getById', $coll_id);
		$ref = $coll['ref'];
		if($ref->num_rows() > 0){
			$except_item = array();
			foreach($ref->result() as $item){
				array_push($except_item, $item->product_id);
			}	
			$this->db->where_not_in('id', $except_item);
		}
		// illegal query outside model :) heheheh
		$this->db->like('name', $q_post);
		$this->db->or_like('sku', $q_post);
		$prods = $this->db->get('store_product');
		
		
			if($prods->num_rows() > 0){
				foreach($prods->result() as $prod){
					
					$img = modules::run('store/product/prodImg', $prod->id);
					$final_item .= '
					<div class="coll_item mb10" id="'.$prod->id.'">
						<div class="img_prod left mr5"><img src="'.site_url('thumb/show/70-30-crop/dir/assets/product-img/'.$img->path).'"/></div>
						<div class="detail_prod left">
						'.$prod->name.'
						</div>
						<div class="clear"></div>
						<div class="horline"></div>
						<div class="clear"></div>
					</div>';
				}
					$output['prods'] = $final_item;
					$output['status'] = 'success';
			}else{
					$output['status'] = 'failed';
			}
		
		}else{
			$output['status'] = 'failed';
		}
			echo json_encode($output);
	}
	function ajx_addItem(){
		if($this->input->post('idProd')){
			$add = modules::run('store/collection/exe_additem', $this->input->post('idColl'), $this->input->post('idProd'));
			if($add){
				// initialize product by product_id
				$param = array(
					'id' => $this->input->post('idProd'),
					);	
				$q = modules::run('store/product/detProd', $param);
				$p = $q['prod'];
				$img = modules::run('store/product/prodImg', $this->input->post('idProd'));
				$output = '
				<div class="coll_item mb10" id="'.$add.'">
					<div class="img_prod left mr5"><img src="'.site_url('thumb/show/70-30-crop/dir/assets/product-img/'.$img->path).'"/></div>
					<div class="detail_prod left">
					'.$p->name.'
					</div>
					<div class="clear"></div>
					<div class="horline"></div>
					<div class="clear"></div>
				</div>';
				$data = array('prod' => $output, 'status' => 'success');
				echo json_encode($data);
			}
			else{
				$data = array('status' => 'failed');
				echo json_encode($data);
			}
		}
	}
	function ajax_deleteItem(){
		$id = $this->input->post('id_ref');
		if($id){
			$del = modules::run('store/collection/exe_deleteitem', $id);
			if($del){
				$return = array('status' => 'success', 'id_ref' => $id);
				echo json_encode($return);
			}else{
				$return = array('status' => 'failed', 'id_ref' => $id);
				echo json_encode($return);
			}
		}
		
	}
	// end  dependecy for function detail
	function browse(){
		$q = modules::run('store/collection/exe_browse');
		$menuSource = array(
			array(
				'anchor' => 'Create Collection', 'link' => site_url('backend/store/b_collection/create')),
		);
		$menu = $this->dodol_theme->menu_rend($menuSource);
		$data['pageMenu'] = $menu;
		$data['pH'] = 'Collection';
		$data['mainLayer'] = 'backend/page/store/collection/browse_v';
		$data['data'] = $q;
		$this->dodol_theme->render($data, 'back');
	}
	function delete(){
		$id = $this->uri->segment(5);
		$del = modules::run('store/collection/exe_delete', $id);
		if($del){
			$this->messages->add('Success Delete Collection with id '.$id, 'success');
			redirect('backend/store/b_collection/browse');
		}else{
			$this->messages->add('failed Delete Collection with id '.$id, 'warning');
			redirect('backend/store/b_collection/browse');
		}
	}
	function edit(){
		$id = $this->uri->segment(5);
		$coll = modules::run('store/collection/exe_getById', $id);
		if($coll == false ){
			//redirect to backend not found
		}
		$data['coll'] = $coll['main'];
		$data['mainLayer'] = 'backend/page/store/collection/edit_v';
		$this->dodol_theme->render($data, 'back');
		
		//execution
		if($this->input->post('submit')){
			$passdata['name'] = $this->input->post('title');
			$passdata['description'] = $this->input->post('description');
			if($_FILES['img_file']['name']){
			$passdata['img_file'] = 'img_file';
			}
			$passdata['p_date'] = $this->input->post('p_date');
			$q = modules::run('store/collection/exe_update', $id, $passdata);	
			if($q){
				$this->messages->add('Success Update collection with name '.$passdata['name'], 'success');
				redirect('backend/store/b_collection/browse');
			}else{
				$this->messages->add('Failed update collection with name '.$passdata['name'], 'warning');
				redirect('backend/store/b_collection/browse');
			}
		}
		
	}
	

}