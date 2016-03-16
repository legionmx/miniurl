/*** /auth/signUp.js --- Script for sign up via AJAX POST ***
*/
$(document).ready(function(){
	var FormSubmit = function(){
		this.email = $("#email").val();
		this.password = $("#password").val();
		this.checkPassword = $("#passcheck").val();
		this.firstName = $("#firstName").val();
		this.lastName = $("#lastName").val();
		this.errorMsg = "";
		this.isValidSignupForm = function(){
			if(this.email.length<=0) {
				this.errorMsg = "The email field cannot be empty";
				return false;
			}
			if(this.password.length<=0) {
				this.errorMsg = "A password is required";
				$("#password").focus();
				return false;
			}
			if(this.checkPassword.length<=0) {
				this.errorMsg = "Please confirm your password";
				$("#passcheck").focus();
				return false;
			}
			if(this.checkPassword != this.password) {
				this.errorMsg = "Your passwords do not match";
				$("#password").focus();
				return false;
			}
			this.errorMsg = "";
			return true;
		};
	};

	var changeMessage = function(message,classType){
		$("#messageTxt").html(message);
		$("#messageContent").addClass(classType); //TODO: Check if this line is necessary
		$("#messages").removeClass('hidden');
	};

	var clearMessage = function(){
		$("#messages").addClass('hidden');
		$("#messageContent").removeClass('has-error has-warning');
	};

	/* Event handlers */
	$("#signup").click(function(){
		var form = new FormSubmit();

		if(form.isValidSignupForm()){
			$.post('signup.php',{'email': form.email, 'password': form.password, 'firstName': form.firstName, 'lastName': form.lastName, 'ss': 'blah'},function(data,status){				
				if(data.status == '1'){
					changeMessage(data.message,'has-success');
					window.setTimeout(function(){
						window.location.replace('/auth/');
					},3000);
				}
				else{
					changeMessage(data.message,'has-warning');
				}
				//console.log(status);
				//console.log(data.log);
			},'json');
		}
		else{
			changeMessage(form.errorMsg,'has-error');

			//console.log("Pass1: "+password);
			//console.log("Pass2: "+checkPassword);
		}
	});

	$("#email").on("input",function(event){
		if($(this).val().length>0){
			clearMessage();
		}
		else{
			console.log('The email field is empty');
			changeMessage("The email field cannot be empty",'has-warning');
		}
	});

	$("#lastName").keypress(function(event){
		if(event.key == 'Enter'){
			$("#signup").click();
		}
	});
});