<?php
	/*** /stats/getLinks.php --- Obtains the JSON data for a set of links, given the uid ***/
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	

	//TODO: Falta validacion de parámetros
	//$uid = $_REQUEST['uid'];
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	}
	else{
		echo "It seems like there is no session, or it has expired";
		exit;
	}
	$from  = $_REQUEST['from'];
	$limit = $_REQUEST['limit'];

	$sqlVisitedUserLinks = "select id_enlace,count(*) as visits from enlaces,visitas where enlaces.id = visitas.id_enlace and enlaces.id_user = $uid group by id_enlace";
	$rsVisitedUserLinks = $base->Execute($sqlVisitedUserLinks);
	foreach ($rsVisitedUserLinks as $registro) {
		$arrayVisitedUserLinks[$registro['id_enlace']] = $registro['visits'];
	}

	$sqlAllUserLinksIds = "select id,seLogea from enlaces where enlaces.id_user = 1 order by created desc";
	$rsAllUserLinksIds = $base->Execute($sqlAllUserLinksIds);
	if($rsAllUserLinksIds !== false){
		$totalNumOfUserLinks = $rsAllUserLinksIds->RecordCount();
		foreach ($rsAllUserLinksIds as $userLink) {
			if($userLink['seLogea'] == 0){
				$userLinksTable[$userLink['id']] = false;
			}
			else{
				$userLinksTable[$userLink['id']] = true;
			}
		}
	}

	$sql = "select id,hash,url,cve_protocolo as prot, id_category, mini_url from enlaces where enlaces.id_user = $uid order by created desc limit $limit offset $from";

	$tableBody = "";

//die($sql);
	
	
	$rs = $base->Execute($sql);
	if($rs&&$rs->RecordCount()>0){
		foreach ($rs as $registro) {
			$idLink = $registro['id'];
			$alias = $registro['hash'];
			$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
			$visits = 0;
			if(array_key_exists($idLink, $arrayVisitedUserLinks)){
				$visits = $arrayVisitedUserLinks[$idLink];
			}
			if($registro['id_category'] == null){ //TODO: This condition has to be reviewed
				$category = "No category";
			}
			else{
				$category = $_CATEGORIES[$registro['id_category']];
			}
			$miniurl = $_HTTP.$registro['mini_url'];
			?>
			<tr>
									
				<?php if($userLinksTable[$idLink]) {?>
				<td>
					<a href='graphAlias.php?a=<?php echo $alias;?>'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-line-chart'></i></span></button></a></td><td class='text-center'><a href='viewAlias.php?a=$alias'><i class='fa fa-file-text-o'></i></a>&nbsp;
				</td>
				<?php }
				else{
					echo '<td>&nbsp;</td><td>&nbsp;</td>';
				}
				?>
										
				<td class='text-left'><a href='<?php echo $direccion;?>'><?php echo $direccion;?><a></td><td class='text-left'><?php echo $category;?></td><td class='text-left'><a href='$miniurl' target='_blank'><?php echo $miniurl;?></a></td><td class='text-center'><?php echo $visits;?></td>
			</tr>
			<?php
			//echo "<tr><td><a href='graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-line-chart'></i></span></button></a></td><td class='text-center'><a href='viewAlias.php?a=$alias'><i class='fa fa-file-text-o'></i></a>&nbsp;</td><td class='text-left'><a href='$direccion'>$direccion<a></td><td class='text-left'>$category</td><td class='text-left'><a href='$miniurl' target='_blank'>$miniurl</a></td><td class='text-center'>$visitas</td></tr>";
		}
	}
	else{
		//echo "There were no registries --> $sql";
		echo "false";
		exit;
	}

	die($tableBody);

	/*$fechas = array();
	$visitas = array();

	$rs = $base->Execute($sql);
	foreach($rs as $dia){
		array_push($fechas, $dia['dia']);
		array_push($visitas, intval($dia['hits']));
	}

	echo json_encode(array('fechas'=>$fechas,'visitas'=>$visitas));*/

?>