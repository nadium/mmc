<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>EaselJS: Sprite Sheet Example</title>

	<link href="assets/demoStyles.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	
	<script>
		// this sets the namespace for CreateJS to the window object, so you can instantiate objects without specifying 
		// the namespace: "new Graphics()" instead of "new createjs.Graphics()"
		// this is a quick way to make projects built on pervious versions of EaselJS run without extensive modifications
		var createjs = window;
	</script>
	
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
	<nav>
		<div id="nav-wrapper">
			<div id="logo">&nbsp;</div>
			<div>
				<a class="first" href="">MY PROFILE</a>
				<a href="hof.php">HALL OF FAME</a>
				<a href="">ABOUT</a>
			</div>
			<div>
				<a class="first" href="">Sign Up</a>
				<a href="">Log In</a>
			</div>
		</div>
	</nav>
	<div id="loader">toto</div>

	
	<div class="canvasHolder">
		<canvas id="canvas" width="1300" height="450"></canvas>
	</div>
	<div>Fame Points: </div><div id="num">Nombre</div>
	<div>Aléatoire: </div><div id="aleatoire">Nombre</div>
	<input type="button" name="tweet" id="tweet" value="Tweet!" onClick="clickMove();"/>

	<div id="myDiv" class="hide">jflsdjk </div>
	<footer>©Tweet my creature</footer>
</body>
</html>
