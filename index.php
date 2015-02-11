<?php
	$mp3 = array();
	$mp3directory = 'neil';
	
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
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" /> 
	<meta property="og:title" content="Soundboard for Radio's Neil Rogers" />
	<meta property="og:image" content="/img/neil-mask-radio.jpg" />	
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
        <script>
            var _gaq = [['_setAccount', 'UA-1744925-10'], ['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
</body>
</html>
