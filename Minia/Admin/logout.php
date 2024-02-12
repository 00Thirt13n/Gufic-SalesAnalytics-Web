<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

$helper = array_keys($_SESSION);
    foreach ($helper as $key){
        unset($_SESSION[$key]);
    }

    
// Destroy the session.
session_destroy();

// Redirect to login page
header("location: auth-login.php");
exit;
?>