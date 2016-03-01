<?php
/*** stats/index.php -- Index de las estadísticas ***/
require_once("../const.php");
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
			<h2>Estad&iacute;sticas de uso de enlaces</h2>
		</div>
		<div class="row">
			<div class="col-md-10">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Alias</th>
							<th>Direcci&oacute;n</th>
							<th>Visitas</th>
							<th>More</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//$sql = "select hash,url from enlaces where seLogea = true";
							//$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace group by id_enlace";
							$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true group by id_enlace";
							$rs = $base->Execute($sql);
							foreach ($rs as $registro) {
								$alias = $registro['hash'];
								$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
								$visitas = $registro['num_visitas'];
								echo "<tr><td><a href='viewAlias.php?a=$alias'>$alias</a>&nbsp;<a href='graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-picture' aria-hidden='true'></span></button></a></td><td><a href='$direccion'>$direccion<a></td><td>$visitas</td><td>&nbsp;</td></tr>";
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