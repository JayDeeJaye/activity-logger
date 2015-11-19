<!DOCTYPE html>
<?php
session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('Location: index.php');
  }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activity Tracker</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/"></script>
    </head>

    <body>
    	


    </body>
    </html>