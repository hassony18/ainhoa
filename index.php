<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";
	// update views
	if (!isset($_SESSION["visitor"])) {
		$stmt = $conn->prepare("UPDATE stats SET views = views + 1;");
		$stmt->execute();
	}
	// get views
	$stmt = $conn->prepare('SELECT views from stats');
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_assoc();
	$views = $data['views'];
	
	$_SESSION["visitor"] = true
?>

<!-- setup custom login button -->
<?php
	if (!isset($_SESSION["email"])) {
		echo "
			<script src='https://apis.google.com/js/api:client.js'></script>
			<script>
				var googleUser = {};
				var startApp = function() {
					gapi.load('auth2', function(){
					auth2 = gapi.auth2.init({
						client_id: '372269759504-cb7cvbb0gv611id6r3viv55hetndn13a.apps.googleusercontent.com',
						cookiepolicy: 'single_host_origin',
						//scope: 'https://www.googleapis.com/auth/user.addresses.read',
					});
					attachSignin(document.getElementById('customGoogleButton'));
					});
				};
				function attachSignin(element) {
					auth2.attachClickHandler(element, {}, onLogin, onFail)
				}

				function onLogin(googleUser) {
					var profile = googleUser.getBasicProfile();
					var id_token = googleUser.getAuthResponse().id_token;
				
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'backend/login.backend.php'); // link
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.onload = function() {
						//console.log('Signed in:' + xhr.responseText);
						if (xhr.responseText == 'invaliduser') { 
							showNotification('error', 'Seulement Ainhoa & Hassan ont accès.')
						} else {					
							window.location.reload();
						}
					};
					xhr.send('idtoken=' + id_token);
				}
				function onFail(error) {
					console.log(error);
				}
				startApp();
			</script>
 		";
	}
