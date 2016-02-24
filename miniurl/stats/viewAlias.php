<?php
	/*** stats/viewAlias.php***/
	require_once("../const.php");

	//TODO: validación de parámetros
	$alias = $_REQUEST['a'];

	$sql= "select ip,fecha,cve_protocolo,url,created from visitas,enlaces where visitas.id_enlace = enlaces.id and enlaces.hash = '$alias' order by fecha desc";
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

	<div class="container">
		<div class="row">
			<h2>Estad&iacute;sticas del alias <?php echo $alias; ?></h2>
		</div>
		<div class="row">
			<div class="col-md-8">
				<table class="table table-hover table-condensed">
					<thead>
						<tr><th>IP</th><th>Fecha</th></tr>
					</thead>
					<tbody>
						<?php
							$rs = $base->Execute($sql);
							foreach ($rs as $registro) {
								$ip = $registro['ip'];
								$fecha = $registro['fecha'];
								echo "<tr><td>$ip</td><td>$fecha</td></tr>";
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