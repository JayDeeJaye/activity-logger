<?php
        // Show unconfirmed tracks
        
        $query = "SELECT t.id, " .
                        "a.activity_name, " .
                        "DATE_FORMAT(t.start_time,'%m/%d/%Y %H:%i') start_time, " .
                        "FORMAT(t.elapsed_time,2) elapsed_time " .
                   "FROM activity_log t JOIN activity a ON (a.id = t.activity_id) " .
                   "WHERE t.user_id = '" . $_SESSION['user_id'] . "' " .
                     "AND t.confirmed = 'N' " .
                   "ORDER BY t.start_time DESC";

        $data = mysqli_query($dbc, $query)
            or die("An error occurred querying the activity log: " . mysqli_error($dbc));

        // Loop through the array of activity data and show it
        if (mysqli_num_rows($data)) {
            $unconfirmed = true;
            echo '<h4>My Unconfirmed Tracks</h4>';
            echo '<p class="alert-warning">You have work in unconfirmed tracks. Confirm or discard them and apply your decisions.</p>';
            echo '<form class="form-inline" method="POST" action="doconfirmdiscard.php">';
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<tr>';
            echo '<th>Activity Name</th>';
            echo '<th>Date/Time</th>';
            echo '<th>Hours</th>';
            echo '<th>Decision</th>';
            echo '</tr>';
            while ($row = mysqli_fetch_array($data)) {
                echo '<tr>';
                echo '<td>' . $row['activity_name'] . '</td>';
                echo '<td>' . $row['start_time'] . '</td>';
                echo '<td>' . $row['elapsed_time'] . '</td>';
                echo '<td>';
                echo '<label class="radio-inline">';
                echo '<input type="radio" name="decision['.$row['id'].']" value="confirm" checked>Confirm';
                echo '</label>';
                echo '<label class="radio-inline">';
                echo '<input type="radio" name="decision['.$row['id'].']" value="discard">Discard';
                echo '</label>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '<input class="btn btn-primary" type="submit" value="Apply" name="submit" />';
            echo '</form>';            
        } else {
            $unconfirmed = false;
        }
?>

