<?php

/** This file is the controller of the tweetcik */

include_once 'tweetcik_model.php';

/**
 * Tries to post a tweetcik
 *
 * @param $username Username input coming from the session
 * @param $content Content of the tweetcik coming from the input
 * @param $database Database connection object
 *
 * @return true if tweetcik is posted successfully, false otherwise
 */
function postTweetcik($username, $content, $database)
{
	// Prepare a statement avoiding SQL injections to post the tweetcik
	if($statement = $database->prepare("INSERT INTO tweetciks (username, content) VALUES (?, ?)"))
	{
		// Bind $username and $content to parameter
		$statement->bind_param('ss', $username, $content);

        // Execute the prepared query
		if($statement->execute())
		{
			// Well done mate!
			return true;
		}
	}

	// Something's wrong, shut the light, heavy thoughts tonight, and they aren't of snow white
	return false;
}

/**
 * Reads all tweetciks
 *
 * @param $database Database connection object
 *
 * @return true Array of all tweetciks
 */
function readAllTweetciks($database)
{
	// Create the result array
	$tweetciks = array();

	// Execute the query
	$result = $database->query("SELECT id, username, content, tweetcikdate FROM tweetciks");

    // For all tweetciks out there
    while($row = $result->fetch_assoc())
    {
		$tweetcik = new Tweetcik();

		$tweetcik->id = $row['id'];
		$tweetcik->username = $row['username'];
		$tweetcik->content = $row['content'];
		$tweetcik->tweetcikDate = $row['tweetcikdate'];

		array_push($tweetciks, $tweetcik);
	}

	// Return all the read tweetciks
	return $tweetciks;
}

?>