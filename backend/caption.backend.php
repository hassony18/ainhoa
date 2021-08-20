<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_POST["path"]) && isset($_POST["caption"])) {
		if (!isset($_SESSION["email"])) {
			die(header("location: index.php"));
		}
		$stmt = $conn->prepare('INSERT INTO captions (path, caption)  VALUES (?, ?) ON DUPLICATE KEY UPDATE caption = ?;');
		$stmt->bind_param('sss', $_POST["path"], $_POST["caption"], $_POST["caption"]);
		$stmt->execute();
		exit();
    } else if (isset($_POST["path"]) && !isset($_POST["caption"])) {
		$stmt = $conn->prepare('SELECT caption FROM captions WHERE path = ?');
		$stmt->bind_param('s', $_POST["path"]);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		echo $data["caption"];
		exit();
	}
