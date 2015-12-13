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
    require_once('pagination.php');
    
    // Database connection variables
    require_once('connectvars.php');

    // Calculate pagination information
    $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $results_per_page = 5;  // number of results per page
    $skip = (($cur_page - 1) * $results_per_page);
    $status_filter = isset($_GET['status']) ? $_GET['status'] : '%';

?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="clearfix">
                <div class="pull-left"><h4>My Activities</h4></div>
                <div class="pull-right">

                    <?php
                        echo '<select name="Status" id="selStatus" onchange="filterStatus(' . "'" .  $_SERVER['PHP_SELF'] . '?page=' . $cur_page . "'" . ')" >';
                    ?> 

                          <option <?php echo (($status_filter == '%') ? 'selected' : ''); ?> value="%">All Activities</option>
                          <option <?php echo (($status_filter == 'Not Started') ? 'selected' : ''); ?> value="Not Started">Not Started</option>
                          <option <?php echo (($status_filter == 'In Progress') ? 'selected' : ''); ?> value="In Progress">In Progress</option>
                          <option <?php echo (($status_filter == 'Deferred') ? 'selected' : ''); ?> value="Deferred">Deferred</option>
                          <option <?php echo (($status_filter == 'Completed') ? 'selected' : ''); ?> value="Completed">Completed</option>
                        </select>
                </div>
            </div>
<?php
            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Cannot connect to database'); 

            // Get all activities and calculate pages
            $query = "SELECT id, activity_name, priority, status " .
                "FROM activity " .
                "WHERE user_id = '" . $_SESSION['user_id'] ."' " .
                "AND status LIKE '$status_filter' " . 
                "ORDER BY priority, activity_name ASC";

            $result = mysqli_query($dbc, $query);
            $total = mysqli_num_rows($result);
            $num_pages = ceil($total / $results_per_page);

            if ($total > 0) {
                // Query again to get just the subset of results
                $query =  $query . " LIMIT $skip, $results_per_page";
                $data = mysqli_query($dbc, $query);

                echo '<div class="table-responsive">';
                echo '<table class="table table-condensed">';
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
                    echo '<td class="text-center"><a class="btn btn-primary btn-sm" href="editactivity.php?activity_id=' . $row['id'] . '" >Edit</a></td>';
                    echo '<td class="text-center"><a class="btn btn-success btn-sm" href="tracking.php?activity_id=' . $row['id'] . '" >Track</a></td>';
                    echo '</tr>';
                }
                // Generate navigational page links if we have more than one page
                if ($num_pages > 1) {
                    echo '<tr>';
                    echo '<td colspan=5>' . generate_page_links($cur_page, $num_pages,"&status=" . urlencode($status_filter)) . '</td>';
                    echo '</tr>';
                }
                
                echo '</table>';

                echo '</div>';
                echo '<a class="btn btn-primary" href="addactivity.php">Add New</a>';
            } else {
                if ($status_filter == '%') {
                    echo '<p class="alert-warning">You don\'t have any activities loaded yet. <a href="addactivity.php">Add Some</a>';
                } else {
                    echo '<p class="alert-warning">You don\'t have any "' . $status_filter . '" activities.';
                }
            }
            
            mysqli_close($dbc);
?>
        </div>
    </div>

    <script>
        function filterStatus(url) {
            var realUrl;
            var selectedStatus = $('#selStatus').val();
            
            realUrl = encodeURI(url + '&status=' + selectedStatus);
            window.location.replace(realUrl);
        }
    </script>    

<?php require_once('footer.php'); ?>

