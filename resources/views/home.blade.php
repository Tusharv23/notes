@include('layouts.app')
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
  top: 55px;
  z-index: 2;
  position: relative;
  opacity: 0.7;
 display: none;
}
#analyser_render{
  background-color: red;
 
 
  height: 0px;
  width: 500px;
  border-radius: 0%;
  z-index: 1;

}
.song
{
  position: relative;
  top: 20px;
  width: 100px;
  margin: auto;
  display: block;
  color: white;
  font-size: 14px;
  text-decoration: none;
  margin-top: 15px;
}
#dynamic{
  
 
    height: 50px; 
    width: 0px; 
    z-index: 4; 
    background-color: blue;
    opacity: 0.5;
}
#seeker
{
  background-color: transparent;
  width: 500px;
  height: 50px;
  
}

</style>
<body>


<div id="mp3_player">

<div class="playlist" >
<div id="timer"></div>
  <a href="" id="1.mp4" class="song">Song 1</a>
<a href="#" id="2.mp4" class="song">Song 2</a>
<a href="#" id="3.mp4" class="song">Song 3</a>
<a href="#" id="4.mp4" class="song">Song 4</a>
<a href="#" id="5.mp3" class="song">Song 5</a>
</div>
<div id="audio_box">
  
</div>
  
  </div>
  
 <div id="visualiser">
   <a href="#" >
    <div id="seeker">
      <div id="dynamic" >
        
      </div>
    </div>
  </a>   
<canvas id="analyser_render">
  
</canvas> 
 </div>
 
</body>
<script>
$("#analyser_render,#audio_box").mouseenter(function(){
  $("#audio_box").fadeIn(100);
});
$("#analyser_render,#audio_box").mouseleave(function(){
  $("#audio_box").fadeOut(100);
});
var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width, bar_height;
context = new AudioContext(); 



$(".song").click(function(e){

      e.preventDefault();
      $("#analyser_render").animate({
        height: "50px",
        

      },500,function(){});
       $("#dynamic").animate({
        height: "50px",
        

      },500,function(){});
      var song;
      
     if($(this).attr('id') !== song)
     {

      var song = $(this).attr('id');

var audio = new Audio();      
audio.src = song;
audio.controls = true;
audio.loop = false;
audio.autoplay = true;
    initMp3Player(audio); 
   
   
     }

});

function visual(audio,time)
{
  var length = audio.duration;
  var diff = 500 / length;
  
   
  
  var current = audio.currentTime;
  
  current = diff*current;
  $("#dynamic").animate({
        width: current,
      },0.1,"linear",function(){});
}

function seeker(audio)
{
  audio.ontimeupdate= function(){
    visual(audio)
  };
}

function initMp3Player(audio){
   $("#audio_box").empty();
	$('#audio_box').append(audio);
  $(audio).attr('id','current');
	// AudioContext object instance
	analyser = context.createAnalyser(); // AnalyserNode method
	canvas = document.getElementById('analyser_render');
	ctx = canvas.getContext('2d');
	// Re-route audio playback into the processing graph of the AudioContext
	source = context.createMediaElementSource(audio); 
	source.connect(analyser);
	analyser.connect(context.destination);

	frameLooper();
   seeker(audio);
  var aud = audio;


 
  aud.onended = function(){
    $("#analyser_render").animate({
        height: "1px"
      },500,function(){});
      $("#dynamic").animate({
        height: "0px"
      },500,function(){});
  }

     
}

function frameLooper(){
	window.requestAnimationFrame(frameLooper);
	fbc_array = new Uint8Array(analyser.frequencyBinCount);
	analyser.getByteFrequencyData(fbc_array);
	ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
	ctx.fillStyle = '#000000'; 
  // Color of the bars
	bars = 100;
	for (var i = 0; i < bars; i++) {
		bar_x = i * 3;
		bar_width = 2;
		bar_height = -(fbc_array[i] / 2);
		//  fillRect( x, y, width, height ) // Explanation of the parameters below
		ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);

	}
 
}

$("#seeker").click(function(e){

  var f = $("#analyser_render").offset().left;
  var pos = e.pageX - f;
  var audio = document.getElementById('current')
  var length = audio.duration;
  var diff = 500 / length;
   pos = pos/diff;
      audio.currentTime = pos;

});


</script>
</html>