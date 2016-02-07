<?php
require_once 'config.php';


/* make the dropdown */
$albums = $facebook->api('/me/albums');
echo "<p> Select a photo album:</p>";
echo "<select name='album'>";
foreach($albums['data'] as $album)
{
  echo "<option value='{$album['name']}'> {$album['name']} </option> ";
}
echo "</select>";

echo "<form name='input' action='html_form_action.asp' method='get'>";
echo "<input type='submit' value='Submit' />";
echo "</form>";


  /* make the submit button */


 // get albums
$albums = $facebook->api('/me/albums');

foreach($albums['data'] as $album)
{
	/* print the album name */
	echo "<p> {$album['name']}, ";
	
	/* print the likes */
	$count = 0;
	$likes = $facebook->api("/{$album['id']}/likes");
	foreach($likes['data'] as $like )
	{
	$count += 1;
	}
	echo "$count album likes</p>";
	
	/* print the album cover */
	$cov_pic = $facebook->api( $album['cover_photo'] );
	echo "<img src={$cov_pic['source']} /> <br/>";
	
	/* get the total likes of all pictures */
	$photos = $facebook->api("/{$album['id']}/photos");
	$count = 0;
	foreach($photos['data'] as $photo)
	{
	$likes = $photo['likes'];
	$count += sizeof($likes);
	}
echo "<p>$count total likes of all pics in album</p>";
}