<?php require("../oauth/twitteroauth.php");   
session_start(); 

	$home_timeline = $_SESSION['oauthtweet']->get('statuses/home_timeline', array('count' => 8)); 
	foreach ($home_timeline as $key => $tweet){
	    echo "<li style='list-style-type:none;'>";
	    echo $tweet->created_at .": ";
	    echo $tweet->text;
	    echo "</li>";
	}
						
?>