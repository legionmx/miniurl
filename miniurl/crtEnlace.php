<?php
require_once("const.php");

$hash = $_REQUEST['hash'];
$url = $_REQUEST['url'];
$protocolo = $_REQUEST['protocolo'];
$seLogea = $_REQUEST['seLogea'];

if($seLogea) $seLogea='true';
else $seLogea='false';

$query = "INSERT INTO enlaces(cve_protocolo,url,hash,seLogea) values ($protocolo,'$url','$hash',$seLogea)";
$base->Execute($query);
//TODO: Aqui hace falta una validación de que el insert ocurrió
echo json_encode(array('status' => "Se minimiz&oacute; el enlace", 'query' => $query));
?>