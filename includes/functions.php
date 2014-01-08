<?php

include_once 'config.php';
 
function sec_session_start()
{
	// Set a custom session name
    $session_name = 'twittercik_session_id';

    // On https, this should be true
    $secure = false;


    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if(ini_set('session.use_only_cookies', 1) === FALSE)
    {
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);

    // Sets the session name to the one set above.
    session_name($session_name);

    // Start the PHP session 
    session_start();

    // Regenerated the session, delete the old one.
    session_regenerate_id();
}

function login($username, $password, $mysqli)
{
    // Using prepared statements means that SQL injection is not possible. 
    if($stmt = $mysqli->prepare("SELECT username, password, salt FROM users WHERE username = ? LIMIT 1"))
    {
    	// Bind "$username" to parameter.
        $stmt->bind_param('s', $username);

        // Execute the prepared query.
        $stmt->execute();

        $stmt->store_result();
 
        // Get variables from result.
        $stmt->bind_result($username, $db_password, $salt);
        $stmt->fetch();
 
        // Hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if($stmt->num_rows == 1)
        {
            // Check if the password in the database matches the password the user submitted.
            if($db_password == $password)
            {
            	// Password is correct!
            	// Get the user-agent string of the user.
            	$user_browser = $_SERVER['HTTP_USER_AGENT'];

            	// XSS protection as we might print this value
            	$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);

            	$_SESSION['username'] = $username;
            	$_SESSION['login_string'] = hash('sha512', $password . $user_browser);

            	// Login successful.
            	return true;
            }
            else
            {
            	// Password is not correct
            	// We record this attempt in the database
            	return false;
            }
        }
        else
        {
        	// No user exists.
        	return false;
        }
    }
}

function login_check($mysqli)
{
	// Check if all session variables are set
	if(isset($_SESSION['username'], $_SESSION['login_string']))
	{
		$username = $_SESSION['username'];
		$login_string = $_SESSION['login_string'];

		// Get the user-agent string of the user.
		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		if($stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ? LIMIT 1"))
		{
			// Bind "$username" to parameter.
			$stmt->bind_param('s', $username);

			// Execute the prepared query.
			$stmt->execute();

            $stmt->store_result();
 
            if($stmt->num_rows == 1)
            {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if($login_check == $login_string)
                {
                    // Logged In!!!! 
                    return true;
                }
                else
                {
                    // Not logged in 
                    return false;
                }
            }
            else
            {
                // Not logged in 
                return false;
            }
        }
        else
        {
            // Not logged in 
            return false;
        }
    }
    else
    {
        // Not logged in 
        return false;
    }
}

function esc_url($url)
{
	if('' == $url)
	{
		return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while($count)
    {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if($url[0] !== '/')
    {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    }
    else
    {
        return $url;
    }
}

?>