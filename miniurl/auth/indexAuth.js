/*** /auth/indexAuth.js --- Scripts related to the authentification index page***
*/
$(document).ready(function(){

	var isFieldValid = function(fieldName){
		var field = $("#"+fieldName);
		//return value > 0;
		if(field.val().length > 0){
			return true;
		}
		else{
			field.parent().addClass('has-error');
			field.focus();
			//TODO:Some error message should be sent
			$("#success-row").removeClass('hidden');
			$("#success-row").text('The '+fieldName+' is empty');
			return false;
		}
	}

	var attemptLogin = function(){
		if(!isFieldValid('username')){
			return false;
		}
		if(!isFieldValid('password')){
			return false;
		}
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

	$("#username,#password").on('input',function(){
		if($(this).val().length>0) {
			$(this).parent().removeClass('has-error');
			$("#success-row").addClass('hidden');
		}
		//else console.log("--> "+$(this).val().length);
	});

});