<?php

function img_crop($img, $img_src) {
	
	$info = getimagesize($img_src);
	if($info[2] == IMAGETYPE_JPEG){
		$image = imagecreatefromjpeg($img_src);
	} else if($info[2] == IMAGETYPE_PNG){
		$image = imagecreatefrompng($img_src);
	} else if($info[2] == IMAGETYPE_BMP) {
		$image = imagecreatefromwbmp(bmp($img_src));
	} else if($info[2] == IMAGETYPE_GIF) {
		$image = imagecreatefromgif($img_src);
	}
	$filename = 'images/temp/IMG_'.$img.'.jpg';
	
	$thumb_width = 250;
	$thumb_height = 190;

	$width = imagesx($image);
	$height = imagesy($image);

	$original_aspect = $width / $height;
	$thumb_aspect = $thumb_width / $thumb_height;

	if($original_aspect >= $thumb_aspect)
	{
   	// If image is wider than thumbnail (in aspect ratio sense)
   		$new_height = $thumb_height;
   		$new_width = $width / ($height / $thumb_height);
	}
	else
	{
   	// If the thumbnail is wider than the image
   		$new_width = $thumb_width;
   		$new_height = $height / ($width / $thumb_width);
	}

	$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

// Resize and crop
	imagecopyresampled($thumb, $image,
                   		0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                   		0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                   		0, 0, $new_width, $new_height, $width, $height);

	imagejpeg($thumb, $filename, 80);
	return $filename;
}
?>