<?php
/*** /auth/vwSignUp.php --- View for account signup ***
**/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
session_start();
if(isset($_SESSION['authToken'])){ //If there is an authToken, no sign up is possible
	header("Location: /");
	exit();
}
$activePage = 'Sign up';
include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

    <div class="carousel-caption">
	<div class="container">
		<div id="wrapAllForm">
	
		
			<div class="row page-header">
				<div class="col-md-12 headerLine"><h2>Sign up</h2></div>
			</div>
			<div id="containerForm" class="container" >
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group">
							<label for="email">Email address</label>
							<input type="text" id="email" class="form-control" placeholder="newuser@lnk.cool">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" class="form-control" placeholder="Enter password">
							<input type="password" id="passcheck" class="form-control" placeholder="Repeat password">
						</div>
						<div class="form-group">
							<label for="firstName">Name(s)</label>
							<input type="text" id="firstName" class="form-control" placeholder="Your given name(s)">
						</div>
						<div class="form-group">
							<label for="lastName">Family Name</label>
							<input type="text" id="lastName" class="form-control" placeholder="Your last name">
						</div>
						<!-- <div class="form-group">
							<label for="dob">Date of Birth</label>
							<input type="date" id="dob" class="form-control">
						</div> --><!-- Not all browser have implemented the type='date' input control -->
					</div>
				</div>
				<div class="row hidden" id="messages">
					<div class="col-md-12">
						<span id="messageContent" class="text-center">
							<em class='help-block'><i class='fa fa-exclamation-triangle'></i><span id="messageTxt"></span></em>
						</span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<button type="submit" id="signup" class="btn btn-primary btn-lg btn-block">Sign up now!</button>
					</div>
				</div>
			</div>
		
		</div>
	</div>

	</div>

<?php
$ownFinalScripts = array('/auth/signUp.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>