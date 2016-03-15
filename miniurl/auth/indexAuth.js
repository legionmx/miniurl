/*** /auth/indexAuth.js --- Scripts related to the authentification index page***
*/
$(document).ready(function(){

	var attemptLogin = function(){
		var username = $("#username").val();
		var password = $("#password").val();
		$.post('authUser.php',{'username': username, 'password': password, 'ss': 'blah'},function(data,status){
			if(data.status == '1'){
				window.location.replace("/");
			}
			else{
				//TODO: An error message should be displayed
			}
			console.log(status);
			console.log(data.message);
		},'json');
	}

	/* -- Handlers -- */
	$("#login").click(function(){
		attemptLogin();
	});

	$("#password").keypress(function(event){
		if(event.key == 'Enter'){
			attemptLogin();
		}
	});

});