<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hall of Fame</title>
</head>
<body>

	<div style="width:500px; height:auto; background-color:silver;">

		<?php
		/* HALL OF FAME POINT*/

		include("db.php");
		$sqluser="SELECT * FROM User ORDER BY US_point DESC;";
		$resuser=mysql_query($sqluser);

		//echo $sqluser;

		while($tabuser=mysql_fetch_array($resuser)){
			echo $tabuser["US_twitter"];
			echo " | ";
			echo $tabuser["US_point"]." point";
			echo "<hr/>";		
		}
echo "<br/><br/><br/>";

		/* HALL OF FAME MUSIC*/

		include("db.php");
		$sqluser="SELECT * FROM User ORDER BY US_music DESC;";
		$resuser=mysql_query($sqluser);

		//echo $sqluser;

		while($tabuser=mysql_fetch_array($resuser)){
			echo $tabuser["US_twitter"];
			echo " | ";
			echo $tabuser["US_music"]." pointmusic";
			echo "<hr/>";		
		}

echo "<br/><br/><br/>";

		/* HALL OF FAME FOOD*/

		include("db.php");
		$sqluser="SELECT * FROM User ORDER BY US_food DESC;";
		$resuser=mysql_query($sqluser);

		//echo $sqluser;

		while($tabuser=mysql_fetch_array($resuser)){
			echo $tabuser["US_twitter"];
			echo " | ";
			echo $tabuser["US_food"]." pointfood";
			echo "<hr/>";		
		}
echo "<br/><br/><br/>";

		/* HALL OF FAME PHOTO*/

		include("db.php");
		$sqluser="SELECT * FROM User ORDER BY US_photo DESC;";
		$resuser=mysql_query($sqluser);

		//echo $sqluser;

		while($tabuser=mysql_fetch_array($resuser)){
			echo $tabuser["US_twitter"];
			echo " | ";
			echo $tabuser["US_photo"]." pointphoto";
			echo "<hr/>";		
		}

echo "<br/><br/><br/>";

		?>
	</div>	
</body>
</html>



