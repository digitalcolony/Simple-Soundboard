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
  <meta name="description" content="Neil Rogers Soundboard">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>	  
  <link rel="stylesheet" type="text/css" href="sb.css">
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">    
</head>

<body>
<div id="soundboard">
</div>	
  
<script type="text/javascript">
	// pass PHP variable declared above to JavaScript variable
	var ar = <?php echo json_encode($mp3) ?>;
	var BASE_AUDIO_PATH = 'neil/';
	ar.sort();

	ar.map(function(url){
		$('#soundboard').append(function(){
			var thisAudio = $('<audio/>').attr({
				src: BASE_AUDIO_PATH + url,
				preload: "none"
				});	
			var buttonText = url.replace(/-/g, ' ').replace('.mp3', '');
			var thisButton = $('<button />').addClass('myButton').text(buttonText);
			return $('<span />').addClass('track').append(thisAudio).append(thisButton);
		})
	});

		$('#soundboard').on( 'click', 'button', function() {			
			$(this).siblings('audio').get(0).play();			
			$(this).css('color','yellow');		
		});
	</script>
</body>
</html>
