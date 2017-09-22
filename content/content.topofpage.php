<?php

//This is where it all begins.
// version 7/3/13

define("SECURE",1);  //A defined variable used to prevent direct access to the logic and content
                     //modules.

include "logic/logic.submission.php";  //Check for form input. (registration, login, etc.)

include "content/content.header.php";  //Output the page header.
session_start();

//Is the user logged in?
if (isset($_SESSION['loggedIn'])) {
?>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
<a class="brand" href="/">ViralRank Dashboard</a>     
            
    <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="/">Home</a></li>
              <li><a href="/compare.php">Compare</a></li>
              <li><a href="/kw.php">Keywords</a></li>
              <li><a href="/rank.php">Rank</a></li>
              <li><a href="/report.php">Report</a></li>
              <li><a href="/twitter.php">Twitter</a></li>
             <li><form action="index.php" method="post" enctype="application/x-www-form-urlencoded">
	<input type='hidden' value='dummy' name='logout' />
	<input type='submit' value='Log Out' />
</form></li>
             </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./bootstrap/docs/assets/js/jquery.js"></script>
    <script>
    /* ===================================================
 * bootstrap-transition.js v2.3.1
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 * ===================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


  /* CSS TRANSITION SUPPORT (http://www.modernizr.com/)
   * ======================================================= */

  $(function () {

    $.support.transition = (function () {

      var transitionEnd = (function () {

        var el = document.createElement('bootstrap')
          , transEndEventNames = {
               'WebkitTransition' : 'webkitTransitionEnd'
            ,  'MozTransition'    : 'transitionend'
            ,  'OTransition'      : 'oTransitionEnd otransitionend'
            ,  'transition'       : 'transitionend'
            }
          , name

        for (name in transEndEventNames){
          if (el.style[name] !== undefined) {
            return transEndEventNames[name]
          }
        }

      }())

      return transitionEnd && {
        end: transitionEnd
      }

    })()

  })

}(window.jQuery);
    </script>
    <script src="./bootstrap/docs/assets/js/bootstrap-alert.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-modal.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-tab.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-popover.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-button.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-carousel.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>


<?php
  
 	
}
else
{ ?>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
<a class="brand" href="/">ViralRank Dashboard</a>         
            
    <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
            <ul class="nav">
              
             <li><a href="/">Home</a></li>
             <li><a href="/login.php">Login</a></li>
             <li><a href="/register.php">Register</a></li>
             </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


    <div class="container">


    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./bootstrap/docs/assets/js/jquery.js"></script>
    <script>
    /* ===================================================
 * bootstrap-transition.js v2.3.1
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 * ===================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


  /* CSS TRANSITION SUPPORT (http://www.modernizr.com/)
   * ======================================================= */

  $(function () {

    $.support.transition = (function () {

      var transitionEnd = (function () {

        var el = document.createElement('bootstrap')
          , transEndEventNames = {
               'WebkitTransition' : 'webkitTransitionEnd'
            ,  'MozTransition'    : 'transitionend'
            ,  'OTransition'      : 'oTransitionEnd otransitionend'
            ,  'transition'       : 'transitionend'
            }
          , name

        for (name in transEndEventNames){
          if (el.style[name] !== undefined) {
            return transEndEventNames[name]
          }
        }

      }())

      return transitionEnd && {
        end: transitionEnd
      }

    })()

  })

}(window.jQuery);
    </script>
    <script src="./bootstrap/docs/assets/js/bootstrap-alert.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-modal.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-tab.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-popover.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-button.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-carousel.js"></script>
    <script src="./bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>

<?php
}

?>