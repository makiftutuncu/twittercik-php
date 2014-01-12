<?php

/** This file is the controller of removing a user picture */

include_once 'session.php';

// Use a secure session
startSecureSession();

$userPicture = "../userpictures/" . $_SESSION['username'] . ".jpg";

// Delete user picture
if(file_exists($userPicture))
{
	unlink($userPicture);
}

// Move back to user page
header('Location: ../user.php');

?>