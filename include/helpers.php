<?php

function db_connect()
{
	include '../../../../login/chatdb_login.php';
	$mysqli = new mysqli($server,$user,$pass,$db);
	if ($mysqli->connect_error) {
		echo ($mysqli->connect_error);
		return null;
	} else {
		return $mysqli;
	}
}

//Removes leading/trailing whitespace, slashes, html characters
function sanitize_input($input)
{
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

?>