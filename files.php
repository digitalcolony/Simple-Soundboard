<?php
$mp3 = array();
 
$directory = new DirectoryIterator('neil');
foreach ($directory as $fileinfo) {
	if ($fileinfo->isFile()) {
		$extension = $fileinfo->getExtension();
		if($extension == "mp3"){
			$mp3[] = $fileinfo->getFilename();
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Neil Rogers Soundboard</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <script src="dist/id3-minimized.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>	
  
  <link rel="stylesheet" type="text/css" href="sb.css">
  <link rel="stylesheet" href="http://neilrogers.org/css/normalize.min.css">
  <link rel="stylesheet" href="http://neilrogers.org/css/main.css">
  <link rel="stylesheet" type="text/css" media="handheld, screen and (max-device-width: 480px)" href="http://neilrogers.org/css/handheld.css">
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">    
</head>

<body>
<div id="soundboard">
</div>	
  
<script type="text/javascript">

	// pass PHP variable declared above to JavaScript variable
	var thisMP3;
	var ar = <?php echo json_encode($mp3) ?>;


	var arTracks = new Array();
	for (var i = 0; i < ar.length; i++) {
	   	thisMP3 = "neil/" + ar[i];	   				
	   	displayMP3(thisMP3,i);    		
	}
	//alert(arTracks.length);
	arTracks.sort();
	for (var i = 0; i < arTracks.length; i++) {
		thisTrack = arTracks[i];
		var thisTrackDiv = "<span class='track'>" + thisTrack + "</span>";
	  	var soundboard = document.getElementById('soundboard'); 
	  	soundboard.insertAdjacentHTML('beforeend', thisTrackDiv);		
	}
	// build track	    
	/*  		
	var thisAudio = "<audio id='sound" + number + "' src='" + escape(url) + "'></audio>";
	var thisButton = "<button class='myButton' title='" + thisArtist + "' onclick=\"document.getElementById('sound" + number + "').play()\">" + thisTitle + "</button>";
	var thisTrackDiv = "<span class='track'>" + thisAudio + thisButton + "</span>";
  	var soundboard = document.getElementById('soundboard'); 
  	soundboard.insertAdjacentHTML('beforeend', thisTrackDiv);	
	*/
	function displayMP3(url,number){
		alert(number);
		ID3.loadTags(url, function(event) {
	    	var tags = ID3.getAllTags(url); 
	    	var thisTitle = tags.title.replace(/-/g,' ') || "";
	    	var thisArtist = tags.artist || "";
	    	arTracks.push(thisTitle + '|' + thisArtist);  			      		      		
	    }, {
	      tags: ["title","artist"]
	    });	    
	}

	

	
	</script>
</body>
</html>
