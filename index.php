<?php
	/* SETUP: 
		Enter folder where sounds are besides the $mp3directory assignment below. 
		If the sounds are in same folder as code the directory will be a period (.) 
	*/
	$mp3directory = 'sounds';
	$mp3 = array();

	// confirm directory exists 
	if (file_exists($mp3directory)) {
		// build an array of MP3 files 
		$directory = new DirectoryIterator($mp3directory);
		foreach ($directory as $fileinfo) {
			if ($fileinfo->isFile()) {
				$extension = $fileinfo->getExtension();
				if($extension == "mp3"){
					$mp3[] = $fileinfo->getFilename();
				}
			}
		}		
		if(count($mp3) == 0){
			echo "ERROR: There are no MP3 files in the  [". $mp3directory ."] directory. Add one or more and try again.";
			exit();
		}
	} else {
		echo "ERROR: Directory defined [". $mp3directory ."] does not exist.";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<title>Simple Soundboard</title>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<meta name="description" content="Simple Soundboard">
  	<meta name="viewport" content="width=device-width">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	  
  	<link rel="stylesheet" type="text/css" href="sb.css">
  	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">   			
</head>

<body>
	<div id="soundboard">
	</div>	
	
	<script type="text/javascript">
		// pass PHP array of MP3 files declared above to JavaScript variable
		var ar = <?php echo json_encode($mp3) ?>;
		var BASE_AUDIO_PATH = '' + <?php echo json_encode($mp3directory) ?> + '/';

		// sort files to be in alphabetical order by title
		ar.sort(function (a, b) {
			return a.toLowerCase().localeCompare(b.toLowerCase());
		});

		// Add <audio> files and buttons to soundboard
		// preload set to "none" is optional
		ar.map(function(url){
			$('#soundboard').append(function(){
				var thisAudio = $('<audio/>').attr({
					src: BASE_AUDIO_PATH + url,
					preload: "none",
					onplay:"$(this).siblings('button').css('color', 'yellow');",
					onended: "$(this).siblings('button').css('color', 'white');"	
					}) 	
				var buttonText = url.replace(/-/g, ' ').replace('.mp3', '').replace('[Q]','?');			
				var thisButton = $('<button />').addClass('myButton').text(buttonText);			 		
				return $('<span />').addClass('track').append(thisAudio).append(thisButton);
			})
		});
		$('#soundboard').on( 'click', 'button', function() {			
			$(this).siblings('audio').get(0).play();							
		});				
		</script>

	<div id="footer">
		<p><strong><a href="/">HOME</a></strong></p>
	</div>        
</body>
</html>
