<?php
/*** const.php --- Incluye constantes, librerias y funciones necesarias para todo el sistema ***/

class CONS{
	const BASEURL = "localhost:8080/edsa-mini/i/?";
	//const PROTOCOLOS = array(1=>"HTTP",2=>"HTTPS",3=>"OTRO");
	//Sacaremos los protocolos de la BD
}

//Conexion a BD, usando ADO
require_once("adodb5/adodb.inc.php");
//require_once("C:/Users/Legion/Documents/Biz/miniurl/adodb5/adodb.inc.php");

$base = NewADOConnection('mysqli');
if($base->Connect("localhost",'root',"","miniurl")){
	//NOP
}
else{
	die("ERROR EN LA CONEXION A BD");
}

//Una vez con la BD arriba, sacamos los protocolos
$sqlProts = "select clave, descripcion as des from cat_protocolo where edo_reg = 1";
$rsProts = $base->Execute($sqlProts);
$_PROTOCOLOS = array();
foreach ($rsProts as $protocolo) {
	$_PROTOCOLOS[$protocolo['clave']] = $protocolo['des'];
}
?>