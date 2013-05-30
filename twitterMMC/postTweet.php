<?php require("twitteroauth.php");  
session_start(); 
  $texttweet= $_GET['tweet'];
  echo $_SESSION['toto']->post('statuses/update', array('status' => $texttweet ));  
?>