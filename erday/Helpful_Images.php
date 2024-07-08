<?php


namespace JW3B\erday;
use JW3B\erday\Helpful_Files;

class Helpful_Images {

	public $magick = 'magick';

	public static function get_large_img($img){
		$base = basename($img);
		$large_img = str_replace($base, 'l'.substr($base, 1), $img);
		return $large_img;
	}

	public function set_im($val){
		$this->magick = $val;
		return $this;
	}

	public static function get_mime_type($file){
		switch($file['type']){
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				return 'jpg';
			case "image/webp":
				return 'webp';
			case 'image/apng':
				return 'apng';
			case "image/png":
			case "image/x-png":
				return 'png';
			case "image/gif":
				return 'gif';
			case 'image/avif':
				return 'avif';
			case 'image/svg':
				return 'svg';
			case 'image/vnd.adobe.photoshop':
				return 'psd';
			default:
				return ['error' => $file['type']];
		}
	}


	/** Converts image to webp image using gd
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

	/**
	 * resize_uploaded_image
	 *
	 * @param array $file == $_FILES['input-name]
	 * @param string $dir Should already be created, and chmod to 777
	 * @param array $opts  ['sizes' => ['s' => '300', 'l' => '800'],
	 * 										'convert' => true, // if true, webp is the answer.
	 * 										'build_dir' => ['year', 'month, 'day']]
	 * @return string|array error or [path/2/s-file.webp, path/2/l-file.webp]
	 */
	public function resize_uploaded_image($file, $dir, $opts=[]){
		$make_webp = false;
		if($file['error'] == 0){
			if(!isset($opts['convert'])) { $opts['convert'] = true; }
			if(!is_array($opts['sizes'])){ $opts['sizes'] = ['s' => '300', 'l' => '800']; }
			$check = self::get_mime_type($file);
			if(is_array( $check ) && isset($check['error'])){
				return 'Incorrect file type uploaded. Only png, gif, and jpg files are supported. - '.$check['error'];
			} else {
				$ext = '.'.$check;
				if($ext != 'webp' && $opts['convert'] == true){
					$make_webp = true;
				}
			}
			$filename = preg_replace('/[^a-zA-Z0-9\._]/i', '', $file['name']);
			$dir = Helpful_Files::make_yr_directory($dir);
			$filename = Helpful_Files::check_file($dir, $filename);

			move_uploaded_file($file['tmp_name'], $dir . $filename);
			if(is_file($dir . $filename)){
				return $this->resize_image($dir, $filename, $opts['sizes'], ['ext' => $check, 'make' => $make_webp], $opts['trim_filepath'] ?? '');
			} else {
				//copy($file['tmp_name'], $dir . $filename); // makes a binary file
				//if(is_file($dir . $filename)){
				//	return $this->resize_image($dir, $filename, $opts['sizes'], ['ext' => $check, 'make' => $make_webp], $opts['trim_filepath'] ?? '');
				//} else {
					return [
						'error' => 'couldnt move uploaded file or copy the temp file to the destination.'
					];
				//}
			}
		} else {
			return 'Looks like there was an error uploading this file.';
		}
	}
			//$year = date('Y', time());
			//$month = date('n', time());
			//if(!is_dir($dir.$year.'/')){
			//	@mkdir($dir.$year.'/', 0777);
			//}
			//if(!is_dir($dir.$year.'/'.$month.'/')){
			//	@mkdir($dir.$year.'/'.$month.'/', 0777);
			//}
			//$dir = $dir.$year.'/'.$month.'/';
			//if(is_file($dir.$filename)){
			//	$n = 0;
			//	for(;;){
			//		if(!is_file($dir.$n.$filename)){
			//			$filename = $n.$filename;
			//			break;
			//		}
			//		$n++;
			//	}
			//}
			//list($width, $height, $typeM, $attr) = getimagesize($dir.$filename);
			//$total_sizes = count($opts['sizes']);
			//$created = array();
			//foreach($opts['sizes'] as $pre => $size){
			//	$new_file = $total_sizes > 1 ? $dir.$pre.'-'.$filename : $dir.$filename;
			//	if($width > $size || $height > $size){
			//		system("magick convert ".$dir.$filename." -resize ".$size."x".$size." -quality 100 ".$new_file);
			//	} else if($new_file != $dir.$filename){
			//		copy($dir.$filename, $new_file);
			//	}
			//	if($make_webp == true){
			//		$file3 = str_replace('.', '-', $new_file).'.webp';
			//		if(!str_ends_with($new_file, 'webp')){
			//			system('magick "'.$new_file.'" -quality 80 -define webp:alpha-filtering=1 -define webp:alpha-quality=80 -define webp:lossless=true "'.$file3.'"');
			//			// magick "'.$file2.'" -quality 80 -define webp:alpha-filtering=1 -define webp:alpha-quality=80 -define webp:lossless=true "'.$file3.'"
			//			$new_file = $file3;
			//		}
			//	}
			//	$created[$pre] = $new_file;
			//}
			//$not_found = false;
			//foreach($created as $file2){
			//	if($file2 != '' && !is_file($file2)){
			//		$created['not_found'][] = $file2;
			//	}
			//}

	/**
	 * resize_image imagemagick is required
	 *
	 * @param string $dir  directory file is in
	 * @param string $filename  the filename
	 * @param array $sizes  ['s' => '100', 'm' => '500', 'l' => '1500']
	 * @param array $make_webp
	 * @param string $remove_from_beginning = __DIR__.'/../../'
	 * @return array
	 */
	public function resize_image($dir, $filename, $sizes, $make_webp=[], $remove_from_beginning=''){
		$created = [];
		list($width, $height, $typeM, $attr) = getimagesize($dir.$filename);
		$total_sizes = count($sizes);
		foreach($sizes as $pre => $size){
			$new_file = $total_sizes > 1 ? $dir.$pre.'-'.$filename : $dir.$pre.'-'. $filename;
			if($width > $size || $height > $size){
				\system($this->magick." ".$dir.$filename." -resize ".$size."x".$size." -quality 100 ".$new_file);
			} else if($new_file != $dir.$filename){
				copy($dir.$filename, $new_file);
			}
			if($make_webp['make'] == true){
				$file3 = str_replace('.'.$make_webp['ext'], '-'.$make_webp['ext'], $new_file).'.webp';
				if(!str_ends_with($new_file, 'webp')){
					\system($this->magick.' "'.$new_file.'" -quality 80 "'.$file3.'"');
					// magick "'.$file2.'" -quality 80 -define webp:alpha-filtering=1 -define webp:alpha-quality=80 -define webp:lossless=true "'.$file3.'"
					$webp_file = $file3;
				}
			}
			if(!is_file($new_file)){
				$created['not_found'][$pre] = $new_file;
			} else {
				$created[$pre] = str_replace($remove_from_beginning, '', $new_file);// $new_file;
			}
			if(!is_file($webp_file)){
				$created['webp_not_found'][$pre] = $webp_file;
			} else {
				$created['webp'][$pre] = str_replace($remove_from_beginning, '', $webp_file);// $new_file);// $new_file;
			}
		}
		return $created;
	}
}