<?php

namespace JW3B\Helpful;

Class Ary {
	
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
}
