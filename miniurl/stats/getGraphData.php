<?php
	/*** /stats/getGraphData.php --- Obtener el JSON para una gráfica ***/
	require_once('../const.php');

	//TODO: Falta validacion de parámetros
	$alias = $_REQUEST['alias'];

	$sql = "select date(fecha) as dia,count(*) as hits from visitas where id_enlace = (select id from enlaces where hash='$alias') group by dia";
	$fechas = array();
	$visitas = array();

	$rs = $base->Execute($sql);
	foreach($rs as $dia){
		array_push($fechas, $dia['dia']);
		array_push($visitas, intval($dia['hits']));
	}

	echo json_encode(array('fechas'=>$fechas,'visitas'=>$visitas));

?>