<?php
/*** /auth/index.php --- If not logged in, it shows a login page. If logged, redirect to main page.***
**/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
?>
<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="/css/sticky-footer.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">M I N I U R L</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li ><a href="/">Inicio</a></li>
					<li class="active"><a href="#">Login</a></li>
					<!-- <li><a href="stats/">Estad&iacute;sticas</a></li> -->
				</ul>
			</div>
		</div>
	</nav>

	<div class="content">
		<div class="row page-header">
			<div class="col-md-8 col-md-offset-2">
				<h1>Login</h1>
			</div>
		</div>
		<div class="col-md-8 col-md-offset-2 form-inline">
			<div class="input-group input-group-lg">
				<span class="input-group-addon text-right">Username:</span>
				<input type="text" id="username" class="form-control">
			</div>
			<div class="input-group input-group-lg">
				<span class="input-group-addon text-right">Password:</span>
				<input type="password" id="password" class="form-control">
			</div>
			<!-- <div> -->
				<button type="submit" id="login" class="btn btn-primary btn-lg text-right">L O G I N</button>
			<!-- </div> -->
		</div>
	</div>

	<!-- JQuery y Bootstrap-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Own scripts -->
	<script type="text/javascript" src="indexAuth.js"></script>
</body>
</html>