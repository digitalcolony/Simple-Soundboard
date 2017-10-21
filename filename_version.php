<?php
	$configs = include("config.php");
	$mp3directory = $configs->MP3_DIRECTORY;
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
	// sort drops alphabetically
	sort($mp3);
?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<title><?php echo($configs->PAGE_TITLE); ?></title>
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

		// Add <audio> files and buttons to soundboard
		// preload set to "none" is optional
		ar.map(function(url){
			$('#soundboard').append(function(){
				var thisAudio = $('<audio/>').attr({
					src: BASE_AUDIO_PATH + url,
					preload: "<?php echo($configs->PRELOAD_AUDIO); ?>",
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
