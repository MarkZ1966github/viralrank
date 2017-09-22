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
	//A script for taking the user's login details and adding their registration entry to the
	//database.
	//Flags for storing information about invalid form data.
	$bad_email = false;
	$email_exists = false;
	$name_exists = false;
	$name_needed = false;
	$password1_needed = false;
	$password2_needed = false;
	$passwords_dont_match = false;
	$register_success = false;

	//Check for registration.
	if($_POST['register'])
	{
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		if(isset($_POST['registerUsername'])){ $name = $_POST['registerUsername']; } 
		if(isset($_POST['registerEmail'])){ $email = $_POST['registerEmail']; } 
		if(isset($_POST['registerPassword1'])){ $password1 = $_POST['registerPassword1']; } 
		if(isset($_POST['registerPassword2'])){ $password2 = $_POST['registerPassword2']; } 

		//Now add slashes to remove characters which may mess up the data store.
		$password1 = addslashes($password1);
		$password2 = addslashes($password2);
		$name = addslashes($name);
		$email = addslashes($email);
		
		//Use the built-in filters first.
		$email = filter_var($email,FILTER_VALIDATE_EMAIL);
		$name = filter_var($name);
		$password1 = filter_var($password1);
		$password2 = filter_var($password2);
		
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		$name = strip_tags($name);
		$email = strip_tags($email);
		
		//Make sure that the email is in lower case letters.  This is because the salted hash that we
		//will use later is case sensitive.
		$email = strtolower($email);
		
		//Check to see if the email address is in a valid format.
		$email = filter_var($email,FILTER_VALIDATE_EMAIL);
		if(strcmp($email,"")==0)
		{
			$bad_email = true;
			echo "This doesn't look like an email address. <br />";
			echo "Please <a href='/register.php'>try again</a> or if you have an account, please <a href='/login.php'>Login</a>";
		}
		
			//Check to see if the email address already exists.
			$email = addslashes($email);
			//Now do a search for the email.
			if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
    			header("Location: index.php");
    			die("Denny access");
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

			if(mysqli_num_rows($result) != 0)
			{
				 $email_exists = true;
				 echo "That email address is already taken. <br />";
				 echo "Please <a href='/register.php'>try again</a> or if you have an account, please <a href='/login.php'>Login</a>";

				
			}
								
		//Check the username to make sure it is valid.
		if(strcmp($name,'')==0)
		{
			$name_needed = true;
			echo "Please enter your name. <br />";
		}
		
			//Check the username to make sure it doesn't already exists in the database.
			$name = addslashes($name);
			//Now do a search for the name.
			$db = new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>No Connect to database</b>") ;
}
if (!$result = $db->query("select * from viralrankmembers where name='$name'")) {
    throw new Exception("<b>Could not read data from the table </b>") ;
}	
			if(mysqli_num_rows($result) != 0)
			{
				 $name_exists = true;
				 echo "The name you chose is already taken. <br />";
				 echo "Please <a href='/register.php'>try again</a> or if you have an account, please <a href='/login.php'>Login</a>";
			}
					
		//Check to make sure the passwords are valid.
		if(strcmp($password1,'')==0)
		{
			$password1_needed = true;
			echo "Please enter a password. <br />";
			
		}
						
		if(strcmp($password2,'')==0)
		{
			$password2_needed = true;
			echo "Please reenter your password. <br />";
			echo "Please <a href='/register.php'>try again</a> or if you have an account, please <a href='/login.php'>Login</a>";
		}
							
		if(strcmp($password1,$password2)!=0)
		{
			$passwords_dont_match = true;
			echo "The two passwords don't match.  <br />";
			echo "Please <a href='/register.php'>try again</a> or if you have an account, please <a href='/login.php'>Login</a>";
		}
		//Now the big test.....
		if($password1_needed | $password2_needed | $passwords_dont_match |$bad_email | $email_exists | $name_exists | $name_needed)
		{
				// BIG FAIL
		}
		else
		{
			
			//Everything looks good.  Add the user's entry to the database.
			
			//Make a salted hash of the password for increased security.
			$passwordHash = sha1($name . $password1 . $email . '@#$');
			$db = new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>No Connect to database</b>") ;
}
if (!$result = $db->query("insert into viralrankmembers set name='$name', passwordHash = '$passwordHash', email = '$email'")) {
    throw new Exception("<b>Could not read data from the table </b>") ;
}	
			
							
			$register_success = true;
?>
<br> 
<p><h2><em>You have successfully registered!</em><br>Please <a href = "/login.php">Login</a></h2></p>
<?php
		}
	}
	
?>