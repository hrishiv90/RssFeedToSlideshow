function update() {
	url=document.getElementById("feed_url").value;
	if(url=="") {
		alert("Please Enter Proper URL !!");
	}else {
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
				document.getElementById("assign").innerHTML=xmlhttp.responseText;
				document.getElementById("assign").style.display="none";
				$("#assign").slideToggle("slow");
					//Run SlideShow 
				Galleria.run('#galleria');
			}
		}
		xmlhttp.open("GET","rssAssignment.php?feed_url="+url,true);
		xmlhttp.send();
	}
}