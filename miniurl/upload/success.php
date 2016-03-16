<?php

if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
	
	$activePage = 'CSV Upload';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption backgroundCaption">
		
			<div class="container">
				<div class="row" class="page-header">
						<div class="col-md-12"><h2 class="success">Success</h2></div>
				</div>

				<div id="containerForm" class="container">
						<div class="row">
							
								<div id="errorSuccess" class="col-md-12">
								
								
								
								</div>
								
								<p class="totalUrl">They have shortened <?php echo $totalInserts; ?> URL's. </p>
								
								<div class="col-md-12">
										<table class="table table-hover table-condensed">
											<thead>
												<tr>
												<?php foreach($insertHeaders as $index => $value){ ?>
														
												
														<?php echo '<th>' .  $index . '</th>'; ?>
												
												<?php }?>
												</tr>
											</thead>
											<tbody>
												<?php foreach($insertAlias as $registers){ ?>
												<tr>
														<?php foreach($registers as $index => $value){ ?>
														
																<?php echo '<td>' .  $value . '</td>'; ?>
														
														<?php }?>
														</tr>
												<?php }?>
											</tbody>
										</table>
								</div>
								
								
						</div>
				
				</div>
			</div>
				


	</div>
<?php
$ownFinalScripts = array('/index.js');
$ownFinalScripts = array('/upload/success.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>