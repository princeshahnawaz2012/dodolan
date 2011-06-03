
	<div class="footerWrap">
	<p>Dodolan Framework &copy; 2011 Alright Reserved, Develop by BarockProjects</p>
	</div>
	<?
	$dt = 20110603;
		list($year, $month, $day) = sscanf($dt, '%04d%02d%02d');
		$date = new DateTime($year.'-'.$month.'-'.$day);
		
		$str_date = $date->format('l, F j,  Y');
		echo $str_date;
	?>
	<small>Debug</small>
	
	<div class="horline"></div>
Page rendered in {elapsed_time} seconds
</div>
</div>
<div id="ajaxdialog" class="ajaxdialog hide msg-Ui">
	
</div>
</body>
</html>
