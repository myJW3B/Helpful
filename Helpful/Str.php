<?php

namespace JW3B\Helpful;

class Str
{

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
	 * Print a variable in a readable format.
	 *
	 * @param mixed $t The variable to print.
	 * @return string The formatted variable.
	 */
	public static function p(mixed $t): string
	{
		return '<pre>' . print_r($t, true) . '</pre>';
	}

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
	 * Clean a URL string.
	 *
	 * @param string $str The string to clean.
	 * @return string The cleaned URL.
	 */
	public static function clean_url(string $str): string
	{
		// Trim whitespace and replace spaces with hyphens
		$str = trim($str);
		$str = preg_replace('/\s+/', '-', $str); // Normalize spaces to single hyphens
		// Remove invalid URL characters
		$str = preg_replace('/[^a-zA-Z0-9-_]+/', '', $str); // Allow alphanumeric, hyphen, and underscore
		// Remove consecutive hyphens
		$str = preg_replace('/--+/', '-', $str);
		return $str;
	}	/**
	 * Generate a random string.
	 *
	 * @param int $length Length of the string to generate.
	 * @param bool $lowercase Include lowercase letters.
	 * @param bool $uppercase Include uppercase letters.
	 * @param bool $number Include numbers.
	 * @return string The generated random string.
	 */
	public static function random_string(
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
	 * Send an email.
	 *
	 * @param string $to The recipient's email address.
	 * @param string $from Senders email address.
	 * @param string $subject The subject of the email.
	 * @param string $message The email message.
	 * @param array $header Additional headers.
	 * @return bool True if the email was sent successfully, false otherwise.
	 */
	public static function mail2(string $to, string $from, string $subject, string $message, array $header = []): bool
	{
		$headers[] = 'Content-type: text/html; charset=UTF-8';
		$headers[] = 'From: ' . $from;
		$headers[] = 'Reply-To: ' . $from;
		$headers[] = 'X-Mailer: PHP/' . phpversion();
		$head = implode("\r\n", array_merge($headers, $header));
		return @mail($to, $subject, $message, $head, "-f " . $from);
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
}