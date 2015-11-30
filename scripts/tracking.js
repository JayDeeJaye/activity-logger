$(document).ready(function(){

	var FREQ = 1000 ;
	var repeat = false;
    var seconds = 0;
    
	function updateTimer(){
	
		if(repeat){
			setTimeout( function() {
			        seconds = seconds + 1;
					$("#elapsed_time").html(seconds);
					updateTimer();
				}, 	
				FREQ
			);
		}
	}

	$("#btnStop").click(function(){
		repeat = false;
	});

	$("#btnStart").click(function(){
		repeat = true;
		updateTimer();
	});	
});

