<?php
//echo json_encode(array('existe' => true));
//require_once 'const.php';
//TODO: Checar que exista el parametro
$alias = $_REQUEST['alias'];
$exists = true;

include_once($_SERVER['DOCUMENT_ROOT'].'/class/Link.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/class/User.php');
/*$sql = "select count(*) as cuenta from enlaces where hash='$alias'";
//die($sql);
$rs = $base->Execute($sql);
if($rs->fields['cuenta']=="0"){
	$existe = false;
}
else{
	//NOP
}*/

$exists = Link::existsInDB($alias);

echo json_encode(array('exists'=>$exists, 'alias_revisado'=>$alias));
?>