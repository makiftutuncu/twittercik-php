<?php

/** This file is the controller of session operations */

define("SESSION_NAME", "twittercik_session");

/** This function starts a session which has some security precautions */
function startSecureSession()
{
    // Force sessions to only use cookies
	if(ini_set('session.use_only_cookies', 1) === FALSE)
	{
		exit();
	}

    // Get current cookie parameters
	$cookieParams = session_get_cookie_params();

    // Set current session parameters with updated values
	session_set_cookie_params(
        $cookieParams["lifetime"],	// Use the current lifetime
        $cookieParams["path"],		// Use the current path
        $cookieParams["domain"],	// Use the current domain
        false,						// *** This should be true for HTTPS servers. ***
        true);						// HTTP only so JavaScript isn't able to access the session

	// Set the session name
	session_name(SESSION_NAME);

    // Start the PHP session 
	session_start();

    // Regenerate the session id, delete the old one
	session_regenerate_id();
}

?>