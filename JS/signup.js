var valid = document.getElementById("valid");

function passwordvalidate(){
	var pwd1 = document.getElementById("pwd1").value;
	var pwd2 = document.getElementById("pwd2").value;
	

	console.log(pwd1, pwd2);

	if (pwd1 != pwd2 && pwd2.length != 0){
		valid.innerHTML = "The passwords does not match";
		valid.style.color = "red";
	}else if(pwd1 == pwd2 && pwd2.length !=0){
		valid.innerHTML = "Matching passwords";
		valid.style.color ="green";
	}
	if(pwd1.length == 0 && pwd2.length != 0){
		if(pwd2.length > 1){
			valid.innerHTML = "Enter a password first"
		}else{
			valid.innerHTML = "";
		}
		
	}if(pwd1.length == 0 && pwd2.length == 0 || pwd2.length == 0){
		valid.innerHTML = "";
	}
}

function emailvalidator(){
	var email = document.getElementById("email").value;

	if(!email.includes("@") || !email.includes(".")){
		valid2.innerHTML = "Email must be on the form x@y.z"
		valid2.style.color = "red";
	}else{
		valid2.innerHTML = "";
	}
	if(email.length == 0){
		valid2.innerHTML = "";
	}
}

function rmv(){
	valid2.innerHTML = "";
}