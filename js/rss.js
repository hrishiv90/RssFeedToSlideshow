function update() {
	url=document.getElementById("feed_url").value;		//Get Url from text input
	if(url=="") {						// check whether or not Url is entered properly
		alert("Please Enter Proper URL !!");
	}else {
			//show loading notification for ajax working
		document.getElementById("assign").innerHTML="<img alt='Loading' src='images/loader.gif'>";
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if(xmlhttp.readyState==4 && xmlhttp.status==200) {
					//Initialize Galleria Theme
				Galleria.loadTheme('galleria.classic.min.js');
					//display the feeds to the slideshow in its area
				document.getElementById("assign").innerHTML=xmlhttp.responseText;
				document.getElementById("assign").style.display="none";
				$("#assign").slideToggle("slow");
					//Run SlideShow 
				Galleria.run('#galleria');
			}
		}
		xmlhttp.open("GET","rssAssignment.php?feed_url="+url,true);	//load the feeds and slideshow to display
		xmlhttp.send();
	}
}