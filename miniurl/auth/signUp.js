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
		$("#messageContent").html(message);
		$("#messageContent").addClass(classType);
		$("#messages").removeClass('hidden');
	};

	var clearMessage = function(){
		$("#messages").addClass('hidden');
		$("#messageContent").removeClass('has-error has-warning');
	};

	var passwordsMatch = function(){
		return $("#password").val() == $("#passcheck").val();
	}

	var isValidSignupForm = function(){
		console.log("Using the validation function outside the Form object. This usage is deprecated");
		return false;
		/*var formToSend = new FormSubmit();
		if(formToSend.email.length<=0) return false;
		if(formToSend.password.length<=0) return false;
		if(!passwordsMatch()) return false;
		return true;*/
	}

	/* Event handlers */
	$("#signup").click(function(){
		var form = new FormSubmit();

		if(form.isValidSignupForm()){
			$.post('signup.php',{'email': form.email, 'password': form.password, 'firstName': form.firstName, 'lastName': form.lastName, 'ss': 'blah'},function(data,status){
				//$("#messageContent").html(data.message);
				if(data.status == '1'){
					//$("#messageContent").html("<em class='help-block'>Succesful registration! Redirecting to main page</em>");
					//$("#messageContent").addClass('has-success');
					//$("#messages").removeClass('hidden');
					changeMessage(data.message,'has-success');
					window.setTimeout(function(){
						window.location.replace('/auth/');
					},5000);
				}
				else{
					//TODO: Error display and related UI change
					//$("#messageContent").addClass('has-warning');
					changeMessage(data.message,'has-warning');
				}
				//$("#messages").removeClass('hidden');
				//console.log(status);
				console.log(data.log);
			},'json');
		}
		else{
			/*$("#messageContent").html("<em class='help-block'>The passwords don't match</em>");
			$("#messageContent").addClass('has-error');
			$("#messages").removeClass('hidden');*/
			//changeMessage("<em class='help-block'>The passwords don't match</em>",'has-error')
			//changeMessage("<em class='help-block'>The registration form has errors</em>",'has-error');
			changeMessage("<em class='help-block'>"+form.errorMsg+"</em>",'has-error');

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
			changeMessage("<em class='help-block'>The email field cannot be empty</em>",'has-warning');
		}
	});
});