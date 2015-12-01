<?php

    require_once('session.php');
    require_once('connectvars.php');
    
    if (isset($_SESSION['user_id']) && isset($_POST['activity_id'])) {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or fail("An error occurred connecting to the database: " . mysqli_error($dbc));

        $track_id = mysqli_real_escape_string($dbc, trim($_POST['track_id']));
        $activity_id = mysqli_real_escape_string($dbc, trim($_POST['activity_id']));
        $elapsed_time = mysqli_real_escape_string($dbc, trim($_POST['elapsed_time']));

        if (preg_match('/(\d+):(\d\d):(\d\d)/',$elapsed_time,$parts)) {
            $hours = $parts[1] + ($parts[2] / 60) + ($parts[3] / 3600);
        } else {
            fail("Invalid elapsed time on update");
        }
             
        $query = "UPDATE activity_log " .
                 "SET elapsed_time = '$hours' " .
                 "WHERE id = '$track_id' " .
                   "AND user_id = '" . $_SESSION['user_id'] . "' " .
                   "AND activity_id = '$activity_id'";

        mysqli_query($dbc,$query)
            or fail("An error occurred updating the track: " . mysqli_error($dbc));
        
        mysqli_close($dbc);
        success("Track Updated");
    }

	function fail($message) {
		die(json_encode(array('status' => 'fail', 'message' => $message)));
	}
	function success($message) {
		die(json_encode(array('status' => 'success', 'message' => $message)));
	}

?>
