<?
class menu extends Widget_helper
{
	var $detail = array(
		'name' => 'Menu Manager',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'menu',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'Some Koplak Widget'
	);
	function getdetail(){
		return $this->detail;
	}
    function run($param=array()) {
		$data['param'] = $param;
		$data['menus'] = modules::run('nav/nav_item/getbynav', $param['id_menu']);
		$this->render('index',$data);
    }
	function create(){
		$this->render('create');
	}
	function update($param){
		$data['param'] = $param;
		$this->render('update', $data);
	}
	
}