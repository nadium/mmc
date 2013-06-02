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
	<?php include_once("partial/header.php"); ?>	
	
	<section id="sectionlogin">
		<h1>Hello ! Your creature awaits you !</h1>

		<div class="wraplogin">

			<div class="contentlogin">
				<form class="flogin" action="" method="post">

					<span>User login </span><span><a href="#">Forgot Password?</a></span>
					<div class="imguser">
						<input type="text" name="login" placeholder="Login"/>
					</div>
					<div class="imgkey">
						<input type="password" name="pw" placeholder="Password"/>
					</div>
					<input type="submit" name"send" value="LOGIN TO YOUR ACCOUNT">

				</form>

			</div>

			<p class="ortwitter"> OR </p>
			<a href="twitterClient/twitter_login.php"><input type="button" id="login" value="LOGIN WITH TWITTER"/></a>

		</div>

	</section>

	<footer>©Tweet my creature</footer>
</body>
</html>