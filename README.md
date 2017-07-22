# Simple Single Page Soundboard
This code creates a Soundboard on a single page using PHP, Javascript, JQuery, HTML5 and CSS. I was motivated to create this when Soundboard.com ignored my two feature requests. This version is better than Soundboard.com in at least 4 ways:
  1. Loads way faster.
  2. Tablet and Mobile friendly. 
  3. Sorts alphabetically automatically.  
  4. You can play multiple drops simultaneously. 

### ID3 version
The code in index.php will draw the buttons on the soundboard using the file name. The id3.php file usings the getID3 library to read the title and artist. The ID3 title will be used for the button text and the artist will be used for a tooltip on mouseover.

### Getting Started
  1. Create a new folder and place all the MP3 drops you wish to have on the soundboard.
  2. On the top of the index.php file define that folder where is says $mp3directory. 
  3. Deploy to a web server that supports PHP (most do). 

### Some Ideas For Your Soundboard
  1. Search for "CSS Button Generator" to create your own custom super cool looking buttons. Place that CSS into the sb.css file.  
  2. I set the preload: none. This is because I have 200+ drops and want the initial page draw to be fast. Remove this line if you prefer the drops load on page draw and not on play. 
  
## Resources
  1. The ID3 version of the soundboard uses getID3 from James Heinrich. (https://github.com/JamesHeinrich/getID3/)
  2. The ID3 version uses Ballon.CSS for the mouseover tooltips. (https://kazzkiq.github.io/balloon.css/)
  3. The styling for the soundboard buttons were created with help from CSS Button Generator. (http://css3buttongenerator.com/)

### Demo and Sharing
  This is the [Neil Rogers Soundboard](https://neilrogers.org/soundboard/) built using this code. Let me know if you build a Soundboard you would like to share. You can email me the link (digitalcolony@gmail.com) and I'll share it here for others to see. 


  


