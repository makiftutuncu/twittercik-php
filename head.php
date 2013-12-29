<?php include_once("config.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $pageTitle; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS integration -->
        <link rel="stylesheet" href="<?php echo DIR_CSS . 'bootstrap.min.css'; ?>">
        <!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo DIR_CSS . 'main.css'; ?>">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="<?php echo DIR_IMG . 'favicon.png'; ?>">
        <!-- JQuery integration -->
        <script src="<?php echo DIR_JS . 'jquery-1.9.0.min.js'; ?>" type="text/javascript"></script>
        <!-- Bootstrap JS integration -->
        <script src="<?php echo DIR_JS . 'bootstrap.min.js'; ?>" type="text/javascript"></script>
    </head>
    <body>
        <!-- Main logo -->
        <a href="<?php echo DIR_ROOT; ?>"><img src="<?php echo DIR_IMG . 'logo.png'; ?>" class="logo img-responsive" alt="logo" ></a>

        <!-- Contents of the page -->
