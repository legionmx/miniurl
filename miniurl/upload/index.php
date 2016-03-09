<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();
	if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
	$activePage = 'CSV Upload';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption">
		
			<form method="post" action="upload.php?method=transformCsv" enctype="multipart/form-data">

				<div class="row">
					<div class="col-md-12"><h2>URL´s CSV UPLOAD</h2></div>
				</div>

				<div id="containerForm" class="container">
				<div class="row">
					
					<div class="col-md-8">
						<input type="file" name="fileToUpload" id="fileToUpload" class="form-control fileToUpload" placeholder="Selecciona un archivo">
					</div>

					<div class="col-md-4">
						<button type="submit" id="upload1" class="btn btn-primary" name="submit" disabled>Subir y generar alias</button>
					</div>

				</div>

				<div class="row">
					<div class="col-md-7" id="alias-group">
					
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>
							<label for="sameUrl">¿Usar misma url?</label>&nbsp;<input type="checkbox" id="sameUrl" name="sameUrl">
						</p>
					</div>
				</div>

				<div class="row" id="sameUrlBox" style="display: none;">
					<div class="col-md-3">
						<select id="protocolo" name="protocolo" class="form-control">
							<?php
							foreach ($_PROTOCOLOS as  $cveProt => $abvProt) {
								echo "<option value='$cveProt'>$abvProt</option>\n";
							}
							?>
						</select>
						<input type="text" id="prot_propio" class="form-control input-sm hidden" placeholder="Protocolo">
					</div>
					<div class="col-md-5">
						<input type="text" name="url" id="url" placeholder="Direcci&oacute;n a minimizar">
					</div>
					<div class="col-md-4">
						<p>
							<label id="labelLog" for="conLog">¿Logear visitas?</label>&nbsp;<input type="checkbox" id="conLog" name="conLog">
						</p>
					</div>
				</div>
				</div>
				

			</form>

	</div>
	<!-- <footer class="footer">
      <div class="container">
        <p class="text-muted">Nunc scio tenebris lux</p>
      </div>
    </footer> -->

	<!-- JQuery y Bootstrap-->
	<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- Scripts propios -->
	<!-- <script type="text/javascript" src="../index.js"></script>
	<script type="text/javascript" src="../js/jquery.bxslider.min.js"></script>
	<script src="../js/owl.carousel.min.js"></script>
</body>
</html> -->
<?php
$ownFinalScripts = array('/index.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>