<?php require("../oauth/twitteroauth.php");  
session_start(); 

if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){  
    // We've got everything we need  
} else {  
    // Something's missing, go back to square 1  
    header('Location: twitter_login.php');  
}  

// TwitterOAuth instance, with two new parameters we got in twitter_login.php  
$twitteroauth = new TwitterOAuth('medqkafL4cjnVrcx1YgKw', 'AgcYnYozGkxvBV6rZZ6r3Fnwj81Yt5lXjufOz8EVvw', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);  
// Let's request the access token  
$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']); 
// Save it in a session var 
$_SESSION['access_token'] = $access_token; 
// Let's get the user's info 
$user_info = $twitteroauth->get('account/verify_credentials'); 
// Print user's info  
//print_r($user_info);  

mysql_connect('localhost', 'root', 'root');  
mysql_select_db('twitter');


if(isset($user_info->error)){  
    // Something's wrong, go back to square 1  
    header('Location: twitter_login.php'); 
} else { 
    // Let's find the user by its ID  
    $query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND oauth_uid = ". $user_info->id);  
    $result = mysql_fetch_array($query);  
  
    // If not, let's add it to the database  
    if(empty($result)){  
        $query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username, oauth_token, oauth_secret) VALUES ('twitter', {$user_info->id}, '{$user_info->screen_name}', '{$access_token['oauth_token']}', '{$access_token['oauth_token_secret']}')");  
        $query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());  
        $result = mysql_fetch_array($query);  
    } else {  
        // Update the tokens  
        $query = mysql_query("UPDATE users SET oauth_token = '{$access_token['oauth_token']}', oauth_secret = '{$access_token['oauth_token_secret']}' WHERE oauth_provider = 'twitter' AND oauth_uid = {$user_info->id}");  
    }  
  
    $_SESSION['id'] = $result['id']; 
    $_SESSION['username'] = $result['username']; 
    $_SESSION['oauth_uid'] = $result['oauth_uid']; 
    $_SESSION['oauth_provider'] = $result['oauth_provider']; 
    $_SESSION['oauth_token'] = $result['oauth_token']; 
    $_SESSION['oauth_secret'] = $result['oauth_secret']; 
 
    //header('Location: twitter_update.php');  
}  

if(!empty($_SESSION['username'])){  
    // User is logged in, redirect  
    //header('Location: twitter_update.php');  
}  
?>

<h2>Hello <?=(!empty($_SESSION['username']) ? '@' . $_SESSION['username'] : 'Guest'); ?></h2>  

<?php if(!empty($_SESSION['username'])){  
    $twitteroauth = new TwitterOAuth('medqkafL4cjnVrcx1YgKw', 'AgcYnYozGkxvBV6rZZ6r3Fnwj81Yt5lXjufOz8EVvw', $_SESSION['oauth_token'], $_SESSION['oauth_secret']);  
}  

//$home_timeline = $twitteroauth->get('statuses/home_timeline'); 
$home_timeline = $twitteroauth->get('statuses/home_timeline', array('count' => 3)); 
//$nettuts_timeline = $twitteroauth->get('statuses/user_timeline', array('screen_name' => 'nettuts'));  
//print_r($home_timeline);  
?>
<div id="blockTweet">
<?php 
foreach ($home_timeline as $key => $tweet)
{
    echo $tweet->created_at .": ";
    echo $tweet->text ."<br><br>";
}
?>
</div>

<?php 
$_SESSION['oauthtweet']= $twitteroauth;
?>



