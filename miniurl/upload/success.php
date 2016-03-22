<?php

if(!isset($_SESSION['authToken']) || !isset($_SESSION['uid'])){
		header('Location: /auth/');
	}
	$uid = $_SESSION['uid'];
	
	$activePage = 'CSV Upload';
	$activeHeader = 'ok';
	$limit = 10;
        $startOffset = 0;
        $numberOfPages = 10;
        $lastInitialRecord = $numberOfPages * $limit;
	include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
	
?>
<input type="text" id="timeStamp" value="<?php echo $timeStamp; ?>" class="hidden" >
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
																
																<?php
																
																if($index == 'cve_protocolo'){
																		echo '<td>' .  $getProtocols[$value] . '</td>';
																}elseif($index== 'id_category'){
																	echo '<td>' . $nameCat[$value]. '</td>';
																}else{
																	echo '<td>' .  $value . '</td>'; 
																}
																?>
																 
														
														<?php }?>
														</tr>
												<?php }?>
											</tbody>
										</table>
								</div>
								
								
						</div>
				
				</div>
				<!-- <nav> -->
				<div class="row row-paginator">
						<div class="col-md-4 col-sm-6">
							<ul>
								<li>&nbsp;</li>
								<li>Number of links: <?php echo $totalInserts;?></li>
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
								for($i = 0, $j = 1;$i<$totalInserts;$i+=$limit,$j++){
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
							for($i = 0, $j = 1;$i<$totalInserts;$i+=$limit,$j++){
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
			</div>
				

<?php
$ownFinalScripts = array('/upload/success.js', '/upload/pager.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>