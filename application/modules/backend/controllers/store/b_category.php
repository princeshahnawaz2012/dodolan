<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_category extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->load->model('store/category_m');
		modules::run('user/auth/userRoleCheck', 'owner');
	}
	
	//php 4 constructor
	function B_category() {
		parent::Controller();
	}
	
	function index() {
		$data = array(
		'directLayer' => 'this is index of category banck end',
		'pt' => 'category'
			);
			$this->theme->render($data, 'back');
	}
	function addcat(){
		$data = array(
			'pt'  => 'Add Category',
			'mainLayer' => 'backend/page/store/category/addcat_v',
			'ht' => 'Add Category'
				);
		$this->theme->render($data, 'back');
		if($this->input->post('submit')){
			$this->exe_addcat();
		}
	}
	function editcat(){
		$id = $this->uri->segment(5);
		$cat = $this->category_m->getcatbyid($id);
		$data = array(
			'pt'  => 'Edit Category',
			'mainLayer' => 'backend/page/store/category/editcat_v',
			'ht' => 'Edit Category',
			'category' => $cat
				);
		$this->theme->render($data, 'back');
		if($this->input->post('submit')){
			$this->exe_editcat($id);
		}
	}
	function browse(){
		$this->listcat();
	}
	function listcat(){
		$cats = $this->category_m->getAllCAt();
		$data = array(
		'pt' => 'list category',
		'mainLayer' => 'backend/page/store/category/listcat_v',
		'cats' =>$cats,
			);
			$this->theme->render($data, 'back');
		
	}

	function exe_addcat(){
		if($this->input->post('publish') == 'n'){
			$pub = 'n';
		}else{
			$pub = 'y';
		}
		$ins = array(
			'name' => $this->input->post('name'),
			'desc' => $this->input->post('desc'),
			'publish' => $pub,
			'parent_id' => $this->input->post('parent_id')
		);
		$q = $this->category_m->addcat($ins);
		if($q){
			$this->messages->add('Your Succes add category with name '.$this->input->post('name'), 'success');
			redirect('backend/store/b_category/listcat');
		}
		else{
			$this->messages->add('category named '.$this->input->post('name').' cannot be added', 'warning');
			redirect('backend/store/b_category/addcat');
		}
		
	}
	
	function exe_editcat($id){
		if($this->input->post('publish') == 'n'){
			$pub = 'n';
		}else{
			$pub = 'y';
		}
		$ins = array(
			'name' => $this->input->post('name'),
			'desc' => $this->input->post('desc'),
			'publish' => $pub,
			'parent_id' => $this->input->post('parent_id')
		);
		$q = $this->category_m->editcat($ins, $id);
		if($q){
			$this->messages->add('Your Succes add category with name '.$this->input->post('name'), 'success');
			redirect('backend/store/b_category/listcat');
		}
		else{
			$this->messages->add('category named '.$this->input->post('name').' cannot be added', 'warning');
			redirect('backend/store/b_category/editcat/'.$id);
		}
		
	}

	function viewcat(){
	$root = $this->uri->segment(5);
	if($root == 0){
	$tree = $this->subtree0(0);
	}else{
	$tree = $this->subtree($root);
	}
	echo $tree;
	}


	function subtree0($parid){
		$roots = $this->category_m->getCatByPar($parid);
		$tree = '<ul>';	
		if($roots){
		    foreach($roots as $root){
				$tree .= '<li><a href="'.site_url('store/category/view/'.$root->id).'">'.$root->name;
				$subs = $this->category_m->getCatByPar($root->id);
				if($subs){
				$tree .= $this->subtree0($root->id);
				$tree .='</a></li>';
				}
			}
		}
		$tree .= '</ul>';
		return $tree;
	}
	function subtree($parid){
		$roots = $this->category_m->getCatByPar($parid);
		$tree = '<ul>';	
		if($roots){
			$own = $this->category_m->getcatbyid($parid);
			$tree .= '<li>'.$own->name.'<ul>';
		    foreach($roots as $root){
				$tree .= '<li><a href="'.site_url('store/category/view/'.$root->id).'">'.$root->name;
				$subs = $this->category_m->getCatByPar($root->id);
				if($subs){
				$tree .= $this->subtree($root->id);
				$tree .='</a></li>';
				}
			}
			$tree .= '</li></ul>';
		}else{
			$own = $this->category_m->getcatbyid($parid);
			$tree .= '<li><a href="'.site_url('store/category/view/'.$own->id).'">'.$own->name.'</li>';
		}
		$tree .= '</a></ul>';
		return $tree;
	}
	
///// backup
	/*
	//////////////////////////
	function viewcat(){
		$parid = $this->uri->segment(5);
		$tree = $this->wtf($parid);
		echo $tree;
	}
	
	function wtf($parid){
		$tree = '';
		if($parid != 0){
			$tree = '<ul>';
			$own = $this->category_m->getcatbyid($parid);
			$tree .= '<li>'.$own->name;	
		}
		
		$roots = $this->category_m->getCatByPar($parid);
		
		if($roots){
			$tree .= $this->subtree($parid);
		}
		
		$tree .='</li>';
		$tree .='</ul>';
		
		return $tree;
		
	}
	

	function subtree($parid){
		$tree = '<ul>';	
		$roots = $this->category_m->getCatByPar($parid);
		foreach($roots as $root){
			$tree .= '<li>'.$root->name;
			$subs = $this->category_m->getCatByPar($root->id);
			if($subs){
				$tree .= $this->subtree($root->id);
				$tree .='</li>';
			}
		}
		
		
		$tree .= '</ul>';
		return $tree;
	}
	//////////////////////////
	
	
	*/
		

}?>