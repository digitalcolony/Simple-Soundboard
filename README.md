# Simple Single Page Soundboard

This code creates a Soundboard on a single page using PHP, Javascript, JQuery, HTML5, and CSS. I was motivated to create this when Soundboard.com ignored my two feature requests. This version is better than Soundboard.com in at least 4 ways:

  1. Loads way faster.
  1. Tablet and Mobile friendly.
  1. Sorts alphabetically automatically.
  1. You can play multiple drops simultaneously.

## Getting Started

1. Create a new folder and place all the MP3 drops you wish to have on the soundboard. For this repo, I've added 20 drops to get you started.
1. Update the settings in the **config.php** file. This includes the name of the drops folder, title of the Soundboard, and how you want the sound files to preload.
1. Deploy to a web server that supports PHP (most do).

## Filename version (original version)

If you want the buttons to draw their names using the filename, use the **filename_version.php** page for your Simple Soundboard. To display a ? on the button use [Q] in the file name. 

Example: **why[Q].mp3**.

## ID3 version

If your MP3 files have Titles defined in the ID3 tags, you will want to use the **id3_version.php** page for your Simple Soundboard. The code will draw the buttons on the soundboard using the getID3 library to read the title and artist. The ID3 title will be used for the button text and the artist will be used for a tooltip on mouseover.

This is the better version to use. If you need a tool to help you edit the ID3 tags of your MP3 files so they all have titles, look into [Mp3Tag](https://www.mp3tag.de/en/). Artist is optional. Drops without an artist will not have a tooltip.

## Some Ideas For Your Soundboard

1. Search for "CSS Button Generator" to create your own custom super cool looking buttons. Place that CSS into the sb.css file.
1. I set the preload: **none**. This is because I have 200+ drops and want the initial page draw to be fast. If you have a small number of drops or know that your users all have fast connections, set the preload to **auto**.

## Resources

1. The ID3 version of the soundboard uses [getID3](https://github.com/JamesHeinrich/getID3/) from James Heinrich.
1. The ID3 version uses [Ballon.CSS](https://kazzkiq.github.io/balloon.css/) for the mouseover tooltips.
1. The styling for the soundboard buttons were created with help from [CSS Button Generator](http://css3buttongenerator.com/).

## Demo and Sharing

This is the [Neil Rogers Soundboard](https://neilrogers.org/soundboard/) built using this code. Let me know if you build a Soundboard you would like to share. You can [email me](digitalcolony@gmail.com) the link and I'll share it here for others to see.