/*** /auth/signUp.js --- Script for sign up via AJAX POST ***
*/
$(document).ready(function(){
	$("#signup").click(function(){
		var email = $("#email").val();
		var password = $("#password").val();
		var firstName = $("#firstName").val();
		var lastName = $("#lastName").val();

		$.post('signup.php',{'email': email, 'password': password, 'firstName': firstName, 'lastName': lastName, 'ss': 'blah'},function(data,status){
			if(data.status == '1'){
				window.location.replace('/auth/');
			}
			else{
				//TODO: Error display and related UI change
			}
			console.log(status);
			console.log(data.message);
		},'json');
	});
});