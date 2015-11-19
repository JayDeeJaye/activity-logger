<?php
   
    session_start();
  
   if ($_SERVER["REQUEST_METHOD"] == "POST") {

mysql_connect("localhost", "root", "smartguy06")or die("cannot connect"); //connection variable
mysql_select_db("app_content")or die("cannot select DB");

//process signup page  
if($_POST['submit'] =='signup'){

   $firstname = mysql_real_escape_string($_POST['firstname']);
   $lastname = mysql_real_escape_string($_POST['lastname']);
   $email = mysql_real_escape_string($_POST['email']);
   $username = mysql_real_escape_string($_POST['username']);
   $password = mysql_real_escape_string($_POST['password']);
   $con_password = mysql_real_escape_string($_POST['con-password']);
   $organization = mysql_real_escape_string($_POST['organization']);

    if($password == $con_password){
    //sql variable holds the database queries
      $sql = "INSERT INTO user_information (firstname, lastname, username, password, email, organization)
        VALUES ('$firstname', '$lastname', '$username','$password','$email','$organization')";

        mysql_query($sql);
        $_SESSION['loggedin'] = true;
        header('Location: activity.php');
        }
        else {
            $_SESSION['loggedin'] = false;
            echo "<script type='text/javascript'>alert('Password does not match, please re-enter!');window.location.href='signup.php';</script>";
            /*header('Location: signup.php');*/
           
             }
             mysql_close();
            }

//process login page
else if($_POST['submit'] =='login'){
   $username = mysql_real_escape_string($_POST['username']);
   $password = mysql_real_escape_string($_POST['password']); 
   $username = stripslashes($username);
   $password = stripslashes($password);

$sql="SELECT * FROM user_information WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
  $_SESSION['loggedin'] = true;
  header('Location: activity.php');
// login success, redirect to file "login_success.php" 
}

else {
  $_SESSION['loggedin'] = false;
echo "<script type='text/javascript'>alert('Please this user information does not exist, try with correct account information!');window.location.href='index.php';</script>";

}
mysql_close();
}

 }
?>
