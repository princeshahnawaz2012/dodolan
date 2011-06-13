<?
class Misc {
	
	function Misc()
	{
			$this->_ci =& get_instance();
	}
	
	function custom_time($date, $nodate=false)
	{
		if(empty($date) || $date == null) {
			if($nodate==false){
		        return "No date provided";
			}else{
				return $nodate;
			}
		    }

		    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		    $lengths         = array("60","60","24","7","4.35","12","10");

		    $now             = time();
		    $unix_date         = strtotime($date);

		       // check validity of date
		    if(empty($unix_date)) {    
		        return "Bad date";
		    }

		    // is it future date or past date
		    if($now > $unix_date) {    
		        $difference     = $now - $unix_date;
		        $tense         = "ago";

		    } else {
		        $difference     = $unix_date - $now;
		        $tense         = "from now";
		    }

		    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		        $difference /= $lengths[$j];
		    }

		    $difference = round($difference);

		    if($difference != 1) {
		        $periods[$j].= "s";
		    }
		    return "$difference $periods[$j] {$tense}";
	}
	function arrayObject($array){
		return json_decode(json_encode($array));
	}
	function objectToArray($object)
		{
			$array=array();
			foreach($object as $member=>$data)
			{
				$array[$member]=$data;
			}
			return $array;
		}
		
	function jsonToArray($json){
		return json_decode($json, true);
	}
	function arrayToJson($array){
		return json_encode($array);
	}
	function objectToJson($objects){
		return json_encode($this->objectToArray($objects));
	}
	function print_arrayRecrusive($array){
		$output = '';
		foreach($array as $key => $value){
			$output .= '<div class="box2 mb10"><span class="bold">'.$key.'</span> =';
			if(is_array($value)){
				$output .= $this->print_arrayRecrusive($value);
			}else{
				$output .= $value;
			}
				
				
			$output .= '</div>';
		}
		return $output;
	}
	function datetime($sort=false){
		if($sort){
			return date('Y-m-d H:i:s', strtotime($sort));
		}else{
			return date('Y-m-d H:i:s');
		}
	}
}