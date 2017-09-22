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



    <div class="container">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="text"],
      .form-signin input[type="password"],
      .form-signin input[type="password"]
      {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
      <form class="form-signin" action="index.php" method="post" enctype="application/x-www-form-urlencoded">
        <h2 class="form-signin-heading">Please Register</h2>
        <input type="text" class="input-block-level" placeholder="Username" name='registerUsername'>
         
  <input type="text" class="input-block-level" placeholder="Email Address" name='registerEmail'>
         
        <input type="password" class="input-block-level" placeholder="Password" name='registerPassword1'>
   
  <input type="password" class="input-block-level" placeholder="Password Again" name='registerPassword2'>

        
        <button class="btn btn-large btn-primary" type='hidden' value="dummy" name='register'>Register</button>
      </form>

    </div> 