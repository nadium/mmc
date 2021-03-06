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

spriteSheet ={"animations": {"run": [1, 8], "stand": [0],"standleft": [19],"runleft":[12,18],"eat":[20,24], "eatYes":[25], "eatNo":[26] }, "images": ["./assets/evolution0.png"], "frames": {"regX": 0, "height": 524, "count": 26, "regY": 0, "width": 320}};
		
spriteSheet1 ={"animations": {"run": [1, 8], "stand": [0],"standleft": [19],"runleft":[12,18],"eat":[20,24], "eatYes":[25], "eatNo":[26] }, "images": ["./assets/evolution1.png"], "frames": {"regX": 0, "height": 524, "count": 26, "regY": 0, "width": 320}};


if(pointTweet<10){
	var ss = new SpriteSheet(spriteSheet);
}
else if(9<pointTweet){
	var ss = new SpriteSheet(spriteSheet1);
}	
myCreature = new BitmapAnimation(ss);

// Set up looping
ss.getAnimation("stand").next = "stand";
ss.getAnimation("run").next = "run";
ss.getAnimation("runleft").next = "runleft";
ss.getAnimation("eat").next = "eatYes";
ss.getAnimation("eat").frequency = 5;
ss.getAnimation("eatYes").next = "eatYes";
ss.getAnimation("eatYes").frequency = 4;
ss.getAnimation("eatNo").next = "eatNo";
ss.getAnimation("eatNo").frequency = 4;

// grab canvas width and height for later calculations:
w = canvas.width;
h = canvas.height;

// Position the myCreature sprite
myCreature.x = w/4;
myCreature.y = 40;
myCreature.scaleX = myCreature.scaleY = 0.8;

assets = [];
if(fp<10){
	manifest = [
		{src:"assets/evolution0.png", id:"myCreature"}
	];
}
else if(9<fp){
	manifest = [
		{src:"assets/evolution1.png", id:"myCreature"}
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
		if(3<=i && i<6){
			myCreature.gotoAndPlay("stand");
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
		
	}
	

},2000);


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
    var array = ["#Feed","Bonjour"];
    var string;

    $('#button').click(function(){
        var text = $('#texttweet').val();
     	alert(pointTweet);
        $.ajax({
			url: "./twitterClient/postTweet.php",
			type: "POST",
			data: "tweet="+text,
			context: document.body
		});


        for(i=0;i<array.length;i++){
            string=array[i];
            if(text.indexOf(string) != -1){
                myCreature.gotoAndPlay("stand");
                mouvement= false;
            }        
        }

        $('#texttweet').val('');
    })
   
    $.ajaxSetup({ cache: false }); 
    setInterval(function() {
        $('#blockTweet').load('./twitterClient/refreshTweet.php');       
    }, 3000);
})
