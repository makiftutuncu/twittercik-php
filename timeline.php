<?php

include_once 'database/database.php';
include_once 'controller/session.php';
include_once 'controller/login.php';

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
        <title>Twittercık - Timeline</title>
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
        <!-- Character counter JS integration -->
        <script src="js/counter.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- Main logo -->
        <a href="/"><img src="img/logo.png" class="logo img-responsive" alt="logo" ></a>

        <!-- Contents of the page -->
        <!-- Main container-->
		<div class="container col-md-6 col-md-offset-3">
		    <!-- User information bar -->
		    <div class="row">
		        <div class="panel panel-success">
		            <div class="panel-heading nav">
		                <div class="user-info navbar-text">Welcome <b>@<?php echo $_SESSION['username']; ?></b>!</div>
		                <form action="controller/perform_logout.php" method="post">
		                	<button class="btn btn-success navbar-btn user-logout" type="submit">Logout</button>
		                </form>
		            </div>
		        </div>
		    </div>

		    <!-- New tweetcik panel -->
		    <div class="row">
		        <div class="panel panel-success">
		            <div class="panel-heading dialog-title">
		                Post a new tweecik
		            </div>
		            <div class="panel-body">
		                <form method="POST" action="controller/post_tweetcik.php">
		                    <p>
		                        <textarea rows="2" id="tweetcik-area" oninput="ensureTweetcikLength(this);" name="tweetcik" class="form-control input-block-level tweetcik-input" placeholder="Enter your tweetcik here."></textarea>
		                    </p>
		                    <p>
			                    <div id="tweetcik-counter" class="tweetcik-counter"></div>
			                    <button id="tweetcik-button" class="btn btn-success tweetcik-button" type="submit">Tweetcik!</button>
		                    </p>
		                </form>
		            </div>
		        </div>
		    </div>

		    <!-- Timeline -->
		    <div class="row">
		        <div class="panel panel-success">
		            <div class="panel-heading dialog-title">
		                Timeline
		            </div>
		            <ul class="list-group">
		            	<?php

		            	include 'controller/read_tweetciks.php';
		            	
		            	if(isset($tweetciks) && count($tweetciks) > 0)
		            	{
		            		foreach (array_reverse($tweetciks) as $tweetcik)
		            		{
		            			echo "<li class=\"list-group-item\"><p><span class=\"tweetcik-user\">@"
		            			. $tweetcik->username . "</span> / <span class=\"tweetcik-date\">"
		            			. $tweetcik->tweetcikDate . "</span></p><p>"
		            			. $tweetcik->content . "</p></li>";
		            		}
		            	}
		            	else
		            	{
		            		echo "<li class=\"list-group-item\"><p style=\"text-align: center\">There is no tweetcik posted yet. Why not post one now?</p></li>";
		            	}

		            	?>
		            </ul>
		        </div>
		    </div>
		</div>
    </body>
</html>