<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if(login_check($mysqli) == true)
{
    // User logged in, go to timeline
    header('Location: timeline.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Twittercık!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS integration -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="css/main.css">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="img/favicon.png">
        <!-- JQuery integration -->
        <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
        <!-- Bootstrap JS integration -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- Main logo -->
        <a href="/"><img src="img/logo.png" class="logo img-responsive" alt="logo" ></a>

        <!-- Contents of the page -->
        <!-- Container -->
        <div class="container col-md-4 col-md-offset-4">
            <!-- Login panel -->
            <div class="row">
                <div class="panel panel-success">
                    <!-- Title -->
                    <div class="panel-heading dialog-title">
                        Welcome to Twittercık!
                    </div>
                    <div class="panel-body">
                        <p>Twittercık is a place where you can freely express your opinions. The only thing that will be limiting you the 140 characters limit for each message.</p>
                        <p>Happy tweetciking! :)</p>
                        <div style="text-align: center">
                            <a class="btn btn-success" href="/login.php">I Have an Account</a>&nbsp;<a class="btn btn-success" href="register.php">Register for a New Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>