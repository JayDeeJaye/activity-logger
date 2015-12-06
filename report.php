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
        <div class="col-md-10 col-md-offset-1">
            <h4>Report</h4>
<?php   
            //make variables to hold data for compuation must be global fo file
            $activityName = "";
            $estimate = 0;
            $elapsedTime = 0;
            $status = "";
            $confirmed = "";
            $percentComplete = 0;
            $remark = "";
            $priority = "";
            // Database connection variables
            require_once('connectvars.php');

            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Cannot connect to database'); 

            // Show the latest activities
            $query = "SELECT activity.id, activity.activity_name, activity.estimate, activity.priority, 
            sum(activity_log.elapsed_time) AS total_elapsedTime , activity.status, MAX(activity_log.confirmed) AS confirmed 
            FROM activity JOIN activity_log ON activity_log.activity_id = activity.id AND activity_log.user_id = '". $_SESSION['user_id'] ."'
            GROUP BY activity.activity_name";

            $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) > 0) {

                    echo '<div class="table-responsive">';
                    echo '<table class="table">';
                    echo '<tr>';
                    echo '<th>Activity Name</th>';
                    echo '<th>Estimate(Hours)</th>';
                    echo '<th>ElapsedTime(Hours)</th>';
                    echo '<th>Percent completed</th>';
                    echo '<th>Status</th>';
                    echo '<th>confirmed(saved)</th>';
                    echo '<th>Remark</th>';
                    echo '</tr>';
                    echo '<tr>';

                    while ($row = mysqli_fetch_array($data)) {
                    
                    $row['id'] = new collection; //declare a php object using activity id

                    //call functions from class to get and store values from rows in database
                    $activityName = $row['id']->activityName($row['activity_name']);
                    $estimate = $row['id']->estimate($row['estimate']);
                    $elapsedTime = $row['id']->elapsedTime($row['total_elapsedTime']);
                    $percentComplete = $row['id']->percentComplete();
                    $priority = $row['id']->priority($row['priority']);
                    $status = $row['id']->status($row['status']);
                    $confirmed = $row['id']->confirmed($row['confirmed']);
                    $remark = $row['id']->remark();

                    //display
                    echo '<td>' . $activityName. '</td>';
                    echo '<td>' . $estimate . '</td>';
                    echo '<td>' . $elapsedTime. '</td>';
                    echo '<td>' . $percentComplete.'%'. '</td>';
                    echo '<td>' . $status. '</td>';
                    echo '<td>' . $confirmed . '</td>';
                    echo '<td>' . $remark. '</td>';
                    echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
            } else {
                echo '<p class="alert-warning">You don\'t have any activities loaded yet. <a href="addactivity.php">Add Some</a>';
            }

             //class for computations 
            class collection{
                  var $activityName;
                  var $estimate;
                  var $elapsedTime;
                  var $percentComplete;
                  var $status;
                  var $confirmed;
                  var $priority;

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

                function percentComplete(){
                   $result = ($this->elapsedTime / $this->estimate)*100;
                   $result = round($result, 2);
                   $this->percentComplete = $result;
                   return $result;
                }

                function priority($priority){
                   $this->priority = $priority;
                   return $this->priority;
                }

                function status($status){
                 $this->status = $status;
                  return $this->status;
                }

                function confirmed($confirmed){
                 $this->confirmed = $confirmed;
                 return $this->confirmed;
                }

                function remark(){
                    $remark = "";
                    if(($this->percentComplete>100)){
                       $remark = "<p class = 'text-warning'>You exceeded Your Estimate for this Activity, Plan better</p>";
                       return $remark;
                     }
                    else{
                        if(($this->status)=="Completed" && ($this->confirmed=="Y")){
                            $remark ="<p class = 'text-success'>Successful Planning, Activity Completed. Great Job!</p>";
                            return $remark;
                        }
                        else{
                            if(($this->priority)=="A1" || ($this->priority)== "1" || ($this->priority)== "A" ){
                            $remark = "<p class = 'text-danger'>Please begin or continue tracking this Activity Immediately</p>";
                            return $remark;
                            }
                            else{
                                 $remark = "<p class='text-info'>Activity may still be active, deferred, Not started or Not saved</p>";
                                 return $remark;
                            }
                        }
                    }
                }

            }//end of class

            mysqli_close($dbc);
?>
        </div>
    </div>

<?php require_once('footer.php'); ?>