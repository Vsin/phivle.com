<?php
require_once 'config.php';

// show newsfeed
$feeds = $facebook->api('/me/home');
print_r($feeds);
foreach($feeds['data'] as $feed)
{
	echo $feed["message"], "<br />";
}