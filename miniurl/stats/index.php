<?php
/*** stats/index.php -- Statistics index view ***/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
session_start();
if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
	header('Location: /auth/');
}
$uid = $_SESSION['uid'];
//session_destroy();

//We get the number of visited links related to user
$sqlNumberOfVisitedLinks = "select count(distinct id_enlace) as count from enlaces,visitas where enlaces.id = visitas.id_enlace and enlaces.id_user = $uid";
$rsNoVL = $base->Execute($sqlNumberOfVisitedLinks);
//die($rsNoVL);
if($rsNoVL !== false){
	$numberOfVisitedLinks = intval($rsNoVL->fields['count']);
}
else{
	$numberOfVisitedLinks = 0;
}

$limit = 10;
$startOffset = 0;
$numberOfPages = 10;
$lastInitialRecord = $numberOfPages * $limit;

$activePage = 'Statistics';
$ownStyles[] = 'stats.css';
include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption backgroundCaption">

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
							<th class="text-center">Chart</th>
							<th class="text-center">Alias</th>
							<th class="text-left">Direcci&oacute;n</th>
							<th class="text-center">Visitas</th>
						</tr>
					</thead>
					<tbody id='table-body'>
						<?php
							//$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true and enlaces.id_user = $uid group by id_enlace";
							$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true and enlaces.id_user = $uid group by id_enlace limit 10 offset 0";
							$rs = $base->Execute($sql);
							if($rs->RecordCount()>0){
								foreach ($rs as $registro) {
									$alias = $registro['hash'];
									$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
									$visitas = $registro['num_visitas'];
									echo "<tr><td><a href='graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-line-chart'></i></span></button></a></td><td class='text-center'><a href='viewAlias.php?a=$alias'><i class='fa fa-file-text-o'></i></a>&nbsp;</td><td class='text-left'><a href='$direccion'>$direccion<a></td><td class='text-center'>$visitas</td></tr>";
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

	<nav>
 		<!-- <ul class="pager"> -->
 		<ul class="pager">
			<li class="disabled">
				<a id="pager_prev" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php
			for($i = 0, $j = 1;$i<$lastInitialRecord && $i<$numberOfVisitedLinks;$i+=$limit,$j++){
				?>
				<li><a href="#">#<?php echo $j; ?></a></li>
				<?php
			}
			?>
			<!-- <li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li> -->
    		<!-- <li class="disabled"><a href="#" id="pager_previous">Previous</a></li>
    		<li><a href="#" id="pager_next">Next</a></li> -->
			<li>
				<a id="pager_next" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
  		</ul>
	</nav>
<?php
$ownFinalScripts[] = '/stats/pager.js';
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>