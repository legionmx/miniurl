<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	
	if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
	
	$activePage = 'CSV Download';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

	<div class="carousel-caption">
		
		<div class="container">
			<div id="wrapAllForm">
			<div class="row page-header">
				<div class="col-md-12 headerLine"><h2>Download</h2></div>
			</div>
			<form id="uploadForm" method="post" action="/class/report.php?method=csvDownload" enctype="multipart/form-data">

				<div id="containerForm" class="container">
				<div class="row">
					
					<div class="col-md-8">
						<p>
							<label for="rangeIds">¿Quieres descargar por rangos?</label>&nbsp;<input type="checkbox" id="rangeIds" name="rangeIds">
						</p>
					</div>

					<div class="col-md-4 contentButon">
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
							<option value='0' selected="selected">No Categories</option>
							<?php 
							foreach ($_CATEGORIES as  $cveCat => $abvCat) {
								echo "<option value='$cveCat'>$abvCat</option>\n";
							}
							?>
						</select>
						
					</div>

					<div class="col-md-2">
						<label>Del registro:</label>
					</div>

					<div class="col-md-2">
						<input type="text" name="range1" id="range1" placeholder="">
					</div>
					<div class="col-md-1">
						<label>al</label>
					</div>
					<div class="col-md-2">
						<input type="text" name="range2" id="range2" placeholder="">
					</div>
				</div>
				</div>
				

			</form>
		</div>
		</div>

	</div>
<?php
$ownFinalScripts = array('/index.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>