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
                <h1>Activity Tracker <i class="fa fa-clock-o"></i></h1>
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

        $unconfirmed = false;
        // Show any unconfirmed tracks
        require_once('tracksConfirm.php');

        if (!$unconfirmed) {
            // Show the recent track activity
            require_once('tracksHistory.php');
        }
        mysqli_close($dbc);
    }
  // Include the page footer
  require_once('footer.php');
?>

