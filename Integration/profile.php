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
				<a class="first" href="profile.php">MY PROFILE</a>
				<a href="hof.php">HALL OF FAME</a>
				<a href="">ABOUT</a>
			</div>
			<div>
				<a class="first" href="">Sign Up</a>
				<a href="login.php">Log In</a>
			</div>
		</div>
	</nav>
	<header id="headerprofile">
		
				<h3 id="pseudo">akajiro</h3>

	</header>
	<section id="sectionprofile">
		
		<div class="bar"><div id="life" style="width:400px;"></div></div><span class="stats">90 HP</span><br> <br>
		<div class="bar"><div id="xp" style="width:200px;"></div></div> <span class="stats">65 XP</span>

		<div id="creatureprofile"></div>
		
		<div id="details">
		<p style="font-family:Fago;">MY CREATURE</p> <br/>

			Name:	Totox <br/>
			Mood:	Hungry	<br/>
			Level: Beginner	<br/>
		</div>

	</section>
	<footer>©Tweet my creature</footer>
</body>
</html>