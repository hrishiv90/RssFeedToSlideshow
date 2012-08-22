<div class="content">
	<p class="cred" style="color:#FFF;">
   		Note: #To view information about feed click on the " <I>i</I> " symbol<br>
                      #Only post with images will be displayed
	</p>
	<?php include("crop.php");
   		$rss_tags = array(
			'title',
		);
		$rss_item_tag = 'item';
		$rss_url = $_GET["feed_url"];
		echo '<pre>';
		if($rss_url==NULL)
			echo 'Sorry no url entered';
		else
			rss_to_array($rss_item_tag, $rss_tags, $rss_url);
		echo '</pre>';
		
		function rss_to_array($tag, $array, $url){
			$doc = new DOMdocument();
			$doc->load($url);
			$doc2 = file_get_contents($url);
			$items = array();
			$items_img = array();
			$pos=0;
  			echo "<div id='galleria'>";
	    		$j=0;
			foreach($doc->getElementsByTagName($tag) AS $node) {
				foreach($array AS $key => $value) {
					$items[$value] = $node->getElementsByTagName($value)->item(0)->nodeValue;
				}
				$pos_end = strpos($doc2, "</item", $pos+4);
				$img_source = img_src(substr($doc2, $pos, $pos_end-$pos));
				if($img_source!=""){
					$img_source = img_crop($j, $img_source);
					echo "<a href='".$img_source."'><img data-title='".$items[$value]."' src='".$img_source."'> </a>";
				}
				$pos = $pos_end;
				$j++;
			}
			echo "</div>";
		}
	
		function img_src($str_pos){
			$pos = strpos($str_pos, "<content", 0);
			if($pos!=false){
				$pos = strpos($str_pos, "<img", $pos);
				if($pos!=false){
					$pos = strpos($str_pos, "src=", $pos);
					if($pos!=false){
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