<?php
	$dbServerName = "localhost";
	$dbServerUsername = "swisicfc_ainhoa";
	$dbPassword = "z8JoNAPZX{x!";
	$dbName = "swisicfc_ainhoa";
	
	$conn = mysqli_connect($dbServerName, $dbServerUsername, $dbPassword, $dbName);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>