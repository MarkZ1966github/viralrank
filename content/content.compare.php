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
<div style="margin-left: 25px;">
<form action="index.php" method="post" enctype="application/x-www-form-urlencoded">
  <b>Compare</b>:
  <br /> <br />
  <b>First URL</b>:
  <input type='text' name='registerfirsturl' style='height:30px; width:920px'/>
  <input type='hidden' value='dummy' name='firsturl' />
  <br /> <br />
  <b>Second URL</b>:
  <input type='text' name='registersecondurl' style='height:30px; width:900px'/>
  <input type='hidden' value='dummy' name='secondurl' />
  <br /> <br />
  <input type='submit' value='Compare' />
</form>
</div>