<?php

/** Entry point of the Twittercık so welcome */

include_once 'database/database.php';
include_once 'controller/session.php';
include_once 'controller/login.php';

// Use a secure session 
startSecureSession();

// Check if the user is already logged in
if(isLoggedIn($database))
{
    // User logged in, go to timeline
    header('Location: timeline.php');
}
else
{
    // User not logged in, go to welcome
    header('Location: welcome.php');
}

?>