<?php

function img_crop($img, $img_src) {
	
	$info = getimagesize($img_src);		//get array to check further the image type
	if($info[2] == IMAGETYPE_JPEG){
		$image = imagecreatefromjpeg($img_src);
	} else if($info[2] == IMAGETYPE_PNG){
		$image = imagecreatefrompng($img_src);
	} else if($info[2] == IMAGETYPE_BMP) {
		$image = imagecreatefromwbmp(bmp($img_src));
	} else if($info[2] == IMAGETYPE_GIF) {
		$image = imagecreatefromgif($img_src);
	}
	$filename = 'images/temp/IMG_'.$img.'.jpg';	//address to store the thumbnail image
	
	$thumb_width = 200;
	$thumb_height = 150;

	$width = imagesx($image);		//get original image width
	$height = imagesy($image);		//get original image height

	$original_aspect = $width / $height;		//get aspect ratio of original image
	$thumb_aspect = $thumb_width / $thumb_height;	//get aspect ratio of thumbnail image

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

	$thumb = imagecreatetruecolor( $thumb_width, $thumb_height);	//create blank thumbnail image

	// Resize and crop original image to thumbnail
	imagecopyresampled($thumb, $image,
                   		0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                   		0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                   		0, 0, $new_width, $new_height, $width, $height);

	//save image thumbnail to new temporary location
	imagejpeg($thumb, $filename, 80);
	return $filename;	//return the address of the new thumbnail image.
}
?>