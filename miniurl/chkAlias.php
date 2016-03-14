<?php
require_once 'const.php';
//TODO: Checar que exista el parametro
$alias = $_REQUEST['alias'];
$existe = true;

$sql = "select count(*) as cuenta from enlaces where hash='$alias'";
$rs = $base->Execute($sql);
if($rs->fields['cuenta']=="0"){
	$existe = false;
}
else{
	//NOP
}

echo json_encode(array('existe'=>$existe, 'alias_revisado'=>$alias));
?>