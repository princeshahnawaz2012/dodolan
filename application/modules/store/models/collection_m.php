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
	function create($data) {
		$q = $this->db->insert('store_collection', $data['main']);
		if($q):
			$id = $this->db->iinsert_id();
			foreach($data['ref'] as $r){
				$this->additem($id, $r['id']);
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
	
	function browse($param){
		
	}
	function getById($id){
		$this->db->where('id', $id);
		$main = $this->db->get('store_collection');
		if($main->num_rows() == 1){
			$data['main'] = $main->row();
			$this->db->where('collection_id', $id);
			$ref = $this->db->get('store_collection_ref');
			if($ref->num_rows() > 0){
				$data['ref'] = $ref->result();
			}else{
				$data['ref'] = false;
			}
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
	

}