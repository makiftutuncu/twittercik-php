<?php

define('DIR_ROOT', '/twittercik-php/');
define('DIR_CSS', 'css/');
define('DIR_IMG', 'img/');
define('DIR_JS', 'js/');

/**
 * Renders a given page with given title
 */
function renderPage($page, $pageTitle)
{
	include("head.php");
	include($page);
}

?>