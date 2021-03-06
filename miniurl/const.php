<?php
/*** const.php --- Incluye constantes, librerias y funciones necesarias para todo el sistema ***/
class CONS{
	const BASEURL = "localhost:8082/i/?";
	//Sacaremos los protocolos de la BD
}

$_BASEURL = $_SERVER['HTTP_HOST'] . "/i/?";

if(isset($_SERVER['HTTPS'])){
	$_HTTP = 'https://';
}else{
	$_HTTP = 'http://';
}

//Conexion a BD, usando ADO
require_once($_SERVER['DOCUMENT_ROOT']."/adodb5/adodb.inc.php");

$base = NewADOConnection('mysqli');
if($base->Connect("localhost",'root',"root","miniurl")){
	//NOP
}
else{
	die("Failure connecting to the DB");
}

//Once the DB is connected, we extract the protocols from the DB
$sqlProts = "select clave, descripcion as des from cat_protocolo where edo_reg = 1";
$rsProts = $base->Execute($sqlProts);
$_PROTOCOLOS = array();
foreach ($rsProts as $protocolo) {
	$_PROTOCOLOS[$protocolo['clave']] = $protocolo['des'];
}
if(isset($_SESSION['uid'])){
	$sqlCategories = "select id_category, category from cat_categories where active = 1 and id_user = " . $_SESSION['uid'];
	$rsCat = $base->Execute($sqlCategories);
	$_CATEGORIES = array();
	if($rsCat!==false){
		foreach ($rsCat as $category) {
			$_CATEGORIES[$category['id_category']] = $category['category'];
		}
	}
}

?>