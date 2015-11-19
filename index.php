<!DOCTYPE html>

<?php
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      header("Location: activity.php");

     // echo "Hello: ".$_SESSION['loggedin'];
    }
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
         
          <div class="jumbotron">
            <div class="container">
             <h1>Activity Log <i class="fa fa-clock-o"></i></h1>
             <h3>This is a helpful tool, used to keep track of time spent on activities</h3>
             <button onclick = "window.location.href='signup.php'" class ="btn btn-primary">Sign Up</button>
          </div>
          </div>


           <div class="row">
              <div class="col-md-6 col-md-offset-3">
                    <form action= "processForm.php"  method="post" required>
                       <div class="form-group">
                         <label for="Username">Username</label>
                         <input type="text" class="form-control input-lg" placeholder="Username" name="username" size="30" required>
                       </div>
                       <div class="form-group">
                          <label for="Password">Password</label>
                          <input type="password" class="form-control input-lg" placeholder="Password" name="password" size="30" required>
                       </div>

                         <input type="Submit" name="submit" value="login" class="btn btn-success">
                 
                    </form>
               </div>
            </div>

        </div>
    </body>
</html>