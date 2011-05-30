<script type="text/javascript">

	var chart;
	$(document).ready(function() {
		
		// define the options
		var options = {
	
			chart: {
				renderTo: 'gaAnalyticCHart'
			},
			
			title: {
				text: 'Daily visits at www.highcharts.com'
			},
			
			subtitle: {
				text: 'Source: Google Analytics'
			},
			
			xAxis: {
				type: 'datetime',
				tickInterval: 30 * 24 * 3600 * 1000, // one week
				tickWidth: 0,
				gridLineWidth: 1,
				labels: {
					align: 'left',
					x: 3,
					y: -3 
				}
			},
			
			yAxis: [{ // left y axis
				title: {
					text: null
				},
				labels: {
					align: 'left',
					x: 3,
					y: 16,
					formatter: function() {
						return Highcharts.numberFormat(this.value, 0);
					}
				},
				showFirstLabel: false
			}, { // right y axis
				linkedTo: 0,
				gridLineWidth: 0,
				opposite: true,
				title: {
					text: null
				},
				labels: {
					align: 'right',
					x: -3,
					y: 16,
					formatter: function() {
						return Highcharts.numberFormat(this.value, 0);
					}
				},
				showFirstLabel: false
			}],
			
			legend: {
				align: 'left',
				verticalAlign: 'top',
				y: 20,
				floating: true,
				borderWidth: 0
			},
			
			tooltip: {
				shared: true,
				crosshairs: true
			},
			
			plotOptions: {
				series: {
					cursor: 'pointer',
					point: {
						events: {
							click: function() {
								hs.htmlExpand(null, {
									pageOrigin: {
										x: this.pageX, 
										y: this.pageY
									},
									headingText: this.series.name,
									maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) +':<br/> '+ 
										this.y +' visits',
									width: 200
								});
							}
						}
					},
					marker: {
						lineWidth: 1
					}
				}
			},
			
			series: [{
				name: 'All visits',
				data:[["Saturday, May 28, 2011","9"],["Friday, May 27, 2011","151"],["Thursday, May 26, 2011","153"],["Wednesday, May 25, 2011","180"],["Tuesday, May 24, 2011","152"]] 
			
			}, {
				name: 'New visitors',
				data: {[["Saturday, May 28, 2011","9"],["Friday, May 27, 2011","151"],["Thursday, May 26, 2011","153"],["Wednesday, May 25, 2011","180"],["Tuesday, May 24, 2011","152"]]}
			}]
		}
		
		// Load data asynchronously using jQuery. On success, add the data
		// to the options and initiate the chart.
		// This data is obtained by exporting a GA custom report to TSV.
		// http://api.jquery.com/jQuery.get/
		chart = new Highcharts.Chart(options);
	});
		
</script>
all visit = <br/>
<div class="dataChart"></div>
new Visit = <br/>
<div class="dataChart2"></div>
</div>

<?php

 print strtotime(date('Ymd'));

?>
<div id="gaAnalyticCHart" style="width: 800px; height: 200px; margin: 0 auto"></div>
<div class="box2">
<span class="bold">Analytics</span>	
<div class="horline"></div>
<br class="clear">
<?
function cinverttimestamp($indate){
    list($year, $month, $day) = explode('-', $indate);
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    return $timestamp;
}
$date = date_create('2011-05-17');
echo date_timestamp_get($date);


echo '<h1>'.$timestamp.'</h1>';
?>

<span class="bold itsdate"></span>
<? 
$ga = modules::run('backend/widget/ga_chart_visit_req');
echo json_encode($ga['newVisits']);
$utc_str = gmdate("M d Y H:i:s", time());

?>


