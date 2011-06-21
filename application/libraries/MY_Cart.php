<?php if (!defined('BASEPATH')) exit('No direct script access allowed');		
/**
 * This is Extended Class for Native Ci_Cart Class Library
 * file name : application/library/MY_cart.php
 * @package default
 * @author Zidni Mubarock
 **/
class MY_Cart extends CI_Cart {		
		
	var $_ci 			= '';
	var $customer_info 	= '';
	var $shipto_info    = '';
	var $shipping_info 	= '';	
	var $paymnet_info 	= '';
	var $extra_data_name= 'meta_cart';
	var $meta  			= '';
	var $check_step 	= '';	
	
	function MY_Cart(){	
		parent::__construct();
		
		$this->_ci =& get_instance();		
		$this->_ci->load->library('session');
		$this->customer_info = $this->get_sess('customer_info');
		$this->shipping_info = $this->get_sess('shipping_info');
		$this->shipto_info  = $this->get_sess('shipto_info');	
		$this->payment_info = $this->get_sess('payment_info');	
		$this->check_step   = $this->get_sess('checkout_step');
	}		
	
	/**
	 * get_sess
	 *
	 * @return $session_name or False
	 * @author Zidni Mubarock
	 **/
	function get_sess($name)
	{
		if($this->_ci->session->userdata($name)){
			return $this->_ci->session->userdata[$name];
		}else{
			return false;
		}
	}
	/**
	 * write addtional data on session, needed during transaction
	 *
	 * @param string $name 
	 * @return void
	 * @author Zidni Mubarock
	 */
	function write_data($name=false){
		if($name){
			$this->_ci->session->set_userdata($name);
		}else{
			$this->_ci->session->sess_write();
		}
	}
	
	/**
	 * destroy_data
	 * for destroying all data on session, which needing during transaction				
	 * @return void
	 * @author Zidni Mubarock
	 **/
	function destroy_data($specify=false)
	{
		if($specify == false){
			$this->_ci->session->unset_userdata('customer_info');
			$this->_ci->session->unset_userdata('shipto_info');
			$this->_ci->session->unset_userdata('shipping_info');
			$this->_ci->session->unset_userdata('payment_info');
			$this->_ci->session->unset_userdata('checkout_step');
		}else{
			$this->_ci->session->unset_userdata($specify);
		}
		return true;
		
	}
	/**
	 * HackAttrib, to extract the product attribute from database, to array each key and value;
	 *
	 * @param string $value 
	 * @return $pairs
	 * @author Zidni Mubarock
	 */	
	function hackAttrib($value){		
	 $attribute = explode (';',$value);		
	       foreach ($attribute as $pair) {		
	               list ($k,$v) = explode (':',$pair);		
	               $pairs[$k] = $v;		
	       }		
	       return $pairs;		
	}
	/**
	 * GroupAttrib, to grouping and array into one index, if have same value
	 *
	 * @param array $attribs 
	 * @return new sorted array $attribs
	 * @author Zidni Mubarock
	 */	
	function groupArray($attribs){		
	$gr_attrib = array();		
	foreach ($attribs as $key => $value) {		
		if (array_key_exists($value, $gr_attrib)) {		
			 $gr_attrib[$value] .= ",$key";		
			} else {		
			 $gr_attrib[$value] = $key;		
			} // endif		
		} // end foreach		
	$attribs = array_flip($gr_attrib);		
	return $attribs;		
		
	}
	/**
	 * loadAttrib, extract the product attribute from database into and array, and group it
	 *
	 * @param array $attributes 
	 * @param string $index name of search index
	 * @return extracted and sorted group array $attrib
	 * @author Zidni Mubarock
	 */	
	function loadAttrib($attributes, $index){		
		foreach($attributes as $singelAttrb){		
			$source = $singelAttrb->attribute;		
			$attrb = $this->hackAttrib($source);		
				$preFinalArray[] = $attrb[$index];		
			} 		
				
			$attrb = $this->groupArray($preFinalArray);		
			return $attrb;		
			
	}
	function extractAttrib($data){
		$i = 0;
		foreach($data as $dt){
			$attrib = explode(';',$dt->attribute);
			foreach($attrib as $a){
			$i_attrb[$i] = strstr($a, ':', true);
			$i++;
			}
		}
		$return['index'] = $this->groupArray($i_attrb);
		
		foreach($return['index'] as $index){
			$return['attribute'][$index] = $this->loadAttrib($data, $index);
		}
		
		return $return;
	}
	/**
	 * Show_price, showing formated money format which selected currency or site default currency
	 *
	 * @param int $number ; number to be formated
	 * @param string $curr ; currency want to embed
	 * @return $formated
	 * @author Zidni Mubarock
	 */			
	function show_price($number, $curr=false){		
		if($curr == false){		
		$formated = $this->currency().' '.number_format($number, 2, ',', '.');		
		}else{	
			// TODO : Change when currency session change	
		$formated = $curr.' '.number_format($number, 2, ',', '.');		
		}		
		return $formated;		
	}	
	/**
	 * currency; get current currency set, from session or site config, default currency
	 *
	 * @return $currency
	 * @author Zidni Mubarock
	 */
	function currency(){		
		if($this->_ci->session->userdata('currency')){		
			$currency = $this->_ci->session->userdata('currency');		
		}else{		
			$currency = $this->_ci->config->item('currency');		
		}		
		return $currency;		
	}		
	/**
	 * rate ; get the current rate based on the current currency seted.
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */	
	function rate(){		
		$rate = $this->_ci->session->userdata('rate');		
		if($rate){		
			$rate = $rate;		
		}else{		
			$rate = 1;		
		}		
		return $rate;		
	}		
		
}		
