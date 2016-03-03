<?php
/*** /auth/signup.php --- Signs up users ***
**/
session_start();
if(isset($_SESSION['authToken'])){ //If there is an authToken, we should logout and exit
	$_SESSION = array();
	session_destroy();
	header("Location: /auth/ ");
	exit();
}
if(!isset($_POST['ss'])){
	//die("Bogus POST request not allowed");
	throw new Exception("Bogus POST request", 1);
}
if(!isset($_POST['email'])){
	throw new Exception("Required parameter missing : em", 1);
	exit();
}
else{
	$email = $_POST['email'];
}
if(!isset($_POST['password'])){
	throw new Exception("Required parameter missing : pw", 1);
	exit();
}
else{
	$password = $_POST['password'];
}

$firstName = '&nbsp;';
$lastName = '&nbsp;';
if(isset($_POST['firstName'])){
	$firstName = $_POST['firstName'];
}
if(isset($_POST['lastName'])){
	$lastName = $_POST['lastName'];
}

require_once($_SERVER['DOCUMENT_ROOT']."/const.php");

include_once($_SERVER['DOCUMENT_ROOT'].'/class/User.php');

try{
	$requestedNewUser = new User($email);
} catch(Exception $e){
	//For the moment we just ignore the catch
}

if(!$requestedNewUser->isRegistered()){
	//Lets go ahead with the registration
	//echo json_encode(array('status' => 1, 'message' => 'Registration success (Not done) --- Username is available'));
	$newUserData = array('username' => $email, 'password' => $password, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email);
	$newUser = User::create($newUserData);
	if($newUser instanceof User){
		echo json_encode(array('status' => 1, 'message' => 'Registration success --- '.$newUser ));
	}
	else{
		echo json_encode(array('status' => 0, 'message' => 'Registration failed --- Something went wrong with the class method creation'));
	}
}
else{
	//Lets send error message
	echo json_encode(array('status' => 0, 'message' => 'Registration failed --- Username already exists'));
}
?>