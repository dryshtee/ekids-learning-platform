var tag = document.createElement('script');
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;

function onYouTubeIframeAPIReady() {
	player = new YT.Player('videoembed', {
		
		videoId: '',
		
		playerVars: {'autoplay': 1,'controls': 1,'showinfo':0},
		
		events: {
			'onReady': onPlayerReady,
		}
	});
}

var ready = false;
function onPlayerReady(event){
	ready= true;
}

function myVideoLink(myLink) {
theLink=myLink;
var processedURL=theSubsetFunction();
	player.loadVideoByUrl('"'+processedURL+'"');
	 
}

var theLink;

function theSubsetFunction(){
var videoID=theLink;

var right_text = videoID.substring(videoID.indexOf("=")+1);

var firstPart="https://www.youtube.com/v/";
var lastPart="?version=3";
var finalLink=firstPart+right_text+lastPart;

return finalLink
}


