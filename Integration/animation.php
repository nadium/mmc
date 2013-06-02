<?php require("oauth/twitteroauth.php");  
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Tweet My Creature</title>
	
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/profil.css" rel="stylesheet" type="text/css" />
	
	<script>
		// this sets the namespace for CreateJS to the window object, so you can instantiate objects without specifying 
		// the namespace: "new Graphics()" instead of "new createjs.Graphics()"
		// this is a quick way to make projects built on pervious versions of EaselJS run without extensive modifications
		var createjs = window;
	</script>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/preloadjs-0.2.0.min.js"></script>

	<script type="text/javascript" src="js/easeljs/utils/UID.js"></script>
	<script type="text/javascript" src="js/easeljs/geom/Matrix2D.js"></script>
	<script type="text/javascript" src="js/easeljs/display/DisplayObject.js"></script>
	<script type="text/javascript" src="js/easeljs/display/Container.js"></script>
	<script type="text/javascript" src="js/easeljs/display/Stage.js"></script>
	<script type="text/javascript" src="js/easeljs/events/MouseEvent.js"></script>
	<script type="text/javascript" src="js/easeljs/display/Shape.js"></script>
	<script type="text/javascript" src="js/easeljs/display/Graphics.js"></script>
	<script type="text/javascript" src="js/easeljs/utils/Ticker.js"></script>
	<script type="text/javascript" src="js/easeljs/display/SpriteSheet.js"></script>
	<script type="text/javascript" src="js/easeljs/display/Bitmap.js"></script>
	<script type="text/javascript" src="js/easeljs/display/BitmapAnimation.js"></script>
	<script type="text/javascript" src="js/easeljs/geom/Rectangle.js"></script>

	<!-- Script animation créature -->
	<script type="text/javascript" src="js/script.js"></script>


</head>
<body onload="init();">

	<?php include_once("partial/header.php"); ?>

	<?php if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){  
		    // We've got everything we need  
		} else {  
		    // Something's missing, go back to square 1  
		    header('Location: twitterClient/twitter_login.php');  
		}  

		// TwitterOAuth instance, with two new parameters we got in twitter_login.php  
		$twitteroauth = new TwitterOAuth('medqkafL4cjnVrcx1YgKw', 'AgcYnYozGkxvBV6rZZ6r3Fnwj81Yt5lXjufOz8EVvw', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);  
		// Let's request the access token  
		$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']); 
		// Save it in a session var 
		$_SESSION['access_token'] = $access_token; 
		// Let's get the user's info 
		$user_info = $twitteroauth->get('account/verify_credentials'); 

		mysql_connect('localhost', 'root', 'root');  
		mysql_select_db('twitter');


		if(isset($user_info->error)){  
		    // Something's wrong, go back to square 1  
		    header('Location: twitterClient/twitter_login.php'); 
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
		}  

		if(!empty($_SESSION['username'])){  
		    $twitteroauth = new TwitterOAuth('medqkafL4cjnVrcx1YgKw', 'AgcYnYozGkxvBV6rZZ6r3Fnwj81Yt5lXjufOz8EVvw', $_SESSION['oauth_token'], $_SESSION['oauth_secret']);  
		}  
		
		$_SESSION['oauthtweet']= $twitteroauth;
	?>
	
	<div id="loader"></div>

	<div class="content">
		<div id="welcome">Welcome Back <?=(!empty($_SESSION['username']) ? '@' . $_SESSION['username'] : 'Guest'); ?> !</div>
		<div class="canvasHolder">
			<canvas id="canvas" width="1300" height="450"></canvas>
		</div>
		<div class="wrap">
			<div id="tweeting">
				<div>
					<p>Feed my creature</p>
				    <textarea name="tweet" id="texttweet" cols="30" rows="1" placeholder="Compose new tweet"></textarea><br>
				    <input type="button" id="button" value="Envoyer">
				</div>
			</div>

			<div id="blockTweet-wrapper">
				<p>Tweets</p>
				<div id="blockTweet">
					<ul>
						<?php 
							$home_timeline = $_SESSION['oauthtweet']->get('statuses/home_timeline', array('count' => 8)); 
							foreach ($home_timeline as $key => $tweet){
							    echo "<li>";
							    echo $tweet->created_at .": ";
							    echo $tweet->text;
							    echo "</li>";
							}
						?>
					</ul>
				</div>
			</div>
			
		</div>



	</div>
	
	





	<footer>©Tweet my creature</footer>
</body>
</html>
