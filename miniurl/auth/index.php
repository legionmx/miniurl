<?php
/*** /auth/index.php --- If not logged in, it shows a login page. ***
TODO:If logged, redirect to main page.
**/
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');

session_start();
if(isset($_SESSION['authToken'])){ //If there is an authToken, no sign up is possible
	header("Location: /");
	exit();
}
$activePage = 'Login';
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
						<!-- <div> -->
							<button type="submit" id="login" class="btn btn-primary btn-lg text-right">Login</button>
						<!-- </div> -->
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- JQuery y Bootstrap-->
	<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- Own scripts -->
	<!-- <script type="text/javascript" src="indexAuth.js"></script> -->
	<!-- Other scripts-->
	<!-- <script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
</body>
</html> -->

<?php
$ownFinalScripts = array('/auth/indexAuth.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>