<?php

/** This file is the controller of performing a register */

include_once '../database/database.php';
include_once 'register.php';
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

    // If user is not registered
    if(!isRegistered($username, $database))
    {
        // Try to register in with these credentials
        if(register($username, $hashedPassword, $database))
        {
            // Looks like we got you registered mate. Now, let's also log you in.
            if(login($username, $hashedPassword, $database))
            {
                // Successfully logged in. Welcome aboard mate.
                header('Location: ../timeline.php');
            }
            else
            {
                // Well, something odd happened. Let's take you home.
                header('Location: ../welcome.php');
            }
        }
        else
        {
            // Well, something odd happened. Let's take you home.
            header('Location: ../welcome.php');
        }
    }
    else
    {
        // Set error message
        $_SESSION['errorMessage'] = "Username is already registered. Choose a different username.";

        // Username is taken, go to register again
        header('Location: ../register.php');
    }
}
else
{
    // Set error message
	$_SESSION['errorMessage'] = "Username and password are invalid.";

	// Go to register again
    header('Location: ../register.php');
}

?>