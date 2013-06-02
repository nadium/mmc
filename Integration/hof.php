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
				<a href="">HALL OF FAME</a>
				<a href="">ABOUT</a>
			</div>
			<div>
				<a class="first" href="">Sign Up</a>
				<a href="">Log In</a>
			</div>
		</div>
	</nav>
	<header id="headerhof">
		
				<h1>Welcome to the Hall of Fame!</h1>
				<div>Who’s the best creature ? Let’s find out!</div>

	</header>
	<section id="contenthof">
<?php
//Requete SQL recupérant les membres classé par point décroissant
$sqluser="SELECT * FROM User ORDER BY US_point DESC;";
$resuser=mysql_query($sqluser);

?>
		<div id="no1">
			
			<?php 
				$tabuser1=mysql_fetch_array($resuser); 

						echo '<div class="number">#1</div>';
						echo '<div class="imgwinner"></div><div class="userwin">'.$tabuser1["US_twitter"].'</div>';
						echo '<div class="point">'.$tabuser1["US_point"].' <font size="30px">points</font></div> ';
						echo '<div class="nbtweet"><font size="58px">'.$tabuser1["US_music"].' </font> <font size="30px">tweets</font> </div>'; //changement de dernière minutes, US_musique = tweets
						echo '';
			?>
			
		</div>

		<div id="tableuser">
			<table id="tableother" border="1">
			<?php
			$i=2;
			while($tabuser=mysql_fetch_array($resuser))
			{
				
			echo '<tr><td>#'.$i.'</td>';
			echo '<td><div id="imgcreature"></div>'.$tabuser["US_twitter"].'</td>';
			echo '<td>'.$tabuser["US_point"].' points </td>';
			echo '<td>'.$tabuser["US_music"].' Tweets </td>'; //changement de dernière minutes, US_musique = tweets
			echo '</tr>';
			$i++;		
			}

			?>

			</table>

		</div>



	</section>
	<footer>©Tweet my creature</footer>
</body>
</html>