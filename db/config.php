<?php
	$dbServerName = "";
	$dbServerUsername = "";
	$dbPassword = "";
	$dbName = "";
	
	$conn = mysqli_connect($dbServerName, $dbServerUsername, $dbPassword, $dbName);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
