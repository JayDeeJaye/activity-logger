<?php

    require_once('session.php');
    require_once('connectvars.php');
    
    if (isset($_SESSION['user_id']) && isset($_POST['activity_id'])) {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or fail("An error occurred connecting to the database: " . mysqli_error($dbc));

        $activity_id = mysqli_real_escape_string($dbc, trim($_POST['activity_id']));

        $query = "INSERT INTO activity_log " .
                   "(user_id,activity_id,start_time,elapsed_time,confirmed) " .
            "VALUES ('" . $_SESSION['user_id'] . "','$activity_id',NOW(),0,'N')";

        mysqli_query($dbc,$query)
            or fail("An error occurred creating the track: " . mysqli_error($dbc));
        $track_id = mysqli_insert_id($dbc);
        
        mysqli_close($dbc);
        success($track_id);
    }

	function fail($message) {
		die(json_encode(array('status' => 'fail', 'message' => $message)));
	}
	function success($message) {
		die(json_encode(array('status' => 'success', 'message' => $message)));
	}

?>
