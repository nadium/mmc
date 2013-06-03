<?php require("oauth/twitteroauth.php");  
session_start();
include("db.php");
$sqluser="SELECT US_point FROM User WHERE US_Twitter='Deadmush';";
$resuser=mysql_query($sqluser);
$tabuser=mysql_fetch_array($resuser);  
$point= $tabuser['US_point'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Tweet My Creature</title>
	
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/profil.css" rel="stylesheet" type="text/css" />
	
	<script>
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
	
	<script>
		/*Animation créature
	******************************************/
	var pointTweet = "<?php echo $point; ?>";
	var direction = true;
	var assets;
	var mouvement = true;
	var stage;
	var w, h;
	var sens= true;
	var myCreature;
	var runningRate, isInWarp, isStationary;
	var stationaryPosition, isPassed;
	var fp=10;
	function init() {
		if (window.top != window) {
			document.getElementById("header").style.display = "none";
		}

		document.getElementById("loader").className = "loader";

		var canvas = document.getElementById("canvas");
		stage = new Stage(canvas);

		runningRate = 1;
		isInWarp = false;
		isStationary = false;
		stationaryPosition = 300;
		isPassed = false;

	spriteSheet ={"animations": {"run": [1, 8], "stand": [0],"standleft": [19],"runleft":[12,18],"eat":[20,24], "eatYes":[25], "eatNo":[26], "stand2":[27], "stand3":[28],"stand4":[29] }, "images": ["./assets/evolution0.png"], "frames": {"regX": 0, "height": 524, "count": 30, "regY": 0, "width": 320}};
	spriteSheet1 ={"animations": {"run": [1, 8], "stand": [0],"standleft": [19],"runleft":[12,18],"eat":[20,24], "eatYes":[25], "eatNo":[26], "stand2":[27], "stand3":[28],"stand4":[29] }, "images": ["./assets/evolution1.png"], "frames": {"regX": 0, "height": 524, "count": 30, "regY": 0, "width": 320}};
	spriteSheet2 ={"animations": {"run": [1, 8], "stand": [0],"standleft": [19],"runleft":[12,18],"eat":[20,24], "eatYes":[25], "eatNo":[26], "stand2":[27], "stand3":[28],"stand4":[29] }, "images": ["./assets/evolution2.png"], "frames": {"regX": 0, "height": 524, "count": 30, "regY": 0, "width": 320}};
	spriteSheet3 ={"animations": {"run": [1, 8], "stand": [0],"standleft": [19],"runleft":[12,18],"eat":[20,24], "eatYes":[25], "eatNo":[26], "stand2":[27], "stand3":[28],"stand4":[29] }, "images": ["./assets/evolution3.png"], "frames": {"regX": 0, "height": 524, "count": 30, "regY": 0, "width": 320}};

	if(pointTweet<100){
		var ss = new SpriteSheet(spriteSheet);
	}
	else if(100<pointTweet && pointTweet<500){
		var ss = new SpriteSheet(spriteSheet1);
	}	
	else if(500<pointTweet && pointTweet<1000){
		var ss = new SpriteSheet(spriteSheet2);
	}	
	else if(1000<pointTweet ){
		var ss = new SpriteSheet(spriteSheet3);
	}	
	myCreature = new BitmapAnimation(ss);

	// Set up looping
	ss.getAnimation("stand").next = "stand";
	ss.getAnimation("stand2").next = "stand2";
	ss.getAnimation("stand3").next = "stand3";
	ss.getAnimation("stand4").next = "stand4";
	ss.getAnimation("stand4").frequency = 6;
	ss.getAnimation("run").next = "run";
	ss.getAnimation("runleft").next = "runleft";
	ss.getAnimation("eat").next = "eatYes";
	ss.getAnimation("eat").frequency = 5;
	ss.getAnimation("eatYes").next = "eatYes";
	ss.getAnimation("eatYes").frequency = 5;
	ss.getAnimation("eatNo").next = "eatNo";
	ss.getAnimation("eatNo").frequency = 5;

	// grab canvas width and height for later calculations:
	w = canvas.width;
	h = canvas.height;

	// Position the myCreature sprite
	myCreature.x = w/4;
	myCreature.y = 40;
	myCreature.scaleX = myCreature.scaleY = 0.8;

	assets = [];

	if(pointTweet<100){
		manifest = [
			{src:"assets/evolution0.png", id:"myCreature"}
		];
	}
	else if(100<pointTweet && pointTweet<500){
		manifest = [
			{src:"assets/evolution1.png", id:"myCreature"}
		];
	}	
	else if(500<pointTweet && pointTweet<1000){
		manifest = [
			{src:"assets/evolution2.png", id:"myCreature"}
		];
	}	
	else if(1000<pointTweet ){
		manifest = [
			{src:"assets/evolution3.png", id:"myCreature"}
		];
	}	
	
	loader = new PreloadJS();
	loader.useXHR = false;  // XHR loading is not reliable when running locally.
	loader.onFileLoad = handleFileLoad;
	loader.onComplete = handleComplete;
	loader.loadManifest(manifest);
	stage.autoClear = false;
	}

	function handleFileLoad(event) {
		assets.push(event);
	}

	function handleComplete() {

		document.getElementById("loader").className = "";

		if (myCreature == null) {
			console.log("Can not play. myCreature sprite was not loaded.");
			return;
		}

		stage.addChild(myCreature);
		
		Ticker.setFPS(15);
		Ticker.addListener(window);
	}


	setInterval(function randomMove() {
		var i = Math.floor(Math.random()*10);
		
		if(sens==true){
			if(0<=i && i<3){
				myCreature.gotoAndPlay("run");
				mouvement=true;
			}
			
				if(i==3){
					myCreature.gotoAndPlay("stand");
					mouvement= false;
				}
				else if(i==4){
					myCreature.gotoAndPlay("stand2");
					mouvement= false;
				}
				else if(i==5){
					myCreature.gotoAndPlay("stand3");
					mouvement= false;
				}
				
			
			
		}
		if(sens==false){
			if(0<=i && i<3){
				myCreature.gotoAndPlay("runleft");
				mouvement=true;
			}
			if(3<=i && i<6){
				myCreature.gotoAndPlay("standleft");
				mouvement= false;
			}
			else if(i==6){
				myCreature.gotoAndPlay("stand2");
				mouvement= false;
			}	
		}
		

	},3000);


	function tick() {
		var outside = w-400;
		
		if(myCreature.x>=200 && myCreature.x<=outside && sens==true ){
			if (mouvement) {
				//myCreature.x = ((myCreature.x + 10) >= outside) ? sens=false : (myCreature.x + 10);
				if((myCreature.x + 10) >= outside){
					sens=false;
					myCreature.x=outside;
					myCreature.gotoAndPlay("runleft");
				}
				else{
					myCreature.x=myCreature.x + 10;
				}
			} 	
		}
		else if(sens==false){
			if (mouvement) {
				//myCreature.x = ((myCreature.x - 10) >= outside) ? sens=true : (myCreature.x - 10);
				if((myCreature.x - 10) <= 200){
					sens=true;
					myCreature.x=200;
					myCreature.gotoAndPlay("run");
				}
				else{
					myCreature.x=myCreature.x - 10;
				}
			} 	
		}


		stage.clear();
		stage.update();
	}


	/* Gestion de twitter
	******************************************/

	$(document).ready(function(){
	    var i=0;
	    var array = ["#FeedMC","#PhotoMC", "#MusicMC", "#HeticMC","#MeetMyCreature"];
	    var string;

	    $('#button').click(function(){
	        var text = $('#texttweet').val();
	       
	        var j = Math.floor(Math.random()*10);

	        if(text.indexOf(array[0]) != -1){
	        	 $.ajax({
				url: "./twitterClient/postTweet.php",
				type: "POST",
				data: "tweet="+text,
				context: document.body
			});
	                myCreature.gotoAndPlay("eat");
					mouvement= false;
	            }  
            else if(text.indexOf(array[1]) != -1) {
            	myCreature.gotoAndPlay("eatNo");
            	mouvement= false;
            }
            else if(text.indexOf(array[2]) != -1) {
            	 $.ajax({
				url: "./twitterClient/postTweet.php",
				type: "POST",
				data: "tweet="+text,
				context: document.body
			});
            	myCreature.gotoAndPlay("eat");
            	mouvement= false;
            }
            else if(text.indexOf(array[3]) != -1) {
            	myCreature.gotoAndPlay("stand4");
            	mouvement= false;
            }
            else if(text.indexOf(array[4]) != -1) {
            	 $.ajax({
				url: "./twitterClient/postTweet.php",
				type: "POST",
				data: "tweet="+text,
				context: document.body
			});
            	myCreature.gotoAndPlay("eat");
            	mouvement= false;
            }
            else {
            	myCreature.gotoAndPlay("eatNo");
            	mouvement= false;
            }
	        /*for(i=0;i<array.length;i++){
	            string=array[i];

	            if(text.indexOf(string) != -1){
	                myCreature.gotoAndPlay("eat");
					mouvement= false;
	            }  
	            else if(text.indexOf(string) == -1) {
	            	myCreature.gotoAndPlay("eatNo");
	            	mouvement= false;
	            }
	        }*/

	        $('#texttweet').val('');
	    })
	   
	    $.ajaxSetup({ cache: false }); 
	    setInterval(function() {
	        $('#blockTweet').load('./twitterClient/refreshTweet.php');       
	    }, 3000);
	})
	</script>

</head>
<body onload="init();">

	<?php include_once("partial/header.php"); ?>

	<?php 
	if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){  
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
				    <input type="button" id="button" value="Tweet!">
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
