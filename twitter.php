<?php

//This is where it all begins.
// version 5/5/13

define("SECURE",1);  //A defined variable used to prevent direct access to the logic and content
                     //modules.

include "logic/logic.submission.php";  //Check for form input. (registration, login, etc.)

include "content/content.header.php";  //Output the page header.

include "content/content.topofpage.php";

//Is the user logged in?
if (isset($_SESSION['loggedIn']))
{ 

include "content/content.twitter.php";   
 	
}
else
{ 


include "content/content.loggedout.php";


}

include "content/content.footer.php";

?>