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
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <script src="dist/id3-minimized.js" type="text/javascript"></script>
  <!-- <script src="dist/sorting.js" type="text/javascript"></script> -->		
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>	
  <script>
  <!-- SORT not working -->
  function sortMP3() {
		$('span').sortElements(function(a, b){
		    return $(a).innerText() > $(b).innerText() ? 1 : -1;
		});
	}
  </script>
  <link rel="stylesheet" type="text/css" href="sb.css">
  <link rel="stylesheet" href="http://neilrogers.org/css/normalize.min.css">
  <link rel="stylesheet" href="http://neilrogers.org/css/main.css">
  <link rel="stylesheet" type="text/css" media="handheld, screen and (max-device-width: 480px)" href="http://neilrogers.org/css/handheld.css">
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">    
</head>

<body>
<div id="soundboard">
</div>	
  
<script type="text/javascript">

	// pass PHP variable declared above to JavaScript variable
	var thisMP3;
	var ar = <?php echo json_encode($mp3) ?>;
	for (var i = 0; i < ar.length; i++) {
	   	thisMP3 = "neil/" + ar[i];	   				
	   	displayMP3(thisMP3,i);    		
	}
	
		
	function displayMP3(url,number){
		ID3.loadTags(url, function(event) {
	    	var tags = ID3.getAllTags(url); 
	    	var thisTitle = tags.title.replace(/-/g,' ') || "";
	    	var thisArtist = tags.artist || "";
	    	  			      		
	      	// build track	      		
			var thisAudio = "<audio id='sound" + number + "' src='" + escape(url) + "'></audio>";
			var thisButton = "<button class='myButton' title='" + thisArtist + "' onclick=\"document.getElementById('sound" + number + "').play()\">" + thisTitle + "</button>";

  			var thisTrackDiv = "<span class='track'>" + thisAudio + thisButton + "</span>";

	      	var soundboard = document.getElementById('soundboard'); 
	      	soundboard.insertAdjacentHTML('beforeend', thisTrackDiv);	
	        	
	    }, {
	      tags: ["title","artist"]
	    });	    
	}

	/**
	 * jQuery.fn.sortElements
	 * --------------
	 * @param Function comparator:
	 *   Exactly the same behaviour as [1,2,3].sort(comparator)
	 *   
	 * @param Function getSortable
	 *   A function that should return the element that is
	 *   to be sorted. The comparator will run on the
	 *   current collection, but you may want the actual
	 *   resulting sort to occur on a parent or another
	 *   associated element.
	 *   
	 *   E.g. $('td').sortElements(comparator, function(){
	 *      return this.parentNode; 
	 *   })
	 *   
	 *   The <td>'s parent (<tr>) will be sorted instead
	 *   of the <td> itself.
	 */
		jQuery.fn.sortElements = (function(){
	 
	    var sort = [].sort;
	 
	    return function(comparator, getSortable) {
	 
	        getSortable = getSortable || function(){return this;};
	 
	        var placements = this.map(function(){
	 
	            var sortElement = getSortable.call(this),
	                parentNode = sortElement.parentNode,
	 
	                // Since the element itself will change position, we have
	                // to have some way of storing its original position in
	                // the DOM. The easiest way is to have a 'flag' node:
	                nextSibling = parentNode.insertBefore(
	                    document.createTextNode(''),
	                    sortElement.nextSibling
	                );
	 
	            return function() {
	 
	                if (parentNode === this) {
	                    throw new Error(
	                        "You can't sort elements if any one is a descendant of another."
	                    );
	                }
	 
	                // Insert before flag:
	                parentNode.insertBefore(this, nextSibling);
	                // Remove flag:
	                parentNode.removeChild(nextSibling);
	 
	            };
	 
	        });
	 
	        return sort.call(this, comparator).each(function(i){
	            placements[i].call(getSortable.call(this));
	        });
	 
	    };
	 
	})();
	</script>
</body>
</html>
