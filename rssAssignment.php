<style>
	/* Demo styles */
	html,body{background:#222;margin:0;}
	body{border-top:4px solid #000;}
      	.content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
    	h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
   	p{margin:0 0 20px}
    	a{color:#22BCB9;text-decoration:none;}
    	.cred{margin-top:20px;font-size:12px;}

    	/* This rule is read by Galleria to define the gallery height: */
    	#galleria{height:320px}
</style>

<!-- load jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<!-- load Galleria -->
<script src="js/galleria-1.2.8.min.js"></script>

<script>
	// Load the classic theme
	Galleria.loadTheme('galleria.classic.min.js');

    	// Initialize Galleria
    	Galleria.run('#galleria');
</script>

<div class="content">
	<center>
    		<p class="cred" style="color:#FFF;">
        		Note: To view information about feed click on the " <b><I>i</I></b> " symbol
        	</p>
    	</center>
	<?php
    		$rss_tags = array(
			'title',
		);
		$rss_item_tag = 'item';
		$rss_url = 'http://devilsworkshop.org/feed/';
		echo '<pre>';
		$rssfeed = rss_to_array($rss_item_tag, $rss_tags, $rss_url);
		echo '</pre>';
		
		function rss_to_array($tag, $array, $url){
			$doc = new DOMdocument();
			$doc->load($url);
			$doc2 = file_get_contents($url);
			$rss_array = array();
			$items = array();
			$items_img = array();
			$pos=0;
  			echo "<div id='galleria'>";
		      	$i=0;
			$j=0;
			 
			foreach($doc->getElementsByTagName($tag) AS $node) {
				foreach($array AS $key => $value) {
	  				$items[$i] = $node->getElementsByTagName($value)->item(0)->nodeValue;
	  			}
			$pos_end = strpos($doc2, "</item", $pos+5);
			$img_source = img_src(substr($doc2, $pos, $pos_end));
			echo "<a href='".$img_source."'><img data-title='".$items[$i]."' src='".$img_source."'> </a>";
			$pos = $pos_end;
			$j++;
			array_push($rss_array, $items);
			}
		}
	
		function img_src($str_pos){
			$pos = strpos($str_pos, "<content", 0);
			$pos = strpos($str_pos, "<img", $pos);
			$pos = strpos($str_pos, "src=", $pos);
			$img_src = substr($str_pos, $pos+5, ((strpos($str_pos, "\" ", $pos))-($pos+5)));
			return $img_src;
		}
	?>
	</div>
	<center>
    		<p class="cred" style="padding: 5px 0 0 37%;">
        		Made by <a href="#" style="padding-left:0;">Hrishikesh A. Vaipurkar</a>.
        	</p>
    	</center>
</div>