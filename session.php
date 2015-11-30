<?php
    session_start();

    // If the session vars aren't set, try to set them with a cookie
    if (!isset($_SESSION['user_id'])) {
        if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
//            $_SESSION['user_id'] = $_COOKIE['user_id'];
//            $_SESSION['username'] = $_COOKIE['username'];
        }
    }
  
    // Set the logged-in flag with the current status
    if (isset($_SESSION['user_id'])) {
        $_SESSION['loggedin'] = true;
    } else {
        $_SESSION['loggedin'] = false;
    }

?>

