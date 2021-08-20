<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //action.php
	if (!isset($_SESSION["email"])) {
		die(header("location: index.php"));
	}
    if(isset($_POST["path"])) {
		unlink($_SERVER['DOCUMENT_ROOT']."/".$_POST["path"]."");
		exit();
    }
