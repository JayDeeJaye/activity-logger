<!DOCTYPE html>

<?php
session_start();

//$_SESSION['loggedin'] = true;

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('Location: index.php');
  }

  //echo "Current session value of logged in is: ".$_SESSION['loggedin'];
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activity</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">

           <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Activity Log <i class="fa fa-clock-o"></i></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
             <div id="navbarCollapse" class="collapse navbar-collapse navbar-right">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Activity</a></li>
                    <li><a href="#">Tracking</a></li>
                    <li><a href="#">Share/Report</a></li>
                  </ul> 
                </div>
              </nav> 

         


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
               </div>    	
    </body>
</html>
