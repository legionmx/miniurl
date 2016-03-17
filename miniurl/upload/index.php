<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/class/Register.php');
	session_start();
	
	if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
	
	$activePage = 'CSV Upload';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
	
	$regCategories = new Register;
	$getCategories= $regCategories->getNameCat();

?>

    <div class="carousel-caption">
	<div class="container">
		<div id="wrapAllForm">
			
			<div class="row page-header">
				<div class="col-md-12 headerLine">
					<h2>Upload</h2>
				</div>
			</div>
		
			<form method="post" action="upload.php?method=transformCsv" enctype="multipart/form-data">

				<div id="containerForm" class="container">
					<div class="row">
						
						<div class="col-md-8">
							<div class="inputFile"><label class="butonInputFile">Browse</label><span id="fileName">Select File</span></div>
							<input type="file" name="fileToUpload" id="fileToUpload" class="form-control fileToUpload" placeholder="Select CSV">
						</div>
	
						<div class="col-md-4 contentButon">
							<button type="submit" id="upload1" class="btn btn-primary" name="submit" disabled>Upload - generate</button>
						</div>
	
					</div>
	
					<div class="row">
						<div class="col-md-7" id="alias-group">
						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p>
								<input type="checkbox" id="sameUrl" name="sameUrl">&nbsp;<label for="sameUrl">Use the same url?</label>
							</p>
						</div>
					</div>
	
					<div id="sameUrlBox" style="display: none;">
						<div class="row">
							<div class="col-md-3">
								<select id="protocolo" name="protocolo" class="form-control">
									<?php
									foreach ($_PROTOCOLOS as  $cveProt => $abvProt) {
										echo "<option value='$cveProt'>$abvProt</option>\n";
									}
									?>
								</select>
								<input type="text" id="prot_propio" name="prot_propio" class="form-control input-sm hidden" placeholder="Protocol">
							</div>
							<div class="col-md-5">
								<input type="text" name="url" id="url" placeholder="URL to minimize">
							</div>
							<div class="col-md-4">
								<p>
									<input type="checkbox" id="conLog" name="conLog">&nbsp;<label id="labelLog" for="conLog">¿Log visits?</label>
								</p>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-3 newCategory">
								<select id="newCategory" name="category" class="form-control">
									<option value="off" selected="selected">-Select-</option>
									<option value='0'>Other</option>
									<?php 
										foreach ($getCategories as  $cveCat => $abvCat) {
											echo "<option value='$cveCat'>$abvCat</option>\n";
										}
									?>
								</select>
								
							</div>
							<div class="col-md-5">
								<input type="text" id="category_new" name="category_new" class="form-control input-sm hidden" placeholder="New Category">
							</div>
							
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