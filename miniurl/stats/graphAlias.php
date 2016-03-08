<?php
	/*** /stats/graphAlias.php --- Generates a graphic view of the visits of a given alias ***/
	//require_once('../const.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();
	if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];

	//TODO: Falta validar parámetros
	$alias = $_REQUEST['a'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Gr&aacute;fica de visitas</title>
	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">M I N I U R L</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/">Home</a></li>
					<?php if(isset($_SESSION['authToken'])){ ?>
					<li class="active"><a href="/stats/">Statistics</a></li>
					<li><a href="/upload/">CSV upload</a></li>
					<li><a href="/download/">CSV download</a></li>
					<li><a href="/auth/logout.php">Logout</a></li>
					<?php
					}
					else{
					?>
					<li><a href="/auth/">Login</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row page-header">
			<div class="col-md-12">&nbsp;</div>
		</div>
		<div class="row">
			<div id="graph-container" style="width:100%; height:400px;"></div>
		</div>
	</div>

	<!-- JQuery y Bootstrap-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript">
	$(function(){
		$.getJSON('getGraphData.php',{"alias":"<?php echo $alias; ?>"},function(response){
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
	</script>
</body>
</html>