<?php

/** This file is the controller of removing a user picture */

include_once 'session.php';

// Use a secure session
startSecureSession();

$userPicture = "../userpictures/" . $_SESSION['username'] . ".jpg";

if($_FILES["file"]["error"] > 0)
{
	$_SESSION['errorMessage'] = 'Please select a valid file.';
}
else
{
	$allowedExts = array("jpg", "jpeg", "JPG", "JPEG");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if($_FILES["file"]["type"] == "image/jpeg")
	{
		if(in_array($extension, $allowedExts))
		{
			if($_FILES["file"]["size"] < 204800)
			{
				move_uploaded_file($_FILES["file"]["tmp_name"], $userPicture);
			}
			else
			{
				$_SESSION['errorMessage'] = 'Maximum file size is 200 kilobytes.';
			}
		}
		else
		{
			$_SESSION['errorMessage'] = 'Only JPEG images are supported.';
		}
	}
	else
	{
		$_SESSION['errorMessage'] = 'Only JPEG images are supported.';
	}
}

// Move back to user page
header('Location: ../user.php');

?>