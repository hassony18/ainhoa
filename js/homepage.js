const hamburger_icon = document.querySelector('#nav-bar .nav-bar .nav-list .hamburger');
const nav_list = document.querySelector('#nav-bar .nav-bar .nav-list');
var preventSpam = null;
var shownEditCaption = false;
document.getElementById("warning_container").style.display = "none"


hamburger_icon.addEventListener('click', () => {
	nav_list.classList.toggle('open');
	hamburger_icon.classList.toggle('active');
});


// preview image

var galleryImages = document.getElementsByClassName("gallery_images")
var requestClick = function() {
	if (!preventSpam) {
		showPicture(this)
	}
};

for (var i = 0; i < galleryImages.length; i++) {
    galleryImages[i].addEventListener('click', requestClick, false);
}

var container = document.getElementById("previewContainer");
var previewImage = document.getElementById("previewImage");
var dateText = document.getElementById("picture_date");

function showPicture(img) {
	if (container.style.display == "block") {
		return false;
	}
	container.style.display = "block";
	previewImage.src = img.src;
	previewImage.setAttribute("data-path", img.getAttribute("data-path"))
	dateText.innerHTML = "Uploaded: " + img.getAttribute("data-date");
	// request caption!
	var path = img.src
	var path = path.replace("https://ainhoa.studio/style/images/gallery/", "") 
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'backend/caption.backend.php'); // link
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		document.getElementById("picture_caption").innerHTML = xhr.responseText
	};
	xhr.send('path=' + encodeURIComponent(path));
}

// close preview
var close = document.getElementById("closePreview");
close.onclick = function() {
	container.style.display = "none";
}

// upload button
var uploadImage = document.getElementById("uploadImage");
if (uploadImage) {
	uploadImage.onclick = function() {
		document.getElementById("fileToUpload").click()
	}
}

//logout button
var logoutButton = document.getElementById("logoutButton");
if (logoutButton) {
	logoutButton.onclick = function() {
		document.getElementById("logoutForm").submit();
	}
}

// delete img
var deleteImage = document.getElementById("deleteImage");
if (deleteImage) {
	deleteImage.onclick = function() {
		var path = previewImage.getAttribute("data-path");
		if (path) {
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'backend/delete.backend.php'); // link
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onload = function() {
				window.location.reload();
			};
			xhr.send('path=' + path);
		}
	}

}

// edit image
var editPreview = document.getElementById("editPreview");
if (editPreview) {
	editPreview.onclick = function() {
		if (!shownEditCaption) {
			document.getElementById("editDiv").style.display = "block"
		} else {
			document.getElementById("editDiv").style.display = "none"
		}
		shownEditCaption = !shownEditCaption
	}

}

// save caption
var saveCaption = document.getElementById("saveCaption");
if (saveCaption) {
	saveCaption.onclick = function() {
		if (!previewImage.src) {
			return false;
		}
		var path = previewImage.src
		var caption = captionBox.value;
		var path = path.replace("https://ainhoa.studio/style/images/gallery/", "") 
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'backend/caption.backend.php'); // link
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			window.location.reload();
		};
		xhr.send('path=' + encodeURIComponent(path) + '&caption=' + encodeURIComponent(caption));
	}
}



// close on clickoutside preview image


document.addEventListener('mouseup', function(e) {
	var img = document.getElementById('previewImage');
	if (!previewImage.contains(e.target) && "deleteImage" != e.target.id && "editPreview" != e.target.id && container.style.display == "block") {
		if (document.getElementById("editDiv")) {
			if (document.getElementById("editDiv").contains(e.target)) {
				return false
			}
		}
        container.style.display = 'none';
    }
});

document.addEventListener('touchstart', function(e) {
	if (!previewImage.contains(e.target) && "deleteImage" != e.target.id && "editPreview" != e.target.id && container.style.display == "block") {
		if (document.getElementById("editDiv")) {
			if (document.getElementById("editDiv").contains(e.target)) {
				return false
			}
		}
        container.style.display = 'none';
		preventSpam = true;
		setTimeout(function(){ preventSpam = null; }, 500);
    }
});


// notifications


/* Notifications panel */

function showNotification(type, msg) {
	if (type == "error") {
		document.getElementById("warning_container").style.backgroundColor = "red";
	} else if (type == "warning") {
		document.getElementById("warning_container").style.backgroundColor = "yellow";
	} else if (type == "affirmation") {
		document.getElementById("warning_container").style.backgroundColor = "green";
	}
	document.getElementById("warning_text").innerHTML = msg;
	document.getElementById("warning_container").style.display = "block";
	setTimeout(function(){ document.getElementById("warning_container").style.display = "none"; }, 3000);
}

// auto submit images
if (document.getElementById("fileToUpload")) {
	document.getElementById("fileToUpload").onchange = function() {
		document.getElementById("upload_form").submit();
	};
}

// music button
var audio = document.getElementById("backgroundAudio");
audio.volume = 0.1;
var paused = true

const music_box = document.querySelector('.music_box');
music_box.addEventListener('click', (e)=>{
	paused = !paused
	e.target.classList.toggle('pause');
	if (paused) {
		audio.pause()
	} else {
		audio.play()
	}
})

// on size change
window.addEventListener("orientationchange", function() {
	window.location.reload();
})