<?php
        // Show the most recent tracks
        $query = "SELECT activity_id,activity_name,MAX(start_time) AS last_worked " .
            "FROM activity_log a JOIN activity b on (b.id = a.activity_id) " .
            "WHERE a.user_id = '" . $_SESSION['user_id'] ."' " .
            "GROUP BY a.activity_id,b.activity_name " .
            "ORDER BY MAX(start_time) DESC LIMIT 5";

        $data = mysqli_query($dbc, $query)
            or die("An error occurred querying the activity log: " . mysqli_error($dbc));

        echo '<h4>My Recent Tracks</h4>';
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
            echo '<p class="alert-info">You haven\'t tracked anything yet. <a href="activity.php">Get Started</a>';
        }
?>

