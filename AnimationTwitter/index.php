<?php require("oauth/twitteroauth.php");  
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>EaselJS: Sprite Sheet Example</title>
	<link href="assets/demoStyles.css" rel="stylesheet" type="text/css" />
	<script>
		var createjs = window;
	</script>
	
	<script src="assets/preloadjs-0.2.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>

	<script type="text/javascript" src="src/easeljs/utils/UID.js"></script>
	<script type="text/javascript" src="src/easeljs/geom/Matrix2D.js"></script>
	<script type="text/javascript" src="src/easeljs/display/DisplayObject.js"></script>
	<script type="text/javascript" src="src/easeljs/display/Container.js"></script>
	<script type="text/javascript" src="src/easeljs/display/Stage.js"></script>
	<script type="text/javascript" src="src/easeljs/events/MouseEvent.js"></script>
	<script type="text/javascript" src="src/easeljs/display/Shape.js"></script>
	<script type="text/javascript" src="src/easeljs/display/Graphics.js"></script>
	<script type="text/javascript" src="src/easeljs/utils/Ticker.js"></script>
	<script type="text/javascript" src="src/easeljs/display/SpriteSheet.js"></script>
	<script type="text/javascript" src="src/easeljs/display/Bitmap.js"></script>
	<script type="text/javascript" src="src/easeljs/display/BitmapAnimation.js"></script>
	<script type="text/javascript" src="src/easeljs/geom/Rectangle.js"></script>

	<!-- Script animation créature -->
	<script type="text/javascript" src="src/script.js"></script>


</head>
<body onload="init();">

	<div id="loader">Loader</div>

	<header id="header" class="EaselJS">
		<h1><span class="text-product">Meet my Creature</span> </h1>
		<p>Projet d'une créature évolutive, autonome et interactive</p>
	</header>

	<div class="canvasHolder">
		<canvas id="canvas" width="1300" height="450"></canvas>
	</div>
	<div>Fame Points: </div><div id="num">Nombre</div>
	<div>Aléatoire: </div><div id="aleatoire">Nombre</div>
	<a href="twitterClient/twitter_login.php">Tweet</a>
	<input type="button" name="tweet" id="tweet" value="Tweet!" onClick="clickMove();"/>

	<div id="myDiv" class="hide">Mydiv </div>
	<form>
	    <textarea name="tweet" id="texttweet" cols="30" rows="3" placeholder="Nourrissez votre créature! #FeedPhoto, #FeedMusic, #Feed"></textarea>
	    <input type="button" id="button" value="Envoyer">
	</form>
	<div id="blockTweet">
		<?php 
		$home_timeline = $_SESSION['oauthtweet']->get('statuses/home_timeline', array('count' => 5)); 
		foreach ($home_timeline as $key => $tweet)
		{
		    echo $tweet->created_at .": ";
		    echo $tweet->text ."<br><br>";
		}
		?>
	</div>

	
</body>
</html>
