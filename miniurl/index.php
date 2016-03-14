<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption">
	
	<div class="container">
		<div id="wrapAllForm">
			<div class="row page-header">
				<div class="col-md-12 headerLine"><img id="logoTitle" src="/images/logo_lnk.cool_green.png" width="200"></div>
			</div>
			<div id="containerForm" class="container" >
				<div class="row">
					<div class="col-md-3">
						<select id="protocolo" name="protocolo" class="form-control">
							<?php
							foreach($_PROTOCOLOS as $cveProt => $abvProt) {
								echo "<option value='$cveProt'>$abvProt</option>\n";
							}
							?>
						</select>
						<input type="text" id="prot_propio" class="form-control input-sm hidden" placeholder="Protocolo">
					</div>
					<div class="col-md-5">
						<input type="url" name="url" id="url" class="form-control" placeholder="URL to minimize">
					</div>
					<div class="col-md-4 contentButon">
						<button type="submit" id="generar" class="btn btn-default" disabled>Generate Alias</button>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8" id="alias-group">
					<p>
						<div class="input-group">
							<span class="input-group-addon"><?php echo CONS::BASEURL;?></span>
							<input type="text" id="alias" class="form-control" placeholder="Alias">
						</div>
					</p>
					</div>
					<?php if(isset($_SESSION['authToken'])) { ?>
					
						<div class="col-md-4">
							<p>
								<label id="labelLog" for="conLog">Log visits?</label>&nbsp;<input type="checkbox" id="conLog">
							</p>
						</div>
					
					<?php } ?>
				</div>
		
				<div class="row">
					<div class="col-md-12">
						<p id="error" class="hidden"></p>
					</div>
				</div>
				<div class="row">
 					<div class="col-md-12 hidden" id="success-row">
 						The Cool Link was saved:&nbsp;
 						<a href="#" target="_blank" id="alias-success" class="btn btn-link">Etwas</a>
 						<button type="button" class="btn btn-default" id="copy-link-btn">
 							<span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
 						</button>
 					</div>
 				</div>
				
				<div class="row">
					<div id="contentSubmit" class="col-md-12">
						<p>
							<button type=submit id="salvar" class="btn btn-primary" disabled>Save cool URL</button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

<?php
$ownFinalScripts = array('/index.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>