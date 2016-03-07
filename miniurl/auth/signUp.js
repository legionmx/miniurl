/*** /auth/signUp.js --- Script for sign up via AJAX POST ***
*/
$(document).ready(function(){
	$("#signup").click(function(){
		var email = $("#email").val();
		var password = $("#password").val();
		var checkPassword = $("#passcheck").val();
		var firstName = $("#firstName").val();
		var lastName = $("#lastName").val();

		if(password == checkPassword){
			$.post('signup.php',{'email': email, 'password': password, 'firstName': firstName, 'lastName': lastName, 'ss': 'blah'},function(data,status){
				if(data.status == '1'){
					$("#messageContent").html("<em class='help-block'>Succesful registration! Redirecting to main page</em>");
					$("#messageContent").addClass('has-success');
					$("#messages").removeClass('hidden');
					window.setTimeout(function(){
						window.location.replace('/auth/');
					},5000);
				}
				else{
					//TODO: Error display and related UI change
				}
				//console.log(status);
				//console.log(data.message);
			},'json');
		}
		else{
			$("#messageContent").html("<em class='help-block'>The passwords don't match</em>");
			$("#messageContent").addClass('has-error');
			$("#messages").removeClass('hidden');
			//console.log("Pass1: "+password);
			//console.log("Pass2: "+checkPassword);
		}
	});
});