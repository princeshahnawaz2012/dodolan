<?
class Admin_ga extends Widget_helper
{
	var $detail = array(
		'name' => 'Google Analytic For Admin',
		'file_name' => 'admin_ga',
		'Author' => 'Zidni Mubarock',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'state'=> 'admin',
	);
	
    function run() {
		$this->render('index');
    }
	function getdetail(){
		return $this->detail;
	}
 
	function ga_chart_visit_req(){
		if($this->input->post('type')){
		$ga = $this->load->library('gapi');
		$req = $ga->requestReportData(array('date'),array('visitors', 'newVisits'), array('-date'),  $filter=null, $start_date=null, $end_date=null, $start_index=1, $max_results=50, 'ori');
			if($req){
				$data = $this->ga_data_extractor($ga->getDataArray());
				$data_ext = array('status' => 'true');
			}else{
				$data = array('status' => 'error');
			}
			echo json_encode($data);
		}
	}
	
	function ga_data_extractor($gadata){
		$visitors =  array();
		$newVisits = array();
		// visitors
		foreach($gadata as $dt => $datval){
			list($year, $month, $day) = sscanf($dt, '%04d%02d%02d');
			$date = new DateTime($year.'-'.$month.'-'.$day);

			$str_date = $date->format('l, F j,  Y');
			//$date = date_create_from_format('Ymd', $dt);
			//$str_date = $dt;
			$v = array('date' => $str_date, 'value' => $datval['ga:visitors']);
			$nv = array('date' => $str_date, 'value' => $datval['ga:newVisits']);
			array_push($visitors, $v);
			array_push($newVisits, $nv);	
		}
		$return['visitors'] = $visitors;
		$return['newVisits'] = $newVisits;
		return $return;
	}

	function test_func($var){
		echo $var;
	}
	
}
?>