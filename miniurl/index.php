<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption">
	<div class="container">
		<div class="row page-header">
			<div class="col-md-12"><h2>M I N I U R L</h2></div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<select id="protocolo" name="protocolo" class="form-control">
					<?php
					foreach($_PROTOCOLOS as $cveProt => $abvProt) {
						echo "<option value='$cveProt'>$abvProt</option>\n";
					}
					?>
				</select>
				<input type="text" id="prot_propio" class="form-control input-sm hidden" placeholder="Protocolo">
			</div>
			<div class="col-md-4">
				<input type="url" name="url" id="url" class="form-control" placeholder="URL to minimize">
			</div>
			<div class="col-md-1">
				<button type="submit" id="generar" class="btn btn-default" disabled>Generate Alias</button>
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
		<?php if(isset($_SESSION['authToken'])) { ?>
		<div class="row">
			<div class="col-md-12">
				<p>
					<label for="conLog">Log visits?</label>&nbsp;<input type="checkbox" id="conLog">
				</p>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<p>
					<button type=submit id="salvar" class="btn btn-primary" disabled>Save cool URL</button>
				</p>
			</div>
		</div>
	</div>
	</div>

<?php
$ownFinalScripts = array('/index.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>