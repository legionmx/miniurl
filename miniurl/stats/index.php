<?php
/*** stats/index.php -- Index de las estadísticas ***/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
session_start();
if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
	header('Location: /auth/');
}
$uid = $_SESSION['uid'];
//session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Estad&iacute;sticas de uso</title>

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
					<li class="active"><a href="#">Statistics</a></li>
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
		<div class="row" class="page-header">
			<div class="col-md-12">
				<h2>Cool links use statistics</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th class="text-center" colspan="2">Alias</th>
							<th>Direcci&oacute;n</th>
							<th class="text-center">Visitas</th>
							<th>More</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true and enlaces.id_user = $uid group by id_enlace";
							$rs = $base->Execute($sql);
							foreach ($rs as $registro) {
								$alias = $registro['hash'];
								$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
								$visitas = $registro['num_visitas'];
								echo "<tr><td class='text-right'><a href='viewAlias.php?a=$alias'>$alias</a>&nbsp;</td><td><a href='graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-picture' aria-hidden='true'></span></button></a></td><td><a href='$direccion'>$direccion<a></td><td class='text-center'>$visitas</td><td>&nbsp;</td></tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- JQuery y Bootstrap-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>