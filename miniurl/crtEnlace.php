<?php
require_once("const.php");

//TODO: Falta validacion de parametros
$alias = $_REQUEST['alias'];
$url = $_REQUEST['url'];
$protocolo = $_REQUEST['protocolo'];
$seLogea = $_REQUEST['seLogea'];

if($seLogea) $seLogea='true'; //TODO: Al parecer esta condición es siempre true
else $seLogea='false';

$query = "INSERT INTO enlaces(cve_protocolo,url,hash,seLogea) values ($protocolo,'$url','$alias',$seLogea)";
$base->Execute($query);
//TODO: Aqui hace falta una validación de que el insert ocurrió
echo json_encode(array('status' => "Se minimiz&oacute; el enlace -> ".CONS::BASEURL."$alias",'alias'=> $alias, 'query' => $query));
?>