<?php


namespace JW3B\erday;

class Helpful_Images {

	public static function get_large_img($img){
		$base = basename($img);
		$large_img = str_replace($base, 'l'.substr($base, 1), $img);
		return $large_img;
	}

	public static function get_mime_type($file){
		switch($file['type']){
			case "image/jpeg":
			case "image/jpg":
			case "image/pjpeg":
				return 'j';
			case "image/webp":
				return 'w';
			case "image/png":
			case "image/x-png":
				return 'p';
			case "image/gif":
				return 'g';
			default:
				return 'Incorrect file type uploaded. Only png, gif, and jpg files are supported.';
		}
	}


	/** Converts image to webp image
	 *
	 * @param string $source - path to original image
	 * @param int $quality - 0-100 - 0 being low quality 100 being the best quality
	 * @param bool $removeOld - removes original image
	 * @return string path/to/image.webp
	 */
	public static function webpImage($source, $quality = 75, $removeOld = false){
		$dir = pathinfo($source, PATHINFO_DIRNAME);
		$name = pathinfo($source, PATHINFO_FILENAME);
		$destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
		$info = getimagesize($source);
		$isAlpha = false;
		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source);
		elseif ($isAlpha = $info['mime'] == 'image/gif') {
			$image = imagecreatefromgif($source);
		} elseif ($isAlpha = $info['mime'] == 'image/png') {
			$image = imagecreatefrompng($source);
		} else {
			return $source;
		}
		if($isAlpha){
			imagepalettetotruecolor($image);
			imagealphablending($image, true);
			imagesavealpha($image, true);
		}
		imagewebp($image, $destination, $quality);
		if ($removeOld && is_file($destination)) unlink($source);
		return $destination;
	}

	public function resize_uploaded_image($file, $destination, $sizes=array('s' => '300', 'l' => '800')){
		if($file['error'] == 0){
			switch($file['type']){
				case "image/jpeg":
				case "image/jpg":
				case "image/pjpeg":
					$ext = '.jpg';
					break;
				case "image/png":
				case "image/x-png":
					$ext = '.png';
					break;
				case "image/gif":
					$ext = '.gif';
					break;
				default:
					return 'Incorrect file type uploaded. Only png, gif, and jpg files are supported.';
			}
			$filename = preg_replace('/[^a-zA-Z0-9\._]/i', '', $file['name']);
			$year = date('Y', time());
			$month = date('n', time());
			if(!is_dir($destination.$year.'/')){
				@mkdir($destination.$year.'/', 0777);
			}
			if(!is_dir($destination.$year.'/'.$month.'/')){
				@mkdir($destination.$year.'/'.$month.'/', 0777);
			}
			$dir = $destination.$year.'/'.$month.'/';
			if(is_file($dir.$filename)){
				$n = 0;
				for(;;){
					if(!is_file($dir.$n.$filename)){
						$filename = $n.$filename;
						break;
					}
					$n++;
				}
			}
			move_uploaded_file($file['tmp_name'], $dir.$filename);
			list($width, $height, $typeM, $attr) = getimagesize($dir.$filename);
			$total_sizes = count($sizes);
			$created = array();
			foreach($sizes as $pre => $size){
				$new_file = $total_sizes > 1 ? $dir.$pre.'_'.$filename : $dir.$filename;
				if($width > $size || $height > $size){
					system("convert ".$dir.$filename." -resize ".$size."x".$size." -quality 100 ".$new_file);
				} else if($new_file != $dir.$filename){
					copy($dir.$filename, $new_file);
				}
				$created[$pre] = $new_file;
			}
			$not_found = false;
			foreach($created as $file2){
				if($file2 != '' && !is_file($file2)){
					$not_found = true;
				}
			}
			if($not_found == true){
				return 'error - '.$file2.' is not found';
			} else {
				return $created;
			}
		} else {
			return 'Looks like there was an error uploading this file.';
		}
	}
}