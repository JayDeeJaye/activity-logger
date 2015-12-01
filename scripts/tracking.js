$(document).ready(function(){

    Number.prototype.toHHMMSS = function () {
        var seconds = Math.floor(this),
            hours = Math.floor(seconds / 3600);
        seconds -= hours*3600;
        var minutes = Math.floor(seconds / 60);
        seconds -= minutes*60;

        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}
        return hours+':'+minutes+':'+seconds;
    }

	var FREQ = 1000 ;
	var repeat = false;
    var duration = 0.0;
    var activityTimer;
    
	function updateTimer(){
	
		if(repeat){
			activityTimer = setTimeout( function() {
			        duration = duration + 1;
					$("#elapsed_time").val(duration.toHHMMSS());
					updateTimer();
				}, 	
				FREQ
			);
		}
	}

	$("#btnStop").click(function(){
		clearTimeout(activityTimer)
		repeat = false;

        // Update the elapsed time 
		var data = $("#trackForm :input").serializeArray();

		$.post("updatetrack.php", data, function(json){
			if (json.status == "fail") {
				$("#divTrackError").html(json.message);
			}
			if (json.status == "success") {
				$("#divTrackSuccess").html(json.message);
			}
		}, "json");

		$("#btnStop").prop("disabled",true);
		$("#btnStart").prop("disabled",false);
		$("#btnSave").prop("disabled",false);
	});

	$("#btnStart").click(function(){

		var data = $("#trackForm :input").serializeArray();
        $("#divTrackError").html("");
        $("#divTrackSuccess").html("");

        // Open a tracking record if this is a clean start
        // Otherwise, this is just a pause.
        if ($("#inTrackId").val() == "") {
		    $.post("opentrack.php", data, function(json){
			    if (json.status == "fail") {
				    $("#divTrackError").html(json.message);
			    }
			    if (json.status == "success") {
				    $("#inTrackId").val(json.message);
			    }
		    }, "json");
        }

        // Start the stopwatch
		$("#btnStop").prop("disabled",false);
		$("#btnStart").prop("disabled",true);
		$("#btnSave").prop("disabled",true);

		repeat = true;
		updateTimer();
	});	
});

