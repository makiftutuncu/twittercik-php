<?php

/** This file is the controller of the login */

/**
 * Tries to log in with the given credentials
 *
 * @param $username Username input coming from the login form
 * @param $hashedPassword SHA-512 hashed password from the login form
 * @param $database Database connection object
 *
 * @return true if credentials are valid, false otherwise
 */
function login($username, $hashedPassword, $database)
{
    // Prepare a statement avoiding SQL injections to check login credentials
	if($statement = $database->prepare("SELECT username, password, salt FROM users WHERE username = ? LIMIT 1"))
	{
    	// Bind "$username" to parameter
		$statement->bind_param('s', $username);

        // Execute the prepared query
		$statement->execute();

		// Store query result
		$statement->store_result();

		// If database returns a single row
		if($statement->num_rows == 1)
		{
			// Bind variables to the result result
			$statement->bind_result($dbUsername, $dbPassword, $dbSalt);

			// Fetch the resulting values
			$statement->fetch();

			// Add some salt to the hashed password and create the actual password
			$password = hash('sha512', $hashedPassword . $dbSalt);

            // Check if the password in the database matches the salted password
			if($dbPassword == $password)
			{
            	// Password is correct! We are going to log this guy in now. Let's create some session info

            	// Get the user-agent string of the user
				$userAgent = $_SERVER['HTTP_USER_AGENT'];

				// Put username to the session variables
            	$_SESSION['username'] = $username;

            	// Hash out a value using password and user agent as the session id for this guy
				$_SESSION['sessionId'] = hash('sha512', $password . $userAgent);

            	// Welcome aboard mate!
				return true;
			}
			else
			{
				// Password is incorrect! Sorry mate, maybe later
				return false;
			}
		}
		else
		{
			// Even the database doesn't know you, sorry.
			return false;
		}
	}
}

/**
 * Checks the session information to figure out if the user is logged in or not
 *
 * @param $database Database connection object
 *
 * @return true if user is logged in, false otherwise
 */
function isLoggedIn($database)
{
	// Check if all session variables are set
	if(isset($_SESSION['username'], $_SESSION['sessionId']))
	{
		// Keep the provided session variables because we will check if they are valid
		$username = $_SESSION['username'];
		$sessionId = $_SESSION['sessionId'];

		// Get the user-agent string of the user
		$userAgent = $_SERVER['HTTP_USER_AGENT'];

		// Prepare a statement avoiding SQL injections to check session variables
		if($statement = $database->prepare("SELECT password FROM users WHERE username = ? LIMIT 1"))
		{
			// Bind "$username" to parameter
			$statement->bind_param('s', $username);

	        // Execute the prepared query
			$statement->execute();

			// Store query result
			$statement->store_result();

			// If database returns a single row
			if($statement->num_rows == 1)
			{
				// Bind variables to the result result
				$statement->bind_result($dbPassword);

				// Fetch the resulting values
				$statement->fetch();

				// Generate a session id
				$generatedSessionId = hash('sha512', $dbPassword . $userAgent);

				// Check if the generated session id is equal to the one read from the session variable
				if($generatedSessionId == $sessionId)
				{
                    // This guy is telling the truth, logged in.
					return true;
				}
				else
				{
                    // Seems like we have a joker here, not logged in mate.
					return false;
				}
			}
		}
	}
}

?>