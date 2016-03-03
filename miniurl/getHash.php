<?php
//include_once("adodb5/adodb.inc.php");
require_once("const.php");

//Sacamos el url completo, incluyendo el protocolo
$url = $_REQUEST['url'];
$protocolo = $_PROTOCOLOS[$_REQUEST['protocolo']];
//}
$urlCompleto = strtolower($protocolo)."://$url";

//We hash the url using md5, and we only keep 8 characters
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