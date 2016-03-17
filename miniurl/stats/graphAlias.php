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
	$activePage = 'Statistics';
	$activeHeader = 'ok';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>


	<div class="container">
		<div class="row">
			<div class="col-md-12"><h2>Gr&aacute;fica diaria</h2><a href="/stats" class="back"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Get Back</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<!--The next hidden input is to feed the alias to the JS script in the footer-->
			<input type="hidden" id="alias" value="<?php echo $alias;?>" />
				<div id="graph-container" style="width:100%; height:400px;"></div>
			</div>
		</div>

	</div>
	

	<!-- JQuery y Bootstrap-->
	<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- Look and feel scripts -->
	<!-- <script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script> -->
	<!-- Highcharts scripts-->
	<!-- <script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script> -->
	<!-- <script type="text/javascript">
	/*$(function(){
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
	});*/
	</script>
</body>
</html> -->

<?php
$ownFinalScripts = array('/stats/graphAlias.js',"http://code.highcharts.com/highcharts.js","https://code.highcharts.com/modules/exporting.js");
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>
