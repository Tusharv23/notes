<!DOCTYPE html>
<html>
<head>
	<title>Round Cloud</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<style>

#mp3_player
{
  background-color: black;
  width: 500px;
  height: 500px;
  margin: auto;
 
  border-radius: 50%;

}
#audio_box
{
  background-color: blue;
  margin: auto;
  width: 300px;
  top: 225px;
  z-index: 2;
  position: relative;
  opacity: 0.4;
 
}
canvas{
  background-color: red;
  position: relative;
  top: 180px;
  height: 10%;
  width: 100%;
  border-radius: 30%;
  z-index: 1;

}

</style>
<body>

<div id="mp3_player">
<div id="audio_box">
  
</div>
  <canvas id="analyser_render"></canvas> 
  </div>
</body>
<script>

$("#mp3_player").hover(alert("hello"));

var song = "1.mp4";
// Create a new instance of an audio object and adjust some of its properties
var audio = new Audio();
audio.src = song;
audio.controls = true;
audio.loop = true;
audio.autoplay = false;
// Establish all variables that your Analyser will use
var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width, bar_height;
// Initialize the MP3 player after the page loads all of its HTML into the window

function initMp3Player(){
	document.getElementById('audio_box').appendChild(audio);
	context = new webkitAudioContext(); // AudioContext object instance
	analyser = context.createAnalyser(); // AnalyserNode method
	canvas = document.getElementById('analyser_render');
	ctx = canvas.getContext('2d');
	// Re-route audio playback into the processing graph of the AudioContext
	source = context.createMediaElementSource(audio); 
	source.connect(analyser);
	analyser.connect(context.destination);
	frameLooper();
}
// frameLooper() animates any style of graphics you wish to the audio frequency
// Looping at the default frame rate that the browser provides(approx. 60 FPS)
function frameLooper(){
	window.webkitRequestAnimationFrame(frameLooper);
	fbc_array = new Uint8Array(analyser.frequencyBinCount);
	analyser.getByteFrequencyData(fbc_array);
	ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
	ctx.fillStyle = '#000000'; // Color of the bars
	bars = 100;
	for (var i = 0; i < bars; i++) {
		bar_x = i * 3;
		bar_width = 2;
		bar_height = -(fbc_array[i] / 2);
		//  fillRect( x, y, width, height ) // Explanation of the parameters below
		ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);
	}

 
}


</script>
</html>