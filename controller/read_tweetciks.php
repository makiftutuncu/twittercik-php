<?php

/** This file is the controller of reading all tweetciks */

include_once 'tweetcik.php';

// Create tweetciks array
$tweetciks = array();

// Check if the variables are defined
if(isset($_SESSION['username']))
{
    $tweetciks = readAllTweetciks($database);
}

?>