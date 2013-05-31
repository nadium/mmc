<?php require("../oauth/twitteroauth.php");  
session_start(); 
	$texttweet= $_GET['tweet'];
	echo $_SESSION['oauthtweet']->post('statuses/update', array('status' => $texttweet ));  
?>
