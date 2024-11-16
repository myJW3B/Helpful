<?php

namespace JW3B\Helpful;
/**
 * Some of these functions have been influenced by Laravels Str class
 */
class Str
{
	/**
	 * The cache of snake-cased words.
	 *
	 * @var array
	 */
	protected static $snakeCache = [];

	/**
	 * The cache of camel-cased words.
	 *
	 * @var array
	 */
	protected static $camelCache = [];

	/**
	 * The cache of studly-cased words.
	 *
	 * @var array
	 */
	protected static $studlyCache = [];

	/**
	 * Convert a value to camel case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function camel(string $value) : string
	{
		if (isset(self::$camelCache[$value])) {
			return self::$camelCache[$value];
		}

		return self::$camelCache[$value] = lcfirst(self::studly($value));
	}

	/**
	 * Clean a URL string.
	 *
	 * @param string $str The string to clean.
	 * @return string|null The cleaned URL.
	 */
	public static function clean_url(string $str): string|null
	{
		// Convert to lowercase
		$str = strtolower($str);
		// Trim whitespace
		$str = trim($str);
		// Replace spaces with hyphens and remove invalid characters
		$str = preg_replace('/[^a-z0-9]+/', '-', $str);
		// Trim hyphens from the beginning and end
		$str = trim($str, '-');
		return $str;
	}

