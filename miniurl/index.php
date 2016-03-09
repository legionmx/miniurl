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

	<!-- <footer class="footer">
      <div class="container">
        <p class="text-muted">Nunc scio tenebris lux</p>
      </div>
    </footer> -->

	<!-- JQuery y Bootstrap-->
	<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- Scripts propios -->
	<!-- <script type="text/javascript" src="/index.js"></script>
	<script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
</body>
</html> -->
<?php
$ownFinalScripts = array('/index.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>