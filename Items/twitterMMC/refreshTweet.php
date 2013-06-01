<?php require("twitteroauth.php");  
session_start(); 
	
	$home_timeline = $_SESSION['oauthtweet']->get('statuses/home_timeline', array('count' => 3)); 
	foreach ($home_timeline as $key => $tweet)
	{
	    echo $tweet->created_at .": ";
	    echo $tweet->text ."<br><br>";
	}
?>