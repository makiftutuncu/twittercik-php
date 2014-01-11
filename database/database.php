<?php

/** This file contains provides database connection to other parts of the application */

// Include the database configuration for once
include_once 'config.php';

// Obtain a database connection
$database = new mysqli(HOST, USER, PASSWORD, DATABASE);

?>