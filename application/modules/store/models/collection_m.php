<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Collection_m extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	//php 4 constructor
	function Collection_m() {
		parent::Model();
	}
	//// API /////
	
	// collection management
	function create($data) {
		$data['main']['c_date'] =  date('Y-m-d H:i:s');
		$q = $this->db->insert('store_collection', $data['main']);
		if($q):
			$id = $this->db->insert_id();
			if(isset($data['ref'])){
				foreach($data['ref'] as $r){
					$this->additem($id, $r['id']);
				}
			}
			return $id;
		else :
			return false;
		endif;
		
	}
	function update($id, $data){
		$this->db->where('id', $id);
		$q = $this->db->update('store_collection',$data);
		if($q):
			return true;
		else:
			return false;
		endif;
	}
	function browse($param=false){
		$q = $this->db->get('store_collection');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function getById($id){
		$this->db->where('id', $id);
		$main = $this->db->get('store_collection');
		if($main->num_rows() == 1){
			$data['main'] = $main->row();
			$data['ref'] = $this->getitem($main->row()->id);
		}else{
			$data['main'] = false;
			$data['ref']  = false;
		}
		return $data;
		
	}
	function delete($id){
		$this->db->where('id', $id);
		$q = $this->db->delete('store_collection');
		if($q){
			return true;
		}else{
			return false;
		}
	}
	
	// item management
	function getitem($id_coll){
		$this->db->where('collection_id', $id_coll);
		$q = $this->db->get('store_collection_ref');
		if($q){
			return $q;
		}else{
			return false;
		}
	}
	function additem($coll_id, $prod_id){
		$data = array('collection_id' => $coll_id, 'product_id' => $prod_id);
		$this->db->where('collection_id', $coll_id);
		$this->db->where('product_id', $prod_id);
		$pre = $this->db->get('store_collection');
		if($pre->num_rows() == 0):
			$this->db->insert('store_collection_ref', $data);
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}
	function deleteitem($id_ref){
		$this->db->where('id', $id_ref);
		$q = $this->db->delete('store_collection');
		if($q){
			return true;
		}else{
			return false;
		}
	}
	
	
	

}