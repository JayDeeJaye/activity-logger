<!DOCTYPE html>
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
        <div class="container-fluid">

        <div class="jumbotron">
          <div class="container">
            <h1>Activity Log <i class="fa fa-clock-o"></i></h1>
            <h3>This is a helpful tool, used to keep track of time spent on activities</h3>
          </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class= "form-2">
                 <form action= "processForm.php"  method="post" required> 
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

                   <div class ="form-group">
                    <label>Organization name</label>
                    <input type="text" class="form-control input-lg" placeholder="Organization name" name="organization"size="50" required>
                   </div>

                   <input type="Submit" name="submit" value="signup" class="btn btn-success">
                 </form> 
              </div>
            </div>
        </div>

     </div>
 </body>
</html>