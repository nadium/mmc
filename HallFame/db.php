<?php

	mysql_connect("localhost","root","root") or die ("Erreur de connexion a MySql".mysql_error());
	mysql_select_db("mmc") or die ("Erreur de connexion a la base mmc".mysql_error());

?>