?>

	<head>
	  <meta charset="UTF-8">
		<meta name="google-signin-client_id" content="372269759504-cb7cvbb0gv611id6r3viv55hetndn13a.apps.googleusercontent.com">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
		<title>Ainhoa Studio</title>
		<link rel="stylesheet" href="style/homepage.css?yeeet">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>
		<div id="player">
			<audio id="backgroundAudio" hidden loop>
			 <source src="style/audio/background.mp3" type="audio/mpeg">
						If you're reading this, audio isn't supported. 
			</audio>
		</div>
		  <!-- nav-bar  -->
		  <section id="nav-bar" class="container">
			<div class="music_box"></div>
			<header id="myHeader" class="nav-bar">
				<?php
					echo '
					<script>
						if (window.matchMedia("(max-width: 800px)").matches) {
							var a = document.createElement("a")
							var img = document.createElement("img")
							a.setAttribute("href", "#")
							img.setAttribute("height", 50)
							img.setAttribute("width", 50)
							img.src = "style/images/icon.png"
							a.append(img)
							document.getElementById("myHeader").append(a)
						} else {
							var a = document.createElement("a")
							var img = document.createElement("img")
							a.setAttribute("href", "#")
							img.setAttribute("height", 50)
							img.setAttribute("width", 100)
							img.src = "style/images/ainhoa.png"
							a.append(img)
							document.getElementById("myHeader").append(a)
						}
					</script>';
				?>
			<!-- <a href="#"><img height=50 width=50 src="style/images/ainhoa.png"></a> -->
			<div class="brand">
				
				<a href="https://vsco.co/ainhoajade/gallery" target="_blank"><img height=25 width=25 src="style/images/vsco.png"><i class="fab fa-instagram-square"></i></a>
				<a href="https://www.instagram.com/ainhoajade/" target="_blank"><img height=25 width=25 src="style/images/instagram.png"><i class="fab fa-instagram-square"></i></a>
				<?php
					if (isset($_SESSION["email"])) {
						echo '
						<form id="logoutForm" action="backend/logout.backend.php" method="post">
							<img id="logoutButton" height=25 width=25 src="style/images/log-out.png"><i class="fab fa-logout-square"></i>
						</form>
						';
					} else {
						echo '<div id="customGoogleButton" class="customGPlusSignIn"><img height=25 width=25 src="style/images/sign-in.png"><i class="fab fa-login-square"></i></div>';
					}
				?>
			  </div>
			  <div class="nav-list">
				<div class="hamburger">
				  <div class="bar"></div>
				</div>
				<ul>
				  <li><a href="#about">Qui suis-je?</a></li>
				  <li><a href="#gallery">Galerie</a></li>
				</ul>
			  </div>
			</header>
		  </section>
		  <!-- End nav-bar  -->

		  <!-- Hero Section  -->
		  <section id="hero" class="hero container">
			<div class="hero-info">
			  <h1 class="hero-info-heading">“I don’t trust words. I trust pictures.”</h1>
			  <p class="hero-info-subheading">— Gilles Peress</p>
			  <a href="#gallery" type="button" class="hero-info-button">Galerie</a>
			  <h2 id="views_label">Visites totales: <?php echo number_format($views); ?></h2>
			</div>
			<div class="hero-img">
			  <img src="style/images/cover.jpg" alt="">
			</div>
		  </section>
		  <!-- End Hero Section  -->

		  <!-- About section  -->
		  <section id="about" class="about container">
			<div class="about-info">
				<h1 class="about-info-heading">Qui suis-je?</h1>
				<p class="about-info-desc">Salut! Je suis une artiste genevoise qui adore la photographie et le montage vidéo. Vous trouvez ici quelques unes de mes réalisations. N'hésitez pas à me contacter !</p>
				<h3 class="about-info-desc">Contact</h3>
				<a href="https://www.instagram.com/ainhoajade/" target="_blank"><img class="container_white_background" width=100 height=100 src="style/images/instagram-colored.png"></a>
				<a href="https://vsco.co/ainhoajade/gallery" target="_blank"><img class="container_white_background" width=100 height=100 src="style/images/vsco-colored.png"></a>
				<a href="mailto: ainhoajade@gmail.com" target="_blank"><img class="container_white_background" width=100 height=100 src="style/images/email.png"></a>
				<br>
				<a href="#about"><img class="container_white_background" width=350 height=350 src="style/images/qr.png"></a>
			</div>
			<div class="about-img">
			  <div class="about-img-wrapper">
				<img src="style/images/qui.jpg" alt="">
			  </div>
			</div>
		  </section>
		  <!-- End About section  -->

		  <!-- Service Section  -->
		  <section id="gallery" class="gallery container">
		  		  
			<div class="galleryContainer">
				<?php
					if (isset($_SESSION["email"])) {
						echo '
								<form id="upload_form" action="backend/upload.backend.php" method="post" enctype="multipart/form-data">
									<div class="image-upload">
										<img id="uploadImage" class="container_white_background" width=100 height=100 style="margin-left: auto; margin-right: auto; display: block;" src="style/images/add.png">
										<input id="fileToUpload" type="file" name="fileToUpload" />
									</div>
								</form>
							';
								
					}
				?>
				<div class="row">
					<div class="column"></div>
					<div class="column"></div>
					<div class="column"></div>
					<div class="column"></div>
					<?php
					
					// get current directory path
					$dirpath = dirname(realpath(__FILE__)).'/style/images/gallery/';
					// set file pattern
					$dirpath .= "*";
					// copy filenames to array
					$files = array();
					$files = glob($dirpath);

					// sort files by last modified date
					usort($files, function($x, $y) {
						return filemtime($x) < filemtime($y);
					});
				
					$order = -1;
					$id = 0;
					foreach($files as $item){
						$order = $order + 1;
						$id = $id + 1;
						if ($order > 3) {
							$order = 0;
						}
						
						echo '
						<script>
							if (window.matchMedia("(max-width: 600px)").matches) { // 1 columns
								var column = document.getElementsByClassName("column")[0]
							} else { // 4 columns
								var column = document.getElementsByClassName("column")['.$order.']
							}
							var img = document.createElement("img")
							img.setAttribute("class", "gallery_images")
							img.id = "'.$id.'"
							img.src = "style/images/gallery/'.basename($item).'"
							img.setAttribute("data-path", "style/images/gallery/'.basename($item).'")
							img.setAttribute("data-date", "'. @date('F d, Y, H:i:s', filemtime($item)) .'")
							img.style.width = 100%
							column.append(img)
						</script>
						';
					}
					?>
				</div>
			</div>

			<!-- The Modal -->
			<div id="previewContainer">
				<img id="closePreview" src="style/images/close.png"></span>
				<?php
					if (isset($_SESSION["email"])) {
						echo '<img id="editPreview" src="style/images/edit.png"></span>';
					}
				?>
				<img id="previewImage">
				<div id="picture_date"></div>
				<div id="picture_caption"></div>
				<?php
					if (isset($_SESSION["email"])) {
						echo '
							<div id="editDiv">
								<label for="captionBox">Caption this!</label>
								<input type="text" id="captionBox" name="captionBox" autofocus>
								<button id="saveCaption" type="button">Sauvgarder</button>
							</div>	
							';
					}

					if (isset($_SESSION["email"])) {
						echo '<span id="deleteImage">Supprimer!</span>';
					}
				?>
			</div>
			
		  </section>
		  <!-- End Service Section  -->
		  


		  <!-- Footer section  -->
		  <footer id="footer" class="footer container">
			<img width=200 height=50 src="style/images/logo.png"><br><br>
			<div class="footer-social-follow">
				<h1 class="footer-social-follow-heading">Trouvez-moi sur</h1>
			  <div class="footer-social-icon">
				<a href="https://www.instagram.com/ainhoajade/" target="_blank"><img height=50 width=50 src="style/images/instagram.png"><i class="fab fa-instagram-square"></i></a>
				<a href="https://vsco.co/ainhoajade/gallery" target="_blank"><img height=50 width=50 src="style/images/vsco.png"><i class="fab fa-vsco-square"></i></a>
			  </div>
			  <p>All rights reserved © Al-Obaidi Hassan 2021</p>
			</div>
		  </footer>
		  <!-- End Footer section  -->
		<!-- Warning panel -->
		<div id="warning_container">
			<span id="warning_text">ERROR: no errors (just yet).</span>
		</div>
		  
		  <script src="js/homepage.js"></script>
	</body>
	
<!-- Catch errors -->
<?php
	if (isset($_GET["error"])) {
		$error = $_GET["error"];
		if ($error == "notImage") {
			echo "<script>showNotification('error', 'File is not an image.');</script>";
		} elseif ($error == "exists") {
			echo "<script>showNotification('error', 'File exists already.');</script>";
		}  elseif ($error == "tooLarge") {
			echo "<script>showNotification('error', 'File is too big.');</script>";
		}  elseif ($error == "format") {
			echo "<script>showNotification('error', 'Unacceptable file format.');</script>";
		} elseif ($error == "unknown") {
			echo "<script>showNotification('error', 'unknown error.');</script>";
		} 
	}
	
	if (isset($_GET["success"])) {
		echo "<script>showNotification('affirmation', 'Task completed.');</script>";
	}
?>