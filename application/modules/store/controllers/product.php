<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Product extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('store/product_m');
		
	}
	
	//php 4 constructor
	function Product() {
		parent::__construct();
	}
	
	//Page
	function index() {
		
	}
	function prodImg($id){
		$q = $this->product_m->getProdSnap($id);
		$data = $q['media'];
		return $data;
	}
	function prodSnap($id){
		$q = $this->product_m->getProdSnap($id);
		$data['prod'] =  $q['prod'];
		$data['media'] = $q['media'];
		$this->load->view('store/misc/product/productSnap_v', $data);
	}
	function sendCatalog(){
		$param['id'] = $this->uri->segment(4);
		$param['attr'] = true;
		$param['media'] = true;
		
		$data['prod'] = $this->detProd($param);
		$data['template'] = 'store/page/product/detailProd';
		$this->load->library('mailer');
		$this->mailer->to = 'zidmubarock@gmail.com';
		$this->mailer->subject = $data['prod']['prod']->name;
		$this->mailer->body = $data ;
		$this->mailer->send();
	}
	function detProd($param=array()){
		$q = $this->product_m->getProdById($param);
		return $q;
	}
	function get_relation($id){
		return $this->product_m->getRel($id);
	}
	function view(){
		$param['id'] = $this->uri->segment(4);
		$param['attr'] = true;
		$param['media'] = true;
		//$data['prod'] = $this->detProd($param);
		$data['prod'] = $this->api_getbyid($this->uri->segment(4), array('media', 'medias', 'relations', 'attributes'));
		$data['loadSide'] = false;
		$data['mainLayer'] = 'store/page/product/detailProd';
		$data['pT']        = $data['prod']['product']->name;
		$this->dodol_theme->render($data);
		// execution buy product
		modules::run('store/store_cart/buyProd');
	}
	function prod_price($id, $id_attrb=false){
		$param = array('select'=> 'price, disc, currency', 'id'=> $id);
		$currency = $this->addon_store->currency();
		$qp = $this->detProd($param);
		$p = $qp['prod'];
		$rate = $this->addon_store->rate();
		if($p->disc){
			$disc = explode(':', $p->disc);	
			if($disc[0] == 'n'){		
				$disc_nominal = $disc[1];
			}else{
				$disc_nominal  = $p->price*($disc[1]/100);
			}
		}else{
			$disc_nominal = 0;
		}
		if($id_attrb){
			$attrb = $this->product_m->getAttrbById($id_attrb);
			if($attrb){
				$price_addon = $attrb->price_opt;
			}else{
				$price_addon = 0;
			}
		}else{
			$price_addon = 0;
		}
		/*next task
		if($p->currency != $this->config->item('currency') && !$this->session->userdata('currency') ){
		$new_rate = $this->yh_conv->conv($p->currency, $this->config->item('currency') );
		$final_value = ($p->price*$new_rate ) - ($disc_nominal*$new_rate ) - (-1*($price_addon*$new_rate ));
		$origin_value = $p->price*$new_rate ;
		}elseif($this->session->userdata('currency') && $p->currency == $this->session->userdata('currency') && $p->currency != $this->config->item('currency')){
		$final_value = $p->price - ($disc_nominal) - (-1*($price_addon));
		$origin_value = $p->price;
		}
		elseif($this->session->userdata('currency') && $p->currency != $this->session->userdata('currency')){
		$final_value = ($p->price*$rate) - ($disc_nominal*$rate) - (-1*($price_addon*$rate));
		$origin_value = $p->price*$rate;
		}
		else{
		$final_value = $p->price - ($disc_nominal) - (-1*($price_addon));
		$origin_value = $p->price;
		}
		*/
		///* backup
		if($p->currency != $currency ){
		$final_value = ($p->price*$rate) - ($disc_nominal*$rate) - (-1*($price_addon*$rate));
		$origin_value = $p->price*$rate;
		}
		else{
		$final_value = $p->price - ($disc_nominal) - (-1*($price_addon));
		$origin_value = $p->price;
		}
		//*/
		$data['final'] = $final_value;
		$data['origin'] = $origin_value;
		$data['formated'] = $currency.' '.number_format($final_value, 2, ',', '.');
		if(!$p->disc){
		$data['formated_detail'] = '<div class="priceProduct_formated"><span class="finalPrice"> '.$currency.' '.number_format($final_value, 2, ',', '.').'</span></div>';
		}else{
			
		$data['formated_detail'] = '<div class="priceProduct_formated"><span class="finalPrice"><span class="finalPrice"> '.$currency.' '.number_format($origin_value, 2, ',', '.').'</span><br/>
		<span class="originPrice">'.$currency.' '.number_format($origin_value, 2, ',', '.').'</span><br/>
		'.$rate.'
		
		</div>
		';	
		}
		return $data;
		
	}
	
	
	function browse(){
		$this->load->library('barock_page');
		
		$param = $this->uri->uri_to_assoc(4);
		if(!isset($param['limit'])){
			$param['limit'] = 12;
		}
		if(!isset($param['cat'])){
			$param['cat'] = false;
		}
		if(!isset($param['page'])){
			$param['page'] = 0;
		}
		if(!isset($param['pub'])){
			$param['pub'] = 'y';
		}
		if(!isset($param['q'])){
			$param['q'] = false;
		}
		
		if($param['page']){
			$start = ($param['page'] - 1)* $param['limit'];
		}else{
			$start = 0;
		}
		$limit = $param['limit'];
		// configuration before query to database
		$conf = array(
			'cat_id'   => $param['cat'],
			'publish'  => $param['pub'],
			'limit'    => $param['limit'],
			'start'    => $start,
			'search'   =>  $param['q']
			);
		$prods = $this->product_m->getListProd($conf);
		// get the base url for pagination,
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		// configuration for pagination
		$confpage = array(
			'target_page' => $target_url,
			'num_records' => $prods['num_rec'],
			'num_link'	  => 5,
			'per_page'   => $limit,
			'cur_page'   => $param['page']
			);
		// execute the pagination conf
		$this->barock_page->initialize($confpage);
		$data = array(
			'mainLayer' => 'page/product/browse_view_v',
			'prods'     => $prods['prods'],
			'param'     => $param
			);
		if($param['cat']){
			$cat = modules::run('store/category/getCatDet', $param['cat']);
			$data['pT'] = $cat->name; 
		}else{
		$data['pT'] = 'Store Product';
		}
		$this->dodol_theme->render($data);
	}
	
	/// API ///
	function exe_delete($id){
		$del = $this->product_m->deleteProduct($id);
		return $del;
	}
	
	
	//--------------------------------//
	// 				API V.02 
	//--------------------------------//
	
	// PRODUCT
	function api_update($id, $data){
		return $this->mdl->update($id, $data);
	}
	function api_create($data){
		return $this->mdl->create($data);
	}
	function api_delete($id){
		return $this->mdl->delete($id);
	}
	function api_getbyid($id){
		return $this->mdl->getbyid($id);
	}
	function api_browse($param){
		return $this->mdl->browse($param);
	}
	
	// IMAGES
	function api_getmedia($id){
		return $this->mdl->getimage($id);
	}
	function api_getmedias($id){
		return $this->mdl->getimages($id);
	}
	// IMAGES TRANASACTION
	function api_media_create($data){
		return $this->mdl->media_create($data);
	}
	function api_media_update($id, $data){
		return $this->mdl->media_update($data);
	}
	function api_media_delete($id){
		return $this->mdl->media_delete($id); 
	}
	function api_media_getbyid($id){
		return $this->mdl->media_getbyid($id);
	}
	
	
	// ATTRIBUTES
	function api_getattributes($id){
		return $this->mdl->getattributes($id);
	}
	// ATTRIBUTES TRANSACTIONS
	function api_attribute_create($data){
		return $this->mdl->attribute_create($data);
	}
	function api_attribute_update($id, $data){
		return $this->mdl->attribute_update($data);
	}
	function api_attribute_delete($id){
		return $this->mdl->attribute_delete($id); 
	}
	function api_attribute_getbyid($id){
		return $this->mdl->attribute_getbyid($id);
	}
	
	
	// RELATIONS
	function api_getrelations($id){
		return $this->mdl->getrelations($id);
	}
	// RELATION TRANSACTIONS
	function api_relation_create($data){
		return $this->mdl->relation_create($data);
	}
	function api_relation_update($id, $data){
		return $this->mdl->relation_update($data);
	}
	function api_relation_delete($id){
		return $this->mdl->relation_delete($id); 
	}
	function api_relation_getbyid($id){
		return $this->mdl->relation_getbyid($id);
	}

	

}?>