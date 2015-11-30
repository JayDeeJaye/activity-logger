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

            if (isset($_GET['activity_id'])) {
?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>" />
                    <h4><?php echo 'Activity: ' . $row['activity_name']; ?></h4>
                    <button type="button" id="btnStart">Start</button>
                    <button type="button" id="btnStop">Stop</button>
                    <input type="submit" value="Save" name="submit" disabled />
                    <input type="text" name="elapsed_time" id="elapsed_time" value="0" />
                </form>

<?php                
/*            
            } else if ($_POST['submit'] == 'Start') {
                // Store the start event and start the timer
                $activity_id = mysqli_real_escape_string($dbc, trim($_POST['activity_id']));
                
                $query = "INSERT INTO activity_log (" .
                            "user_id,activity_id,start_time,elapsed_time,confirmed " .
                         ") VALUES ( " .
                         "'" . $_SESSION['user_id'] . "', '$activity_id', NOW(), '00:00:00', 'N')";
                mysqli_query($dbc,$query)
                    or die("An error occurred loading the activity: " . mysqli_error($dbc));
?>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>" />
                    <h4><?php echo 'Activity: ' . $row['activity_name']; ?></h4>
                    <input type="submit" value="Start" name="submit" disabled />
                    <input type="submit" value="Stop" name="submit" />
                    <input type="text" name="elapsed_time" id="elapsed_time" value="00:00:00" readonly />
                </form>

<?php
              
            } else if ($_POST['submit'] == 'Stop') {
                // Stop the timer
*/
            }
        } else {
            echo '<p class="bg-danger">The selected activity could not be found!</p>';
        }
    }
        
    mysqli_close($dbc);
?>

          </div>
    </div>

	<script src="scripts/jquery-1.6.2.min.js"></script>
	<script src="scripts/tracking.js"></script>

<?php
    require_once('footer.php');
?>

