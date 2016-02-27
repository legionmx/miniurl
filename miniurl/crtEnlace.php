<?php
require_once("const.php");

//TODO: Falta validacion de parametros
$alias = $_REQUEST['alias'];
$url = $_REQUEST['url'];
$cve_protocolo = $_REQUEST['protocolo'];
$protTxt = $_REQUEST['protTxt'];
$seLogea = $_REQUEST['seLogea'];

if($seLogea == 'true'){
	$seLogea='true';
}
else {
	$seLogea='false';
}

if($cve_protocolo == '3'){
	//Hay que checar si existe el 'OTRO'
	$sqlClave = "select clave as cve_protocolo  from cat_protocolo where descripcion like '$protTxt'";
	$rsCat = $base->Execute($sqlClave);
	$num_filas = 0;
	foreach ($rsCat as $fila) {
		$num_filas++;
		$cve_protocolo = $fila['cve_protocolo'];
	}
	if($num_filas === 0){
		//El protocolo no existe en catalogo. Se inserta
		$sqlIns = "insert into cat_protocolo (descripcion) values ('$protTxt')";
		$rsn = $base->Execute($sqlIns);
		$rsCat = $base->Execute($sqlClave);
		foreach ($rsCat as $fila) {
			$cve_protocolo = $fila['cve_protocolo'];
		}
	}
	else{
		//NOP: Si hubo registros, obtuvimos ya la clave antes del if
	}
}

$query = "INSERT INTO enlaces(cve_protocolo,url,hash,seLogea) values ($cve_protocolo,'$url','$alias',$seLogea)";
$base->Execute($query);
//TODO: Aqui hace falta una validación de que el insert ocurrió

echo json_encode(array('status' => "Se minimiz&oacute; el enlace -> ".CONS::BASEURL."$alias",'alias'=> $alias, 'query' => $query));
?>