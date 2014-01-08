<?php

include_once 'db_connect.php';
include_once 'config.php';
 
$error_msg = "";
 
if(isset($_POST['username'], $_POST['hashed-password']))
{
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'hashed-password', FILTER_SANITIZE_STRING);

    if(strlen($password) != 128)
    {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= 'Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
 
    $prep_stmt = "SELECT username FROM users WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if($stmt)
    {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
        if($stmt->num_rows == 1)
        {
            // A user with this username already exists
            $error_msg .= 'Username is already registered. Choose another username.';
        }
    }
    else
    {
        $error_msg .= 'Database error.';
    }
 
    if(empty($error_msg))
    {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        // Insert the new user into the database 
        if($insert_stmt = $mysqli->prepare("INSERT INTO users (username, password, salt) VALUES (?, ?, ?)"))
        {
            $insert_stmt->bind_param('sss', $username, $password, $random_salt);

            // Execute the prepared query.
            if(!$insert_stmt->execute())
            {
                header('Location: register.php');
            }
        }
        header('Location: ../timeline.php');
    }
}

?>