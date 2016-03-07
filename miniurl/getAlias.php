<?php
require_once($_SERVER['DOCUMENT_ROOT']."/const.php");
require_once($_SERVER['DOCUMENT_ROOT']."/class/Link.php");
require_once($_SERVER['DOCUMENT_ROOT']."/class/alias.php");
require_once($_SERVER['DOCUMENT_ROOT']."/class/User.php");

//TODO: Parameters existence and coherence check
$url = $_REQUEST['url'];
//$protocol = $_PROTOCOLOS[$_REQUEST['protocol']];
$protocolKey = $_REQUEST['protocol'];

$link = new Link($url,$protocolKey);
$alias =  new Alias($link->getCompleteURL());

$hash = $alias->pubGetHash();
$link->setAlias($hash);

echo json_encode(array("exists" => $link->exists(), "alias"=>$hash));
?>