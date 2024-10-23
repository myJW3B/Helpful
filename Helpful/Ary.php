<?php

namespace JW3B\Helpful;

Class Ary {

	/**
	 * Convert an array to an object.
	 *
	 * @param mixed $d The array to convert.
	 * @return object The converted object.
	 */
	public static function arrayToObject(mixed $d): object
	{
		if (is_array($d)) {
			return (object) array_map([self::class, __FUNCTION__], $d);
		}
		return $d;
	}

	/**
	 * Preserving the keys and flop the values in reverse order.
	 *
	 * @param array $ary Array
	 * @return array The new array.
	*/
	public static function flop_vals(array $ary): array
	{
		$keys = array_keys($ary);
		$values = array_reverse(array_values($ary));
		return array_combine($keys, $values);
		// return array_combine(array_keys($colors), array_reverse(array_values($colors)));
	}

	/**
	 * Convert an object to an array.
	 * ? credits to
	 * ! https://www.if-not-true-then-false.com/2009/php-tip-convert-stdclass-object-to-multidimensional-array-and-convert-multidimensional-array-to-stdclass-object/
	 *
	 * @param mixed $d The object to convert.
	 * @return mixed The converted array.
	 */
	public static function objectToArray(mixed $d): mixed
	{
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
		if (is_array($d)) {
			return array_map([self::class, __FUNCTION__], $d);
		}
		return $d;
	}
}
