<?php

namespace JW3B\erday;
class Helpful_SQL extends Helpful {
	// already set up for USA money
	public static function decimal($str, $length=13, $after=2){
		if($str == '') $str = '0.00';
		$num = number_format($str, 2, '.', ',');
		$b4 = $length-$after-1;
		$divide = $b4/3;
		if(is_int($divide)){
			$commas = $divide-1;
		} else {
			$commas = round($divide);
		}
		$total_len = $length+$commas+1;
		if(strlen($num) > $total_len){
			return array('error' => 'Length of price is too high. We can only accept prices up to $999,999.00');
		} else if($num == ''){
			return '0.00';
		} else {
			return $num;
		}
	}

	public static function format($what, $val=''){
		if($what == 'datetime'){
			$time = $val == '' ? time() : $val;
			return date ("Y-m-d H:i:s", $time);
		} else if($what == 'mysql-phone'){
			return preg_replace('~\D~', '', $val);;
		} else if($what == 'display-time'){
			return date("m/d/Y h:i A", strtotime($val)); //l F jS Y h:i A", strtotime($val));
		} else if($what == 'phone'){
			$areaCode 	= substr($val, 0, 3);
			$nextThree	= substr($val, 3, 3);
			$lastFour 	= substr($val, 6, 4);
			return '('.$areaCode.') '.$nextThree.'-'.$lastFour;
		} else {}
	}
}