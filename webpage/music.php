<?php 
	$shuffle="off";
	$bySize="off";
	$size[]=array();
    if(isset($_REQUEST['playlist'])){
    	$variablito=TRUE;
    	$txtlist=array();
        $playlist = $_REQUEST['playlist'];
        $lines = file($playlist, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line){            
            if ($line[0] === '#') continue;
            else
            $songlist[] = $line;
        }
    } else{
        $songlist = glob("songs\*.mp3");
        $txtlist = glob("songs\*.m3u");
        $variablito=FALSE;
    }
    if(isset($_REQUEST['shuffle'])){
    	shuffle($songlist);
    	$shuffle="on";
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="http://www.cs.washington.edu/education/courses/cse190m/09sp/labs/3-music/viewer.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<div id="header">
			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

		<div id="listarea">
			<?if($variablito==TRUE)
		{ ?>
			<a href= "music.php">Back Link</a><?
		}?>
		<ul id="musiclist">
<?php
foreach ($songlist as $songfile) {
	if ($variablito==TRUE)
		$size=filesize("songs\\" . $songfile);
	else
		$size =filesize($songfile);
	if ($size<=1023) {
		$size .= " b";
	}
	if ($size>=1024 and $size<=1048575) {
		$size=round($size/1024,2);
		$size .= " kb";
	}
	if ($size>=1048576) {
		$size=round($size/1048576,2);
		$size .= " mb";
	}
?>
<li class="mp3item"><a href=" <?=$songfile?>"> <?= basename($songfile)?>
</a> 
<?="({$size})"?>
</li>
<?php
}
foreach ($txtlist as $txtfile) {
?>
<li class="playlistitem">
	<a href=" music.php?playlist=<?=$txtfile?>"> 
		<?= basename($txtfile);?>	
</a> 
</li>

<?php
}
?>
<a href= "music.php?shuffle=on">Shuffle</a><br>
<?php 
if ($shuffle=="on")
	{
		?>
		<a href= "music.php">Shuffle Off</a>
	<?php
}
?>
</div>
</ul>
</body></html>

