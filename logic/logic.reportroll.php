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
	if($_POST['report'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$url = $_POST['registerreport'];
				
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
</div>
<?php
$mydata = array(
 array("$title", '', '', '', '', '', ''),
 array("$url", '', '', '', '', '', ''),
 array('ViralRank', 'Facebook', 'Twitter', 'Google+', 'Reddit', '', ''),
 array( viralrank("$url"), fb("$url"), twitter("$url"), gplus("$url"), reddit("$url"), '', '' ),
 array('', '', '', '', '', '', ''));

 $fp = fopen('./files/report.csv', 'w');

foreach ($mydata as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

?>
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
<?php
//A script for finding twitter info
$search = false;

	//Check for registration.
	if($_POST['report'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$twitter = $_POST['registerreport'];
				
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		//$url = strip_tags($url);
	}
require_once('logic/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "899671-YoOKCje5dbEux1wnnJcjFXzhw4fWz11HNQvXAVCVY",
    'oauth_access_token_secret' => "q2cWPte71Bz3cC5KoeGrNWZB6l6cMJ5l6yIKrq9n0",
    'consumer_key' => "6qNHpvUhVC6jWzMSsheevQ",
    'consumer_secret' => "OlwWr2MqjwPbNWMbPU4TWGOWMFjUCGKtxcES6KoIzE"
);
$term = $twitter;
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q='. $twitter;
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                   ->performRequest();
$response = json_decode($response);
?>
<?php
include 'logic/class.en_metagen.php';
//A script for finding keywords
$search = false;

	//Check for registration.
	if($_POST['report'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$kwurl = $_POST['registerreport'];
				
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		//$url = strip_tags($url);
	}
$ch = curl_init("$kwurl");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);

function file_get_contents_curlkw($kwurl)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $kwurl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $datatitle = curl_exec($ch);
    curl_close($ch);

    return $datatitle;
}

$html = file_get_contents_curlkw($kwurl);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

$params['content'] = $data; //page content
//set the length of keywords you like
$params['min_word_length'] =  5;  //minimum length of single words
$params['metakeyLengthMax'] = 50;  //max in meta

$keyword = new metagen($params, $encoding);
$keyword->firstCheck=array('Ø¢Ú¯Ù‡ÛŒ','Ø¢Ú¯Ù‡ÙŠ','ØªØ³Øª');
$key = $keyword->keymetagen();

$mydata = array(
 array('Suggested Keywords'),
 array($key));

 $fp = fopen('./files/report.csv', 'a');

foreach ($mydata as $fields) {
    fputcsv($fp, $fields);
}
$filename = date("m-d-Y--H-i-s");
$oldfile = "./files/report.csv";
$newfile = "./files/".$filename."-report.csv";
copy($oldfile, $newfile);

fclose($fp);

?>
<br><br><br><br><br><br>
<div style="margin-left: 25px;">
<h3>Suggested Keywords</h3>
<?php
echo "Keywords for: <strong>";
echo "<a href = '";
echo $kwurl;
echo "' target = '";
echo "_blank'>$title</a>";
echo "</strong>";
?>
<pre > 
&lt;<span class="start-tag">meta</span><span > name</span>=<span >&quot;keywords&quot; </span><span >content</span>=<span >&quot;<? echo $key;?>&quot; </span><span ><span >/</span></span>&gt;
</pre>
<br>
<?php 
echo "<a href = '";
echo $newfile;
echo "'";
echo "target = '_blank'>"; 
echo "Download Rank-KW CSV</a>";
?>

<br><br>
<h2>Latest 15 Tweets for URL:</h2> <a href = "<?php echo $term; ?>"><strong><?php echo $term; ?></strong></a><br><br>
<table>
<tr>
<td><strong>Pic</strong></td>
<td><strong>@Name</strong></td>
<td><strong>Name</strong></td>
<td><strong>Date-Time</strong></td>
<td><strong>Tweet</strong></td>
<td><strong>Location</strong></td>
<td><strong>Following</strong></td>
<td><strong>Followers</strong></td>
<td><strong>Tweets</strong></td>
</tr>
<?php 
for ($i=0; $i<count($response->statuses); $i++){
?>
<tr>
<td>
<?php echo "<img src ='"; ?>
<?php echo $response->statuses[$i]->user->profile_image_url; ?>
<?php echo "'>"; ?>
</td>
<td>
<?php echo "<a href ='http://twitter.com/"; ?>
<?php echo $response->statuses[$i]->user->screen_name; ?>
<?php echo "' target ='_blank'>" ; ?>
<?php echo $response->statuses[$i]->user->screen_name; ?>
<?php echo "</a>"; ?>
</td>
<td>
<?php echo $response->statuses[$i]->user->name; ?>
</td>
<td>
<?php echo date("F j, Y, g:i a", strtotime($response->statuses[$i]->created_at)); ?>
</td>
<td>
<?php echo $response->statuses[$i]->text; ?>
</td>
<td>
<?php echo $response->statuses[$i]->user->location; ?>
</td>
<td>
<?php echo $response->statuses[$i]->user->friends_count; ?>
</td>
<td>
<?php echo $response->statuses[$i]->user->followers_count; ?>
</td>
<td>
<?php echo $response->statuses[$i]->user->statuses_count; ?>
</td>

</tr>
<?php
};
?>

</table>
</div>
