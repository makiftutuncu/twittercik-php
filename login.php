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
        <title>Twittercık - Login</title>
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
        <!-- SHA512 JS integration -->
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <!-- Form validation JS integration -->
        <script type="text/JavaScript" src="js/forms.js"></script> 
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
		                Login to Twittercık
		            </div>
		            <div class="panel-body">
		            	<form method="POST" action="includes/process_login.php">
			                <div class="col-md-10 col-md-offset-1">
			                    <div class="row row-with-margin">
			                        <div class="input-group">
			                            <span class="input-group-addon">@</span>
			                            <input id="username" name="username" type="text" class="form-control" placeholder="Username">
			                        </div>
			                    </div>

			                    <div class="row row-with-margin">
			                        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
			                    </div>
			                </div>
			                <div class="row row-with-margin">
			                    <div style="text-align: center;">
			                        <button name="login-submit" class="btn btn-success" type="submit" onclick="return validateForm(this.form, this.form.username, this.form.password);">Login</button>
			                    </div>
			                </div>
		                </form>
		            </div>
		        </div>
		    </div>

		    <!-- Alert -->
		    <div class="row" style="<?php echo (isset($_GET['error']) && $_GET['error'] == 1) ? "display: visible;" : "display: none;"; ?>">
	            <div class="alert alert-danger">
	                <p>Username or password is invalid! Please try again.</p>
	            </div>
	        </div>
		</div>
    </body>
</html>