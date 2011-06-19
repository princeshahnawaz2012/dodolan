<?
class Custom_html extends Widget_helper
{
	var $detail = array(
		'name' => 'Custom HTML',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'custom_html',
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
	function create(){
		$this->render('create');
	}
	function update(){
		$this->render('update');
	}
}