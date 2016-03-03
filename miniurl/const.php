<?php
/*** const.php --- Incluye constantes, librerias y funciones necesarias para todo el sistema ***/

class CONS{
	const BASEURL = "localhost:8082/i/?";
	//Sacaremos los protocolos de la BD
}

//Conexion a BD, usando ADO
require_once($_SERVER['DOCUMENT_ROOT']."/adodb5/adodb.inc.php");

$base = NewADOConnection('mysqli');
if($base->Connect("localhost",'root',"","miniurl")){
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
?>