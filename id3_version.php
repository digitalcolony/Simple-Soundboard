<?php
	$configs = include("config.php");
	$mp3directory = $configs->MP3_DIRECTORY;

    $mp3 = array();
	require_once('getID3/getid3.php');
	$getid3_engine = new getID3;
	// confirm directory exists 
	if (file_exists($mp3directory)) {
		// build an array of MP3 files 
		$it = new RecursiveDirectoryIterator(realpath($mp3directory));

		foreach(new RecursiveIteratorIterator($it) as $fileinfo) {
			if ($fileinfo->isFile()) {
				$extension = $fileinfo->getExtension();
				if($extension == "mp3"){		
                    $id3_info = $getid3_engine->analyze($fileinfo);
                    getid3_lib::CopyTagsToComments($id3_info);                         					
					$file_title = htmlentities(!empty($id3_info['comments_html']['title']) ? 
						implode('<br>', $id3_info['comments_html']['title'])         : "");
					$file_artist = htmlentities(!empty($id3_info['comments_html']['artist']) ? 
						implode('<br>', $id3_info['comments_html']['artist'])         : "");
					// Not sure why, but getting a double quote to display right required a double decode.
					$file_title = html_entity_decode(html_entity_decode($file_title));
					$file_artist = html_entity_decode(html_entity_decode($file_artist));
					
                    $file_name = $fileinfo->getFilename();
                    if($file_title == ""){
                        $file_title = str_replace(".mp3","",$file_name);
                    }
                    $mp3[] = $file_title."___".$file_name."___".$file_artist;				
				}
			}			 
		}		
		if(count($mp3) == 0){
			echo "<br>ERROR: There are no MP3 files in the  [". $mp3directory ."] directory. Add one or more and try again.";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.4.0/balloon.min.css">
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
		ar.map(function(fileWithTitle){
			$('#soundboard').append(function(){
                // split fileWithtitle to get filename and button text
               	var sound = fileWithTitle.split("___");
            	var buttonText = sound[0];
				var url = sound[1];   
				var artist = sound[2]         	
				var thisAudio = $('<audio/>').attr({
					src: BASE_AUDIO_PATH + url,
					preload: "<?php echo($configs->PRELOAD_AUDIO); ?>",
					onplay:"$(this).siblings('button').css('color', 'yellow');",
					onended: "$(this).siblings('button').css('color', 'white');"	
					}) 	
				// if artist is known, add to tooltip via the data-ballon
				var thisButton;
				if(artist != ""){
					//artist = artist.replace('&amp;','').replace('&quot;','');
					thisButton = $('<button />').addClass('myButton').text(buttonText).attr("data-balloon", artist).attr("data-balloon-pos","down");	
				} else {
					thisButton = $('<button />').addClass('myButton').text(buttonText);	
				}
				
						 		
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
