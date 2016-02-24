<?php
//include_once("adodb5/adodb.inc.php");
require_once("const.php");

//Sacamos el url completo, incluyendo el protocolo
$urlCompleto = strtolower(CONS::PROTOCOLOS[$_REQUEST['protocolo']]).'://'.$_REQUEST['url'];

//Usamos md5 para hashear, y sólo tomamos 8 caracteres
$hash = substr(md5($urlCompleto),0,8);

$dominioBase = "mi.ni/";
$dominioBase = "localhost:8080/edsa/mini/";
$dominioBase = CONS::BASEURL;
$urlMini = $dominioBase.$hash;

//Revisamos si el hash existe
$rs=$base->Execute("select count(*) as cuenta from enlaces where hash='$hash'");
if($rs->fields['cuenta']=="0"){
	echo json_encode(array("existe"=>false,"hash"=>$hash));
}
else{
	echo json_encode(array("existe"=>true,"hash"=>$hash));
}
?>