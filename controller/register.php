<?php

/** This file is the controller of the register */

/**
 * Tries to register  with the given credentials
 *
 * @param $username Username input coming from the login form
 * @param $hashedPassword SHA-512 hashed password from the login form
 * @param $database Database connection object
 *
 * @return true if registered successfully, false otherwise
 */
function register($username, $hashedPassword, $database)
{
    // Prepare a statement avoiding SQL injections to register user
	if($statement = $database->prepare("INSERT INTO users (username, password, salt) VALUES (?, ?, ?)"))
	{
		// Create a random salt
        $randomSalt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Add some salt to the hashed password
        $password = hash('sha512', $hashedPassword . $randomSalt);

    	// Bind values to parameters
		$statement->bind_param('sss', $username, $password, $randomSalt);

        // Execute the prepared query
		if($statement->execute())
		{
			// It seems we registered you mate.
			return true;
		}
	}

	// If it came to this, you couldn't register mate, sorry.
	return false;
}

/**
 * Checks if the user is registered or not
 *
 * @param $username Username input coming from the login form
 * @param $database Database connection object
 *
 * @return true if the user is registered, false otherwise
 */
function isRegistered($username, $database)
{
	// Prepare a statement avoiding SQL injections to check the user
	if($statement = $database->prepare("SELECT username FROM users WHERE username = ? LIMIT 1"))
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
			// User is already registered. Sorry mate, you need to pick another username.
			return true;
		}
	}
}

?>