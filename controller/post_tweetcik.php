<?php

/** This file is the controller of posting a tweetcik */

include_once '../database/database.php';
include_once 'tweetcik.php';
include_once 'session.php';

// Use a secure session
startSecureSession();

// Check if the variables are defined
if(isset($_SESSION['username'], $_POST['tweetcik']))
{
	// Get the values
    $username = $_SESSION['username'];
    $tweetcik = $_POST['tweetcik'];

    // Try to post tweetcik
    if(postTweetcik($username, $tweetcik, $database))
    {
        // Looks like we posted your tweetcik mate.
        header('Location: ../timeline.php');
    }
    else
    {
        // Well, something odd happened. Let's take you home.
        header('Location: ../timeline.php');
    }
}
else
{
    // Well, something odd happened. Let's take you home.
    header('Location: ../timeline.php');
}

?>