<?
class Front_product_slide extends Widget_helper
{
	var $detail = array(
		'name' => 'Font Product Slide',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'front_product_slide',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'Some Koplak Widget'
	);
	function getdetail(){
		return $this->detail;
	}
    function run($html) {
		$data = $html;
		$this->render('index',$data);
    }
	function getdata(){
		$this->db->where();
	}
}