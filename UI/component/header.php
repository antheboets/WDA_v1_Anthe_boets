<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="<?php echo $url ;?>index.php">eShop</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav" id="navbarButtons">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url ;?>UI/pages/allProducts.php">Products</a>
            </li>
  			<li class="nav-item">
    			<a class="nav-link" href="<?php echo $url ;?>UI/pages/contact.php">Contact</a>
  			</li>
		</ul>
        <ul class="navbar-nav ml-auto">
            <span class="navbar-text" id="banner"></span>
        </ul>
	</div>
</nav>
<div class="modal" tabindex="-1" role="dialog" id="mLogin">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Login</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
    			</button>
  			</div>
  			<div class="modal-body">
  				<form action="<?php echo $url ;?>Logic/Login.php" method="POST" id="fLogin">
  					<p class="error noBreak" style="display: none;"></p>
                    <p class="noBreak">Email:</p>
  					<input type="input" name="email" id="loginEmail">
  					<p class="noBreak">Password:</p>
  					<input type="password" name="password" id="loginPassword">
                    <br>
                    Stay logged in:
                    <input type="checkbox" name="stayLogedIn" id="stayLogedIn">
                    <input type="hidden" name="url" id="loginUrl">
  				</form>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary" id="loginBtn">Login</button>
    			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  			</div>
		</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="mSignUp">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Sign up</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
    			</button>
  			</div>
  			<div class="modal-body">
  				<form action="<?php echo $url ;?>Logic/signUp.php" method="POST" id="fSignUp">
  					<p class="error noBreak" style="display: none;"></p>
  					<p class="noBreak">Firstname:</p>
  					<input type="input" name="firstname" id="sigUpFirstname">
                    <p class="noBreak">Lastname:</p>
                    <input type="input" name="lastname" id="sigUpLastname">
  					<p class="noBreak">Email:</p>
  					<input type="input" name="email" id="signUpEmail">
  					<p class="noBreak">Password:</p>
  					<input type="password" name="password" id="signUpPassword">
  					<p class="noBreak">Re-Password:</p>
  					<input type="password" name="rePassword" id="signUpRePassword">
                    <input type="hidden" name="url" id="signUpUrl">
  				</form>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary" id="signUpBtn">Sign Up</button>
    			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  			</div>
		</div>
	</div>
</div>