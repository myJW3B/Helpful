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

	public static function p($t){
		return '<pre>'.print_r($t, 1).'</pre>';
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

	public static  function removePound($tt){
		return trim(str_replace(['#', '-'], ['', ' '], stripslashes(htmlentities($tt))));
	}

	public static function parse_my_url(){
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
		$headers[] = 'Content-type: text/html; charset=UTF-8'; //iso-8859-1';
		//$headers[] = 'From: "'.Config::$c['site_name'].'" <'.$Config::$c['site_email'].'>';
		$headers[] = 'From: '.Config::$c['site_email'];
		$headers[] = 'Reply-To: '.Config::$c['site_email'];
		$headers[] = 'X-Mailer: PHP/' . phpversion();
		$head = implode("\r\n", array_merge($headers, $header));
		if(@mail($to, $subject, $message, $head, "-f ".Config::$c['site_email'])){
			return true;
		} else {
			return false;
		}
	}
}