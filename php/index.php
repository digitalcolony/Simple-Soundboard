<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Build Simple Soundboard JSON File</title>
</head>
<body>
    <h1>Build Simple Soundboard JSON File</h1>
    <ul>
        <li><a href="buildJSON_filename.php">File Name Version</a> - Use [Q] for ? and dashes will be replaced with spaces.</li>
        <li><a href="buildJSON_id3.php">ID3 Version</a> - Use a tool such as <a href="https://www.mp3tag.de/en/">MP3Tag</a> to update the ID3 fields of your MP3s.</li>
    </ul>
<?php 
 $configs = include("config.php");
 $mp3directory = $configs->MP3_DIRECTORY;
 $json_file = $configs->JSON_FILENAME;
 date_default_timezone_set($configs->TIME_ZONE);

       if(is_dir($mp3directory)){
        echo("<p>MP3 Directory [".$mp3directory."] exists.</p>");
        if(is_file($json_file)){
            echo("<p>JSON File [".$json_file."] was last built at ".date ("F d Y H:i:s", filemtime($json_file)).".</p>");
        } else {
            echo("<p>JSON File [".$json_file."] has not been created.</p>");
        }
    } else {
        echo("<p>MP3 Directory [".$mp3directory."] DOES NOT exist.</p>");
    }
    ?>
</body>
</html>