<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Addon_store Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : Theme.php
**/
class Addon_store
{
var $_ci 		=  '';
function Addon_store(){
	$this->_ci =& get_instance();

}

function hackAttrib($value){
	 $attribute = explode (';',$value);
        foreach ($attribute as $pair) {
                list ($k,$v) = explode (':',$pair);
                $pairs[$k] = $v;
        }
        return $pairs;
	}
function groupAttrib($attribs){
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
function loadAttrib($attributes, $index){
	foreach($attributes as $singelAttrb){
		$source = $singelAttrb->attribute;
		$attrb = $this->hackAttrib($source);
			$preFinalArray[] = $attrb[$index];
		} 
		
		$attrb = $this->groupAttrib($preFinalArray);
		return $attrb;
	
}
function show_price($number, $curr=false){
	if($curr == false){
	$formated = $this->currency().' '.number_format($number, 2, ',', '.');
	}else{
	$formated = $curr.' '.number_format($number, 2, ',', '.');
	}
	return $formated;
}
function currency(){
	if($this->_ci->session->userdata('currency')){
		$currency = $this->_ci->session->userdata('currency');
	}else{
		$currency = $this->_ci->config->item('currency');
	}
	return $currency;
}
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


?>