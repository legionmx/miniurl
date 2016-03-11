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
	
	<div id="wrapperUniq">

	<div class="container">
		<div class="row page-header">
			<div class="col-md-12"><h2>Sign up</h2></div>
		</div>
		<div id="containerForm" class="container" >
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
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
				<div class="col-md-4 col-md-offset-4">
					<button type="submit" id="signup" class="btn btn-primary btn-lg btn-block">Sign up now!</button>
				</div>
			</div>
		</div>
	</div>
	
	</div>

	</div>

	<!-- JQuery y Bootstrap-->
	<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- Own scripts -->
	<!-- <script type="text/javascript" src="./signUp.js"></script> -->
	<!-- Other scripts-->
	<!-- <script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
</body>
</html> -->

<?php
$ownFinalScripts = array('/auth/signUp.js');
include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>