<?php
	/*** /stats/getLinks.php --- Obtains the JSON data for a set of links, given the uid ***/
	require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
	session_start();

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

	//$sql = "select date(fecha) as dia,count(*) as hits from visitas where id_enlace = (select id from enlaces where hash='$alias') group by dia";
	$sql = "select hash,url,cve_protocolo as prot,count(*) as num_visitas from enlaces,visitas where enlaces.id = visitas.id_enlace and seLogea = true and enlaces.id_user = $uid group by id_enlace limit $limit offset $from";
	$tableBody = "";

//die($sql);

	$rs = $base->Execute($sql);
	if($rs&&$rs->RecordCount()>0){
		foreach ($rs as $registro) {
			$alias = $registro['hash'];
			$direccion = strtolower($_PROTOCOLOS[$registro['prot']])."://".$registro['url'];
			$visitas = $registro['num_visitas'];
			$tableBody.= "<tr><td><a href='/stats/graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-line-chart'></i></span></button></a></td><td class='text-center'><a href='viewAlias.php?a=$alias'><i class='fa fa-file-text-o'></i></a>&nbsp;</td><td class='text-left'><a href='$direccion'>$direccion<a></td><td class='text-center'>$visitas</td></tr>";
			//echo "<tr><td><a href='/stats/graphAlias.php?a=$alias'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-line-chart'></i></span></button></a></td><td class='text-center'><a href='viewAlias.php?a=$alias'><i class='fa fa-file-text-o'></i></a>&nbsp;</td><td class='text-left'><a href='$direccion'>$direccion<a></td><td class='text-center'>$visitas</td></tr>";
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