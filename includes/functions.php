<?php 

function resizeImage($file, $folder, $newWidth){

	list($width, $height) = getimagesize($file);

	$imgRatio = $width/$height;

	$newHeight = $newWidth/$imgRatio;

	//echo "$width | $height | $imgRatio"; //testing 

	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	$source = imagecreatefromjpeg($file);

	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

	$newFileName = $folder . $_FILES['myfile']['name'];

	imagejpeg($thumb, $newFileName, 80);

	imagedestroy($thumb);
	imagedestroy($source);

}


function resizeImagePNG($file, $folder, $newWidth){

	list($width, $height) = getimagesize($file);

	$imgRatio = $width/$height;

	$newHeight = $newWidth/$imgRatio;

	//echo "$width | $height | $imgRatio"; //testing 

	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	$source = imagecreatefrompng($file);

	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

	$newFileName = $folder . $_FILES['myfile']['name'];

	$q=9/100;
	$quality*=$q;
	imagepng($thumb, $newFileName, $quality);

	imagedestroy($thumb);
	imagedestroy($source);

}







 ?>