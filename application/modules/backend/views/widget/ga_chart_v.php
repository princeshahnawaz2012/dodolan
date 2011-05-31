<div class="ga_chart">
	<script type="text/javascript" charset="utf-8">
		
		var chart;
		$(document).ready(function(){
			// define the options
			var options = {
				chart: {
					renderTo: 'chart_main'
				},
				title: {
					text: 'Actual Statistic Visitor Counter'
				},
		
				subtitle: {
					text: 'Source: Google Analytics'
				},
				
				xAxis: {
					type: 'datetime',
					tickInterval: 7 * 24 * 3600 * 1000, // one week
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
					lineWidth: 1,
					marker: {
						radius: 2
					}
				}, {
					name: 'New visitors',
					lineWidth: 1,
					marker: {
						radius: 2
					}
				}]
			}
		
		
			
			function ga_data_extract(object){
				new_object = [];
				$.each(object, function(i, item){
					date = Date.parse(item.date +' UTC');
					new_object.push([
						date, 
						parseInt(item.value.replace(',', ''), 10)
					]);
				});
				return new_object;
				
			}
			function get_ga_data(){
					$.ajax({
						type: "POST",
						dataType : "json",
						data : {'type' : 'json'},	
						url: "<?=site_url('backend/widget/ga_chart_visit_req')?>",
						success: function(data){					     
							   	if(data.status != 'error'){
								allVisits = ga_data_extract(data.visitors),
								newVisitors = ga_data_extract(data.newVisits),
								options.series[0].data = allVisits;
								options.series[1].data = newVisitors;

								chart = new Highcharts.Chart(options);
							   	}else{
							   		alert('somthing wrong');
							   	}
						   }
					});
			}
			get_ga_data();
			$('.ga_refresh').click(function(){
				get_ga_data();
			})
		});
	</script>
	
	<div id="chart_main" class="grid_600 left" style="height: 200px; margin: 0 auto" >
		
	</div>
	<br>
	<span class="button ga_refresh">Refresh</span>
	<div class="clear"></div>
</div>
<?
?>