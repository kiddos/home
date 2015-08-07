function toggle_nav() {
	if (document.getElementsByClassName("w3-topnav")[0].style.display == "none") {
		document.getElementsByClassName("w3-topnav")[0].style.display = "block";
	} else if (document.getElementsByClassName("w3-topnav")[0].style.display == "block") {
		document.getElementsByClassName("w3-topnav")[0].style.display = "none";
	}
}
function toggle_dir() {
	if (document.getElementById("folders").style.display == "none") {
		document.getElementById("folders").style.display = "block";
		document.getElementById("foldericon").className = "glyphicon glyphicon-folder-open";
	} else if (document.getElementById("folders").style.display == "block") {
		document.getElementById("folders").style.display = "none";
		document.getElementById("foldericon").className = "glyphicon glyphicon-folder-close";
	}
}
function toggle_preview() {
	if (document.getElementById("scroll_carousel").style.display == "none") {
		document.getElementById("scroll_carousel").style.display = "";
		document.getElementById("previewicon").className = "glyphicon glyphicon-eye-open";
	} else if (document.getElementById("scroll_carousel").style.display == "") {
		document.getElementById("scroll_carousel").style.display = "none";
		document.getElementById("previewicon").className = "glyphicon glyphicon-eye-close";
	} else {
		document.getElementById("scroll_carousel").style.display = "none";
		document.getElementById("previewicon").className = "glyphicon glyphicon-eye-close";
	}
}
function reload() {
	location.reload();
}
