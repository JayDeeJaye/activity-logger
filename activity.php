<?php
    require_once('session.php');
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('Location: index.php');
    }

    // Open the page
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
                echo '</tr>';
                
                while ($row = mysqli_fetch_array($data)) {
                    echo '<form type="post" action="tracking.php">';
                    echo '<input type="hidden" name="activity_id" value=' . $row['id'] . ' />';
                    echo '<tr>';
                    echo '<td>' . $row['activity_name'] . '</td>';
                    echo '<td>' . $row['priority'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td><input class="btn btn-primary" type="submit" name="submit" value="Track"></td>';
                    echo '</tr>';
                    echo '</form>';
                }
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p class="bg-warning">You don\'t have any activities loaded yet. <a href="addactivity.php">Add Some</a>';
            }
            
            mysqli_close($dbc);
?>
        </div>
    </div>
    
<!--
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form>
                <h3>Edit Activity</h3>
                <div class="form-group">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-m dropdown-toggle" data-toggle="dropdown" href="#">Select Activity<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">jfdfkf dffjkkdf ndfkdf</a></li>
                            <li><a href="#">jfkjdfjkfnfd fkffkf fff</a></li>
                            <li><a href="#">kfkff fffkf ffkhhff</a></li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label>Priority</label>
                        <input type="text" class="form-control input-lg" placeholder="Enter priority">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control input-lg" placeholder="Enter Status">
                    </div>

                    <div class="form-group">
                        <input type="submit" value ="Submit" class="btn btn-success">
                    </div>

                </div>                    
            </form>
        </div>
    </div>
-->
<!--

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class ="edit-form">
                <h3>Create new activity</h3>
                <div class="form-group">
                    <label for="Activity">Activity</label>
                    <input type="text" class="form-control input-lg" placeholder="Add new Activity">
                </div>
                <div class="form-group">
                    <label for="finish time">Estimated finish time</label>
                    <input type="text" class="form-control input-lg" placeholder="Estimated Finish Time">
                </div>

                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">Priority<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">High</a></li>
                        <li><a href="#">Medium</a></li>
                        <li><a href="#">low</a></li>
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">Status<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Complete</a></li>
                        <li><a href="#">In Progress</a></li>
                        <li><a href="#">Not Started</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary">Add</button>

                <div class = "form-group">
                    <label for="cart"><i class="fa fa-cart-plus"></i></label>

                    <div class="cart">

                    </div>

                    <input type="submit" value ="Remove" class="btn btn-danger pull-right">
                </div>
                <input type="submit" value ="Submit" class="btn btn-success">

            </form>
        </div>
    </div>
-->
<?php require_once('footer.php'); ?>

