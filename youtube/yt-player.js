var player;

var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function myFunction() {
	/*document.getElementById("video1").innerHTML = "<div id='videoembed'></div>";

	var tag = document.createElement("script");

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName("script")[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);*/
	
	
	var processedURL=theSubsetFunction();
	player.loadVideoByUrl('"'+processedURL+'"');
}

function onYouTubeIframeAPIReady() {
	player = new YT.Player("videoembed", {
		height: "360",
		width: "640",
		//videoId: "2t9NsrJZu2o",
		//ZZslUAjj21w
		//https://youtu.be/ZZslUAjj21w
		
		events: {
			
			onReady: onPlayerReady
		}
	});
}

/*function onPlayerReady(event) {
	event.target.playVideo();
}*/

function onPlayerReady(){
	//well, well, well. This is a test link: https://www.youtube.com/v/2t9NsrJZu2o?version=3
	//var firstPart="https://www.youtube.com/v/";
	//var lastPart="?version=3";
	
	var processedURL=theSubsetFunction();
	//var newUrl=document.getElementById("txtFormattedUrl").value;
	
	
	
	//var finalLink=firstPart+videoID+videoID;
	//alert(finalLink);
	//alert(document.getElementById("txtVideoId").value);
    //player.loadVideoByUrl("https://www.youtube.com/v/2t9NsrJZu2o?version=3");
	 //player.loadVideoByUrl('"'+processedURL+'"');
     player.playVideo();
}

function theSubsetFunction(){
	//https://www.youtube.com/watch?v=NvR60Wg9R7Q
	//https://www.youtube.com/v/NvR60Wg9R7Q?version=3
	//alert("here");
	var videoID=document.getElementById("txtVideoId").value;
	var right_text = videoID.substring(videoID.indexOf("=")+1);
	
	var firstPart="https://www.youtube.com/v/";
	var lastPart="?version=3";
	var finalLink=firstPart+right_text+lastPart;
	
	//document.getElementById("txtFormattedUrl").value=finalLink;
	//alert(right_text);
	return finalLink
}

