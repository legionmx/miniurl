<?php
/*** /auth/index.php --- If not logged in, it shows a login page. ***
**/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');

session_start();
if(isset($_SESSION['authToken'])){ //If there is an authToken, no sign up is possible
	header("Location: /");
	exit();
}
$activePage = 'Login';
$ownStyles[] = 'auth.css';
include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

	<div class="carousel-caption">
		
		<div class="container">
			<div id="wrapAllForm" class="login">
	
				
				<div class="row page-header">
					<div class="col-md-12 headerLine">
						<h2>Login</h2>
					</div>
				</div>
				<div id="containerForm" class="container" >
					<div class="col-md-12 form-inline">
						<div class="input-group">
							<span class="input-group-addon text-right">Username</span>
							<input type="text" id="username" class="form-control">
						</div>
						<div class="input-group">
							<span class="input-group-addon text-right">Password</span>
							<input type="password" id="password" class="form-control">
						</div>
						
					</div>

					<div class="col-md-12 help-block hidden" id="success-row"><i class="fa fa-exclamation-triangle"></i><span id="success-row-txt"></span></div>

					<div class="col-md-4 col-md-offset-4">
						<button type="submit" id="login" class="btn btn-primary btn-lg text-center">Login</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>

<?php
$ownFinalScripts = array('/auth/indexAuth.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>