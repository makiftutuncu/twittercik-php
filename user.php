<?php

include_once 'database/database.php';
include_once 'controller/session.php';
include_once 'controller/login.php';
include_once 'controller/user_picture.php';

// Use a secure session
startSecureSession();

// Check if user was already logged in
if(!isLoggedIn($database))
{
    // User was not logged in, go to timeline
    header('Location: welcome.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Twittercık - @<?php echo $_SESSION['username']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        <!-- Main container-->
		<div class="container col-md-6 col-md-offset-3">
		    <!-- Current User Picture Panel -->
		    <div class="row">
		        <div class="panel panel-success">
		            <div class="panel-heading dialog-title">
		                Your User Picture
		            </div>
		            <div class="panel-body">
		            	<table>
							<tr>
								<td>
									<img class="tweetcik-user-image" src="<?php echo getUserPicturePath($_SESSION['username']); ?>" alt="User Image">
								</td>
								<td>
									<?php $hasUserPicture = hasUserPicture($_SESSION['username']) ? "display: visible;" : "display: none"; ?>
									<p>This is your current user picture.
									<span style="<?php echo $hasUserPicture; ?>">&nbsp;|&nbsp;
										<a href="controller/remove_user_picture.php">Remove Current Picture</a>
									</span>
									</p>
								</td>
							</tr>
						</table>
		            </div>
		        </div>
		    </div>

		    <!-- Upload User Picture Panel -->
		    <div class="row">
		        <div class="panel panel-success">
		            <div class="panel-heading dialog-title">
		                Upload a New User Picture
		            </div>
		            <div class="panel-body">
		            	<p>Upload a new picture.</p>
		            	<p>Only JPEG images are supported. Maximum file size is 200 kilobytes. Use square pictures for best results.</p>
		            	<form enctype="multipart/form-data" action="controller/upload_user_picture.php" method="POST">
		            		<p><input type="file" name="file" id="file"></p>
		            		<p><button class="btn btn-success navbar-btn" type="submit">Upload</button></p>
		            	</form>
		            </div>
		        </div>
		    </div>

		    <!-- Alert -->
		    <?php $errorStyle = (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) ? "display: visible;" : "display: none;"; ?>
		    <div class="row" style="<?php echo $errorStyle; ?>">
	            <div class="alert alert-danger">
	                <p style="text-align:center;"><?php echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); ?></p>
	            </div>
	        </div>
		</div>
    </body>
</html>