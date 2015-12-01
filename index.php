<?php
    // Connect to the session
    require_once('session.php');

    // Insert the page header
    $page_title = 'Track Your Activities';
    require_once('header.php');
 
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        // Show the launch page
?>
        <div class="jumbotron">
            <div class="container">
                <h1>Activity Log <i class="fa fa-clock-o"></i></h1>
                <h3>This is a helpful tool, used to keep track of time spent on activities</h3>
                <button onclick = "window.location.href='signup.php'" class ="btn btn-primary">Sign Up</button>
                <button onclick = "window.location.href='login.php'" class ="btn btn-primary">Login</button>
            </div>
        </div>

<?php
    } else {
        // We have a valid session. Show the user's home page    

        // Show the navigation menu
        $page_name = "Home";
        require_once('navmenu.php');

        // Database connection variables
        require_once('connectvars.php');

        // Connect to the database 
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

        // Show the latest activities
        $query = "SELECT activity_id,activity_name,MAX(start_time) AS last_worked " .
            "FROM activity_log a JOIN activity b on (b.id = a.activity_id) " .
            "WHERE a.user_id = '" . $_SESSION['user_id'] ."' " .
            "GROUP BY a.activity_id,b.activity_name " .
            "ORDER BY MAX(start_time) DESC LIMIT 5";

        $data = mysqli_query($dbc, $query)
            or die("An error occurred querying the activity log: " . mysqli_error($dbc));

        echo '<h4>Your Recent Activity</h4>';
        // Loop through the array of activity data and show it
        if (mysqli_num_rows($data)) {
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            while ($row = mysqli_fetch_array($data)) {
                echo '<tr><td>' . $row['activity_name'] . '</td>';
                echo '<td>' . $row['last_worked'] . '</td></tr>';
            }
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="bg-info">You haven\'t tracked anything yet. <a href="activity.php">Get Started</a>';
        }
        mysqli_close($dbc);
    }
  // Include the page footer
  require_once('footer.php');
?>

