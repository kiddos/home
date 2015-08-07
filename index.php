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
	<script type="text/javascript" src="js/toggle.js"></script>
</head>

<body>

<?php
$colors = array('red', 'pink', 'purple', 'deep-purple', 'indigo', 'blue',
		'teal', 'green', 'deep-orange', 'brown', 'blue-grey');
$color = $colors[rand(0, 10)];
?>

<div class="w3-container" style="width:88%;margin:auto">
	<div class="w3-container <?php echo $color; ?>">
		<div class="w3-row">
			<i class="material-icons w3-opennav w3-right" onclick="toggle_nav()">menu</i>
			<h1>Home</h1>
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

	<div class="w3-row">
		<div class="w3-card-4 <?php echo $color;?> w3-col s6 m4 l3 w3-padding"
			onclick="toggle_dir()" style="margin-top: 10px">
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
		$dir = 'D:\\Pictures';
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
				echo "<a href=\"index.php?folder=$file\" style=\"margin-left: 6px; color: black\" onclick=\"reload()\">$file</a></div>"."\n";
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
			function contain($arr, $e) {
				foreach ($arr as $a) {
					if ($a == $e) return true;
				}
				return false;
			}
			function is_valid_type($file) {
				$file_info = pathinfo($file);
				switch($file_info['extension'])
				{
					case "jpg":
					case "JPG":
						return true;
					break;
				}
				return false;
			}


			$subdir = $files[2];
			if (isset($_GET['folder'])) {
				$subdir = $_GET['folder'];
			}
			$pictures = array_diff(scandir($dir.'/'.$subdir), array('..', '.'));
			$picturesnum = count($pictures) - 2;
			$limit = 64 < $picturesnum ? 64 : $picturesnum;
			$randomlist = array();
			for ($i = 0 ; $i < $picturesnum ; $i ++) {
				$randomlist[$i] = $i;
			}
			for($i = 0 ; $i < $picturesnum ; $i ++) {
				$index1 = rand(0, $picturesnum-1);
				$index2 = rand(0, $picturesnum-1);
				if ($index1 != $index2) {
					$temp = $randomlist[$index1];
					$randomlist[$index1] = $randomlist[$index2];
					$randomlist[$index2] = $temp;
				}
			}

			$first = true;
			for ($i = 0 ; $i < $limit ; $i ++) {
				if ($i == 0) {
					echo '<div class="item active">'."\n";
				} else {
					echo '<div class="item">'."\n";
				}
				$pic = $pictures[$randomlist[$i+2]];
				while (!is_valid_type($pic)) {
					$i ++;
					$pic = $pictures[$randomlist[$i+2]];
				}
				echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic\" alt=\"$i\"></div>"."\n";
			}
			?>
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
			<?php
			for($i = 0 ; $i < $limit ; $i += 4) {
				if ($i == 0) {
					$pic1 = $pictures[$randomlist[$i+2]];
					$pic2 = $pictures[$randomlist[$i+3]];
					$pic3 = $pictures[$randomlist[$i+4]];
					$pic4 = $pictures[$randomlist[$i+5]];
					echo '<div class="w3-col item active">';
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic1\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic2\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic3\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic4\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '</div>';
				} else if ($i + 4 >= $limit){
					echo '<div class="w3-col item">';
					switch($limit - $i) {
					case 4:
						$pic4 = $pictures[$randomlist[$i+5]];
						echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
						echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic4\" alt=\"$i\" style=\"width: 100%\"></div>";
					case 3:
						$pic3 = $pictures[$randomlist[$i+4]];
						echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
						echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic3\" alt=\"$i\" style=\"width: 100%\"></div>";
					case 2:
						$pic2 = $pictures[$randomlist[$i+3]];
						echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
						echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic2\" alt=\"$i\" style=\"width: 100%\"></div>";
					case 1:
						$pic1 = $pictures[$randomlist[$i+2]];
						echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
						echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic1\" alt=\"$i\" style=\"width: 100%\"></div>";
						break;
					}
					echo '</div>';
				} else {
					$pic1 = $pictures[$randomlist[$i+2]];
					$pic2 = $pictures[$randomlist[$i+3]];
					$pic3 = $pictures[$randomlist[$i+4]];
					$pic4 = $pictures[$randomlist[$i+5]];
					echo '<div class="w3-col item">';
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic1\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic2\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic3\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '<div class="w3-col s3 m3 l3" style="padding-right: 6px;">';
					echo "<img src=\"http://192.168.0.100/pictures/$subdir/$pic4\" alt=\"$i\" style=\"width: 100%\"></div>";
					echo '</div>';
				}
			}

			?>
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
