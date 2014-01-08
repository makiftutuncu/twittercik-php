<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if(login_check($mysqli) == true)
{
    // User logged in, go to timeline
    header('Location: timeline.php');
}
else
{
    // User not logged in, go to welcome page
    header('Location: welcome.php');
}

?>