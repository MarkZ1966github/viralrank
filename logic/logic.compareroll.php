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
//A script for comparing data
$search = false;

	//Check for registration.
	if($_POST['firsturl'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$firsturl = $_POST['registerfirsturl'];
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		//$search = strip_tags($search);
		
	}
	
	if($_POST['secondurl'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$secondurl = $_POST['registersecondurl'];
		//Make sure that a devious hacker can't inject HTML, Javascript, or PHP.
		//$search = strip_tags($search);
		
	}
	session_start();
	$_SESSION['firsturl'] = $firsturl;
	$_SESSION['secondurl'] = $secondurl;

function file_get_contents_curl($firsturl)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $firsturl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $datatitle = curl_exec($ch);
    curl_close($ch);

    return $datatitle;
}

$html = file_get_contents_curl($firsturl);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

function file_get_contents_curl2($secondurl)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $secondurl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $datatitle2 = curl_exec($ch);
    curl_close($ch);

    return $datatitle2;
}

$html2 = file_get_contents_curl2($secondurl);

//parsing begins here:
$doc2 = new DOMDocument();
@$doc2->loadHTML($html2);
$nodes2 = $doc2->getElementsByTagName('title');

//get and display what you need:
$title2 = $nodes2->item(0)->nodeValue;

function viralrank($firsturl){
$query = 'http://api.viralrank.me/?action=viralrank&url='.$firsturl.'';
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
function twitter($firsturl){
$query = 'http://api.viralrank.me/?action=twitter&url='.$firsturl.'';
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
function fb($firsturl){
$query = 'http://api.viralrank.me/?action=fb&url='.$firsturl.'';
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
function gplus($firsturl){
$query = 'http://api.viralrank.me/?action=plusone&url='.$firsturl.'';
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
function reddit($firsturl){
$query = 'http://api.viralrank.me/?action=reddit&url='.$firsturl.'';
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
function viralrank2($secondurl){
$query = 'http://api.viralrank.me/?action=viralrank&url='.$secondurl.'';
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
function twitter2($secondurl){
$query = 'http://api.viralrank.me/?action=twitter&url='.$secondurl.'';
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
function fb2($secondurl){
$query = 'http://api.viralrank.me/?action=fb&url='.$secondurl.'';
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
function gplus2($secondurl){
$query = 'http://api.viralrank.me/?action=plusone&url='.$secondurl.'';
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
function reddit2($secondurl){
$query = 'http://api.viralrank.me/?action=reddit&url='.$secondurl.'';
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
$vrdiff = (viralrank($firsturl)-viralrank2($secondurl));
$twtdiff = (twitter($firsturl)-twitter2($secondurl));
$fbdiff = (fb($firsturl)-fb2($secondurl));
$gplusdiff = (gplus($firsturl)-gplus2($secondurl));
$redditdiff = (reddit($firsturl)-reddit2($secondurl));

$vrdiff2 = viralrank2($secondurl)-(viralrank($firsturl));
$twtdiff2 = (twitter2($secondurl)-twitter($firsturl));
$fbdiff2 = (fb2($secondurl)-fb($firsturl));
$gplusdiff2 = (gplus2($secondurl)-gplus($firsturl));
$redditdiff2 = (reddit2($secondurl)-reddit($firsturl));

$ch = curl_init("$firsturl");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);

$params['content'] = $data; //page content
//set the length of keywords you like
$params['min_word_length'] =  5;  //minimum length of single words
$params['metakeyLengthMax'] = 50;  //max in meta

$keyword = new metagen($params, "utf-8");
$keyword->firstCheck=array('Ø¢Ú¯Ù‡ÛŒ','Ø¢Ú¯Ù‡ÙŠ','ØªØ³Øª');
$key = $keyword->keymetagen();

$ch = curl_init("$secondurl");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data2 = curl_exec($ch);
curl_close($ch);

$params['content'] = $data2; //page content
//set the length of keywords you like
$params['min_word_length'] =  5;  //minimum length of single words
$params['metakeyLengthMax'] = 50;  //max in meta

$keyword2 = new metagen($params, "utf-8");
$keyword2->firstCheck=array('Ø¢Ú¯Ù‡ÛŒ','Ø¢Ú¯Ù‡ÙŠ','ØªØ³Øª');
$key2 = $keyword2->keymetagen();

$mydata = array(
 array("$title", '', '', '', '', '', ''),
 array("$firsturl", '', '', '', '', '', ''),
 array('ViralRank', 'Facebook', 'Twitter', 'Google+', 'Reddit', '', ''),
 array( viralrank("$firsturl"), fb("$firsturl"), twitter("$firsturl"), gplus("$firsturl"), reddit("$firsturl"), '', '' ),
 array('Diff', '', '', '', '', '', ''), 
 array("$vrdiff", "$fbdiff", "$twtdiff", "$gplusdiff", "$redditdiff", '', ''),
 array('Suggested Keywords'),
 array($key),
 array('', '', '', '', '', '', ''),
 array('', '', '', '', '', '', ''),
 array("$title2", '', '', '', '', '', ''),
 array("$secondurl", '', '', '', '', '', ''),
 array('ViralRank', 'Facebook', 'Twitter', 'Google+', 'Reddit', '', ''),
 array( viralrank("$secondurl"), fb("$secondurl"), twitter("$secondurl"), gplus("$secondurl"), reddit("$secondurl"), '', '' ),
 array('Diff', '', '', '', '', '', ''), 
 array("$vrdiff2", "$fbdiff2", "$twtdiff2", "$gplusdiff2", "$redditdiff2", '', ''),
 array('Suggested Keywords'),
 array($key2));   
 $fp = fopen('./files/comp-data.csv', 'w');

foreach ($mydata as $fields) {
    fputcsv($fp, $fields);
}
$filename = date("m-d-Y--H-i-s");
$oldfile = "./files/comp-data.csv";
$newfile = "./files/".$filename."-compare-data.csv";
copy($oldfile, $newfile);

fclose($fp);
?>

<div align = "left">
<div style="margin-left: 25px;">

<a href = "/visualize.php" target = "_blank">See Bar Chart</a> | <?php 
echo "<a href = '";
echo $newfile;
echo "'";
echo "target = '_blank'>"; 
echo "Download CSV</a>";
?><br><br>
Scoring for: <strong><a href ="<?php echo $firsturl; ?>" target="_blank"><?php echo $title; ?></a></strong><br>
<table>
<tr>
<td>
Social
</td>
<td>
Score
</td>
<td>
Diff
</td>
</tr>
<tr>
<td>
ViralRank
</td>
<td>
<?php echo viralrank($firsturl); ?>
</td>
<td><?php echo $vrdiff; ?>
</td>
</tr>
<tr>
<td>
Facebook
</td>
<td>
<?php echo fb($firsturl); ?>
</td>
<td>
<?php echo $fbdiff; ?>
</td>
</tr>
<tr>
<td>
Twitter
</td>
<td>
<?php echo twitter($firsturl); ?>
</td>
<td>
<?php echo $twtdiff; ?>
</td>
</tr>
<tr>
<td>
Google+
</td>
<td>
<?php echo gplus($firsturl); ?>
</td>
<td>
<?php echo $gplusdiff; ?>
</td>
</tr>
<tr>
<td>
Reddit
</td>
<td>
<?php echo reddit($firsturl); ?>
</td>
<td>
<?php echo $redditdiff; ?>
</td>
</tr>
</table>
<br>
<h3>Suggested Keywords</h3>
<pre > 
&lt;<span class="start-tag">meta</span><span > name</span>=<span >&quot;keywords&quot; </span><span >content</span>=<span >&quot;<? echo $key;?>&quot; </span><span ><span >/</span></span>&gt;
</pre>
<br>
<form id="trends_search" method="get" action = "http://www.google.com/trends/explore#" target = "_blank" enctype="application/x-www-form-urlencoded">
  <b>Five Keywords Maximum (comma seperated)</b>:
  <input type='text' name='q' style='height:30px; width:600px'/>
  <input type='submit' value='Check Google Trends for these Keywords' />
</form>
<br>
Scoring for: <strong><a href ="<?php echo $secondurl; ?>" target="_blank"><?php echo $title2; ?></a></strong><br>
<table>
<tr>
<td>
Social
</td>
<td>
Score
</td>
<td>
Diff
</td>
</tr>
<tr>
<td>
ViralRank
</td>
<td>
<?php echo viralrank2($secondurl); ?>
</td>
<td><?php echo $vrdiff2; ?>
</td>
</tr>
<tr>
<td>
Facebook
</td>
<td>
<?php echo fb2($secondurl); ?>
</td>
<td>
<?php echo $fbdiff2; ?>
</td>
</tr>
<tr>
<td>
Twitter
</td>
<td>
<?php echo twitter2($secondurl); ?>
</td>
<td>
<?php echo $twtdiff2; ?>
</td>
</tr>
<tr>
<td>
Google+
</td>
<td>
<?php echo gplus2($secondurl); ?>
</td>
<td>
<?php echo $gplusdiff2; ?>
</td>
</tr>
<tr>
<td>
Reddit
</td>
<td>
<?php echo reddit2($secondurl); ?>
</td>
<td>
<?php echo $redditdiff2; ?>
</td>
</tr>
</table>
<br>
<h3>Suggested Keywords</h3>
<pre > 
&lt;<span class="start-tag">meta</span><span > name</span>=<span >&quot;keywords&quot; </span><span >content</span>=<span >&quot;<? echo $key2;?>&quot; </span><span ><span >/</span></span>&gt;
</pre>
<br>
<form id="trends_search" method="get" action = "http://www.google.com/trends/explore#" target = "_blank" enctype="application/x-www-form-urlencoded">
  <b>Five Keywords Maximum (comma seperated)</b>:
  <input type='text' name='q' style='height:30px; width:600px'/>
  <input type='submit' value='Check Google Trends for these Keywords' />
</form>
</div>