<?php
	/*** /stats/viewAlias.php - Shows text statistics for a given alias ***/
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();
	if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];

	//TODO: validación de parámetros
	$alias = $_REQUEST['a'];

	$sql= "select ip,fecha,browser,sisop,cve_protocolo,url,created,user_agent from visitas,enlaces where visitas.id_enlace = enlaces.id and enlaces.hash = '$alias' order by fecha desc";

	//checamos si se puede usar browscap
	$mostrarDatosBrowser = true;
	if(!ini_get('browscap')) $mostrarDatosBrowser = false;
	$activePage = 'Statistics';
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption alias-stats-title backgroundCaption">

	<div class="container">
		<div class="row">
			<div class="col-md-12 headerLine">
				<h2>Stats for alias <?php echo $alias; ?></h2>
				<a href="/stats" class="back"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Get Back</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-condensed">
					<thead>
						<tr><th width="70">IP</th><?php if($mostrarDatosBrowser) { ?><th>Browser</th><th>Sis. Op.</th><?php } ?><th width="180">Fecha</th><th>User Agent</th></tr>
					</thead>
					<tbody>
						<?php
							$rs = $base->Execute($sql);
							foreach ($rs as $registro) {
								$ip = $registro['ip'];
								$fecha = $registro['fecha'];
								$browser = $registro['browser'];
								$sisop = $registro['sisop'];
								$userAgent = $registro['user_agent'];
								?>
								<tr>
									<td class="text-left"><?php echo $ip;?></td>
									<?php if($mostrarDatosBrowser) { ?>
									<td><?php echo $browser;?></td>
									<td><?php echo $sisop;?></td>
									<?php } ?>
									<td class="text-left"><?php echo $fecha;?></td>
									<td class="text-left"><?php echo $userAgent;?></td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	</div>


<!-- JQuery y Bootstrap-->
	<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- Other scripts -->
	<!-- <script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
</body>
</html> -->
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>