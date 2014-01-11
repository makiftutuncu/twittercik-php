<?php

/** This file is the controller of performing a logout */

include_once 'session.php';

// Use a secure session
startSecureSession();
 
// Unset all session values
$_SESSION = array();
 
// Get current session parameters
$params = session_get_cookie_params();
 
// Delete the actual cookie
setcookie(session_name(), '', time() - 42000,
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Destroy session 
session_destroy();

// Go to welcome
header('Location: ../welcome.php');

?>