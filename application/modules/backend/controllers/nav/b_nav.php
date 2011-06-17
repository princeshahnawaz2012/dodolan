<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_nav extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function index() {
		
	}
	function create(){
		$render['mainLayer'] = 'backend/page/nav/create_v';
		$render['pT'] = 'Create Navigation';
		$render['pH'] = 'Create Navigation';
		$this->dodol_theme->render($render, 'back');
		// EXECUTION
		if($this->input->post('create')):
						$data= array('name' => $this->input->post('name'), 'description' => $this->input->post('description'));
			if($q = modules::run('nav/exe_create', $data)):
				$this->messages->add('success Create navigation menu  named <strong>'.$q->name.'</strong>', 'success');
				redirect('backend/nav/b_nav/browse');
			else:
				$this->messages->add('Somthing Wrong, try again later', 'warning');
				redirect('backend/nav/b_nav/browse');
			endif;
			
		endif;
	}
	function update(){
		
		$id = $this->uri->segment(5);
		$menuSource = array(array('anchor' => 'Browse Navigation', 'link' => site_url('backend/nav/b_nav/browse')));		
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$nav = modules::run('nav/getbyid', $id);
		$render['nav'] = $nav;
		$render['pT'] = 'Update Navigation '.$nav->name;
			$render['pH'] = 'Update Navigation '.$nav->name;
		$render['mainLayer'] = 'backend/page/nav/update_v';
		$this->dodol_theme->render($render, 'back');
		if($this->input->post('update')):
			$data= array('name' => $this->input->post('name'), 'description' => $this->input->post('description'));
			if($q = modules::run('nav/exe_update',$id,  $data)):
				$this->messages->add('success update navigation menu  named <strong>'.$q->name.'</strong>', 'success');
				redirect('backend/nav/b_nav/browse');
			else:
				$this->messages->add('Somthing Wrong, try again later', 'warning');
				redirect('backend/nav/b_nav/browse');
			endif;
			
		endif;
	}
	function view(){
		$id = $this->uri->segment(5);
		$menuSource = array(array('anchor' => 'New Menu Item', 'link' => site_url('backend/nav/b_nav/add_item/'.$id)));
		$nav = modules::run('nav/getbyid', $id);
		$render['pT'] = 'Navigation '.$nav->name;
		$render['pH'] = 'Navigation '.$nav->name;
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['nav'] = $nav;
		$render['items'] = modules::run('nav/nav_item/getbynav', $id);
		$render['mainLayer'] = 'backend/page/nav/view_v';
		$this->dodol_theme->render($render, 'back');
	}
	function browse(){
		$menuSource = array(array('anchor' => 'New Navigation', 'link' => site_url('backend/nav/b_nav/create')));
		$render['pT'] = 'Browse Navigation';
		$render['pH'] = 'Browse Navigation';
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['navs'] = modules::run('nav/getall');
		$render['mainLayer'] = 'backend/page/nav/browse_v';
		$this->dodol_theme->render($render, 'back');
	}
	function delete(){
		$id = $this->uri->segment(5);
		if($nav = modules::run('nav/exe_delete',$id )):
			$this->messages->add('success delete navigation menu <strong>'.$nav->name.'</strong>', 'success');
			redirect('backend/nav/b_nav/browse');
		else:
			$this->messages->add('Something Wrong', 'warning');
			redirect('backend/nav/b_nav/browse');
		endif;
	}
	function delete_item(){
		$id = $this->uri->segment(5);
		if($item = modules::run('nav/nav_item/exe_delete',$id )):
			$this->messages->add('success delete navigation menu <strong>'.$item->name.'</strong>', 'success');
			redirect('backend/nav/b_nav/view/'.$item->nav_id);
		else:
			$this->messages->add('Something Wrong', 'warning');
			redirect('backend/nav/b_nav/view/'.$item->nav_id);
		endif;
	}
	function add_item(){
		$id = $this->uri->segment(5);
		$menuSource = array(array('anchor' => 'Cancel', 'link' => site_url('backend/nav/b_nav/view/'.$id)));
		$render['pT'] = 'Create Menu Item';
		$render['pH'] = 'Create Menu Item';
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['nav'] = modules::run('nav/getbyid', $id);
		$render['mainLayer'] = 'backend/page/nav/add_item_v';
		$this->dodol_theme->render($render, 'back');
		// EXEUTION
		if($this->input->post('create')):
			$data = array(
				'name' 		=> $this->input->post('name'),
				'route' 	=> $this->input->post('route'),
				'anchor' 	=> $this->input->post('anchor'),
				'parent_id' => $this->input->post('parent_id'),
				'nav_id'	=> $id
			);
			if($q = modules::run('nav/nav_item/exe_create', $data)):
				$this->messages->add('success create menu item named <strong>'.$q->name.'</strong>', 'success');
				redirect('backend/nav/b_nav/view/'.$id);
			else:
				$this->messages->add('Something wrong', 'warning');
				redirect('backend/nav/b_nav/view/'.$id);
			endif;
			
		endif;
	}
	function edit_item(){
		$id = $this->uri->segment(5);
		$item = modules::run('nav/nav_item/getbyid', $id);
		$menuSource = array(array('anchor' => 'Cancel', 'link' => site_url('backend/nav/b_nav/view/'.$item->nav_id)));
		$render['pT'] = 'Edit Menu item';
		$render['pH'] = 'Edit Menu item';
		$render['pageMenu'] = $this->dodol_theme->menu_rend($menuSource);
		$render['item'] = $item;
		$render['pH'] = 'Edit Menu';
		$render['mainLayer'] = 'backend/page/nav/edit_item_v';
		$this->dodol_theme->render($render, 'back');
		// EXEUTION
		if($this->input->post('update')):
			$data = array(
				'name' 		=> $this->input->post('name'),
				'route' 	=> $this->input->post('route'),
				'anchor' 	=> $this->input->post('anchor'),
				'parent_id' => $this->input->post('parent_id')
			);
			if($q = modules::run('nav/nav_item/exe_update',$id, $data)):
				$this->messages->add('success update menu item named <strong>'.$q->name.'</strong>', 'success');
				redirect('backend/nav/b_nav/view/'.$item->nav_id);
			else:
				$this->messages->add('Something wrong', 'warning');
				redirect('backend/nav/b_nav/view/'.$item->nav_id);
			endif;
		endif;
	}
	function reorder_item(){
		$order_state = explode(',',$this->input->post('order_state'));
		foreach($order_state as $key=>$value){
			$data = array('sort' => $key+1);
			$q = modules::run('nav/nav_item/exe_update',$value, $data);
		}
		echo json_encode(array('return' => true));
		
	}
}?>