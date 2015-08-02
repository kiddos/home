<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=680px, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
	</style>
</head>
<body>
<?php
$colors = array('red', 'pink', 'purple', 'deep-purple', 'indigo', 'blue', 'teal', 'green', 'deep-orange', 'brown', 'blue-grey');
$color = $colors[rand(0, 10)];
?>
<div class="w3-container" style="width:88%;margin:auto">

<div class="w3-card-4">
	<div class="w3-container <?php echo $color; ?>">
		<h1>Home</h1>
	</div>
</div>

<nav class="w3-topnav w3-container w3-padding <?php echo $color; ?>">
	<a href="index.php"><i class="material-icons">home</i>  Home</a>
	<a href="theater.php"><i class="material-icons">desktop_mac</i>  Theater</a>
</nav>

<div style="margin-top:10px;margin-bottom:10px">
<nav class="w3-container white" style="width:20%;float:left;">
<?php
function listDirectory($dir) {
	$files = array_diff(scandir($dir), array('..', '.'));
	foreach($files as $file) {
		echo "<li><a href=\"index.php\">$file</a></li>"."\n";
	}
}
$dir = 'D:\Pictures';
echo "<ul>\n";
listDirectory($dir);
echo "</ul>\n";
?>
</nav>

<div>
<img src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="Main" style="width:76%; float:right;">
</div>

<div style="clear:both">
<div class="image" style="<?php echo "border: 1px solid $color";?>"><img class="preview" src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="preview1"></div>
<div class="image" style="<?php echo "border: 1px solid $color";?>"><img class="preview" src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="preview2"></div>
<div class="image" style="<?php echo "border: 1px solid $color";?>"><img class="preview" src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="preview3"></div>
<div class="image" style="<?php echo "border: 1px solid $color";?>"><img class="preview" src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="preview4"></div>
<div class="image" style="<?php echo "border: 1px solid $color";?>"><img class="preview" src="http://192.168.0.100/pictures/2013-12-1/RIMG0060.JPG" alt="preview5"></div>
</div>

<div>
<footer class="w3-container <?php echo $color;?>" style="clear:both">
	<h5>Made by Joseph Yu (2015/7/21)</h5>
</footer>
</div>

</div>
</div>

</body>
</html>