<?php
if(!defined("SECURE"))
{
  //Someone is trying to access this page directly without going through the proper
  //channel, a classic hacker ploy, so trick the sneaky hacker into thinking
  //that the page doesn't exist.  This is a good combination of security and obscurity.
  header('HTTP/1.1 404 Not Found');
  echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\n";
	echo "<html><head>\n<title>404 Not Found</title>\n</head><body>\n";
	echo "<h1>Not Found</h1>\n";
  echo "<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
	echo "</body></html>";
	exit;
}
?>	

<?php
	//The purpose of this file is to check for the submission of data to the server via POST.
	//If it finds a specific identifying value it will pass control to child code which will handle
	//that specific submission.

	//Check for registration.
	if($_POST['register'])
	{
		include "logic/logic.register.php";
	}
	
	//Check for login.
	if($_POST['login'])
	{
		include "logic/logic.login.php";
	}
	
	//Check for log out.
	if($_POST['logout'])
	{
		include "logic/logic.logout.php";
	}
	
	//rank single post
	if($_POST['url'])
	{
		include "logic/logic.viralrank.php";
	}
	
	//rank compare posts
	if($_POST['firsturl'])
	{
		include "logic/logic.compare.php";
	}
	
	//keyword 
	if($_POST['kwurl'])
	{
		include "logic/logic.kw.php";
	}
	
	//twitter 
	if($_POST['twitter'])
	{
		include "logic/logic.twitter.php";
	}
	
	//report 
	if($_POST['report'])
	{
		include "logic/logic.report.php";
	}
?>