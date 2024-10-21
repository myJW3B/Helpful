<?php

namespace JW3B\Helpful;

Class Ary {
	
	/**
	 * Clean a text string.
	 *
	 * @param array $ary Array that keep the keys in the same order, and flop the values.
	 * @return array The new array.
	*/
	public static function flop_vals(array $ary): array
	{
		$keys = array_keys($colors);
		$values = array_reverse(array_values($colors));
		return array_combine($keys, $values);
		// return array_combine(array_keys($colors), array_reverse(array_values($colors)));
	}
}
