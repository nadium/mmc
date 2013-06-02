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
						echo '<div class="imgwinner"></div>
						<div class="userwin">'.$tabuser1["US_twitter"].'</div>';
						echo '<div class="point"><font size="58px"><p id="textpoint">'.$tabuser1["US_point"].' </font><font size="30px">points</p></font></div> ';
						echo '<div class="nbtweet"><font size="58px"><p id="textpoint">'.$tabuser1["US_music"].' </font> <font size="30px">tweets</p></font> </div>'; //changement de dernière minutes, US_musique = tweets
						echo '';
			?>
			
		</div>

		<div id="tableuser">
			<table id="tableother" border="1">
			<?php
			$i=2;
			while($tabuser=mysql_fetch_array($resuser))
			{
				if($i%2 == 0 )
				{
					echo '<tr><td id="bgfonce" style="font-weight:bold; font-family:Fago; font-size:24px; color:#616161;">#'.$i.'</td>';
					echo '<td id="bgfonce"><div id="imgcreature"></div> <p class="username">'.$tabuser["US_twitter"].'</p></td>';
					echo '<td id="bgfonce">'.$tabuser["US_point"].' points </td>';
					echo '<td id="bgfonce">'.$tabuser["US_music"].' Tweets </td>'; //changement de dernière minutes, US_musique = tweets
					echo '</tr>';
				}
                if($i%2 != 0 )
                {
                        echo '<tr><td id="bgclair"style="font-weight:bold; font-family:Fago; font-size:24px; color:#616161;">#'.$i.'</td>';
                        echo '<td id="bgclair"><div id="imgcreature"></div> <p class="username">'.$tabuser["US_twitter"].'</p></td>';
                        echo '<td id="bgclair">'.$tabuser["US_point"].' points </td>';
                        echo '<td id="bgclair">'.$tabuser["US_music"].' Tweets </td>'; //changement de dernière minutes, US_musique = tweets
                        echo '</tr>';
                }

			$i++;		
			}

			?>

			</table>
	<a href="#"><div class="arrow"></div></a>

		</div>


	</section>
	<footer>©Tweet my creature</footer>
</body>
</html>