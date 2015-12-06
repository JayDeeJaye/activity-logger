<?php
    require_once('session.php');
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('Location: index.php');
    }

    // Open the page
    $page_title = 'View Report';
    require_once('header.php');
?>

<?php
    $page_name = "Report"; 
    require_once('navmenu.php');
?>

<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4>My Activities</h4>
<?php   
            //make variables to hold data for compuation must be global fo file
            $activityName = "";
            $estimate = 0;
            $elapsedTime = 0;
            $status = "";
            $confirmed = "";
            // Database connection variables
            require_once('connectvars.php');

            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Cannot connect to database'); 

            // Show the latest activities
            $query = "SELECT activity.id, activity.activity_name, activity.estimate, 
            sum(activity_log.elapsed_time) AS total_elapsedTime , activity.status, activity_log.confirmed 
            FROM activity JOIN activity_log ON activity_log.activity_id = activity.id AND activity_log.user_id = '". $_SESSION['user_id'] ."'
            GROUP BY activity.activity_name";

            $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) > 0) {

                    echo '<div class="table-responsive">';
                    echo '<table class="table">';
                    echo '<tr>';
                    echo '<th>Activity Name</th>';
                    echo '<th>Estimate</th>';
                    echo '<th>ElapsedTime</th>';
                    echo '<th>Status</th>';
                    echo '<th>confirmed</th>';
                    echo '</tr>';
                    echo '<tr>';

                while ($row = mysqli_fetch_array($data)) {
                    
                    $row['id'] = new collection; //declare a php object using activity id

                    //call functions from class to compute different measures
                    $activityName = $row['id']->activityName($row['activity_name']);
                    $estimate = $row['id']->estimate($row['estimate']);
                    $elapsedTime = $row['id']->elapsedTime($row['total_elapsedTime']);
                    $status = $row['id']->status($row['status']);
                    $confirmed = $row['id']->confirmed($row['confirmed']); 

                    //display
                    echo '<td>' . $activityName. '</td>';
                    echo '<td>' . $estimate . '</td>';
                    echo '<td>' . $elapsedTime. '</td>';
                    echo '<td>' . $status. '</td>';
                    echo '<td>' . $confirmed . '</td>';
                    echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
            } else {
                echo '<p class="alert-warning">You don\'t have any activities loaded yet. <a href="addactivity.php">Add Some</a>';
            }

             //class to compute 
            class collection{

                  var $activityName;
                  var $estimate;
                  var $elapsedTime;
                  var $status;
                  var $confirmed;


                function activityName($activity_name){
                  $this->activityName = $activity_name;
                  return $this->activityName;
                }

                function estimate($estimate){
                  $this->estimate = $estimate;
                  return $this->estimate;
                }

                function elapsedTime($elapsed_time){
                   $this->elapsedTime = $elapsed_time;
                   return $this->elapsedTime;
                }

                function status($status){
                 $this->status = $status;
                  return $this->status;
                }

                function confirmed($confirmed){
                 $this->confirmed = $confirmed;
                 return $this->confirmed;
                }

                function display(){

                }

            }//end of class


            mysqli_close($dbc);
?>
        </div>
    </div>


<?php require_once('footer.php'); ?>