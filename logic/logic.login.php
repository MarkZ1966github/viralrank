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
	//A script for testing submitted login details against the database.
	$unknown_email = false;
	$wrong_password = false;

	//Check for registration.
	if($_POST['login'])
	{
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$email = $_POST['loginEmail'];
		$password1 = $_POST['loginPassword'];
		
		//Now add slashes to remove characters which may mess up the data store.
		$email = addslashes($email);		
		$password1 = addslashes($password1);

		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		$email = strip_tags($email);
		$password1 = strip_tags($password1);
		
		//Make sure that the email is in lower case letters.  This is because the salted hash that we
		//will use later is case sensitive.
		$email = strtolower($email);
		
		//Look up this email to see if it is valid.
if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
header("Location: index.php");die("Denny access");
			}
error_reporting(E_ALL); 
$config = parse_ini_file("logic/my.ini") ;
$db = new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>No Connect to database</b>") ;
}
if (!$result = $db->query("select * from viralrankmembers where email='$email'")) {
    throw new Exception("<b>Could not read data from the table </b>") ;
}
		
		if(mysqli_num_rows($result)==0)
		{
			//Fail, the email address doesn't even exist in our database.
			$unknown_email = true;
			echo "<div align = 'center'>";
			echo "<strong>Unknown email address</strong><br>";
			echo "Please <a href='/login.php'>try again</a> or <a href='/register.php'>Register</a>";
			echo "</div>";
		}
		else
		{
		  //Retrieve that username.
		  $result = mysqli_fetch_assoc($result);
		  $name = $result['name'];
		  $actualPassword = $result['passwordHash'];
		  
			//Compute the salted hash of the password.
			$passwordHash = sha1($name . $password1 . $email . '@#$');
			
			if($passwordHash==$actualPassword)
			{
			  //Successful login, change their session to a logged in one.
session_start();
			  $_SESSION['email'] = $email;
			  $_SESSION['name'] = $name;
      			  $_SESSION['loggedIn'] = 1;
			}
			else
			{
			  //Fail, they didn't enter the right password.
			  $wrong_password = true;
			  echo "<div align = 'center'>";
			  echo "<strong>Wrong password</strong><br>";
			  echo "Please <a href='/login.php'>try again</a>";
			  echo "</div>";
			}
		}
	}
	
?>