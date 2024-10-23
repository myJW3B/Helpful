<?php

namespace JW3B\Helpful;

class Number
{

	/**
	 * Calculate the price per square foot.
	 *
	 * @param float $w Width.
	 * @param float $h Height.
	 * @param float $p Price.
	 * @return string The calculated price.
	 */
	public static function sq(float $w, float $h, float $p): string
	{
		return number_format((($w * $h) / 144) * $p, 2);
	}


	/**
	 * Convert a number to its word representation.
	 *
	 * @param int $number The number to convert.
	 * @return string The word representation.
	 */
	public static function numberToWord(int $number): string
	{
		$words = [
			0 => 'zero',
			1 => 'one',
			2 => 'two',
			3 => 'three',
			4 => 'four',
			5 => 'five',
			6 => 'six',
			7 => 'seven',
			8 => 'eight',
			9 => 'nine',
			10 => 'ten',
			11 => 'eleven',
			12 => 'twelve',
			13 => 'thirteen',
			14 => 'fourteen',
			15 => 'fifteen',
			16 => 'sixteen',
			17 => 'seventeen',
			18 => 'eighteen',
			19 => 'nineteen',
			20 => 'twenty',
			30 => 'thirty',
			40 => 'forty',
			50 => 'fifty',
			60 => 'sixty',
			70 => 'seventy',
			80 => 'eighty',
			90 => 'ninety',
		];
		if ($number <= 20) {
			return $words[$number];
		}
		if ($number < 100) {
			$tens = (int) ($number / 10) * 10;
			$units = $number % 10;
			return $units ? $words[$tens] . '-' . $words[$units] : $words[$tens];
		}
		// Extend for larger numbers as needed
		return 'Number out of range';
	}
}