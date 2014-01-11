<?php

/** This file is the controller of performing a login */

include_once '../database/database.php';
include_once 'login.php';
include_once 'session.php';

// Use a secure session
startSecureSession();

// Check if the POST variables are defined
if(isset($_POST['username'], $_POST['hashed-password']))
{
	// Get the values
    $username = $_POST['username'];
    $hashedPassword = $_POST['hashed-password'];

    // Try to log in with these credentials
    if(login($username, $hashedPassword, $database))
    {
        // Credentials were valid, go to timeline
        header('Location: ../timeline.php');
    }
    else
    {
        // Set error message
        $_SESSION['errorMessage'] = "Username and password doesn't match.";

    	// Credentials were invalid, go to login again
        header('Location: ../login.php');
    }
}
else
{
    // Set error message
	$_SESSION['errorMessage'] = "Username and password are invalid.";

	// Go to login again
    header('Location: ../login.php');
}

?>