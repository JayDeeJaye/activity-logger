<?php
    require_once('session.php');
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('Location: index.php');
    }

    // Open the page
    $page_title = 'Create an Activity';
    require_once('header.php');
?>

<?php
    $page_name = "Activity"; 
    require_once('navmenu.php');
    // Connect to the database
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit'])) {
        // Grab the profile data from the POST
        $activity_name = mysqli_real_escape_string($dbc, trim($_POST['activity_name']));
        $priority = mysqli_real_escape_string($dbc, trim($_POST['priority']));
        $estimate = mysqli_real_escape_string($dbc, trim($_POST['estimate']));
        $status = mysqli_real_escape_string($dbc, trim($_POST['status']));
        $error = false;

        // Validate data
        if (!is_numeric($estimate)) {
            $error = true;
            echo '<p class="alert-danger">Please enter a number for your estimate in hours.</p>';
        }
        
        if (empty($status)) {
            $status = "Not Started";
        }

        // Insert the activity definition data into the database
        if (!$error) {
            if (!empty($activity_name) && !empty($estimate) && !empty($status) ) {
                $query = "INSERT INTO activity " .
                         "(user_id,activity_name,priority,estimate,status) " .
                         "VALUES ( " .
                         "'" . $_SESSION['user_id'] . "', '$activity_name', '$priority', '$estimate', '$status' )";
                mysqli_query($dbc, $query);

                // Confirm success with the user
                echo '<p class="alert-success"><strong>' . $activity_name . '</strong> has been added. <a href="activity.php">Back to Activities</a></p>';

                mysqli_close($dbc);
                
                $activity_name = "";
                $priority = "";
                $estimate = "";
                $status = "";
                
            }
        } else {
            echo '<p class="alert-danger">You need to enter at least an activity name and an estimate.</p>';
        }
    }
        
?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <h4>Create a new Activity</h4>

        <p>Enter the information that describes your activity.</p>
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="activity_name" class="col-sm-2 control-label">Activity Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="activity_name" name="activity_name" placeholder="Enter a name for your activity" value="<?php if (!empty($activity_name)) echo $activity_name; ?>" required />
                </div>
            </div>
            <div class="form-group">
                <label for="priority" class="col-sm-2 control-label">Priority</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="priority" name="priority" placeholder="Optional priority, e.g. [1,2,3] [A,B,C] [A1,A2,B1,B2,C1,C2]" value="<?php if (!empty($priority)) echo $priority; ?>" required />
                </div>
            </div>
            <div class="form-group">
                <label for="estimate" class="col-sm-2 control-label">Estimate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="estimate" name="estimate" placeholder="Estimated time to complete in hours" value="<?php if (!empty($estimate)) echo $estimate; ?>" required />
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name="status" id="status">
                      <option selected value="Not Started">Not Started</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Deferred">Deferred</option>
                      <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Create" name="submit" />
                </div>
            </div>
        </form>

        </div> <!-- main block -->
    </div> <!-- row -->
<?php require_once('footer.php'); ?>

