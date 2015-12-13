<?php

    require_once('session.php');
    require_once('connectvars.php');
    
    if (isset($_SESSION['user_id']) && isset($_POST['decision'])) {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or fail("An error occurred connecting to the database: " . mysqli_error($dbc));

        foreach ($_POST['decision'] as $track_id => $decision) {

            if ($decision == "confirm") {
                $query = "UPDATE activity_log " .
                         "SET confirmed = 'Y' " .
                         "WHERE id = '$track_id' " .
                           "AND user_id = '" . $_SESSION['user_id'] . "'";

                mysqli_query($dbc,$query)
                    or die("An error occurred updating the track: " . mysqli_error($dbc));

            } else if ($decision == "discard") {
                $query = "DELETE FROM activity_log " .
                         "WHERE id = '$track_id' " .
                           "AND user_id = '" . $_SESSION['user_id'] . "'";

                mysqli_query($dbc,$query)
                    or die("An error occurred discarding the track: " . mysqli_error($dbc));
            }                    
        }    
        mysqli_close($dbc);
    }
    
                     $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                    header('Location: ' . $home_url);
   $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header('Location: ' . $home_url);
?>

