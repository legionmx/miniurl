<?php
/*** stats/index.php -- Statistics index view ***/
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');

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

$sqlAllUserLinksIds = "select id,seLogea from enlaces where enlaces.id_user = 1 order by created desc";
$rsAllUserLinksIds = $base->Execute($sqlAllUserLinksIds);
if($rsAllUserLinksIds !== false){
	$totalNumOfUserLinks = $rsAllUserLinksIds->RecordCount();
	$userLinksTable = $rsAllUserLinksIds->GetAssoc();
}


$activePage = 'Statistics';

$ownStyles[] = 'stats.css';
$activeHeader = 'ok';

include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

	<div class="container">
		<div class="row" class="page-header">
			<div class="col-md-8">
				<h2>Usage statistics</h2>
			</div>
			<div class="row col-md-4">
				<div class="row col-md-4">
					<p>Filter by:</p>
				</div>
				<div class="row col-md-8">
					<select id="newCategory" name="category" class="form-control">
						<option value="off" selected="selected">-Select a Category-</option>
						<?php 
							foreach ($_CATEGORIES as  $cveCat => $abvCat) {
								echo "<option value='$cveCat'>$abvCat</option>\n";
							}
						?>
					</select>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th class="text-center">Chart</th>
							<th class="text-center">Alias</th>
							<th class="text-left">URL</th>
							<th class="text-left">Categories</th>
							<th class="text-left">Short URL</th>
							<th class="text-center">Visits</th>
						</tr>
					</thead>
					<tbody id='table-body'>
						<?php
							$sql = "select hash,url,cve_protocolo as prot, id_category, mini_url, count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true and enlaces.id_user = $uid group by id_enlace order by enlaces.created desc limit $limit offset 0";
							
							$rs = $base->Execute($sql);
							if($rs->RecordCount()>0){
								foreach ($rs as $registro) {
									$alias = $registro['hash'];
									$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
									$visitas = $registro['num_visitas'];
									if($reistro['id_category'] == null){
										$category = "No category";
									}
									else{
										$category = $_CATEGORIES[$registro['id_category']];
									}
									$miniurl = $_HTTP.$registro['mini_url'];
									echo "<tr><td><a href='graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-line-chart'></i></span></button></a></td><td class='text-center'><a href='viewAlias.php?a=$alias'><i class='fa fa-file-text-o'></i></a>&nbsp;</td><td class='text-left'><a href='$direccion'>$direccion<a></td><td class='text-left'>$category</td><td class='text-left'><a href='$miniurl' target='_blank'>$miniurl</a></td><td class='text-center'>$visitas</td></tr>";
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
	

	<!-- <nav> -->
		<div class="row row-paginator">
		<div class="col-md-4 col-sm-6">
			<ul>
				<li>&nbsp;</li>
				<li>Number of links: <?php echo $totalNumOfUserLinks;?></li>
			</ul>
		</div>
		<div class="col-md-5 col-md-offset-3 col-sm-6">
			<ul class="pagination">
				<li class="disabled">
					<a id="pager_prev" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<?php
				//for($i = 0, $j = 1;$i<$lastInitialRecord && $i<$numberOfVisitedLinks;$i+=$limit,$j++){
				for($i = 0, $j = 1;$i<$numberOfVisitedLinks;$i+=$limit,$j++){
					?>
					<li<?php echo " id='page-$j'"; if($i>=$lastInitialRecord) echo ' class="hidden"'; ?>><a class="page-selector" offset="<?php echo $i;?>"><?php echo $j; ?></a></li>
					<?php
				}
				?>
				<li>
					<a id="pager_next" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
  			</ul>
		</div>

 		<!-- <ul class="pager"> -->
 		<!-- <ul class="pagination">
			<li class="disabled">
				<a id="pager_prev" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php
			//for($i = 0, $j = 1;$i<$lastInitialRecord && $i<$numberOfVisitedLinks;$i+=$limit,$j++){
			for($i = 0, $j = 1;$i<$numberOfVisitedLinks;$i+=$limit,$j++){
				?>
				<li<?php echo " id='page-$j'"; if($i>=$lastInitialRecord) echo ' class="hidden"'; ?>><a class="page-selector" offset="<?php echo $i;?>"><?php echo $j; ?></a></li>
				<?php
			}
			?>
			<li>
				<a id="pager_next" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
  		</ul> -->
	<!-- </nav> -->

	</div>

<?php
$ownFinalScripts[] = '/stats/pager.js';
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>