<?php

/** This file is the controller of the user picture */

/**
 * Gets a user picture path
 *
 * @param $username Username input coming from the session
 *
 * @return Path of the user picture if it exists or default user picture path if it doesn't
 */
function getUserPicturePath($username)
{
	if(hasUserPicture($username))
	{
		return "userpictures/" . $username . ".jpg";
	}

	return "img/defaultuserpicture.png";
}

/**
 * Checks whether there is an uploaded user picture for given user
 *
 * @param $username Username input coming from the session
 *
 * @return true if user picture exists, false otherwise
 */
function hasUserPicture($username)
{
	return file_exists("userpictures/" . $username . ".jpg");
}

?>