<?
class Cart_widget extends Widget_helper
{
	var $detail = array(
		'name' => 'Cart Mini',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'cart_widget',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'Widget for Cart'
	);
	function getdetail(){
		return $this->detail;
	}
	function run(){
		$this->load->library('cart');
		$data = array(
			'total_price' => $this->cart->total(),
			'total_item' => $this->cart->total_items()
			);
		$this->render('index',$data);
	}
}