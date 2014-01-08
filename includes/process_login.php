<?php

include_once 'db_connect.php';
include_once 'functions.php';

// Our custom secure way of starting a PHP session.
sec_session_start();

if(isset($_POST['username'], $_POST['hashed-password']))
{
    $username = $_POST['username'];
    $password = $_POST['hashed-password']; // The hashed password.

    if(login($username, $password, $mysqli) == true)
    {
        // Login success 
        header('Location: ../timeline.php');
    }
    else
    {
        // Login failed 
        header('Location: ../login.php?error=1');
    }
}
else
{
    // Login failed 
    header('Location: ../login.php?error=1');
}

?>