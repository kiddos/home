<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=680px, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>Home Theater</title>
	<style>
		ul a:link {
			text-decoration: none;
			color: black;
		}
		ul a:visited {
			text-decoration: none;
			color: black;
		}
		ul a:hover {
			text-decoration: bold;
			color: green;
		}
		ul a:active {
			text-decoration: none;
			color: green;
		}
	</style>
	<script type="text/javascript" src="js/toggle.js"></script>
</head>

<body>

<?php
$colors = array('red', 'pink', 'purple', 'deep-purple', 'indigo',
				'blue', 'teal', 'green', 'deep-orange', 'brown', 'blue-grey');
$color = $colors[rand(0, 10)];
?>

<div class="w3-container" style="width:88%;margin:auto">

	<div class="w3-container <?php echo $color; ?>">
		<div class="w3-row">
			<i class="material-icons w3-opennav w3-right"
				onclick="toggle_nav()">menu</i>
			<h1>Home Theater</h1>
		</div>
	</div>

	<!-- navigation bar -->
	<nav class="w3-topnav w3-container w3-padding w3-row <?php echo $color; ?>"
		style="display: none;">
		<a class="w3-col s6 m4 l2" href="index.php">
			<i class="material-icons">home</i>  Home</a>
		<a class="w3-col s6 m4 l2" href="theater.php">
			<i class="material-icons">desktop_mac</i>  Theater</a>
	</nav>

	<?php
	function listDirectory($dir, $subdir = "") {
		$files = array_diff(scandir($dir.'\\'.$subdir), array('..', '.'));
		foreach($files as $file) {
			$file = utf8_encode($file);
			$fileType = pathinfo($file, PATHINFO_EXTENSION);
			if(is_dir($dir.'\\'.$subdir.'\\'.$file)) {
				listDirectory($dir, $subdir.'/'.$file);
			} else {
				$subtitle = false;
				if($fileType != "mp4" && $fileType != "mkv")
					continue;
				if(strlen($subdir) == 0)
					echo '<li><a href="play.php?video='.$subdir."/".$file.'">'.$file.'</a></li>'."\n";
				else {
					$lastIndex = strrpos($file, ".");
					$movieName = substr($file, 0, $lastIndex);
					$subtitleName = $dir.'\\'.$subdir.'\\'.$movieName;
					$subtitleExtension = '.srt';
					if(file_exists($subtitleName.'.cht'.$subtitleExtension) ||
						file_exists($subtitleName.'.eng'.$subtitleExtension) ||
						file_exists($subtitleName.$subtitleExtension)) {
						echo '<li><a href="play.php?video='.$subdir."/".$file.'&subtitle=true">'.$file.'</a></li>'."\n";
					} else echo '<li><a href="play.php?video='.$subdir."/".$file.'">'.$file.'</a></li>'."\n";
				}
			}
		}
	}

	$dir = 'D:\\Movie';
	echo '<ul class="w3-ul w3-card-4">';
	listDirectory($dir);
	echo '</ul>';
	?>

	<div class="w3-container w3-padding <?php echo $color;?>" style="margin-top: 20px;">
		<footer>
			<h4>Made by Joseph Yu (2015/7/21)</h4>
		</footer>
	</div>
</div>

</body>
</html>
