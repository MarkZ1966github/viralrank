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

//A script for displaying the stories and putting them into a table
$search = false;

	//Check for registration.
	if($_POST['url'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$url = $_POST['registervr'];
				
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		//$url = strip_tags($url);
	}

function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $datatitle = curl_exec($ch);
    curl_close($ch);

    return $datatitle;
}

$html = file_get_contents_curl($url);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

function viralrank($url){
$query = 'http://api.viralrank.me/?action=viralrank&url='.$url.'';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$data = curl_exec($ch); 
curl_close($ch); 
$data = str_replace( "{\"ViralRank\":","", $data );
$data = str_replace("}"," ", $data );
$object = json_decode( $data ); 
return $data;
}
function twitter($url){
$query = 'http://api.viralrank.me/?action=twitter&url='.$url.'';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$datatwt = curl_exec($ch); 
curl_close($ch); 
$datatwt = str_replace( "{\"Tweets\":","", $datatwt );
$datatwt = str_replace("}"," ", $datatwt );
$object = json_decode( $datatwt ); 
return $datatwt;
}
function fb($url){
$query = 'http://api.viralrank.me/?action=fb&url='.$url.'';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$datafb = curl_exec($ch); 
curl_close($ch); 
$datafb = str_replace( "{\"Facebook\":","", $datafb );
$datafb = str_replace("}"," ", $datafb );
$object = json_decode( $datafb ); 
return $datafb;
}
function gplus($url){
$query = 'http://api.viralrank.me/?action=plusone&url='.$url.'';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$dataplusone = curl_exec($ch); 
curl_close($ch); 
$dataplusone = str_replace( "{\"G+\":","", $dataplusone );
$dataplusone = str_replace("}"," ", $dataplusone );
$object = json_decode( $dataplusone ); 
return $dataplusone;
}
function reddit($url){
$query = 'http://api.viralrank.me/?action=reddit&url='.$url.'';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$datareddit = curl_exec($ch); 
curl_close($ch); 
$datareddit = str_replace( "{\"Reddit\":","", $datareddit );
$datareddit = str_replace("}"," ", $datareddit );
$object = json_decode( $datareddit ); 
return $datareddit;
}
?>
<?php
$mydata = array(
 array("$title", '', '', '', '', '', ''),
 array("$url", '', '', '', '', '', ''),
 array('ViralRank', 'Facebook', 'Twitter', 'Google+', 'Reddit', '', ''),
 array( viralrank("$url"), fb("$url"), twitter("$url"), gplus("$url"), reddit("$url"), '', '' ));
 
 $fp = fopen('./files/rank-data.csv', 'w');

foreach ($mydata as $fields) {
    fputcsv($fp, $fields);
}
$filename = date("m-d-Y--H-i-s");
$oldfile = "./files/rank-data.csv";
$newfile = "./files/".$filename."-VR.csv";
copy($oldfile, $newfile);

fclose($fp);

?>
<div style="margin-left: 25px;">
Scoring for: <a href = "<?php echo $url; ?>" target = "_blank"><?php echo $title; ?></a><br>
<table>
<tr>
<td>
<strong>ViralRank</strong> <?php echo viralrank($url); ?> | 
</td>
<td>
<strong>Facebook</strong> <?php echo fb($url); ?>| 
</td>
<td>
<strong>Twitter</strong> <?php echo twitter($url); ?>| 
</td>
<td>
<strong>Google+</strong> <?php echo gplus($url); ?>| 
</td>
<td>
<strong>Reddit</strong> <?php echo reddit($url); ?>
</td>
</tr>
</table>
<br>
<?php 
echo "<a href = '";
echo $newfile;
echo "'";
echo "target = '_blank'>"; 
echo "Download CSV</a>";
?>
<br>
<?php include "content/content.twitter.php"; ?>
</div>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
            function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['URL', 'ViralRank', 'Facebook', 'Twitter', 'Google Plus', 'Reddit'],
          ["<?php echo $title; ?>",  <?php echo viralrank($url); ?>,    <?php echo fb($url); ?>,    <?php echo twitter($url); ?>,   <?php echo gplus($url); ?>, <?php echo reddit($url); ?>],
        ]);      
        // Create and draw the visualization.
        new google.visualization.BarChart(document.getElementById('visualization')).
            draw(data,
                 {title:"",
                  width:900, height:500,
                  vAxis: {title: "Headlines"},
                  hAxis: {title: "Social Scores"}}
            );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
    <div id="visualization" style="width: 600px; height: 400px;"></div>

