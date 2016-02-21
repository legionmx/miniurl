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
				$sql = "select hash,url from enlaces where seLogea = true";
				$rs = $base->Execute($sql);
				foreach ($rs as $registro) {
					$hash = $registro['hash'];
					$url = $registro['url'];
					echo "<tr><td>$hash</td><td>$url</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				}
			?>
		</tbody>
	</table>
</body>
</html>