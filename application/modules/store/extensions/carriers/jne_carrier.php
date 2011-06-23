<? 
class Jne_carrier extends Store_carrier_helper {

	var $url_getcity = 'http://www.jne.co.id/tariff.php?';
	var $url_getrate = 'http://www.jne.co.id/index.php?mib=tariff&amp;lang=IN';
	var $base_from_code = 'Q0dLMTAwMDBK';// jakarta base
	function load()
	{
		
	}
	// OVERIDING FUNCTION
	function get_rate($destination_code, $weight){
		$fields = 	'origin_code='.urlencode($this->base_from_code).
                    '&destination_code='.urlencode($destination_code).
                    '&weight='.$weight;
		
		$ch = curl_init($this->url_getrate);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		if (!$result) {
			return false;
		} else {
			curl_close($ch);
				// ambil variabel data tarif
				// checking if the curl result macth form the pattern, if no, return false
				if(strpos($result, "<tr class='trfC'>") == true){
						$result = explode("<tr class='trfC'>", $result);
						$last = count($result)-1;
						unset($result[0]);
						$result[$last] = explode("</table>", $result[$last]);
						$result[$last] = $result[$last][0]; 

						$tag = array('<td>', '</td>', '</tr>');
						foreach ($result as &$str) {
							$str = str_replace($tag, '', $str);
							$str = explode(' ', $str);
							//unset($str[1]);
							$str[2] = trim(str_replace(array(',', '.00'), '', $str[2]));
						ksort($str);
						}

						$rate = $this->addon_store->rate();
						$site_currency = $this->addon_store->currency();
						$index = 0;

						foreach($result as $r){
							$cost = $r[2]*$rate;
							$data[$index]['id_rate']   = 'jne_'.$index++;
							$data[$index]['type'] = $r[0];
							$data[$index]['formated_rate'] = $this->addon_store->show_price($cost);
							$data[$index]['rate'] = $cost;
							$data[$index]['o_rate'] = $cost/$weight;
							$index++;
						}
					$return['data'] = $data;
					return $return;
				}else{
					return false;
				}
			
		}
	}
	function chec_krate($id){
		
	}
	// ADDITION FUNCTION
	function ajax_getcity(){
		if($this->input->post('city')){
			$json = $this->getDestination($this->input->post('city'), 4);
			echo $json;
		}
	}
	function getDestination($q, $limit) {
		$query = 'q='.$q.'&limit=5';
		$url = $this->url_getcity.''.$query;

	    $getSource = @fopen($url, 'r');

		if($getSource){
		while(!feof($getSource)){
       		$lines[] = fgets($getSource, 4096);
		}
        fclose($getSource);
	    $list = $lines;
	    $index = 0;
	 	foreach($list as $item){
	 		$itemdata = explode('|', $item);
			if(isset($itemdata[0])&&isset($itemdata[1])){
	 		$codecity = preg_replace('/\r\n|\r/', "", $itemdata[1]);
	 		$data[$index]['value'] =   ucwords(strtolower($itemdata[0]));
	 		$data[$index]['city_code'] = $codecity;
			}
	 		$index++;
	 	}
	 		if(count($data) >= 1 && $data[0]['city_code'] == ' null '){
	 			$data_nope = array('value' => 'nope', 'city_code' => 'null');
			
	 			return json_encode($data_nope);
	 		}else{
 				
 				return json_encode($data);	
 			}
 		
	 	}else{
	 		$data_nope = array('value' => 'nope', 'city_code' => 'null');
	 		return json_encode($data_nope);
	 	}
	 	
		
	}
	function getRate($destination_code, $weight){
		
		$fields = 	'origin_code='.urlencode($this->base_from_code).
                    '&destination_code='.urlencode($destination_code).
                    '&weight='.$weight;
		
		$ch = curl_init($this->url_getrate);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		if (!$result) {
			return false;
		} else {
			curl_close($ch);
				// ambil variabel data tarif
				// checking if the curl result macth form the pattern, if no, return false
				if(strpos($result, "<tr class='trfC'>") == true){
						$result = explode("<tr class='trfC'>", $result);
						$last = count($result)-1;
						unset($result[0]);
						$result[$last] = explode("</table>", $result[$last]);
						$result[$last] = $result[$last][0]; 

						$tag = array('<td>', '</td>', '</tr>');
						foreach ($result as &$str) {
							$str = str_replace($tag, '', $str);
							$str = explode(' ', $str);
							//unset($str[1]);
							$str[2] = trim(str_replace(array(',', '.00'), '', $str[2]));
						ksort($str);
						}

						$rate = $this->addon_store->rate();
						$site_currency = $this->addon_store->currency();
						$index = 0;

						foreach($result as $r){
							$cost = $r[2]*$rate;
							$data[$index]['id_rate']   = 'jne_'.$index++;
							$data[$index]['type'] = $r[0];
							$data[$index]['formated_rate'] = $this->addon_store->show_price($cost);
							$data[$index]['rate'] = $cost;
							$data[$index]['o_rate'] = $cost/$weight;
							$index++;
						}
					$return['data'] = $data;
					return $return;
				}else{
					return false;
				}
			
		}
	}
	function choosenRate($destination_code, $weight, $id){
		$rates = $this->getRate($destination_code, $weight);
		
		if($rates){
		foreach($rates['data'] as $rate){
				if($rate['id_rate'] == $id){
					$final_cost = $rate;
				}
			}
		return $final_cost;
		}else{
			return false;
		}
	}
	function service($code){
		if($code == 'SS'){
			$type = 'SS (Special Service)';
		}elseif($code == 'YES'){
			$type = 'YES (Yakin Esok Sampai)';
		}elseif($code == 'REG'){
			$type = 'REG (Regular)';
		}elseif($code == 'OKE'){
			$type = 'OKE (Ongkos Kirim Ekomonis)';
		}else{
			$type = $code;
		}	
		return $type;	
	}
}