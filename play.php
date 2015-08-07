<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=680px, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/playr.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="js/playr.js"></script>
	<title>Home Theater</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<style>
	#video_container {
		margin-top: 5px;
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
	$video = $_GET['video'];
	$fileType = pathinfo($video, PATHINFO_EXTENSION);
	switch($fileType) {
		case "mp4":
			$type = "video/mp4";
			break;
		case "mkv":
			$type = "video/mp4";
			echo '<div class="alert alert-danger fade in" style="margin-top: 10px">';
			echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo '<i class="material-icons" style="maring-right: 10px">warning</i>  <strong>MKV is not a MIME type!</strong>  The Video may or may not be play properly</div>';
			break;
	}
	?>

	<div id="video_container" class="w3-card-2">
	<video class="playr_video" controls autoplay="false" autostart="false" name="media" width="100%" data-rendering="playr">
		<source src="http://192.168.0.100/movie/<?php echo $video;?>" type="<?php echo $type;?>">
		<?php
		$hasSubtitle = $_GET['subtitle'];
		if(isset($hasSubtitle) && $hasSubtitle == "true") {
			$dir = 'D:\\Movie';
			$lastIndex = strrpos($video, ".");
			$moviePath = substr($video, 0, $lastIndex);
			$subtitlePath = $dir.$moviePath;
			$subtitleExtension = '.srt';
			// TODO
			// remove old subtitles
			$subtitles = array_diff(scandir("./subtitle"), array('..', '.'));
			foreach($subtitles as $subtitle) {
				unlink("./subtitle/$subtitle");
			}
			if(file_exists($subtitlePath.'.eng'.$subtitleExtension)) {
				$src = $subtitlePath.'.eng'.$subtitleExtension;
				$dst = "./subtitle/".substr($moviePath, strrpos($moviePath, "/")).'.eng'.$subtitleExtension;
				copy($src, $dst);
				echo "<track kind=\"subtitles\" srclang=\"en-US\" label=\"English\" src=\"$dst\" default>"."\n";
			}
			if(file_exists($subtitlePath.'.cht'.$subtitleExtension)) {
				$src = $subtitlePath.'.cht'.$subtitleExtension;
				$dst = "./subtitle/".substr($moviePath, strrpos($moviePath, "/")).'.cht'.$subtitleExtension;
				copy($src, $dst);
				echo "<track kind=\"subtitles\" srclang=\"zh-TW\" label=\"Chinese\" src=\"$dst\">"."\n";
			}
			if(file_exists($subtitlePath.'.chi'.$subtitleExtension)) {
				$src = $subtitlePath.'.chi'.$subtitleExtension;
				$dst = "./subtitle/".substr($moviePath, strrpos($moviePath, "/")).'.chi'.$subtitleExtension;
				copy($src, $dst);
				echo "<track kind=\"subtitles\" srclang=\"zh-TW\" label=\"Chinese\" src=\"$dst\">"."\n";
			}
			if(file_exists($subtitlePath.$subtitleExtension)) {
				$src = $subtitlePath.$subtitleExtension;
				$dst = "./subtitle/".substr($moviePath, strrpos($moviePath, "/")).$subtitleExtension;
				copy($src, $dst);
				echo "<track kind=\"subtitles\" srclang=\"en-US\" label=\"English\" src=\"$dst\" default>"."\n";
			}
		}
		?>
		Your Web Browser does not support HTML 5 video tag!!
	</video>
	</div>

	<div class="w3-container w3-padding <?php echo $color;?>" style="margin-top: 20px;">
		<footer>
			<h4>Made by Joseph Yu (2015/7/21)</h4>
		</footer>
	</div>
</div>
</body>
