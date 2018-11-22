<?php
    $configs = include("config.php");
    $mp3directory = $configs->MP3_DIRECTORY;
    $json_file = $configs->JSON_FILENAME;
   
    $files = array();
    $sounds = array();
    require_once('getID3/getid3.php');
    $getid3_engine = new getID3;
    // confirm directory exists 
    if (is_dir($mp3directory)) {
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
                    $file_name = $mp3directory . $fileinfo->getFilename();
                    // Remove .. from path for Soundboard loading
                    $file_name = str_replace("../","/", $file_name);
                    if($file_title == ""){
                        $file_title = str_replace(".mp3","",$file_name);
                    }

                    $sounds[] = array('name'=> $file_title, 
                            'artist'=> $file_artist,
                            'mp3'=> $file_name);
                }
            }			 
        }		
        if(count($sounds) == 0){
            echo "<br>ERROR: There are no MP3 files in the  [". $mp3directory ."] directory. Add one or more and try again.";
            exit();
        }
    } else {
        echo "ERROR: Directory defined [". $mp3directory ."] is either undefined or does not exist.";
        exit();
    }
    // sort drops alphabetically 
    sort($sounds);
    $files['files'] = $sounds;
    $fp = fopen($json_file, 'w');
    fwrite($fp, json_encode($files));
    fclose($fp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Soundboard JSON Built</title>
</head>
<body>
    <p>Simple Soundboard JSON Built successfully!</p>
    <p>Visit your <a href="<?php echo($configs->SOUNDBOARD_PAGE) ?>">Soundboard</a>.</p>

    <p></p>
</body>
</html>