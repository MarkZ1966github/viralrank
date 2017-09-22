<?php
require_once('logic/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "899671-YoOKCje5dbEux1wnnJcjFXzhw4fWz11HNQvXAVCVY",
    'oauth_access_token_secret' => "q2cWPte71Bz3cC5KoeGrNWZB6l6cMJ5l6yIKrq9n0",
    'consumer_key' => "6qNHpvUhVC6jWzMSsheevQ",
    'consumer_secret' => "OlwWr2MqjwPbNWMbPU4TWGOWMFjUCGKtxcES6KoIzE"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=hernandez';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                   ->performRequest();
$response = json_decode($response);
?>
<table>
<tr>
<td>Profile Pic</td>
<td>@ Name</td>
<td>Name</td>
<td>Date-Time</td>
<td>Tweet</td>
<td>Location</td>
<td>Following</td>
<td>Followers</td>
<td>Number of Updates</td>
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
<?php echo $response->statuses[$i]->user->screen_name; ?>
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
