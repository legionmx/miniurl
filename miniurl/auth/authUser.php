<?php
/*** authUser.php --- Returns an authorization token, or false on failure ***
*/
if(!isset($_POST['ss'])){
	die("POST requests not allowded");
}
if(!isset($_POST['username'])){
	throw new Exception("Require parameter missing", 1);
	exit();
}
else{
	$username = $_POST['username'];
}
if(!isset($_POST['password'])){
	throw new Exception("Required parameter missing", 1);
	exit();
}
else{
	$password = $_POST['password'];
}
require_once($_SERVER['DOCUMENT_ROOT']."/const.php");

include_once($_SERVER['DOCUMENT_ROOT'].'/class/User.php');

try{
	$requestedUser = new User($username);
} catch(Exception $e){
	//For the moment we just ignore the catch
}

if($requestedUser->isRegistered()){
	if($requestedUser->matchPassword($password)){
		//session_destroy(); //TODO: Destroy the session if one exists
		session_start();
		$authToken = substr(md5($username.time()), 0, 10);
		$_SESSION['authToken'] = $authToken;
		$_SESSION['uid'] = $requestedUser->getId();
		session_write_close();
		echo json_encode(array('status' => 1, 'message' => 'Authentication success', 'authToken' => $authToken));
	}
	else{
		echo json_encode(array('status' => 0, 'message' => 'Authentication failed --- Wrong password'));
	}
}
else{
	echo json_encode(array('status' => 0, 'message' => 'Authentication failed --- Invalid user'));
}
?>