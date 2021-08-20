<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

	//$jwt = new \Firebase\JWT\JWT;
	//$jwt::$leeway = 10;

	$verifiyAccess = array(
		"hassonyalobaidy01@gmail.com" => true,
		"ainhoajade@gmail.com" => true
	);
	
	if (!isset($_POST["idtoken"])) {
		exit();
	}
	$id_token = $_POST["idtoken"];
	$CLIENT_ID = '372269759504-cb7cvbb0gv611id6r3viv55hetndn13a.apps.googleusercontent.com';

	$client = new Google_Client(['client_id' => $CLIENT_ID]); 
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
		if (!isset($verifiyAccess[$payload["email"]])) {
			echo "invaliduser";
		} else {
			//log in
			session_start();
			$_SESSION['email'] = $payload["email"];
			exit();
		}
	
	} else {
		echo "<h1>ERROR</h1>";
	}