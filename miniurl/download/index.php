<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();
	if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MINIURL - Carga masiva</title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="../css/sticky-footer.css" rel="stylesheet">
	<link href="../css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/owl.carousel.css"/>
    <link rel="stylesheet" href="../css/owl.theme.css"/>

</head>
<body>
	<nav id="section_header" class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">M I N I U R L</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav navbar-right">

					<li><a href="/">Inicio</a></li>
					<li><a href="/stats/">Estad&iacute;sticas</a></li>
					<li><a href="/upload/">Carga masiva</a></li>
					<li class="active"><a href="#">Descarga de url´s</a></li>
					<li><a href="/auth/logout.php">Logout</a></li>


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
           	 			<img src="../images/p1.jpg" alt="" class="img-responsive">
           	 		</div>
           	 	</div>
                <div class="item">
                    <div class="overlay-slide">
                        <img src="../images/p2.jpg" alt="" class="img-responsive">
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
		
			<form method="post" action="/class/report.php?method=csvDownload" enctype="multipart/form-data">

				<div class="row">
					<div class="col-md-12"><h2>URL´s CSV DOWNLOAD</h2></div>
				</div>

				<div id="containerForm" class="container">
				<div class="row">
					
					<div class="col-md-8">
						<p>
							<label for="rangeIds">¿Quiers descargar por rangos?</label>&nbsp;<input type="checkbox" id="rangeIds" name="rangeIds">
						</p>
					</div>

					<div class="col-md-4">
						<button type="submit" id="upload1" class="btn btn-primary" name="submit">Descargar Url´s</button>
					</div>

				</div>

				<div class="row">
					<div class="col-md-7" id="alias-group">
					
					</div>
				</div>
				

				<div class="row" id="rangeBox" style="display: none;">
					<div class="col-md-2">
						<label>Categor&iacute;a:</label>
					</div>
					<div class="col-md-3">
						
						<select id="categories" name="category" class="form-control">
							<option value="0">ninguna</option>
							<option value="1">Campaña 1</option>
							<option value="2">Campaña 2</option>
							<?php /*
							foreach ($_PROTOCOLOS as  $cveProt => $abvProt) {
								echo "<option value='$cveProt'>$abvProt</option>\n";
							}
							*/ ?>
						</select>
						
					</div>

					<div class="col-md-2">
						<label>Del registro:</label>
					</div>

					<div class="col-md-2">
						<input type="text" name="url" id="url" placeholder="1">
					</div>
					<div class="col-md-1">
						<label>al</label>
					</div>
					<div class="col-md-2">
						<input type="text" name="url" id="url" placeholder="">
					</div>
				</div>
				</div>
				

			</form>

	</div>
	<footer class="footer">
      <div class="container">
        <p class="text-muted">Nunc scio tenebris lux</p>
      </div>
    </footer>

	<!-- JQuery y Bootstrap-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Scripts propios -->
	<script type="text/javascript" src="../index.js"></script>
	<script type="text/javascript" src="../js/jquery.bxslider.min.js"></script>
	<script src="../js/owl.carousel.min.js"></script>
</body>
</html>