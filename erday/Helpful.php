<?php
namespace JW3B\erday;

class Helpful {

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