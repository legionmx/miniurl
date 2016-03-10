<?php
/*** stats/index.php -- Statistics index view ***/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
session_start();
if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
	header('Location: /auth/');
}
$uid = $_SESSION['uid'];
//session_destroy();
$activePage = 'Statistics';
include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption">

	<div class="container">
		<div class="row" class="page-header">
			<div class="col-md-12">
				<h2>Usage statistics</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th class="text-center" colspan="2">Alias</th>
							<th>Direcci&oacute;n</th>
							<th class="text-center">Visitas</th>
							<th>More</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true and enlaces.id_user = $uid group by id_enlace";
							$rs = $base->Execute($sql);
							if($rs->RecordCount()>0){
								foreach ($rs as $registro) {
									$alias = $registro['hash'];
									$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
									$visitas = $registro['num_visitas'];
									echo "<tr><td class='text-right'><a href='viewAlias.php?a=$alias'>$alias</a>&nbsp;</td><td><a href='graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-picture' aria-hidden='true'></span></button></a></td><td><a href='$direccion'>$direccion<a></td><td class='text-center'>$visitas</td><td>&nbsp;</td></tr>";
								}
							}
							else{
								?>
								<tr>
									<td colspan="5">You haven't created any links with the option to log them yet :=(</td>
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
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>