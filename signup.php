<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activity Tracker</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/"></script>
    </head>

    <body>
        <div class="container">

        <div class = "Signup-box">
        
        <form action= "processForm.php"  method="post" required>    
        <legend>Sign up</legend>
        <h4>Firstname:</h4>
        <input type="text" name="firstname"size="30" required>
        <br>
        <h4>Lastname:</h4>
        <input type="text" name="lastname"size="30" required>
         <br>
         <h4>E-mail:</h4>
        <input type="text" name="email"size="40" required>
         <br>
        <h4>Username:</h4>
        <input type="text" name="username"size="30" required>
        <br>
        <h4>Password:</h4>
        <input type="password" name="password"size="30" required>
         <br>
         <h4>Confirm Password:</h4>
        <input type="password" name="con-password"size="30" required>
         <br>
         <h4>Organization name:</h4>
        <input type="text" name="organization"size="50" required>
         <br>
         <h4>
        <input type="Submit" name="submit" value="signup">
        </h4>

        </form> 
        </div>

    </div>
    </body>
    </html>