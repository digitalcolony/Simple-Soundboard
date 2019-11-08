# Simple Single Page Soundboard

This code creates a Soundboard on a single HTML page that loads a JSON file. It uses Javascript, JQuery, HTML5, and CSS. The JSON file can be created by hand or built using PHP. I was motivated to create this in 2015 when Soundboard.com ignored my two feature requests. This version is better than Soundboard.com in at least 4 ways:

1.  Loads way faster.
1.  Tablet and Mobile friendly.
1.  Sorts alphabetically automatically.
1.  You can play multiple drops simultaneously. (optional)

The original version required PHP. Now you can use PHP to build the JSON file of your Soundboard files, but it is not required.

## 2019 Update

You can now filter the drops with the text input. It will search track titles and artists.

## Getting Started

1.  Create a new folder and place all the MP3 drops you wish to have on the soundboard. For this repo, I've added 20 drops to get you started.
1.  Create or build a JSON file with the sound drops. I'll explain the format in the next section of this README.
1.  Add a link to the JSON file on the Soundboard page. (EX: url: "./inc/json/soundboard.json")
1.  Set the variable **_playOnlyOneSoundAtATime_** to true or false inside the javascript.
1.  Deploy to any web server.

## JSON Format

The Soundboard JSON file is a collection of files. Each file will have a name, duration, and mp3 file path. Duration is not used at this time, but could be in the future. The files do not have to be local. Any valid URL pointing to an MP3 file will work, provided that the host allows direct linking to audio files.

```javascript
{
  "files": [
    {
      "name": "1 to 12 hour - Boca Britany Somers",
      "mp3":
        "/sounds/1-to-12-hour.mp3"
    },
    {
      "name": "2 of the Dumbest White Men - Mike Reineri",
      "mp3":
        "/sounds/2-of-the-Dumbest-White-Men.mp3"
    }
  ]
}
```

## Creating the JSON file

You can create the JSON file a few different ways.

1.  By hand. With any editor, you can type up your own JSON file that describes your Soundboard. This is perfect if where you want to host the Soundboard does not support server-side code.
1.  With PHP. Included in this repo is PHP code that will build the JSON file for you. PHP is widely supported with web hosts.
1.  NodeJS. The filename version is now completed. The ID3 version is yet to be coded.

## Building the JSON with PHP

There are 2 ways to build the JSON file using PHP.

1.  Filename: If you want the buttons to draw their names using the filename, use the **buildJSON_filename.php** page for your Simple Soundboard. To display a ? on the button use [Q] in the file name. Example: **why[Q].mp3**.
1.  ID3: If your MP3 files have Titles defined in the ID3 tags, you will want to use the **buildJSON_id3.php** page for your Simple Soundboard. The code will draw the buttons on the soundboard using the getID3 library to read the title and artist. The ID3 title will be used for the button text and the artist will be used for a tooltip on mouseover.

The ID3 version is the better version to use. If you need a tool to help you edit the ID3 tags of your MP3 files so they all have titles, look into [Mp3Tag](https://www.mp3tag.de/en/). Artist is optional. Drops without an artist will not have a tooltip.

## Building the JSON with NodeJS

1.  Filename: If you want the buttons to draw their names using the filename, use the **json_filename.js** page for your Simple Soundboard. To display a ? on the button use [Q] in the file name. Example: **why[Q].mp3**. From the node/ folder run node json_filename.js.

1.  ID3: Not coded yet.

## Some Ideas For Your Soundboard

1.  Search for "CSS Button Generator" to create your own custom super cool looking buttons. Place that CSS into the sb.css file.
1.  Set the preload to **none** if you have a lot of drops or the drops are larger files to improve load time. If you have a small number of drops or know that your users all have fast connections, set the preload to **auto**.

## Resources

1.  The ID3 version of the soundboard uses [getID3](https://github.com/JamesHeinrich/getID3/) from James Heinrich.
1.  The ID3 version uses [Ballon.CSS](https://kazzkiq.github.io/balloon.css/) for the mouseover tooltips.
1.  The styling for the soundboard buttons were created with help from [CSS Button Generator](http://css3buttongenerator.com/).

## Demo and Sharing

This is the [Neil Rogers Soundboard](https://neilrogers.org/soundboard/) built using this code. Let me know if you build a Soundboard you would like to share. You can email me (digitalcolony@gmail.com) the link and I'll share it here for others to see.

## Future Development

1.  Create Node.JS ID3 version

1.  Move JQuery to Vanilla JS
