<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Login Page in HTML with CSS Code Example</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
	<script type="text/javascript" src="js/login.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<h1>Cometh SASU.</h1>
		<p>Outils de gestion des projets de Cometh SASU.&copy;</p>
		<!--<span>
			<p>login with social media</p>
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Login with Twitter</a>
		</span>>
		-->
		</div>
	</div>
	
	
		<div class="right">
		<h5>Connexion</h5>
		<p>Vous avez un compte? <a href="#"> Créer votre compte</a> pour bénéficier de nos outils</p>
		<div class="inputs">
			<input id="username" type="text" placeholder="user name">
			<br>
			<input id="password" type="password" placeholder="password">
		</div>
			
			<br><br>
			
		<div class="remember-me--forget-password">
				<!-- Angular -->
	<label>
		<input type="checkbox" name="item" checked/>
		<span class="text-checkbox">Remember me</span>
	</label>
			<!--<p>forget password?</p>-->
		</div>
			
			<br>
			<button onclick="login(document.getElementById('username').value,
								   document.getElementById('password').value)" >Se connecter</button>
	</div>
	
</div>
<!-- partial -->
  
</body>
</html>
