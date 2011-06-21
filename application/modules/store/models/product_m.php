<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Product_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Product_m() {
		parent::__construct();
	}
	//////////////////////////////////////////
	/////////// Administrator Function ///////
	//////////////////////////////////////////
	
	/////////// Product ///////////
	function addProduct($data) {
		$this->db->where('sku' , $data['sku']);
		$q= $this->db->get('store_product');
		if($q->num_rows() == 0){
		$q = $this->db->insert('store_product', $data);
		$ins['id'] = $this->db->insert_id();
		return	$ins;
		}else{
			return false;
		}
	}
	// edit Product
	function editProduct($data, $id){
		$this->db->where('id', $id);
		$q = $this->db->update('store_product', $data);
		if($q){
			return true;
		}else{
			return false;
		}
	}
	function deleteProduct($id){
		$this->db->where('id', $id);
		$q = $this->db->delete('store_product');
			if($q){
				return true;
			}else{
				return false;
			}
	}
	function getAttrbByKey($id_prod, $attrb_key){
		$this->db->where('prod_id', $id_prod);
		$this->db->where('attribute', $attrb_key);
		$q = $this->db->get('store_product_attrb');
		if($q->num_rows() == 1){
			$data = $q->row();
			return $data;
		}else{
			return false;
		}
	}
	function getAttrbById($id, $select=false){
		if($select){
			$this->db->select($select);
		}
		$this->db->select('price_opt');
		$this->db->where('id', $id);
		$q = $this->db->get('store_product_attrb');
		if($q->num_rows() == 1){
			$data = $q->row();
			return $data;
		}else{
			return false;
		}
		
	}
	function getProdSnap($id){
		$this->db->select('name, price, id');
		$this->db->where('id', $id);
		$prod = $this->db->get('store_product');
		$this->db->where('prod_id', $id);
		$this->db->order_by('prod_id', 'DESC');
		$media = $this->db->get('store_product_media');
		if($media->num_rows() < 1 ){
			$data['media'] = false;
		}else{
			$data['media'] = $media->row();	
		}
		
		if($prod->num_rows() == 1){
			$data['prod'] = $prod->row();
			return $data;
		}else{
			
			return false;
		}
	}
	// get singel product, include attribute and media
	function getProdById($param=array()){
		// retrive from store product
		if(!isset($param['select'])){
		$this->db->distinct();
		}else{
		$this->db->select('cat_id, '.$param['select']);	
		}
		$this->db->where('id', $param['id']);
		$prod = $this->db->get('store_product');
		if($prod->num_rows() == 1){
		$data['prod'] = $prod->row();
		
		$this->db->where('id', $prod->row()->cat_id);
		$cat = $this->db->get('store_category');
		$data['cat'] = $cat->row();
	
		//retrive from attrbute product
		if(isset($param['attr']) == true){
			$this->db->distinct();
			$this->db->where('prod_id', $param['id']);
			$attrb = $this->db->get('store_product_attrb');
			if($attrb->num_rows() < 1 ){
				$data['attrb'] = false;
			}else{
				$data['attrb'] = $attrb->result();	
			}
		}
		//retrive from media product
		if(isset($param['media']) == true){
			$this->db->distinct();
			$this->db->where('prod_id', $param['id']);
			$this->db->order_by('default', 'DESC');
			$media = $this->db->get('store_product_media');
			if($media->num_rows() < 1 ){
				$data['media'] = false;
			}else{
				$data['media'] = $media->result();	
			}
			}
	
		
				return $data;
			}else{
				
				return false;
			}
		
		
		
	}

	// Get List Product BY Cat, Page, Pub, keyword(name or sku)
	function getlistProd($conf=array()){
		if(!isset($conf['cat_id'])){
			$conf['cat_id'] = false;
		}
		if(!isset($conf['publish'])){
			$conf['publish'] = false;
		}
		if(!isset($conf['start'])){
			$conf['start'] = false;  
		}
		if(!isset($conf['limit'])){
			$conf['limit'] = false;
		}
		if(!isset($conf['search'])){
			$conf['search'] = false;
		}
	
		$this->db->select('a.id p_id, b.id cat_id');
		
		//get the limit and offset record
		$this->db->like('a.publish', $conf['publish']);//}
		if($conf['cat_id']){
		$this->db->where('a.cat_id', $conf['cat_id']);
		}
		if($conf['search']){
		$this->db->like('a.name', $conf['search']);	
		$this->db->or_like('a.sku', $conf['search']);	
		}
		$this->db->join('store_category b', 'b.id=a.cat_id');
		$this->db->order_by('a.id', 'desc');
		
		$this->dodol->db_calc_found_rows();
		
		$q  = $this->db->get('store_product a',$conf['limit'], $conf['start']);
		
		
		if($q->num_rows() > 0){
			$data['prods']   = $q->result();
			$data['num_rec'] = $this->dodol->db_found_rows();
			return $data;
		}else{
			return false;
		}
		
	}
	
	/////////// Product Attribute ///////////
	function addAttrib($data){
		$q = $this->db->insert('store_product_attrb', $data);
		if($q){
			return true;
		}else{
			return false;
		}	
	}
	function editAttrib($data, $id){
		$this->db->where('id', $id);
		$q = $this->db->update('store_product_attrb', $data);
		if($q){
			return true;
		}else{
			return false;
		}	
	}
	
	/////////// Product Media ///////////
	function getMediaById($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_product_media');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function addMedia($data){
		$q = $this->db->insert('store_product_media', $data);
		$insid = $this->db->insert_id();
		if($q){
			$media = $this->getMediaById($insid);
			$new_name = 'p_'.$media->prod_id.'_m_'.$media->id.'_'.$media->name;
			$new_file = $this->renameMedia($insid, $new_name);
			$data['path'] = $new_file['basename'];
			$this->editMedia($data, $insid);
			return true;
		}else{
			return false;
		}
	}
	function editMedia($data, $id){
		$this->db->where('id', $id);
		$q = $this->db->update('store_product_media', $data);
		if($q){
			return true;
		}else{
			return false;
		}
	}
	function uploadMedia($input_name, $dest_file_name){
		$this->load->library('upload');
		$config['upload_path'] = './assets/product-img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $dest_file_name;
		$config['max_size']	= '100000';
		$config['overwrite'] = false;
		$this->upload->initialize($config);
		$up = $this->upload->do_upload($input_name);
		$upData = $this->upload->data();
		
		if($up)	{
			$data['file_name'] = $upData['file_name'];
			return $data;
		}else{
			$data['error'] = array('error' => $this->upload->display_errors());
			return $data;
		}
		
	}
	function deleteMedia($id){
		$q = $this->getMediaById($id);
			if($q){
				$path = './assets/product-img/'.$q->path;
				if(file_exists($path)){
					$del = unlink($path);
					if ($del){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
	}
	function renameMedia($id, $new){
		$new_name = str_replace(' ', '_', $new);
		$q = $this->getMediaById($id);
			if($q){
				$path = './assets/product-img/'.$q->path;
				$ext  = pathinfo($path);
				$new  = './assets/product-img/'.$new_name.'.'.$ext['extension'];
				if(file_exists($path)){
					$ren = rename($path, $new);
					if ($ren){
						$new_file = pathinfo($new);
						return $new_file;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		
	}
	/////////// Product Relation ///////////
	function addRel($id, $rel_list=array()){
		foreach($rel_list as $p_rel):
		$this->db->where('p_own', $id);
		$this->db->where('p_rel', $p_rel);
		$q = $this->db->get('store_product_rel');
			if($q->num_rows() == 0):
				$data = array(
					'p_own' => $id,
					'p_rel' => $p_rel
				);
				$this->db->insert('store_product_rel', $data);
			endif;
		endforeach;
		return true;
	}
	function getRel($id){
		$this->db->where('p_own', $id);
		$q = $this->db->get('store_product_rel');
		if($q->num_rows() > 0){
			return $q;
		}else{
			return false;
		}
	}
	function delRel($id){
		$this->db->where('id', $id);
		$q = $this->db->delete('store_product_rel');
		if($q){
			return true;
		}else{
			return false;
		}
	}
	
	
	
	
	//--------------------------------//
	// 				API V.02 
	//--------------------------------//
	
	
	// API REVISION , NOT READY YET IMPLEMENT
	function create($data){
		$this->db->where('sku', element('sku', $data));
		$pre = $this->db->get('store_product');
		if($pre->num_rows() > 0){
			if($this->db->insert('store_product', $data)){
				return $this->getbyid($this->db->insert_id(), false, false);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function update($id, $data){
		if($this->getbyid($id, false, false)){
			$this->db->where('id', $id);
			if($this->db->update('store_product')){
				return $this->getbyid($id, false, false);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function delete($id){
		if($temp = $this->getbyid($id, false)):
			$this->db->where('id', $id);
			if($q = $this->db->delete('store_product')){
				return $temp;
			}else{
				return false;
			}
		else:
			return false;
		endif;
	}
	function getbyid($id, $include = false, $select = '*', $alldata = TRUE){
		if($select != false):
			$this->db->select($select);
		endif;
		$this->db->select('prod.name as name, cat.name as category_name, prod.id as id');
		$this->db->where('prod.id', $id);
		$this->db->join('store_category cat', 'cat.id=prod.cat_id');
		$q = $this->db->get('store_product prod');
		if($q->num_rows() == 1){
			if($alldata == true):
					$data['product'] 		= $q->row();
					$data['media'] 			= $this->getmedia($id);
					$data['medias'] 		= $this->getmedias($id);
					$data['attributes'] 	= $this->getattributes($id);
					$data['relations'] 		= $this->getrelations($id);
			elseif($alldata == true || $alldata == false && $inculde != false):
					if(element('media', $include)):
						$data['media'] 			= $this->getmedia($id);
					endif;
					if(element('medias', $include)):
						$data['medias'] 		= $this->getmedias($id);
					endif;
					if(element('attributes', $include)):
						$data['attributes'] 	= $this->getattributes($id);
					endif;
					if(element('relations', $include)):
						$data['relations'] 		= $this->getrelations($id);
					endif;	
			elseif($alldata == false):
				$data = array('product' => $q->row());
			endif;
			
			return $data;
		}else{
			return false;
		}
	}
	function browse($param){
		$start = ($start = element('start', $param)) ? $start : 0;
		$limit = ($limit = element('limit', $param)) ? $limit : 20;
	}
	
	// FILE TRANSACTION
	function uploadfile($field, $file_name){
		$this->load->library('upload');
		$config = array(
			'upload_path' 	=> './assets/product-img/',
			'allowed_types' => 'gif|jpg|png',
			'file_name'		=> $file_name,
			'max_size'		=> '100000',
			'overwrite'		=> false,
		);
		
		$this->upload->initialize($config);
		if($this->upload->do_upload($field)){
			$upData = $this->upload->data();
			$data['file_name'] = $upData['file_name'];
			return $data;
		}else{
			$data['error'] = array('error' => $this->upload->display_errors());
			return $data;
		}
	}
	function deletefile($path){
		if(file_exists($path)){
			if (unlink($path)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
		
	// ATTRIBUTES
	function getattributes($id_prod){
		$this->db->where('prod_id', $id_prod);
		$q = $this->db->get('store_product_attrb');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	// ATTRIBUTES TRANSACTION
	function attribute_create($data){
		if($this->db->insert('store_product_attrb', $data)){
			return $this->attribute_getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function attribute_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_product_attrb');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function attribute_update($id, $data){
		if($this->attribute_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->update('store_product-attrb', $data)){
				return $this->attribute_getbyid($id);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function attribute_delete($id){
		if($pre = $this->attribute_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->delete('store_product_attrb')){
				return $pre;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	// IMAGES
	function getmedia($id_prod){
		$this->db->where('prod_id', $id_prod);
		$this->db->order_by('sort', 'ASC');
		$q = $this->db->get('store_product_media');
		if($q->num_rows() > 0){
			return $q->row();
		}else{
			return false;
		}
	}
	function getmedias($id_prod){
		$this->db->where('prod_id', $id_prod);
		$this->db->order_by('sort', 'ASC');
		$q = $this->db->get('store_product_media');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	// IMAGES TRANSACTION
	function media_create($data){
		if($q = $this->db->insert('store_product_media',$data)){
			return $this->image_getbyid($this->db->insert_id());
		}else{
			return false;
		}
		
	}
	function media_update($id, $data){
		if($this->image_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->update('store_product_media', $data)){
				return $this->image_getbyid($id);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function media_delete($id){
		if($temp = $this->image_getbyid($id)){
			$this->db->where('id', $id);
			if($this->db->delete('store_product_media')){
				return $temp;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function media_getbyid(i$id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_product_media');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}

	// RELATIONS
	function getrelations($id_prod){
		$this->db->where('p_own', $id_prod);
		$q = $this->db->get('store_product_rel');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	// RELATIONS TRANSACTION
	function relation_crate($data){
		$this->db->where('p_own', element('p_own', $data));
		$this->db->where('p_rel', element('p_rel', $data));
		$pre = $this->db->get('store_product_rel');
		if($pre->num_rows() == 0){
			$q = $this->db->insert('store_product_rel', $data);
			if($q){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function relation_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_product_rel');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function relation_delete($id){
		if($q = $this->relation_getbyid($id)){
			$this->db->where('id', $id);
			$del = $this->db->delete('store_product_rel');
			if($del){
				return $q;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function relation_update($id, $data){
		if($this->relation_getbyid($id)){
			$this->db->where('id', $id);
			if($q= $this->db->update('store_product_rel', $data)){
				return $this->relation_getbyid($id);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	
	

}?>