	/**
	 * Clean a text string.
	 *
	 * @param string $str The string to clean.
	 * @param bool $nl2br Convert newlines to <br> tags.
	 * @return string The cleaned text.
	 */
	public static function e(string $str, bool $nl2br = false): string
	{

		$txt = trim(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
		return $nl2br ? nl2br($txt) : $txt;
	}

	/**
	 * Generate a form element name from a string.
	 *
	 * @param string $str The string to convert.
	 * @return string The form element name.
	 */
	public static function form_element_name(string $str): string
	{
		return strtolower(self::clean_url($str));
	}

	/**
	 * Decode the given Base64 encoded string.
	 *
	 * @param  string  $string
	 * @param  bool  $strict
	 * @return string|false
	 */
	public static function fromBase64(string $string, bool $strict = false) :string|bool
	{
		return base64_decode($string, $strict);
	}

	/**
	 * Convert various string formats to a capitalized headline.
	 *
	 * @param string $string The input string.
	 * @return string The headline formatted string.
	 */
	public static function headline(string $string): string
	{
		// Replace underscores/hyphens and split camelCase
		$string = preg_replace('/[_-]+/', ' ', $string);
		$string = preg_replace('/(?<!\ )[A-Z]/', ' $0', $string);
		// Capitalize each word
		$string = ucwords(strtolower(trim($string)));
		return $string;
	}

	/**
	 * Convert a camelCase, snake_case, or space separated string to kebab-case.
	 *
	 * @param string $string The input string.
	 * @return string The kebab-case string.
	 */
	public static function kebab(string $string): string
	{
		// Convert snake_case to kebab-case
		$string = str_replace('_', '-', $string);

		// Convert space separated to kebab-case
		$string = str_replace(' ', '-', $string);

		// Replace uppercase letters with a hyphen followed by the lowercase equivalent
		$kebab = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $string));
		return $kebab;
	}

	/**
	 * Make a string's first character lowercase.
	 *
	 * @param  string  $string
	 * @return string
	 */
	public static function lcfirst(string $string) : string
	{
		return self::lower(self::substr($string, 0, 1)).self::substr($string, 1);
	}

	/**
	 * Return the length of the given string.
	 *
	 * @param  string  $value
	 * @param  string|null  $encoding
	 * @return int
	 */
	public static function length(string $value, string|null $encoding = null) : int
	{
		return mb_strlen($value, $encoding);
	}

	/**
	 * Limit the number of characters in a string.
	 *
	 * @param  string  $value
	 * @param  int  $limit
	 * @param  string  $end
	 * @param  bool  $preserveWords
	 * @return string
	 */
	public static function limit(
		string $value,
		int $limit = 100,
		string $end = '...',
		bool $preserveWords = false) : string
	{
		if (mb_strwidth($value, 'UTF-8') <= $limit) {
			return $value;
		}
		if (! $preserveWords) {
			return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
		}
		$value = trim(preg_replace('/[\n\r]+/', ' ', strip_tags($value)));
		$trimmed = rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8'));
		if (mb_substr($value, $limit, 1, 'UTF-8') === ' ') {
			return $trimmed.$end;
		}
		return preg_replace("/(.*)\s.*/", '$1', $trimmed).$end;
	}

	/**
	 * Convert the given string to lower-case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function lower(string $value) : string
	{
		return mb_strtolower($value, 'UTF-8');
	}

	/**
	 * Remove all whitespace from the beginning of a string.
	 *
	 * @param  string  $value
	 * @param  string|null  $charlist
	 * @return string
	 */
	public static function ltrim(string $value, string|null $charlist = null) : string
	{
		if ($charlist === null) {
			$ltrimDefaultCharacters = " \n\r\t\v\0";
			return preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$ltrimDefaultCharacters.']+~u', '', $value) ?? ltrim($value);
		}
		return ltrim($value, $charlist);
	}

	/**
	 * Print a variable in a readable format.
	 *
	 * @param mixed $t The variable to print.
	 * @return string The formatted variable.
	 */
	public static function p(mixed $t): string
	{
		return '<pre>'.print_r($t, true).'</pre>';
	}

	/**
	 * Parse the current URL into an array of segments.
	 *
	 * @return array The URL segments.
	 */
	public static function parse_my_url(): array
	{
		$url = $_SERVER['REQUEST_URI'] ?? 'https://github.com';
		$url = substr($url, 1);
		$parts = explode('/', $url);
		$uri = [];
		foreach ($parts as $ui) {
			if ($ui !== '') {
				$uri[] = $ui;
			}
		}
		return $uri;
	}

	/**
	 * Generate a random string.
	 *
	 * @param int $length Length of the string to generate.
	 * @param bool $lowercase Include lowercase letters.
	 * @param bool $uppercase Include uppercase letters.
	 * @param bool $number Include numbers.
	 * @return string The generated random string.
	 */
	public static function randomString(
		int $length = 10,
		bool $lowercase = true,
		bool $uppercase = true,
		bool $number = true): string
	{
		$characters = '';
		if ($lowercase) {
			$characters .= 'abcdefghijklmnopqrstuvwxyz';
		}
		if ($uppercase) {
			$characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}
		if ($number) {
			$characters .= '0123456789';
		}
		if ($characters === '') {
			throw new \InvalidArgumentException('At least one character set must be enabled.');
		}
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**
	 * Remove pound signs and dashes from a string.
	 *
	 * @param string $tt The string to modify.
	 * @return string The modified string.
	 */
	public static function removePound(string $tt): string
	{
		return trim(str_replace(['#', '-'], ['', ' '], self::e($tt)));
	}

	/**
	 * Remove all whitespace from the end of a string.
	 *
	 * @param  string  $value
	 * @param  string|null  $charlist
	 * @return string
	 */
	public static function rtrim(string $value, string|null $charlist = null) : string
	{
		if ($charlist === null) {
			$rtrimDefaultCharacters = " \n\r\t\v\0";
			return preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}'.$rtrimDefaultCharacters.']+$~u', '', $value) ?? rtrim($value);
		}
		return rtrim($value, $charlist);
	}

	/**
	 * Convert a string to snake case.
	 *
	 * @param  string  $value
	 * @param  string  $delimiter
	 * @return string
	 */
	public static function snake(string $value, string $delimiter = '_') : string
	{
		$key = $value;
		if (isset(self::$snakeCache[$key][$delimiter])) {
			return self::$snakeCache[$key][$delimiter];
		}
		if (!ctype_lower($value)) {
			$value = preg_replace('/\s+/u', '', ucwords($value));
			$value = self::lower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value));
		}
		return self::$snakeCache[$key][$delimiter] = $value;
	}

	/**
	 * Convert a value to studly caps case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function studly(string $value) : string
	{
		$key = $value;
		if (isset(self::$studlyCache[$key])) {
			return self::$studlyCache[$key];
		}
		$words = explode(' ', str_replace(['-', '_'], ' ', $value));
		$studlyWords = array_map(fn ($word) => self::ucfirst($word), $words);
		return self::$studlyCache[$key] = implode($studlyWords);
	}

	/**
	 * Returns the portion of the string specified by the start and length parameters.
	 *
	 * @param  string  $string
	 * @param  int  $start
	 * @param  int|null  $length
	 * @param  string  $encoding
	 * @return string
	 */
	public static function substr(string $string, int $start, int|null $length = null, string $encoding = 'UTF-8') : string
	{
		return mb_substr($string, $start, $length, $encoding);
	}

	/**
	 * Swap keywords in a string according to a mapping array.
	 *
	 * @param array $replacements An associative array of replacements.
	 * @param string $string The original string.
	 * @return string The string with replacements.
	 * @example $string = Str::swap(['Tacos' => 'Burritos', 'great' => 'fantastic'], 'Tacos are great!');
	 * // Burritos are fantastic!
	 */
	public static function swap(array $replacements, string $string): string
	{
		return strtr($string, $replacements);
	}

	/**
	 * Convert the given string to proper case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function title(string $value) : string
	{
		return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
	}

	/**
	 * Convert the given string to Base64 encoding.
	 *
	 * @param  string  $string
	 * @return string
	 */
	public static function toBase64(string $string): string
	{
		return base64_encode($string);
	}

	/**
	 * Remove all whitespace from both ends of a string.
	 *
	 * @param  string  $value
	 * @param  string|null  $charlist
	 * @return string
	 */
	public static function trim(string $value, string|null $charlist = null) : string
	{
		if ($charlist === null) {
			$trimDefaultCharacters = " \n\r\t\v\0";

			return preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+|[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+$~u', '', $value) ?? trim($value);
		}

		return trim($value, $charlist);
	}

	/**
	 * Make a string's first character uppercase.
	 *
	 * @param  string  $string
	 * @return string
	 */
	public static function ucfirst(string $string) : string
	{
		return self::upper(self::substr($string, 0, 1)).self::substr($string, 1);
	}

	/**
	 * Split a string into pieces by uppercase characters.
	 *
	 * @param  string  $string
	 * @return string[]
	 */
	public static function ucsplit(string $string) : array
	{
		return preg_split('/(?=\p{Lu})/u', $string, -1, PREG_SPLIT_NO_EMPTY);
	}

	/**
	 * Convert the given string to upper-case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function upper(string $value) : string
	{
		return mb_strtoupper($value, 'UTF-8');
	}

	/**
	 * Wrap a string to a given number of characters using a specified line break.
	 *
	 * @param string $text The input string.
	 * @param int $characters The max number of characters per line.
	 * @param string $break The line break delimiter.
	 * @return string The word-wrapped string.
	 *
	 * @example echo Str::wordWrap("The quick brown fox jumped over the lazy dog.", characters: 20, break: "<br />\n");
	 */
	public static function wordWrap(string $text, int $characters = 75, string $break = "\n"): string
	{
		return wordwrap($text, $characters, $break, true);
	}
}
