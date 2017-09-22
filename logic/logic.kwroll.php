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
include 'logic/class.en_metagen.php';
//A script for finding keywords
$search = false;

	//Check for registration.
	if($_POST['kwurl'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$kwurl = $_POST['registerkw'];
				
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		//$url = strip_tags($url);
	}
$ch = curl_init("$kwurl");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);

function file_get_contents_curl($kwurl)
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

$html = file_get_contents_curl($kwurl);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

echo "Keywords for: <strong>";
echo "<a href = '";
echo $kwurl;
echo "' target = '";
echo "_blank'>$title</a>";
echo "</strong>";

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
 
 $fp = fopen('./files/keyword.csv', 'w');

foreach ($mydata as $fields) {
    fputcsv($fp, $fields);
}
$filename = date("m-d-Y--H-i-s");
$oldfile = "./files/keyword.csv";
$newfile = "./files/".$filename."-keyword.csv";
copy($oldfile, $newfile);

fclose($fp);

?>
<h3>Suggested Keywords</h3>
<?php 
echo "<a href = '";
echo $newfile;
echo "'";
echo "target = '_blank'>"; 
echo "Download CSV</a>";
?>
<br><br>
<pre > 
&lt;<span class="start-tag">meta</span><span > name</span>=<span >&quot;keywords&quot; </span><span >content</span>=<span >&quot;<? echo $key;?>&quot; </span><span ><span >/</span></span>&gt;
</pre>

<form id="trends_search" method="get" action = "http://www.google.com/trends/explore#" target = "_blank" enctype="application/x-www-form-urlencoded">
  <b>Five Keywords Maximum (comma seperated)</b>:
  <input type='text' name='q' style='height:30px; width:600px'/>
  <input type='submit' value='Check Google Trends for these Keywords' />
</form>
<?php include "content/content.twitter.php"; ?>
