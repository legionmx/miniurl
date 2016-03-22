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
				<!-- Next comment in case the code is somehow needed in other scripts validations after sending the form -->
				<!-- <div class="row">
					
					<div class="col-md-8">
						<p>
							<input type="checkbox" id="rangeIds" name="rangeIds">&nbsp;<label for="rangeIds">You want to download ranges?</label>
						</p>
					</div>

					<div class="col-md-4 contentButon">
						<button type="submit" id="upload1" class="btn btn-primary" name="submit">Url´s Download</button>
					</div>

				</div> -->

				<div class="row">
					<div class="col-md-7" id="alias-group">
					
					</div>
				</div>
				

				<div id="rangeBox">
					<?php if(isset($_CATEGORIES) && $_CATEGORIES != null){ ?>
					<div class="row">
						<div class="col-md-3">
							<label>Category:</label>
						</div>
						<div class="col-md-5">
							
							<select id="categories" name="category" class="form-control">
								<option value='0' selected="selected">No Categories</option>
								<?php 
								foreach ($_CATEGORIES as  $cveCat => $abvCat) {
									echo "<option value='$cveCat'>$abvCat</option>\n";
								}
								?>
							</select>
							
						</div>
					</div>
					<?php } ?>
					
					<div class="row">
						
						<div class="col-md-3">
							<label>Range of:</label>
						</div>
	
						<div class="col-md-2">
							<input type="text" name="range1" id="range1" placeholder="">
						</div>
						<div class="col-md-1">
							<label>to:</label>
						</div>
						<div class="col-md-2">
							<input type="text" name="range2" id="range2" placeholder="">
						</div>
						<div class="col-md-4 contentButon">
							<button type="submit" id="upload1" class="btn btn-primary" name="submit">Url´s Download</button>
						</div>
					</div>
				</div>
				</div>
				

			</form>
		</div>
		</div>

	</div>
<?php
$ownFinalScripts = array('download.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>