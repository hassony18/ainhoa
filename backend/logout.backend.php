<?php

session_start();
session_unset();
session_destroy();
$_SESSION["email"] = null;
header("Location: ../index.php");