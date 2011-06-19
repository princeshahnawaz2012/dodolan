<?
class Dodol_conf {
	
	function Dodol_conf()
	{
			$this->_ci =& get_instance();
			$this->mdl = $this->_ci->load->model('conf/conf_m');
			if($all = $this->mdl->getall()):
				foreach($all as $item){
					$config_name = str_replace(' ','_', $item->name);
					$this->$config_name = json_decode($item->config_object);
				}
			endif;
	}
	function load($config_name, $return = false){
		$object = $this->mdl->getbyname($config_name)->config_object;
		if($return == true){
			$config_name = str_replace(' ','_', $config_name);
			$this->$config_name =  json_decode($object, true);
			return $this;
		}else{
			$config_name = str_replace(' ','_', $config_name);
			$this->$config_name =  json_decode($object);
			return $this;
		}
		
	}
	
	function item($config_name, $item_name){
	}
}