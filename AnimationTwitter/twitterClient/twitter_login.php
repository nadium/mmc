<?php require("../oauth/twitteroauth.php");   
session_start(); 

// The TwitterOAuth instance  
$twitteroauth = new TwitterOAuth('medqkafL4cjnVrcx1YgKw', 'AgcYnYozGkxvBV6rZZ6r3Fnwj81Yt5lXjufOz8EVvw');  
// Requesting authentication tokens, the parameter is the URL we will be redirected to  
//$request_token = $twitteroauth->getRequestToken('http://127.0.0.1/git/mmc/AnimationTwitter/twitterClient/twitter_oauth.php');  
$request_token = $twitteroauth->getRequestToken('http://127.0.0.1/git/mmc/AnimationTwitter/index.php');  
  
// Saving them into the session  
$_SESSION['oauth_token'] = $request_token['oauth_token'];  
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];  
  
// If everything goes well..  
if($twitteroauth->http_code==200){  
    // Let's generate the URL and redirect  
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']); 
    header('Location: '. $url); 
} else { 
    // It's a bad idea to kill the script, but we've got to know when there's an error.  
    die('Something wrong happened.');  
}  

