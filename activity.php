<?php
    require_once('session.php');
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('Location: index.php');
    }

    // Open the page
    $page_title = 'My Activities';
    require_once('header.php');
?>

<?php
    $page_name = "Activity"; 
    require_once('navmenu.php');
?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4>My Activities</h4>
<?php
            // Database connection variables
            require_once('connectvars.php');

            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Cannot connect to database'); 

            // Show the latest activities
            $query = "SELECT id, activity_name, priority, status " .
                "FROM activity " .
                "WHERE user_id = '" . $_SESSION['user_id'] ."' " .
                "ORDER BY priority, activity_name ASC LIMIT 5";

            $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                echo '<tr>';
                echo '<th>Activity Name</th>';
                echo '<th>Priority</th>';
                echo '<th>Status</th>';
                echo '<th>&nbsp;</th>';
                echo '<th>&nbsp;</th>';
                echo '</tr>';
                
                while ($row = mysqli_fetch_array($data)) {
                    echo '<tr>';
                    echo '<td>' . $row['activity_name'] . '</td>';
                    echo '<td>' . $row['priority'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td><a class="btn btn-primary btn-xs" href="editactivity.php?activity_id=' . $row['id'] . '" >Edit</a></td>';
                    echo '<td><a class="btn btn-success btn-xs" href="tracking.php?activity_id=' . $row['id'] . '" >Track</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
                echo '<a class="btn btn-primary" href="addactivity.php">Add New</a>';
            } else {
                echo '<p class="alert-warning">You don\'t have any activities loaded yet. <a href="addactivity.php">Add Some</a>';
            }
            
            mysqli_close($dbc);
?>
        </div>
    </div>
    
<?php require_once('footer.php'); ?>

