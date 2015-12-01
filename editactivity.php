<?php
    require_once('session.php');
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('Location: index.php');
    }

    // Open the page
    $page_title = 'Edit an Activity';
    require_once('header.php');
?>

<?php 
    $page_name = "Activity"; 
    require_once('navmenu.php');
    // Connect to the database
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $error = false;

    if (isset($_POST['submit'])) {
        // Grab the profile data from the POST
        $activity_id = mysqli_real_escape_string($dbc, trim($_POST['activity_id']));
        $activity_name = mysqli_real_escape_string($dbc, trim($_POST['activity_name']));
        $priority = mysqli_real_escape_string($dbc, trim($_POST['priority']));
        $estimate = mysqli_real_escape_string($dbc, trim($_POST['estimate']));
        $status = mysqli_real_escape_string($dbc, trim($_POST['status']));

        // Validate data
        if (!is_numeric($estimate)) {
            $error = true;
            echo '<p class="alert-danger">Please enter a number for your estimate in hours.</p>';
        }
        
        if (empty($status)) {
            $status = "Not Started";
        }

        // Update or delete the activity definition data into the database
        if (!$error) {
            if ($_POST['submit'] == 'Update') {
                if (!empty($activity_name) && !empty($estimate) && !empty($status) ) {
                    $query = "UPDATE activity " .
                             "   SET activity_name = '$activity_name', " . 
                                    "priority      = '$priority', " . 
                                    "estimate      = '$estimate', " .
                                    "status        = '$status' " .
                              "WHERE user_id     = '" . $_SESSION['user_id'] . "' " .
                                "AND id          = '$activity_id'";
                    mysqli_query($dbc, $query)
                        or die("An error occurred updating Activity: " . mysqli_error($dbc));;

                    // Confirm success with the user
                    echo '<p class="alert-success"><strong>' . $activity_name . '</strong> has been updated. <a href="activity.php">Back to Activities</a></p>';

                    mysqli_close($dbc);
                    exit();
                }
            } else if ($_POST['submit'] = 'Delete') {
                $query = "DELETE FROM activity " .
                          "WHERE user_id     = '" . $_SESSION['user_id'] . "' " .
                            "AND id          = '$activity_id'";
                mysqli_query($dbc, $query)
                    or die("An error occurred deleting Activity: " . mysqli_error($dbc));

                // Confirm success with the user
                echo '<p class="alert-success"><strong>' . $activity_name . '</strong> has been deleted. <a href="activity.php">Back to Activities</a></p>';

                mysqli_close($dbc);
                exit();
            }
                
        } else {
            echo '<p class="alert-danger">You need to enter at least an activity name and an estimate.</p>';
        }
    } else if (isset($_GET['activity_id'])) {
        $activity_id = mysqli_real_escape_string($dbc, trim($_GET['activity_id']));

        $query = "SELECT activity_name,priority,estimate,status " .
                   "FROM activity " .
                   "WHERE id = '$activity_id' AND user_id = '" . $_SESSION['user_id'] . "'";
        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);

        if ($row != NULL) {
            $activity_name = $row['activity_name'];
            $priority = $row['priority'];
            $estimate = $row['estimate'];
            $status = $row['status'];
        } else {
          echo '<p class="alert-danger">There was a problem retrieving this activity.' . mysqli_error($dbc) . '</p>';
          $error = $true;
        }
      }

      mysqli_close($dbc);
    
    if (!$error) {
?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <h4>Edit or Delete this Activity</h4>
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type=hidden name="activity_id" value="<?php echo $activity_id; ?>" />
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
                    <input class="btn-success" type="submit" value="Update" name="submit" />
                    <input class="btn-danger" type="submit" value="Delete" name="submit" />
                </div>
            </div>
        </form>

<?php
    }
?>
        </div> <!-- main block -->
    </div> <!-- row -->
<?php require_once('footer.php'); ?>

