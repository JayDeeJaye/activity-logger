<?php
    // Connect to the current session
    require_once('session.php');
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('Location: index.php');
        exit();
    }

     // Insert the page header
    $page_title = 'Tracking';
    require_once('header.php');
    require_once('connectvars.php');
    
    // Display the main menu
    $page_name = "Tracking"; 
    require_once('navmenu.php');

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die("An error occurred connecting to the database: " . mysqli_error($dbc));
?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Track This</h3>

<?php
    // Get the activity to track from the database
    if (isset($_GET['activity_id'])) {
        $activity_id = mysqli_real_escape_string($dbc, trim($_GET['activity_id']));
    } else if (isset($_POST['activity_id'])) {    
        $activity_id = mysqli_real_escape_string($dbc, trim($_POST['activity_id']));
    }
    
    if (isset($_GET['activity_id']) || isset($_POST['submit'])) {
    
        $query = "SELECT activity_name " .
                 "FROM activity " .
                 "WHERE id = '$activity_id' AND user_id = '" . $_SESSION['user_id'] ."'";
        $data = mysqli_query($dbc,$query)
            or die("An error occurred loading the activity: " . mysqli_error($dbc));
        
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $activity_name = $row['activity_name'];

            // Tracking is ready to go.
            if (isset($_GET['activity_id'])) {
?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="trackForm">
                    <h4><?php echo 'Activity: ' . $row['activity_name']; ?></h4>
                    <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>" />
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                    <input type="hidden" name="track_id" id="inTrackId" value="" />
                    <button type="button" class="btn btn-success" id="btnStart">Start</button>
                    <button type="button" class="btn btn-danger" id="btnStop" disabled>Stop</button>
                    <button type="submit" class="btn btn-primary" id="btnSave" name="submit" disabled>Save</button>
                    <input type="text" name="elapsed_time" id="elapsed_time" value="00:00:00" readonly />
                </form>

<?php                
            } else if (isset($_POST['submit'])) {
                $track_id = mysqli_real_escape_string($dbc, trim($_POST['track_id']));
                $activity_id = mysqli_real_escape_string($dbc, trim($_POST['activity_id']));
                $elapsed_time = mysqli_real_escape_string($dbc, trim($_POST['elapsed_time']));

                if (preg_match('/(\d+):(\d\d):(\d\d)/',$elapsed_time,$parts)) {
                    $hours = $parts[1] + ($parts[2] / 60) + ($parts[3] / 3600);
                } else {
                    echo '<p class="alert-danger">Invalid elapsed time on update</p>';
                    mysqli_close($dbc);
                    exit();
                }
                     
                $query = "UPDATE activity_log " .
                         "SET elapsed_time = '$hours', confirmed = 'Y' " .
                         "WHERE id = '$track_id' " .
                           "AND user_id = '" . $_SESSION['user_id'] . "' " .
                           "AND activity_id = '$activity_id'";

                mysqli_query($dbc,$query)
                    or die("An error occurred updating the track: " . mysqli_error($dbc));
                
                echo '<p class="alert-success">Track Saved. Go back to <a href="activity.php">Activities</a></p>';
             }   
        } else {
            echo '<p class="alert-danger">The selected activity could not be found!</p>';
        }
    }
        
    mysqli_close($dbc);
?>

            <div class="alert-danger" id="divTrackError"></div>
            <div class="alert-success" id="divTrackSuccess"></div>

        </div>
    </div>

	<script src="scripts/tracking.js"></script>

<?php
    require_once('footer.php');
?>

