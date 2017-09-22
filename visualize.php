<?php 
include "logic/logic.visualize.php";
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      ViralRank | Compare Bar Chart
    </title>
<!-- Le styles -->
    <link href="./bootstrap/docs/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="./bootstrap/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="./bootstrap/docs/assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./bootstrap/docs/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./bootstrap/docs/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./bootstrap/docs/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="./bootstrap/docs/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="./bootstrap/docs/assets/ico/favicon.ico">
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
            function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['URL', 'ViralRank', 'Facebook', 'Twitter', 'Google Plus', 'Reddit'],
          ["<?php echo $title; ?>",  <?php echo viralrank($firsturl); ?>,    <?php echo fb($firsturl); ?>,    <?php echo twitter($firsturl); ?>,   <?php echo gplus($firsturl); ?>, <?php echo reddit($firsturl); ?>],
          ["<?php echo $title2; ?>",  <?php echo viralrank($secondurl); ?>,    <?php echo fb($secondurl); ?>,    <?php echo twitter($secondurl); ?>,  <?php echo gplus($secondurl); ?>, <?php echo reddit($secondurl); ?>]
        ]);      
        // Create and draw the visualization.
        new google.visualization.BarChart(document.getElementById('visualization')).
            draw(data,
                 {title:"Comparing Stories",
                  width:900, height:500,
                  vAxis: {title: "Headlines"},
                  hAxis: {title: "Social Scores"}}
            );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 600px; height: 400px;"></div>
  </body>
</html>