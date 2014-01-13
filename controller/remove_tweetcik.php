<?php

/** This file is the controller of removing a tweetcik */

include_once '../database/database.php';
include_once 'session.php';
include_once 'tweetcik.php';

// Use a secure session
startSecureSession();

// Check if the POST variables are defined
if(isset($_POST['tweetcik-id']))
{
	// Get tweetcik id
	$tweetcikId = $_POST['tweetcik-id'];

	if(!removeTweetcik($tweetcikId, $database))
	{
		// Set error message
        $_SESSION['errorMessage'] = "Error occurred while deleting tweetcik.";
	}
}

// Go to timeline again
header('Location: ../timeline.php');

?>