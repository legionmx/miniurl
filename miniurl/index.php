<?php
	require_once("const.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MINIURL</title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="css/sticky-footer.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">M I N I U R L</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">Inicio</a></li>
					<li><a href="stats/">Estad&iacute;sticas</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12"><h2>M I N I U R L</h2></div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<select id="protocolo" name="protocolo" class="form-control">
					<?php
					//foreach (CONS::PROTOCOLOS as  $cveProt => $abvProt) {
					foreach($_PROTOCOLOS as $cveProt => $abvProt) {
						echo "<option value='$cveProt'>$abvProt</option>\n";
					}
					?>
				</select>
				<input type="text" id="prot_propio" class="form-control input-sm hidden" placeholder="Protocolo">
			</div>
			<!-- <div class="col-md-2">
				<input type="text" id="prot_propio" class="form-control hidden" placeholder="Protocolo">
			</div> -->
			<!-- <div class="col-md-2 hidden" id="div_prot_propio">
				<input type="text" id="prot_propio">
			</div> -->
			<div class="col-md-4">
				<input type="url" name="url" id="url" class="form-control" placeholder="Direcci&oacute;n a minimizar">
			</div>
			<div class="col-md-1">
				<button type="submit" id="generar" class="btn btn-default" disabled>Generar Alias</button>
			</div>
		</div>

		<div class="row">
			<div class="col-md-7" id="alias-group">
			<p>
				<div class="input-group">
					<span class="input-group-addon"><?php echo CONS::BASEURL;?></span>
					<input type="text" id="alias" class="form-control" placeholder="Alias">
				</div>
			</p>
			</div>
		</div>

		


		<div class="row">
			<div class="col-md-12">
				<p id="error"></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>
					<label for="conLog">¿Logear visitas?</label>&nbsp;<input type="checkbox" id="conLog">
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>
					<button type=submit id="salvar" class="btn btn-primary" disabled>Salvar url minimizado</button>
				</p>
			</div>
		</div>
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
	<script type="text/javascript" src="index.js"></script>
</body>
</html>