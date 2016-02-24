<?php
class CONS{
	const BASEURL = "localhost:8080/edsa-mini/i/?";
	const PROTOCOLOS = array(1=>"HTTP",2=>"HTTPS",3=>"OTRO");
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
?>