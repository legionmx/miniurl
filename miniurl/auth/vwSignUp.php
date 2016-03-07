<?php
/*** /auth/vwSignUp.php --- View for account signup ***
**/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
session_start();
if(isset($_SESSION['authToken'])){ //If there is an authToken, no sign up is possible
	header("Location: /");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign up</title>
	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- <link href="/css/sticky-footer.css" rel="stylesheet"> -->
</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">M I N I U R L</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/">Home</a></li>
					<li class="active"><a href="#">Sign up</a></li>
					<?php if(isset($_SESSION['authToken'])){ ?>
					<li><a href="/stats/">Statistics</a></li>
					<li><a href="/auth/logout.php">Logout</a></li>
					<?php
					}
					else{
					?>
					<li><a href="/auth/">Login</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row page-header">
			<div class="col-md-12"><h3>Sign up</h3></div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="text" id="email" class="form-control" placeholder="newuser@coolurl.com">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" class="form-control" placeholder="Super secret password here!">
					<input type="password" id="passcheck" class="form-control" placeholder=" And please repeat it">
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
			<div class="col-md-6 col-md-offset-3">
				<span id="messageContent" class="text-center"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 col-md-offset-5">
				<button type="submit" id="signup" class="btn btn-primary btn-lg btn-block">Sign up now!</button>
			</div>
		</div>
	</div>

	<!-- JQuery y Bootstrap-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Scripts propios -->
	<script type="text/javascript" src="./signUp.js"></script>
</body>
</html>