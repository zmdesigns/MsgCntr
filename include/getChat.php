<?php
	include 'helpers.php';

	$mysqli = db_connect();
	$dbtime = new DateTimeZone('Europe/Paris');
	$mytime = new DateTimeZone('America/Los_Angeles');
	$start = new DateTime(NULL,$dbtime);
	$start->setTimezone($mytime);
	$start->modify('-8 hours');

	$result = $mysqli->query("SELECT * FROM Chat WHERE sent > '".$start->format('Y-m-d H:i:s')."' ORDER BY sent");

	$history = array();

	while($row = $result->fetch_assoc())
	{
		//$url = '/^http:\/\/|(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/';
		//$url = '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';
		$url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
		//$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
		$chatMessage = $row['message'];
		$timestamp = new DateTime($row['sent'], $dbtime);
		$timestamp->setTimezone($mytime);

		//ALERT: HACK
		//  For some reason the timestamp variable 
		//  is 10mins ahead of where it should be
		//  this fixes that for the time being.
		$timestamp->modify('-10 minutes');

		$chatMessage = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $chatMessage);
		array_push($history, '<li class="list-group-item"><b>' . $timestamp->format("H:i") . " " . $row['username'] . ':</b>&nbsp; ' . $chatMessage . '</li>');
	}

	header('Content-Type: application/json');
	echo json_encode($history);
?>