<?php
/*** /auth/logout.php --- Destroys authenticated sessions ***
**/
session_start();
$_SESSION = array();
session_destroy();
header("Location: /");
?>