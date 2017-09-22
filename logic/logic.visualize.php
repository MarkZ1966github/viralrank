<?php
include 'logic/class.en_metagen.php';
session_start();
$firsturl = $_SESSION['firsturl'];
$secondurl = $_SESSION['secondurl'];
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