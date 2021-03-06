<?php

require_once($_SERVER['DOCUMENT_ROOT']."/const.php");

include_once($_SERVER['DOCUMENT_ROOT'].'/class/Register.php');

//TODO: Falta validacion de parametros
$alias = $_REQUEST['alias'];
$url = $_REQUEST['url'];
$cve_protocolo = $_REQUEST['keyProtocol'];
$protTxt = $_REQUEST['protocol'];
$catId = Null;

if(isset($_REQUEST['category']) && $_REQUEST['category'] != ''){
	$category = $_REQUEST['category'];
	$categoryNew = $_REQUEST['category_new'];
}



//$seLogea now defaults to false and is dependant of the user authentication
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
		//The protocol does not exist. It must be persisted first
		$sqlIns = "insert into cat_protocolo (descripcion) values ('$protTxt')";
		$rsn = $base->Execute($sqlIns);
		$rsCat = $base->Execute($sqlClave);
		foreach ($rsCat as $fila) {
			$cve_protocolo = $fila['cve_protocolo'];
		}
	}
	else{
		//NOP: If there were registries, we already have the protocol key
	}
}

//We check if there is auth info
session_start();
if(isset($_SESSION['authToken'])&&isset($_SESSION['uid'])){
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

if(isset($_REQUEST['category']) && $_REQUEST['category'] != ''){

	$regCategories = new Register;

	if($category == 0 && $category != 'off'){
		$insertCat = $regCategories->insertCategories($categoryNew);
		$selectCat = $regCategories->getCategories();
		$catId = $selectCat[$categoryNew];
		
	}elseif($category > 0 && $category != 'off'){
		$catId = $category;
	}else{
		$catId = Null;
	}
}

$miniUrl = $_BASEURL . $alias;

$dataNewLink = array('cve_protocolo' => $cve_protocolo, 'url' => $url, 'hash' => $alias, 'seLogea' => $seLogea, 'id_category'=>$catId, 'mini_url'=>$miniUrl);
if(isset($uid)) $dataNewLink['id_user'] = $uid;

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
	}elseif(is_null($value)){
		
		$insValues .= 'Null';
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