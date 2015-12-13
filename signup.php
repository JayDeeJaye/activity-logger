<?php
  // Load the page heading
  $page_title = 'Sign Up';
  require_once('header.php');
?>
    <div class="container">

        <div class="jumbotron">
            <div class="container">
                <h1>Activity Log <i class="fa fa-clock-o"></i></h1>
                <h3>This is a helpful tool, used to keep track of time spent on activities</h3>
            </div>
        </div>

<?php
    require_once('connectvars.php');

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit'])) {
        // Grab the profile data from the POST
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['con-password']));
        $real_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']) . 
            trim($_POST['lastname']));
        $email_address = mysqli_real_escape_string($dbc, trim($_POST['email']));

        if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
            // Make sure someone isn't already registered using this username
            $query = "SELECT * FROM member WHERE username = '$username'";
            $data = mysqli_query($dbc, $query);
            if (mysqli_num_rows($data) == 0) {
                // The username is unique, so insert the data into the database
                $query = "INSERT INTO member (username, password, real_name, email_address) VALUES ('$username', SHA('$password1'), '$real_name', '$email_address')";
                mysqli_query($dbc, $query);

                // Confirm success with the user
                echo '<p class="alert-success">Your new account has been successfully created. You\'re now ready to <a href="login.php">Log In</a>.</p>';

                mysqli_close($dbc);
                exit();
            } else {
                // An account already exists for this username, so display an error message
                echo '<p class="alert-danger">Ack! An account already exists for ' . $username .'. Please choose a different username.</p>';
                $username = "";
            }
        } else {
            echo '<p class="alert-danger">You must enter all of the sign-up data, including the desired password twice.</p>';
        }
    }

    mysqli_close($dbc);
?>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p class="alert-primary">Please select a username and password to sign up to ActivityTracker.</p>
                 <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" required> 
                   <div class="form-group">   
                     <label>First name</label>
                     <input type="text" class="form-control input-lg" placeholder="First name" name="firstname"size="30" required>
                   </div>

                   <div class ="form-group">
                     <label>Last name</label>
                     <input type="text" class="form-control input-lg" placeholder="Last name" name="lastname"size="30" required>
                   </div>
         
                   <div class = "form-group">
                     <label>E-mail</label>
                     <input type="text" name="email" size="40" class="form-control input-lg" placeholder="E-mail" required>
                   </div>

                   <div class = "form-group">
                     <label>Username</label>
                     <input type="text" class="form-control input-lg" placeholder="Username" name="username"size="30" required>
                   </div>

                   <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control input-lg" placeholder="Password" name="password"size="30" required>
                   </div>


                   <div class = "form-group">
                     <label>Confirm Password</label>
                     <input type="password" class="form-control input-lg" placeholder="confirm Password" name="con-password"size="30" required>
                   </div>

                   <input type="Submit" name="submit" value="Sign Up" class="btn btn-success">
                 </form> 
              </div>
            </div>
        </div>

<?php require_once('footer.php'); ?>

