<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store_cart extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/store_cart_m');
		$this->load->model('store/product_m');
		$this->load->library('jne');
	}
	
	//php 4 constructor
	function Store_cart() {
		parent::__construct();
	}
	function index(){
		echo 'this is cart controller';
	}
	function buyProd(){
    	if($this->input->post('addcart')){
    		$param = array('id_prod' => $this->input->post('id_prod'), 'qty' => $this->input->post('qty'));
    		if($this->input->post('have_attrb') == 'y'){
    		$attrb = 'c:'.$this->input->post('c').';s:'.$this->input->post('s');
    		$param['attrb_key'] = $attrb;
    		}else{
    			unset($param['attrb_key']);
    		}
    		$addToCart = $this->addToCart($param);
    		if($addToCart['addtocart']== 'success'){
    			$this->messages->add('succesfully add to cart', 'success');
    			redirect(current_url());
    		}else{
    			$this->messages->add('failed add to cart ', 'warning');
    			redirect(current_url());	
    		}
    	}
	}
	function ajax_buyProd(){
	    if($this->input->post('have_attrb')){
    		$param['id_prod'] = $this->input->post('id_prod');
    		$param['qty'] = $this->input->post('qty');
    		if($this->input->post('have_attrb') == 'y'){
    		    $attrb = 'c:'.$this->input->post('c').';s:'.$this->input->post('s');
        		$param['attrb_key'] = $attrb;
    		}else{
        		unset($param['attrb_key']);
    		}
    		$addToCart = $this->addToCart($param);
    		if($addToCart['status'] == 'on'){
    			$data['status'] = 'on';
    			$data['new_cart'] = modules::run('store/store_widget/cart');
    			echo  json_encode($data);
    		}elseif($addToCart['status'] == 'min'){
    			$data['status'] = 'min';
    			echo  json_encode($data);
    		}elseif($addToCart['status'] == 'off'){
    			$request_param['id_prod'] = $this->input->post('id_prod');
    			if($this->input->post('have_attrb') == 'y' && !isset($addToCart['id_attrb'])){
    			    $request_param['attrb_key'] = $attrb;
    			}elseif($this->input->post('have_attrb') == 'y' && isset($addToCart['id_attrb'])){
    			    $request_param['id_attrb'] = $addToCart['id_attrb'];
    			}
    			$data['status'] = 'off';
    			$data['msg'] = '<div class="confirmation_msg hide">Atribute product with color '.$this->input->post('c').' and size '.$this->input->post('s').' is out off stock <br/> Woul you like to request update stock ? <br/><small>* we will infrom you when stock available </small><div class="confirm mt20"> <span class="button yes">Yes</span> | <span class="button no">No</span></div></div>';
    			$data['request_form'] = modules::run('store/request_restock', $request_param);
    			echo  json_encode($data);
    		}
    	}
	}
	function delete_cartitem(){
		$iditem = $this->uri->segment(4);
		$this->exe_updateCart($iditem, 0);
		redirect('store/cart/viewcart');
	}
	function ajax_updateCart(){
		if($this->input->post('rowid')){
		$qty = $this->input->post('qty');
		$rowid = $this->input->post('rowid');
		$update =  $this->exe_updateCart($rowid, $qty);
		
		if($update['status'] == 'on' && $qty != 0){
			$cart = $this->getCartItem($rowid);
			$data['status']         = 'on';
			$data['new_qty']        = $cart['qty'];
			$data['new_subtotal']   = $this->addon_store->show_price($cart['subtotal']);
			$data['new_total_item'] = $this->cart->total_items();
			$data['new_total'] = $this->addon_store->show_price($this->cart->total());
			if($this->session->userdata('shipping_info') && isset($this->session->userdata['shipping_info']['fee'])){
		    	$data['new_ship_fee']    = $this->addon_store->show_price($this->session->userdata['shipping_info']['fee']);
    			$data['new_final_total'] = $this->addon_store->show_price($this->cart->total()+$this->session->userdata['shipping_info']['fee']);
			}else{
			    $data['new_final_total'] = $this->addon_store->show_price($this->cart->total());
			}
			echo  json_encode($data);
		}elseif($update['status'] == 'on' && $qty == 0){
			$data['status']         = 'on';
			$data['new_qty']        = $qty;
			$data['new_total_item'] = $this->cart->total_items();
			$data['new_total']      = $this->addon_store->show_price($this->cart->total());
			if($this->session->userdata('shipping_info') && isset($this->session->userdata['shipping_info']['fee'])){
		    	$data['new_ship_fee']       = $this->addon_store->show_price($this->session->userdata['shipping_info']['fee']);
    			$data['new_final_total']    = $this->addon_store->show_price($this->cart->total()+$this->session->userdata['shipping_info']['fee']);
			}else{
			    $data['new_final_total']    = $this->addon_store->show_price($this->cart->total());
			}
			echo  json_encode($data);
	    	}else{
    			$cart = $this->getCartItem($rowid);
    			$data['status']     = 'off';
    			$data['new_qty']    = $cart['qty'];
    			$data['msg']        = 'stock not available';
			
    			echo  json_encode($data);
    		}
		}	
	}
	function updateCart(){
		if($this->input->post('update')){
			$rowid = $this->input->post('rowid');
			$qty = $this->input->post('qty');
			$time_loop = count($rowid);
			for($i=0;$i<$time_loop;$i++){
				$this->exe_updateCart($rowid[$i], $qty[$i]);
			}
			redirect(current_url());
		}
	}
	function addToCartForm($attribute, $product){
		$data = array(
			'a' => $attribute,
			'p' => $product
			);
		$this->load->view('store/misc/cart/addtocart_form_v', $data);
	}
	function exe_updateCart($rowid, $newqty){
		$item = $this->getCartItem($rowid);
		if(isset($item['id_attrb'])){
			$check_param['id_attrb']= $item['id_attrb'];
		}
		$check_param['id_prod'] = $item['id'];
		$check_param['qty']     = $newqty;
		$check = $this->validateProduct($check_param);
		if($check['status']== 'on'){
			$upd_data = array(
				'rowid' => $rowid,
				'qty' => $newqty
				);
			$this->cart->update($upd_data);
			$this->upd_ship_fee();
			return $check;
		}else{
			return $check;
		}
		
		
	}
	// this only happen if the user already choosen the ship rate
	// and cart update
	function upd_ship_fee(){
		
		if($this->session->userdata('ship_to_info')){
			$buyer_info = $this->session->userdata('ship_to_info');
		}elseif(!$this->session->userdata('ship_to_info') && $this->session->userdata('customer_info')){
			$buyer_info = $this->session->userdata('customer_info');	
		}else{
			$buyer_info = false;
		}
		if(isset($this->session->userdata['shipping_info']['fee']) && $buyer_info != false){
		    $this->cart->destroy_data('shipping_info');
		    /*
			$id_rate = $this->session->userdata['shipping_info']['rate_id'];
			$newfee = $this->jne->choosenRate($buyer_info['city_code'], $this->getAllWeight(), $id_rate);
			$this->session->userdata['shipping_info']['fee'] = $newfee['rate'] ;
			$this->session->sess_write();	
			*/
		}else{
			return false;
		}
	}
	
	function validateProduct($param=array()) {
    	$check = $this->store_cart_m->validateProduct($param);
    	return $check;
	}
	function getAllWeight(){
		$index = 0;
		foreach($this->cart->contents() as $item){
			$param = array('id' => $item['id'], 'select' => 'weight');
			$prod = modules::run('store/product/detProd', $param);
			$totalWeight[$index] = $prod['prod']->weight*$item['qty'];
			$index++;
		}
		$finalWeight = array_sum($totalWeight);
		return $finalWeight;
	}
	function getCartItem($rowid){
		if($rowid){
		    $cartContent = $this->cart->_cart_contents[$rowid];
		    return $cartContent;
		}else{
			return false;
		}
	}
	function is_in_cart($id_prod, $id_attrb=false){
		// checking the product is on cart or nope
		if($id_attrb){
			foreach($this->cart->contents() as $item){
				if($item['id'] == $id_prod && $item['id_attrb'] == $id_attrb){
				$rowid = $item['rowid'];
				}else{
				$rowid = false;	
				}
			}
		}else{
			foreach($this->cart->contents() as $item){
				if($item['id'] == $id_prod){
				$rowid = $item['rowid'];
				}else{
				$rowid = false;	
				}
			}
		}
		if(isset($rowid)){
			return $rowid;
		}else{
			return false;
		}
	}
	function refresh_cart(){
		// re insert cart, when currency change
		// backup the cart
		$temp_cart = $this->cart->contents();
		$ins_to_sess = array(
			'temp_cart' => $temp_cart,
				);
		$this->session->set_userdata($ins_to_sess);
		$this->cart->destroy();
		$load_cart = $this->session->userdata('temp_cart');
		
		foreach($load_cart as $item){
				$new_cart['id'] 		= $item['id'];
				$new_cart['qty'] 		= $item['qty'];
				$new_cart['name']  	    = $item['name'];
			
			if($item['options']){
				$price = modules::run('store/product/prod_price', $item['id'], $item['id_attrb']);
					$new_cart['id_attrb'] = $item['id_attrb'];
					$new_cart['price'] = $price['final'];
					$new_cart['options']  =$item['options'];
			}else{
				$price = modules::run('store/product/prod_price', $item['id']);
				$new_cart['price'] = $price['final'];
			}
				$this->cart->insert($new_cart);
		}
		//delete backup cart
		$this->session->unset_userdata('temp_cart');
		// if shipping cost already setup 
	
			$this->upd_ship_fee();
	
		
		
	}
	function addToCart($param=array()){
		
		/*
			param :
			id_prod
			qty
			attrb_key
		
		*/
		if(isset($param['attrb_key'])){
			//if set attribute option
			$attrb = $this->product_m->getAttrbByKey($param['id_prod'], $param['attrb_key']);
			if($attrb){
				// if attribute match
				$options = $this->addon_store->hackAttrib($attrb->attribute);
				$price = modules::run('store/product/prod_price', $param['id_prod'], $attrb->id);
				$rowid = $this->is_in_cart($param['id_prod'], $attrb->id);
				$ins_data['price']   = $price['final'];
				$ins_data['options'] = $options;
				$ins_data['id_attrb'] = $attrb->id;
				$check_param['id_attrb'] = $attrb->id;
				$check_param['id_prod'] = $param['id_prod'];
			}else{
			$rowid = $this->is_in_cart($param['id_prod'], false);
			$price = modules::run('store/product/prod_price', $param['id_prod']);
			$ins_data['price']   = $price['final'];
			$check_param['id_prod'] = $param['id_prod'];
			}
		}else{
			$rowid = $this->is_in_cart($param['id_prod'], false);
			$price = modules::run('store/product/prod_price', $param['id_prod']);
			$ins_data['price']   = $price['final'];
			$check_param['id_prod'] = $param['id_prod'];
		}
		if(!$rowid){
			$check_param['qty'] = $param['qty'];
		}else{
			$cartItem = $this->getCartItem($rowid);
			$check_param['qty'] = $param['qty']+$cartItem['qty'];
			$final_qty = $param['qty']+$cartItem['qty'];
		}
		$check = $this->validateProduct($check_param);
		if($check['status'] == 'on' && !$rowid){	
		// if product valid and available and not exist on cart
			$prd_prm = array(
				'select' => 'name, price, currency, weight',
				'id' => $param['id_prod'],
				);
			$qp = $this->product_m->getProdById($prd_prm);
			$prod = $qp['prod'];
			$ins_data['id']      = $param['id_prod'];
			$ins_data['qty']     = $check_param['qty'];
			$ins_data['name']    = $prod->name;
			$ins_data['weight']  = $prod->weight;
			$check['addtocart']  = 'success';
			$check['rowid']      = $rowid;
			$ins = $this->cart->insert($ins_data);
			$this->upd_ship_fee();
			return $check;
		
		}
		elseif($check['status'] == 'on' && $rowid){
			$update_data = array(
				'rowid' => $rowid,
				'qty' => $final_qty);
			$ins = $this->exe_updateCart($rowid, $final_qty);
			$check['addtocart']  = 'success';
			return $check;	
		}
		else{
			return $check;
		}
		
	}
	
	function viewcart(){	
		$data = array(
			'mainLayer' => 'store/page/cart/cartView_v',
			'items' => $this->cart->contents(),
			);
		$this->dodol_theme->render($data);
		$this->updateCart();
	}
	function destroy_cart(){
		$this->cart->destroy();
		redirect('store/cart/viewcart');
	}
	function exe_removeItemCart($rowid){
		$update_data = array(
				'rowid' => $rowid,
				'qty' => 0 );
		$remove = $this->cart->update($update_data);
	}
	function removeItemCart(){
		$rowid = $this->uri->segment(4);
		$this->exe_removeItemCart($rowid);
	}
	function updateQtyItem($rowid, $qty){
		$update_data = array(
				'rowid' => $rowid,
				'qty' => $qty );
		$update = $this->cart->update($update_data);
	}
	

	
	

}