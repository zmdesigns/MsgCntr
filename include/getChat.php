<?php
	include 'helpers.php';

	$mysqli = db_connect();
	$start = new DateTime();
	$start->modify('-1 day');
	$result = $mysqli->query("SELECT * FROM Chat WHERE sent > '".$start->format('Y-m-d H:i:s')."' ORDER BY sent");

	$history = array();

	while($row = $result->fetch_assoc())
	{
		$url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
		$chatMessage = $row['message'];
		$chatMessage = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $chatMessage);
		array_push($history, '<li class="list-group-item"><b>' . $row['username'] . ':</b>&nbsp; ' . $chatMessage . '</li>');
	}

	header('Content-Type: application/json');
	echo json_encode($history);
?>