<?php
// stats/index.php -- Index de las estadísticas
require_once("../const.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Estad&iacute;sticas de uso</title>

</head>
<body>
	<h1>Estad&iacute;sticas de uso de enlaces</h1>
	<table>
		<thead>
			<tr>
				<th>Hash</th>
				<th>URL</th>
				<th>Visitas</th>
				<th>More</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//$sql = "select hash,url from enlaces where seLogea = true";
				$sql = "select hash,url,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace group by id_enlace";
				$rs = $base->Execute($sql);
				foreach ($rs as $registro) {
					$hash = $registro['hash'];
					$url = $registro['url'];
					$visitas = $registro['num_visitas'];
					echo "<tr><td>$hash</td><td>$url</td><td>$visitas</td><td>&nbsp;</td></tr>";
				}
			?>
		</tbody>
	</table>
</body>
</html>