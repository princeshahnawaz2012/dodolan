<?

class Store_carrier_helper
{


	
	var $path;
	
	function load($file){
		if(strpos($file, '/') !== false){
			$post = explode('/', $file);
			$file = $post[0].'_carrier';
			$func = $post[1];
		}else{
			$file = $file.'_carrier';
			$func = 'load';
		}
		$this->path =  APPPATH.'modules/store/extensions/carriers/';
		$path = $this->path;
		$args = func_get_args();
		// check that file exist;
  		if(self::find($path, $file)):
		    Modules::load_file($file, $path);
		    $file = ucfirst($file);
		    $carrier = new $file();
		    $widget->module_path = $path.'/'.$file;
		    return call_user_func_array(array($carrier, $func), array_slice($args, 1));
		else:
			return false;
		endif;
	
	}
	function find($path, $file){
		$file_path = $path.'/'.$file.EXT ;
		// check that file exist
		if(!file_exists($file_path)){
			return false;
		}else{
			return true;
		}
	}
	// LOAD CI GET_INSTANCE
	function __get($var) {
        global $CI;
        return $CI->$var;
    }
}
?>
