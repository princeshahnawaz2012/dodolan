<?php 
if (! defined('BASEPATH')) exit('No direct script access');
/**
 * Category controller, under store controller
 * path : applicatio/modules/store/controller/category.php
 *
 * @package default
 * @author Zidni Mubarock
 */
class category extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->store_cat = $this->load->model('store/category_m');
		$this->load->model('store/product_m');
	}
	
	//php 4 constructor
	function Category() {
		parent::__construct();
	}
	/**
	 * Get Detail Of Category
	 *
	 * @param int $id 
	 * @return object
	 * @author Zidni Mubarock
	 */
	function getCatDet($id){
		$cat = $this->store_cat->getcatbyid($id);
		if($cat){
			return $cat;
		}else{
			return false;
		}
		
	}
	function showAllCat() {
		$q = $this->store_cat->getAllCat();
		if($q){
			return $q;
		}else{
			return false;
		}
	}
	// page 
	function view(){
		$id = $this->uri->segment(4);
		$q = $this->product_m->getProdByCatid($id);
		$data['prods'] = $q['prodid'];
		$data['mainLayer'] = 'store/page/category/cat_view_v';
		$this->dodol_theme->render($data);
	}
	
	
	
	/**
	 * Catlistmenu
	 *
	 * @param int $id 
	 * @return void
	 * @author Zidni Mubarock
	 */
	function catlistmenu($id=0){
	$root = $id;
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
				$tree .= '<li><a href="'.site_url('store/product/browse/cat/'.$root->id).'">'.$root->name.'</a>';
				$subs = $this->category_m->getCatByPar($root->id);
				if($subs){
				$tree .= $this->subtree0($root->id);
				$tree .='</li>';
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
			$tree .='<ul>';
		    foreach($roots as $root){
				$tree .= '<li><a href="'.site_url('store/product/browse/cat/'.$root->id).'">'.$root->name.'</a>';
				$subs = $this->category_m->getCatByPar($root->id);
				if($subs){
				$tree .= $this->subtree($root->id);
				$tree .='</li>';
				}
			}
			$tree .= '</ul>';
		}else{
			$own = $this->category_m->getcatbyid($parid);
			$tree .= '<li><a href="'.site_url('store/product/browse/cat/'.$own->id).'">'.$own->name.'</a></li>';
		}
		$tree .= '</ul>';
		return $tree;
	}
	// end of category menu list	
	
	
	/// API ///
	function exe_delete($id){
		$del = $this->store_cat->deletecat($id);
		return $del;
	}

}?>