$(document).ready(function() {

	$('#signUpBtn').click(function(){
		signUp();
	});

	$('#loginBtn').click(function(){
		login();
	});

	createButtonsForheader();

	document.getElementById('banner').innerText =  getNameUser();

	function createButtonsForheader(){
		if(isLogedIn()){
			$('#navbarButtons').append('<li class="nav-item"><a class="nav-link" id="bLogin">Login</a></li>');
			$("#bLogin").click(function(){
				openMLogin();
			});
			
			$('#navbarButtons').append('<li class="nav-item"><a class="nav-link" id="bSignUp">Sign Up</a></li>');
			$("#bSignUp").click(function(){
				openMSignUp();
			});
		}
		else{
			$('#navbarButtons').append('<li class="nav-item"><a class="nav-link" id="bLogout">Logout</a></li>');
			$('#bLogout').click(function(){
				logout();
			});
		}
		if(isAdmin()){
			$('#navbarButtons').append('<li class="nav-item"><a class="nav-link" id="bAddProduct">Add a product</a></li>');
			$('#bAddProduct').click(function(){
				addProduct();
			});
		}
	}


	function logout(){
		window.location.href = url +"Logic/logout.php";
	}
	function addProduct() {
		window.location.href = url +"UI/pages/addProduct.php";
	}


	function signUp(){
		
		resetSignUp();
		if(checkSingUp()){
			document.getElementById("signUpUrl").value = window.location.href;
			$('#fSignUp').submit();
		}
	}

	function resetSignUp(){
		$('#mSignUp').find('.error').css('display','none');
		$('#signUpUsername').removeClass();
		$('#signUpEmail').removeClass();
		$('#signUpPassword').removeClass();
		$('#signUpRePassword').removeClass();
	}

	function checkSingUp(){

		var credentials = true;
		if($('#signUpUsername').val() == ""){
			inputFormError($('#mSignUp'),"username can't be empty",$('#signUpUsername'));
			credentials = false;
		}
		if($('#signUpEmail').val() == ""){
			inputFormError($('#mSignUp'),"email can't be empty",$('#signUpEmail'));
			credentials = false;
		}
		if($('#signUpPassword').val() == ""){
			inputFormError($('#mSignUp'),"password can't be empty",$('#signUpPassword'));
			credentials = false;
		}
		if($('#signUpRePassword').val() == ""){
			inputFormError($('#mSignUp'),"repassword can't be empty",$('#signUpRePassword'));
			credentials = false;
		}

		if($('#signUpPassword').val() != $('#signUpPassword').val()){
			inputFormError($('#mSignUp'),"passwords must be the same",$('#signUpPassword'));
			credentials = false;
		}
		if(!validateEmail($('#signUpEmail').val())){
			inputFormError($('#mSignUp'),"invalid email",$('#signUpEmail'));
			credentials = false;
		}
		return credentials;

	}

	function login(){
		resetLogin();
		if(checkLogin()){
			document.getElementById("loginUrl").value = window.location.href;
			$('#fLogin').submit();
		}
	}

	function resetLogin(){
		$('#mLogin').find('.error').css('display','none');
		$('#loginEmail').removeClass();
		$('#loginPassword').removeClass();
	}

	function checkLogin(){
		var credentials = true;
		if($('#loginEmail').val() == ""){
			inputFormError($('#mLogin'),"email can't be empty",$('#loginEmail'));
			credentials = false;
		}
		if($('#loginPassword').val() == ""){
			inputFormError($('#mLogin'),"password can't be empty",$('#loginPassword'));
			credentials = false;
		}

		if(!validateEmail($('#loginEmail').val())){
			inputFormError($('#mLogin'),"invalid email",$('#loginEmail'));
			credentials = false;
		}
		return credentials;
	}

	function openMLogin(){
		$('#mLogin').modal({
			backdrop: 'static'
		});
	}

	function openMSignUp(){
		$('#mSignUp').modal({
			backdrop: 'static'
		});
	}

	function inputFormError($modal,errorMsg,$errorInput){
		$modal.find('.error').css('display','block')
		$modal.find('.error').html(errorMsg);
		$errorInput.addClass('inputError');
	}
});