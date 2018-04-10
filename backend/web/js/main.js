$(function() {

var v = document.getElementsByTagName("audio")[0];
var sound = false;
	$("#boton").on("click", function(){
	  if (!sound) {
	    v.play();
	    $("#pause").attr("class","pause icon")
	    sound = true;
	  } else {
	    v.pause();
	    $("#pause").attr("class","play icon")
	    sound = false;
	  }
	});

	$(".j").on("click",function(){
		$('.ui.labeled.icon.sidebar')
		  .sidebar('setting', 'transition', 'overlay')
		  .sidebar('toggle')
		;	
	});
});