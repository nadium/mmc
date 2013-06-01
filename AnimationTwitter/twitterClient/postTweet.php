<?php require("../oauth/twitteroauth.php");  
session_start(); 
	$texttweet= $_POST['tweet'];
	echo $_SESSION['oauthtweet']->post('statuses/update', array('status' => $texttweet ));  
?>
