<?php
namespace JW3B\erday;

class Helpful {

	public static function random_string($length = 10, $lowercase = true, $uppercase = true, $number = true): string {
		$string = '';
		if ($number)
			$string .= '0123456789';
		if ($lowercase)
			$string .= 'abcdefghijklmnopqrstuvwxyz';
		if ($uppercase)
			$string .= strtoupper($string);
		return substr(
						str_shuffle(
							str_repeat($x = $string,
								ceil($length / strlen($x))
							)
						),
						1, $length);
	}

	public static function mk_dir_writable($dir){
		if(!is_dir($dir)){
			if (!mkdir($dir, 0777)) { // attempt to make it with read, write, execute permissions
				return false; // bug out if it can't be created
			}
		} else {
			if(is_writable($dir)){
				return true;
			} else {
				chmod($dir, 0777);
			}
		}
	}

	public static function p($t){
		return '<pre>'.print_r($t, 1).'</pre>';
	}
	/**
	 * Read all files and folders
	 * @param string path without the trailing slash
	 * @para string match the files to find, just leave empty idr what this did
	 *
	 * @return array ['file'] deep
	 */

	public static function tree($path, $match=''){
		$list['file'] = array();
		// Find the real directory part of the path, and set the match parameter
		$last=strrpos($path,"/");
		if(!is_dir($path)){
			$match=substr($path,$last);
			while(!is_dir($path=substr($path,0,$last)) && $last!==false)
				$last=strrpos($path,"/",-1);
		}
		if(empty($match)) $match="/*";
		if(!$path=realpath($path)) return [];

		// List files
		foreach(glob($path.$match) as $file){
			if(is_dir($file)){
				$more = helpful::tree($file, $match);
				$list['dir'][substr($file,strrpos($file,"/",-1)+1)] = $more;
				$deeper = $more;
				$list['file'] = array_merge($list['file'], $deeper['file']);
			} else {
				$list['file'][]=str_replace($_SERVER['DOCUMENT_ROOT'], '', $path).'/'.substr($file,strrpos($file,"/")+1);
			}
		}
		return @$list;
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

	public static function make_yr_directory($destination){
		$year = date('Y', time());
		$month = date('n', time());
		if(!is_dir($destination.$year.'/')){
			@mkdir($destination.$year.'/', 0777);
		}
		if(!is_dir($destination.$year.'/'.$month.'/')){
			@mkdir($destination.$year.'/'.$month.'/', 0777);
		}
		return $destination.$year.'/'.$month.'/';
	}

	public static function removeEmptySubfolders($path){
		if(substr($path,-1)!= DIRECTORY_SEPARATOR){
			$path .= DIRECTORY_SEPARATOR;
		}
		$d2 = array('.','..');
		$dirs = array_diff(glob($path.'*', GLOB_ONLYDIR),$d2);
		foreach($dirs as $d){
			helpful::removeEmptySubfolders($d);
		}
		if(count(array_diff(glob($path.'*'),$d2))===0){
			rmdir($path);
		}
	}

	public static function get_large_img($img){
		$base = basename($img);
		$large_img = str_replace($base, 'l'.substr($base, 1), $img);
		return $large_img;
	}

	public static function sq($w,$h,$p){
		return number_format((($w*$h)/144)*$p,2);
	}

	public static function clean_url($str){
		return preg_replace(['/[^a-zA-Z0-9+]/', '/--+/'], '-', trim(stripslashes($str)));
	}

	public static function clean_text($str, $nl2br=false){
		$ret = $nl2br == false ? trim(htmlentities(stripslashes($str))) : nl2br(trim(htmlentities(stripslashes($str))));
		return $ret;
	}
	public static function clean($str, $nl2br=''){
		return helpful::clean_text($str, $nl2br);
	}

	public static function form_element_name($str){
		$ret = strtolower(helpful::clean_url($str));
		return $ret;
	}

	public function removePound($tt){
		return trim(str_replace(['#', '-'], ['', ' '], stripslashes(htmlentities($tt))));
	}

	public function parse_my_url(){
		$url = substr($_SERVER['REQUEST_URI'], 1);
		$parts = explode('/', $url);
		foreach($parts as $ui){
			if($ui != ''){
				$uri[] = $ui;
			}
		}
		return $uri;
	}

	public static function mail2($to, $subject, $message, $header=array()){
		global $Sets;
		$headers[] = 'Content-type: text/html; charset=UTF-8'; //iso-8859-1';
		//$headers[] = 'From: "'.$Sets['site_name'].'" <'.$Sets['site_email'].'>';
		$headers[] = 'From: '.$Sets['site_email'];
		$headers[] = 'Reply-To: '.$Sets['site_email'];
		$headers[] = 'X-Mailer: PHP/' . phpversion();
		$head = implode("\r\n", array_merge($headers, $header));
		if(@mail($to, $subject, $message, $head, "-f ".$Sets['site_email'])){
			return true;
		} else {
			return false;
		}
	}

		// fix array for the following function for image uploads
		/*
		$file_ary = reArrayFiles($_FILES['file']);

			foreach ($file_ary as $file) {
					print 'File Name: ' . $file['name'];
					print 'File Type: ' . $file['type'];
					print 'File Size: ' . $file['size'];
			}
			*/
	public function reArrayFiles(&$file_post) {
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
		for($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
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