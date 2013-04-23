<?php
class ImgHelper
{
	public static function resize($file, $w, $h, $crop = false)
	{
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*($r-$w/$h)));
			} else {
				$height = ceil($height-($height*($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		if($ext == 'jpeg' || $ext == 'jpg') {
			$src = imagecreatefromjpeg($file);
		} elseif($ext == 'gif') {
			$src = imagecreatefromgif($file);
		} elseif($ext == 'png') {
			$src = imagecreatefrompng($file);
		} else {
			return false;
		}

		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		if($ext == 'jpeg' || $ext == 'jpg') {
			imagejpeg($dst, $file, 100);
		} elseif($ext == 'gif') {
			imagegif($dst, $file);
		} elseif($ext == 'png') {
			imagepng($dst, $file, 0);
		}
	}
}