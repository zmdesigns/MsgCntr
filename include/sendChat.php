<?php
	include 'helpers.php';
	//date_default_timezone_set('America/Los_Angeles');

	if (empty($_POST['message'])) {
		echo "Missing data: message";	
	}
	else if (empty($_POST['username'])) {
		echo "Missing data: username";	
	}
	else {
		$mysqli = db_connect();
		$sent = new DateTime();
		$username = sanitize_input($_POST['username']);
		$message = mysql_real_escape_string($_POST['message']);

		$sql = "INSERT INTO Chat (sent,username,message,hidden) VALUES ('".$sent->format('Y-m-d H:i:s')."', '".$username."', '".$message."', false)";
		if ($mysqli->query($sql) == TRUE) {
			echo "Message sent.";
		}
		else {
			echo "Error: " . $mysqli->error;
		}
	}
?>
