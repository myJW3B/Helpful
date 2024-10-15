<?php

namespace JW3B\Helpful;

class SQL
{
	/**
	 * Format a decimal number for USA currency.
	 *
	 * @param string|float|int $str The number to format.
	 * @param int $length The maximum length of the formatted number.
	 * @param int $after Number of digits after the decimal point.
	 * @return string|array The formatted number or an error message.
	 */
	public static function decimal(string|float|int $str, int $length = 13, int $after = 2): string|array
	{
		if ($str === '') {
			$str = '0.00';
		}

		$num = number_format($str, $after, '.', ',');
		$b4 = $length - $after - 1;
		$divide = $b4 / 3;

		$commas = is_int($divide) ? $divide - 1 : round($divide);
		$total_len = $length + $commas + 1;

		if (strlen($num) > $total_len) {
			return ['error' => 'Length of price is too high. We can only accept prices up to $999,999.00'];
		} elseif ($num === '') {
			return '0.00';
		} else {
			return $num;
		}
	}

	/**
	 * Format a value based on the specified format type.
	 *
	 * @param string $what The format type (e.g., 'datetime', 'mysql-phone', 'display-time', 'phone').
	 * @param string $val The value to format.
	 * @return string The formatted value.
	 */
	public static function format(string $what, string $val = ''): string
	{
		return match ($what) {
			'datetime' => date("Y-m-d H:i:s", $val === '' ? time() : strtotime($val)),
			'mysql-phone' => preg_replace('~\D~', '', $val),
			'display-time' => date("m/d/Y h:i A", strtotime($val)),
			'phone' => sprintf('(%s) %s-%s', substr($val, 0, 3), substr($val, 3, 3), substr($val, 6, 4)),
			default => '',
		};
	}
}
