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
	<link href="/css/sticky-footer.css" rel="stylesheet">
	<link href="/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/owl.carousel.css"/>
    <link rel="stylesheet" href="/css/owl.theme.css"/>
</head>
<body>

	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand"><img src="/images/logo_white.png" height="73" width="230" /></a>
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

	<!-- Slider start -->
    <section id="slider_part">
         <div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
            <!-- Indicators -->
         	 <ol class="carousel-indicators text-center">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
             </ol>

           	<div class="carousel-inner">
           	 	<div class="item active">
           	 		<div class="overlay-slide">
           	 			<img src="/images/p1.jpg" alt="" class="img-responsive">
           	 		</div>
           	 	</div>
                <div class="item">
                    <div class="overlay-slide">
                        <img src="/images/p2.jpg" alt="" class="img-responsive">
           	 		</div>
           	 	</div>

           	 </div> 	 <!-- End Carousel Inner -->

            <!-- Controls -->
            <div class="slides-control ">
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                	<span><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                	<span><i class="fa fa-angle-right"></i></span>
                </a>
            </div>
        </div>
  	</section>
    <!--/ Slider end -->

    <div class="carousel-caption">

	<div class="container">
		<div class="row page-header">
			<div class="col-md-12"><h2>Gr&aacute;fica diaria</h2></div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<!--The next hidden input is to feed the alias to the JS script in the footer-->
			<input type="hidden" id="alias" value="<?php echo $alias;?>" />
				<div id="graph-container" style="width:100%; height:400px;"></div>
			</div>
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