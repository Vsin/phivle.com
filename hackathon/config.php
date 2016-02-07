<?php
require_once 'library/facebook.php';

$app_id = "244260995665186";
$app_secret = "23a4fa67387b78cdb38cebfa5ae15e04";

$facebook = new Facebook(array(
	'appId' => $app_id,
	'secret' => $app_secret,
	'cookie' => true
));

if(is_null($facebook->getUser()))
{
	header("Location:{$facebook->getLoginUrl(array('req_perms' => 'user_photos, user_status, read_stream'))}");
	exit;
}
