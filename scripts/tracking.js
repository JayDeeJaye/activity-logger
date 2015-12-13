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
    var stopwatchTimer;
	var updDbFREQ = 30000 ;
	var trackTimer;
    
    // Add 1 second to the stopwatch timer every second
	function updateStopwatchTimer(){
	
		if(repeat){
			stopwatchTimer = setTimeout( function() {
			        duration = duration + 1;
					$("#elapsed_time").val(duration.toHHMMSS());
					updateStopwatchTimer();
				}, 	
				FREQ
			);
		}
	}

    // Every updFREQ interval, write the track time to the database
   	function updateTrackTimer(){
	
		if(repeat){
			trackTimer = setTimeout( function() {
                    updateActivityLog("auto-save");
					updateTrackTimer();
				}, 	
				updDbFREQ
			);
		}
	}
 

    function updateActivityLog(kind) {
        // Update the elapsed time 
		var data = $("#trackForm :input").serializeArray();

		$.post("updatetrack.php", data, function(json){
			if (json.status == "fail") {
				$("#divTrackError").html(kind + ": " + json.message);
			}
			if (json.status == "success" && kind != "auto-save") {
				$("#divTrackSuccess").html(json.message);
			}
		}, "json");
    }

	$("#btnStop").click(function(){
		clearTimeout(stopwatchTimer);
		clearTimeout(trackTimer);
		repeat = false;

        updateActivityLog("save-on-stop");

		$("#btnStop").prop("disabled",true);
		$("#btnStart").prop("disabled",false);
;		$("#btnSave").prop("disabled",false);
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
		updateStopwatchTimer();
		updateTrackTimer();
	});	
});

