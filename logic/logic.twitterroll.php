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
//A script for finding twitter info
$search = false;

	//Check for registration.
	if($_POST['twitter'])
	{ 
		//Data has been submitted, now its time to save it.
		//First get all the data from the POST.
		$twitter = $_POST['registertwitter'];
				
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
<div style="margin-left: 25px;">
Latest 15 Tweets for the search term: <strong><?php echo $term; ?></strong><br><br>
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
