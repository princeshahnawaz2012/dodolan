<?
class Dodol_widget {
	
	function Dodol_widget()
	{
			$this->_ci =& get_instance();
	}
	function list_all($state =false){
		$state = ($state == false) ? 'all' : $state;
		$all_widget = array();
		
		if($state == 'all'):
			$admin    = scandir(APPPATH.'widgets/admin');
			if(count($admin) > 0):
			foreach($admin as $item){
				if(strpos($item, '.') === false  && $item != '.DS_Store'){
			 		$detail = widget_helper::run('admin/'.$item.'/'.$item.'/getdetail');
					array_push($all_widget, $detail);
				}
			}
			endif;
			$front    = scandir(APPPATH.'widgets/front');
			if(count($front) > 0):
			foreach($front as $item){
				if(strpos($item, '.') === false){
			 		$detail = widget_helper::run('front/'.$item.'/'.$item.'/getdetail');
			 		$single = array('state' => 'admin', 'name' => $detail['name']);
					array_push($all_widget, $detail);
				}
			}
			endif;


		elseif($state == 'admin'):
			$admin    = scandir(APPPATH.'widgets/admin');
			if(count($admin) > 0):
			foreach($admin as $item){
				if(strpos($item, '.') === false){
			 		$detail = widget_helper::run('admin/'.$item.'/'.$item.'/getdetail');
					array_push($all_widget, $detail);
				}
			}
			endif;
		elseif($state == 'front'):
				$front    = scandir(APPPATH.'widgets/front');
				if(count($front) > 0):
				foreach($front as $item){
					if(strpos($item, '.') === false){
				 		$detail = widget_helper::run('front/'.$item.'/'.$item.'/getdetail');
						array_push($all_widget, $detail);
					}
				}
				endif;
			
		else:
			return false;
		
		endif;
		
		return 	(count($all_widget) > 0 ) ? $all_widget : false;
	}
	function get_detail($state, $name){
		return 	$detail = widget_helper::run($state.'/'.$name.'/'.$name.'/getdetail');
	}
	
	

}