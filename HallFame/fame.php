<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hall of Fame</title>
</head>
<body>

	<div style="width:500px; height:500px; background-color:silver;">

		<?php
		include("db.php");
		$sqluser="SELECT * FROM User ORDER BY US_point DESC;";
		$resuser=mysql_query($sqluser);

		//echo $sqluser;

		while($tabuser=mysql_fetch_array($resuser)){
			echo $tabuser["US_twitter"];
			echo " | ";
			echo $tabuser["US_point"]." cp";
			echo "<hr/>";

			
		}


		?>
	</div>	
</body>
</html>



