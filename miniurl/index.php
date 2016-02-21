<?php
	include("const.php");
?>
<html>
<head>
<title>MINIURL</title>
<script type="text/javascript" src="jquery-2.2.0.js"></script>
<script type="text/javascript" src="index.js"></script>
</head>
<body>
	<h1>M I N I U R L</h1>
	<br>
	<select id="protocolo" name="protocolo">
		<?php
		foreach (CONS::PROTOCOLOS as  $cveProt => $abvProt) {
			echo "<option value='$cveProt'>$abvProt</option>\n";
		}
		?>
	</select>
	<input type="text" size=100 name="url" id="url">
	<input type="button" id="generar" value="Generar" disabled>
	<p id="error"></p>
	<p><em><?php echo CONS::BASEURL;?><span id="hashgen"></span></em><br><label>¿Logear visitas?</label><input type="checkbox" id="conLog"></p>
</body>
</html>