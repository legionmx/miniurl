<?php

if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
	
	$activePage = 'CSV Upload';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption">
		
			<form method="post" action="upload.php?method=transformCsv" enctype="multipart/form-data">

				<div class="row page-header">
					<div class="col-md-12 headerLine"><h2 class="success">Success</h2></div>
				</div>

				<div id="containerForm" class="container">
						<div class="row">
							
							<div id="errorSuccess" class="col-md-12">
								
								
								
							</div>
		
						</div>
				
				</div>
				

			</form>

	</div>
<?php
$ownFinalScripts = array('/index.js');
$ownFinalScripts = array('/upload/success.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>