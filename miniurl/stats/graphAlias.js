$(function(){
	$.getJSON('getGraphData.php',{"alias": $("#alias").val()},function(response){
		$("#graph-container").highcharts({
			xAxis: {
				categories: response.fechas
			},
			yAxis: {
				title: {
					text: 'Visitas'
				}
			},
			tooltip: {
				valueSuffix: ' visita(s)'
			},
			series: [{
				name: ':',
				data: response.visitas
			}]
		});
	});
});