<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION["email"])) {
	die(header("Location: ../index.php"));
}

$target_dir = $_SERVER['DOCUMENT_ROOT']."/style/images/gallery/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$errorType = null;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
	$errorType = "notImage";
  }
}

// Check if file already exists
if ($uploadOk == 1) {
	if (file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	  $errorType = "exists";
	}
}

// Check file size
if ($uploadOk == 1) {
	if ($_FILES["fileToUpload"]["size"] > 50000000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	  $errorType = "tooLarge";
	}
}

// Allow certain file formats
if ($uploadOk == 1) {
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	  $errorType = "format";
	}
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  die(header("Location: ../index.php?error=".$errorType));
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	die(header("Location: ../index.php?success"));
  } else {
    echo "Sorry, there was an error uploading your file.";
	die(header("Location: ../index.php?error=unknown"));
  }
}