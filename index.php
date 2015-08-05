<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<title>Home</title>
	<style>
		li a:link {
			text-decoration: none;
			color: black;
		}
		li a:visited {
			text-decoration: none;
			color: black;
		}
		li a:hover {
			text-decoration: bold;
			color: green;
		}
		li a:active {
			text-decoration: none;
			color: green;
		}
		li {
			padding-top: 5px;
			padding-bottom: 15px;
		}
		div.image {
			display: block;
			margin-top: 15px;
			float: right;
			width: 19%;
			margin-left: 10px;
			padding: 10px;
			margin-bottom: 10px;
		}
		div.image img{
			width: 100%;
		}
		a:link {
			color: #FFFFFF;
		}
		a:visited {
			color: #FFFFFF;
		}
		a:hover {
			color: #FFFFFF;
		}
		a:active {
			color: #FFFFFF;
		}
	</style>
	<script type="text/javascript" charset="utf-8">
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
	</script>
</head>

<body>

<?php
$colors = array('red', 'pink', 'purple', 'deep-purple', 'indigo', 'blue',
		'teal', 'green', 'deep-orange', 'brown', 'blue-grey');
$color = $colors[rand(0, 10)];
?>

<div id="content" class="w3-container" style="width:88%;margin:auto">
	<div class="w3-container <?php echo $color; ?>">
		<div class="w3-row">
			<i class="material-icons w3-opennav w3-right" onclick="toggle_nav()">menu</i>
			<h1>Home</h1>
		</div>
	</div>

	<nav class="w3-topnav w3-container w3-padding w3-row <?php echo $color; ?>"
		style="display: none;">
		<a class="w3-col s6 m4 l2" href="index.php"><i class="material-icons">home</i>  Home</a>
		<a class="w3-col s6 m4 l2" href="theater.php"><i class="material-icons">desktop_mac</i>  Theater</a>
	</nav>

	<div class="w3-row">
		<div class="w3-card-4 <?php echo $color;?> w3-col s4 m3 l3 w3-padding" onclick="toggle_dir()"
			style="margin-top: 10px">
			<span id="foldericon" class="glyphicon glyphicon-folder-close"></span>
			<a href="#" style="margin-left: 10px; margin-right: 10px">Folders</a>
			<span class="caret"></span>
		</div>
	</div>

	<div class="w3-row" id="folders" style="margin-top: 3px; display: none;">
		<!-- Template
		<div class="w3-card-4 w3-col s5 m3 l2 w3-padding" style="margin: 3px">
			<span class="glyphicon glyphicon-folder-open"></span>
			<a href="#" style="margin-left: 6px; color: black">Folder 1</a>
		</div> -->
		<?php
		$dir = '/home/joseph/Pictures';
		//$dir = "http://192.168.0.100/pictures";
		$files = array_diff(scandir($dir), array('..', '.'));
		$first = true;
		foreach($files as $file) {
			if(is_dir($dir.'/'.$file)) {
				echo '<div class="w3-card-4 w3-col s5 m3 l2 w3-padding" style="margin: 3px">'."\n";
				if ($first) {
					echo '<span class="glyphicon glyphicon-folder-open"></span>'."\n";
					$first = false;
				} else {
					echo '<span class="glyphicon glyphicon-folder-close"></span>'."\n";
				}
				echo "<a href=\"#\" style=\"margin-left: 6px; color: black\">$file</a></div>"."\n";
			}
		}
		?>
	</div>
	
	<div id="main_carousel" class="carousel slide" data-ride="carousel" style="margin-top: 10px">
		<!-- Indicators -->
		<!-- <ol class="carousel-indicators">
			<li data-target="#main_carousel" data-slide-to="0" class="active"></li>
			<li data-target="#main_carousel" data-slide-to="1"></li>
			<li data-target="#main_carousel" data-slide-to="2"></li>
			<li data-target="#main_carousel" data-slide-to="3"></li>
		</ol> -->

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<?php
			$subdir = $files[0];
			$pictures = array_diff(scandir($dir.'/'.$subdir), array('..', '.'));
			$first = true;
			$counter = 0;
			foreach ($pictures as $picture) {
				if ($counter == 0) {
					echo '<div class="item active">'."\n";
				} else {
					echo '<div class="item">'."\n";
				}
				echo "<img src=\"http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG\" alt=\"$counter\">"."\n";
				echo '</div>'."\n";
				$counter ++;
			}
			?>
			<div class="item">
				<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="1">
			</div>

			<div class="item">
				<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0062.JPG" alt="2">
			</div>

			<div class="item">
				<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0063.JPG" alt="3">
			</div>

			<div class="item">
				<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0064.JPG" alt="4">
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#main_carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#main_carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<div class="w3-row">
		<div class="w3-card-2 w3-padding <?php echo $color;?>" onclick="toggle_preview()"
			style="margin-top: 10px">
			<span id="previewicon" class="glyphicon glyphicon-eye-open"></span>
			<a href="#scroll_carousel" style="margin-left: 10px; margin-right: 10px">Preview</a>
		</div>
	</div>

	<div id="scroll_carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<div class="w3-col item active">
				<div class="w3-col s3 m3 l3" style="padding-right: 6px;">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px; padding-right: 6px">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px; padding-right: 6px">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px;">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
			</div>

			<div class="w3-col item">
				<div class="w3-col s3 m3 l3" style="padding-right: 6px;">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px; padding-right: 6px">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px; padding-right: 6px">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px;">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
			</div>

			<div class="w3-col item">
				<div class="w3-col s3 m3 l3" style="padding-right: 6px;">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px; padding-right: 6px">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px; padding-right: 6px">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
				<div class="w3-col s3 m3 l3" style="padding-left: 6px;">
					<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0059.JPG" alt="preview1" style="width: 100%">
				</div>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#scroll_carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#scroll_carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<div class="w3-container w3-padding <?php echo $color;?>" style="margin-top: 20px;">
		<footer>
			<h4>Made by Joseph Yu (2015/7/21)</h4>
		</footer>
	</div>
</div>


</body>
</html>
