<div class="box2">
<span class="bold">Analytics</span>	
<div class="horline"></div>
<br class="clear">
<? 
$ga = modules::run('backend/widget/ga_req');
$result =  array('name' => 'zidni', 'wife' => array('1' => 'Valentia', '2' => 'Devi Tri'), 'job' => 'jobless');
echo $this->misc->print_arrayRecrusive(json_decode($ga, true));
?>

</div>
