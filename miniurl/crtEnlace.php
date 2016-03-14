<?php
require_once($_SERVER['DOCUMENT_ROOT']."/const.php");

//TODO: Falta validacion de parametros
/*$alias = $_REQUEST['alias'];
$url = $_REQUEST['url'];
$cve_protocolo = $_REQUEST['protocolo'];
$protTxt = $_REQUEST['protTxt'];
//$seLogea = $_REQUEST['seLogea']; // Now it is always managed in authenticated section*/

$alias = $_REQUEST['alias'];
$url = $_REQUEST['url'];
$cve_protocolo = $_REQUEST['keyProtocol'];
$protTxt = $_REQUEST['protocol'];
//$seLogea = $_REQUEST['seLogea']; // Now it is always managed in authenticated section

//$seLogea now defaults to false and is dependant of the user authentication
/*if($seLogea == 'true'){
	$seLogea='true';
}
else {
	$seLogea='false';
}*/
$seLogea = false;

if($cve_protocolo == '3'){
	//We have to check if the input protocol, presumed new, exists already in the DB.
	//TODO: Because we already have the protocols on a variable in const.php, we can check it with that.
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

//We check if there is auth info
session_start();
if(isset($_SESSION['authToken'])&&isset($_SESSION['uid'])){
	//$seLogea = ($_REQUEST['seLogea'] === 'true');
	$seLogea = ($_REQUEST['isTracked'] === 'true');
	$uid = $_SESSION['uid'];
	if(is_numeric($uid)){
		session_write_close();
	}
	else{
		unset($uid);
		session_destroy();
	}
}
else{
	session_destroy();
}
//die("$alias --- $url --- $cve_protocolo --- $protTxt");
$dataNewLink = array('cve_protocolo' => $cve_protocolo, 'url' => $url, 'hash' => $alias, 'seLogea' => $seLogea);
if(isset($uid)) $dataNewLink['id_user'] = $uid;

//$query = "INSERT INTO enlaces(cve_protocolo,url,hash,seLogea) values ($cve_protocolo,'$url','$alias',$seLogea)";
$insFields = "";
$insValues = "";
foreach ($dataNewLink as $field => $value) {
	if(!empty($insValues)) $insValues.=',';
	if(!empty($insFields)) $insFields.=',';
	$insFields.=$field;
	if(is_numeric($value)){
		$insValues.=$value;
	}
	elseif (is_bool($value)){
		$insValues.= ($value) ? 'true' : 'false';
	}
	else{
		$insValues.="'$value'";
	}
}
$query = "insert into enlaces($insFields) values ($insValues)";

$resInsert = $base->Execute($query);

if($resInsert === false){ //If the result set is false, the query had errors
	echo json_encode(array('error' => '1', 'status' => "Error inserting the link.\nSQL: $query"));
}
else{
	//echo json_encode(array('status' => "Se minimiz&oacute; el enlace -> ".CONS::BASEURL."$alias",'alias'=> $alias, 'query' => $query));
	echo json_encode(array('status' => "$_BASEURL$alias",'alias'=> $alias, 'query' => $query));
}
?>