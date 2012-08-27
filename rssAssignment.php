<div class="content">
	<p class="cred" style="color:#FFF;">
   		Note: #To view information about feed click on the " <I>i</I> " symbol<br>
                      #Only post with images will be displayed
	</p>
	<?php include("crop.php");		//Include the image cropping program
   		$rss_tags = array(
			'title',
		);				//array of list of items to be parsed
		$rss_item_tag = 'item';
		$rss_url = $_GET["feed_url"];	//get feed url from text input of previous form
		echo '<pre>';
		if($rss_url==NULL)
			echo 'Sorry no url entered';	//error if url not entered
		else
			rss_to_array($rss_item_tag, $rss_tags, $rss_url);	//function call to display feeds
		echo '</pre>';
		
		function rss_to_array($tag, $array, $url){
			$doc = new DOMdocument();
			$doc->load($url);			//load the feeds as an XML document from file
			$doc2 = file_get_contents($url);	//load the xml file as in string format
			$items = array();			//defining arrays to 
			$pos=0;
  			echo "<div id='galleria'>";
	    		$j=0;
	    			//loop for each "item" tag in document
			foreach($doc->getElementsByTagName($tag) AS $node) {
					//loop for each list of items to parse
				foreach($array AS $key => $value) {
					//parse the title from XML doc
					$items[$value] = $node->getElementsByTagName($value)->item(0)->nodeValue;
				}
				$pos_end = strpos($doc2, "</item", $pos+4);	///find position of next "item" tag
				
				//function call to get address of original image of this post
				$img_source = img_src(substr($doc2, $pos, $pos_end-$pos));
				if($img_source!=""){
					$img_source = img_crop($j, $img_source);	//function to get address of cropped image
					$items["pubDate"] = substr($items[pubDate], 0 , strpos($items[pubDate], ":", 0)-3);
						//display all the titles & images
					echo "<a href='".$img_source."'><img src='".$img_source."' data-link='".$items["link"]."'> </a>";
					echo "<div class='layer'><div><h2>".$items["title"]."</h2><p>Published: ".$items["pubDate"]." <a href='".$items["link"]."'>View blog...</a></p></div></div>";
				}}
				$pos = $pos_end;
				$j++;
			}
			echo "</div>";
		}
	
		//function to fetch the address of the original image
		function img_src($str_pos){
			$pos = strpos($str_pos, "<content", 0);
			if($pos!=false){
				$pos = strpos($str_pos, "<img", $pos);
				if($pos!=false){
					$pos = strpos($str_pos, "src=", $pos);
					if($pos!=false){
							//substring function to fetch the exact address of the image
						$img_src = substr($str_pos, $pos+5, ((strpos($str_pos, "\" ", $pos))-($pos+5)));
					} else
						$img_src = "";
				} else
					$img_src = "";
			} else
				$img_src = "";
			return $img_src;
		}
	?>
	<p class="cred" style="padding: 5px 0 0 0;">
		Made by <a href="#">Hrishikesh A. Vaipurkar</a>.
	</p>
</div>