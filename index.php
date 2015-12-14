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
                <h2 style="color:grey;">This is a helpful tool, used to keep track of time spent on activities</h2>
                <button onclick = "window.location.href='signup.php'" class ="btn btn-primary">Sign Up</button>
                <button onclick = "window.location.href='login.php'" class ="btn btn-primary">Login</button>
            </div>
        </div>

        <div class ="contain">
         <div class = "welcome">
            <div class = "container">
                <section>
                    <h2>What is Time management and why do we need to manage Time?</h2> 
                        <p>These are the best time management skill to manage your time, there are even more
                        time management skills that can be used to achieve these time management
                        skills even faster. 
                        How long did it take you to read that? 
                    </p>
                    <p style="font-style:italic;">
                        Time management is the act or process of planning and exercising 
                        conscious control over the amount of time spent on specific activities, 
                        especially to increase effectiveness, efficiency or productivity.
                    </p>
                </section>
            </div>
         </div>

         <div class = "welcome-2">
            <div class = "container">
                <section>
                    <h2>What's all the fuss about time?</h2>
                    <img src="img/timeH.jpg" class="img-responsive" alt="Flying Kites">
                </section>
                <section style="width:80%; margin:10px auto;"><p>It is the one quantity that governs us. Being more applicable, it 
                        would be cool to atleast be aware of what we have done, intend to do and
                        will do.
                    </p>
                </section>
            </div>
         </div>

         <div class = "welcome-3">
            <div class = "container">
                <section>
                    <h2>What are we when we work with Time?</h2>
                    <p>Productivity, efficiency and effectiveness are one of the few
                        qualities we can achieve when we are in Sync with time. This can be
                        applied in Business, Science or Technical settings. 
                    </p>
                    <p>Although we do not have all the answers to the Universe, we
                        provide a tool for individuals to track time spent on their
                        activities. This would help manage time and use it wisely.
                   </p>   
                </section>
            </div>
         </div>

         <div class = "welcome-4">
            <div class = "container">
                <section>
                    <h2>Activity Log</h2>
                   <img src="img/activityT.jpg" class="img-responsive" alt="Flying Kites">
                   <p>
                    This is a user friendly app that provides you with time management skills
                    at the ease of the user. You can monitor and track progress on your activities.
                    It also offers remarks and help to push you even further to becoming more time conscious.
                   </p>
                   <h1>Enjoy</h1>
                </section>
            </div>
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

