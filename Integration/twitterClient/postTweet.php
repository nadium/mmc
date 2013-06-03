<?php require("../oauth/twitteroauth.php");  
session_start(); 

include('./db.php');

// $sqltweet=mysql_query("UPDATE User SET US_music=US_music+1 WHERE US_twitter='Nadium';");
// //$restweet=mysql_query($sqltweet);


	$texttweet= $_POST['tweet'];
	echo $_SESSION['oauthtweet']->post('statuses/update', array('status' => $texttweet ));  






?>
