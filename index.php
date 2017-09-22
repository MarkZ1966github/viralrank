<?php

//This is where it all begins.
// version 5/28/13

include "content/content.topofpage.php";
//Is the user logged in?
if (isset($_SESSION['loggedIn'])) {
?>

<?php
  
include "content/content.loggedIn.php";	
}
else
{ ?>



<?php
include "content/content.loggedout.php";	
}

include "content/content.footer.php";

?>