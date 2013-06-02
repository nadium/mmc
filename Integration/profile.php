<?php
include('db.php'); // Importation de la connexion a la BDD
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tweet My Creature</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav>
		<div id="nav-wrapper">
			<div id="logo">&nbsp;</div>
			<div>
				<a class="first" href="">MY PROFILE</a>
				<a href="hof.php">HALL OF FAME</a>
				<a href="">ABOUT</a>
			</div>
			<div>
				<a class="first" href="">Sign Up</a>
				<a href="login.php">Log In</a>
			</div>
		</div>
	</nav>
	<header id="headerlogin">
		
				<h1 style="text-transformation:none;">Hello ! Your creature awaits you !</h1>

	</header>
	<section>
		
		<div class="contentlogin">
			<form action="" method="post">
				<input type="text" name="login" placeholder="Login"/>
				<input type="password" name="pw" placeholder="Password"/>

				<input type="submit" name"send" value="LOGIN TO YOUR ACCOUNT">
			</form>


		</div>

	</section>
	<footer>©Tweet my creature</footer>
</body>
</html>