<?php

namespace JW3B\erday;

/**
* PHP Color Class
*
* An simple colour class for PHP.
* Note: in documentation the 'colour' spelling is intentional.
*
* @subpackage Graphics
* @author Rowan Manning (http://rowanmanning.co.uk/)
* @copyright Copyright (c) 2011, Rowan Manning
* @license Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* @link https://gist.github.com/425464
* @filesource
*
* @subpackage Graphics
* @author Rowan Manning (http://rowanmanning.co.uk/)
* @link https://gist.github.com/425464
*/
class Helpful_Color {
	/**
	 * The red value of the colour.
	 *
	 * @access protected
	 * @var integer
	 */
	protected $red = 0;

	/**
	 * The green value of the colour.
	 *
	 * @access protected
	 * @var integer
	 */
	protected $green = 0;

	/**
	 * The blue value of the colour.
	 *
	 * @access protected
	 * @var integer
	 */
	protected $blue = 0;

	/**
	 * Class constructor.
	 *
	 * @access public
	 * @param integer $red [optional] The red value of the colour (between 0 and 255). Default value is 0.
	 * @param integer $green [optional] The green value of the colour (between 0 and 255). Default value is 0.
	 * @param integer $blue [optional] The blue value of the colour (between 0 and 255). Default value is 0.
	 */	// Constructor to initialize the RGB values.
	 public function __construct($red = 0, $green = 0, $blue = 0) {
		$this->red = self::fixRgbValue($red);
		$this->green = self::fixRgbValue($green);
		$this->blue = self::fixRgbValue($blue);
	}

	/**
	 * Fix a colour value (round and keep between 0 and 255).
	 * Ensures the RGB value is within the valid range (0 to 255).
	 *
	 * @access protected
	 * @static
	 * @param float $value The value to fix.
	 * @return integer Returns the fixed integer.
	 */
	protected static function fixRgbValue(float $value): int {
		return max(min(round($value), 255), 0);
	}

	/**
	 * Convert red, green and blue values to a HEX code.
	 *
	 * @access public
	 * @param $red The red value of the colour (between 0 and 255).
	 * @param $green The green value of the colour (between 0 and 255).
	 * @param $blue The blue value of the colour (between 0 and 255).
	 * @return string Returns the HEX code representing the values given.
	 */
	public static function rgbToHex(int $red, int $green, int $blue): string {
		$red = str_pad(dechex(self::fixRgbValue($red)), 2, '0', STR_PAD_LEFT);
		$green = str_pad(dechex(self::fixRgbValue($green)), 2, '0', STR_PAD_LEFT);
		$blue = str_pad(dechex(self::fixRgbValue($blue)), 2, '0', STR_PAD_LEFT);
		return $red . $green . $blue;
	}

	/**
	 * Convert a HEX code into RGB.
	 *
	 * @access public
	 * @param string $hex The HEX code to convert.
	 * @return array Returns an associative array of values. The array will have 'red', 'green' and 'blue' keys.
	 */
	public static function hexToRgb(string $hex): array {
		// Trim the '#' character if present.
		$hex = ltrim($hex, '#');
		// Check the length of the hex code and parse accordingly.
		if (strlen($hex) === 6) {
			$hex = [
				'red' => $hex[0] . $hex[1],
				'green' => $hex[2] . $hex[3],
				'blue' => $hex[4] . $hex[5]
			];
		} elseif (strlen($hex) === 3) {
			$hex = [
				'red' => str_repeat($hex[0], 2),
				'green' => str_repeat($hex[1], 2),
				'blue' => str_repeat($hex[2], 2)
			];
		} else {
			// Return black (0, 0, 0) for invalid hex codes.
			$hex = ['red' => 0, 'green' => 0, 'blue' => 0];
		}
		// Convert hex values to decimal and fix the RGB range.
		return [
			'red' => self::fixRgbValue(hexdec($hex['red'])),
			'green' => self::fixRgbValue(hexdec($hex['green'])),
			'blue' => self::fixRgbValue(hexdec($hex['blue']))
		];
	}

	/**
	 * Calculate and return a range of colours between a start and end colour.
	 * Generates a gradient of colors between two colors over a defined number of steps.
	 *
	 * @access public
	 * @param Helpful_Color|string $start The start colour. This can be a Helpful_Color object or a HEX code as a string.
	 * @param Helpful_Color|string $end The end colour. This can be a Helpful_Color object or a HEX code as a string.
	 * @param integer $steps The number of colours to return (including start and end colours).
	 * @return array Returns an array of Helpful_Color objects.
	 */
	public static function range($start, $end, $steps = 10): array {
		if (!$start instanceof Helpful_Color) {
			$startc = new Helpful_Color;
			$startc->setHex($start);
			$start = $startc;
		}
		if (!$end instanceof Helpful_Color) {
			$endc = new Helpful_Color;
			$endc->setHex($end);
			$end = $endc;
		}
		$steps -= 2;
		$start_rgb = $start->getArray();
		$end_rgb = $end->getArray();
		$red_increment = ($end_rgb['red'] - $start_rgb['red']) / ($steps + 1);
		$green_increment = ($end_rgb['green'] - $start_rgb['green']) / ($steps + 1);
		$blue_increment = ($end_rgb['blue'] - $start_rgb['blue']) / ($steps + 1);
		$range = [$start];
		$steps_taken = 0;
		while ($steps_taken < $steps) {
			$steps_taken++;
			$start_rgb['red'] += $red_increment;
			$start_rgb['green'] += $green_increment;
			$start_rgb['blue'] += $blue_increment;
			$range[] = new Helpful_Color($start_rgb['red'], $start_rgb['green'], $start_rgb['blue']);
		}
		$range[] = $end;
		return $range;
	}

	/**
	 * Mix two colours together.
	 * Mixes two colors and returns the resulting color.
	 * @access public
	 * @param Helpful_Color|string $color1 The first colour. This can be a Helpful_Color object or a HEX code as a string.
	 * @param Helpful_Color|string $color2 The second colour. This can be a Helpful_Color object or a HEX code as a string.
	 * @return Helpful_Color Returns the result of the mix as a new Helpful_Color object.
	 */
	public static function mix($color1, $color2): Helpful_Color {
		if (!$color1 instanceof Helpful_Color) {
			$color1c = new Helpful_Color;
			$color1c->setHex($color1);
			$color1 = $color1c;
		}
		if (!$color2 instanceof Helpful_Color) {
			$color2c = new Helpful_Color;
			$color2c->setHex($color2);
			$color2 = $color2c;
		}
		$rgb1 = $color1->getArray();
		$rgb2 = $color2->getArray();
		return new Helpful_Color($rgb1['red'] + $rgb2['red'], $rgb1['green'] + $rgb2['green'], $rgb1['blue'] + $rgb2['blue']);
	}

	/**
	 * Set the colour's red, green and blue values
	 *
	 * @access public
	 * @param integer $red [optional] The red value of the colour (between 0 and 255). Default value is 0.
	 * @param integer $green [optional] The green value of the colour (between 0 and 255). Default value is 0.
	 * @param integer $blue [optional] The blue value of the colour (between 0 and 255). Default value is 0.
	 */
	// Sets the RGB values.
	public function set($red = 0, $green = 0, $blue = 0): void {
		$this->red = self::fixRgbValue($red);
		$this->green = self::fixRgbValue($green);
		$this->blue = self::fixRgbValue($blue);
	}

	/**
	 * Modify the colour's red, green and blue values.
	 *
	 * @access public
	 * @param integer $red [optional] The amount to modify the red value of the colour (between -255 and 255). Default value is 0.
	 * @param integer $green [optional] The amount to modify the green value of the colour (between -255 and 255). Default value is 0.
	 * @param integer $blue [optional] The amount to modify the blue value of the colour (between -255 and 255). Default value is 0.
	 */
	// Modifies the RGB values by adding the provided values to the existing ones.
	public function modify($red = 0, $green = 0, $blue = 0): void {
		$this->red = self::fixRgbValue($this->red + (int)$red);
		$this->green = self::fixRgbValue($this->green + (int)$green);
		$this->blue = self::fixRgbValue($this->blue + (int)$blue);
	}

	/**
	 * Randomise red, green and blue values of the colour.
	 *
	 * @access public
	 */
	// Randomizes the RGB values.
	public function randomise(): void {
		$this->red = mt_rand(0, 255);
		$this->green = mt_rand(0, 255);
		$this->blue = mt_rand(0, 255);
	}

	/**
	 * Set the red, green and blue values of the colour with a HEX code.
	 *
	 * @access public
	 * @param string $hex The HEX code to set. This must be 3 or 6 characters in length and can optionally start with a '#'.
	 * @return boolean Returns TRUE on success.
	 */
	// Sets the RGB values from a HEX color code.
	public function setHex($hex): bool {
		$rgb = self::hexToRgb($hex);
		$this->red = $rgb['red'];
		$this->green = $rgb['green'];
		$this->blue = $rgb['blue'];
		return true;
	}

	/**
	 * Get the red, green and blue values of the colour as an array.
	 * Returns the RGB values as an array.
	 *
	 * @access public
	 * @return array Returns an associative array of values. The array will have 'red', 'green' and 'blue' keys.
	 */
	public function getArray(): array {
		return [
			'red' => $this->red,
			'green' => $this->green,
			'blue' => $this->blue
		];
	}

	/**
	 * Get the HEX code that represents the colour.
	 *
	 * @access public
	 * @param boolean $hash Whether to prepend the HEX code with a '#' character. Default value is FALSE.
	 * @return string Returns the HEX code.
	 */
	// Returns the HEX value of the color. Optionally includes the hash (#).
	public function getHex(bool $hash = false): string {
		return ($hash ? '#' : '') . self::rgbToHex($this->red, $this->green, $this->blue);
	}

	/**
	 * get magic method.
	 *
	 * @param string $name The name of the variable to get.
	 * @return mixed Returns the value of the requested variable.
	 */
	// Magic getter for accessing RGB or HEX properties.
	public function __get($name): null {
		switch ($name) {
			case 'red': return $this->red;
			case 'green': return $this->green;
			case 'blue': return $this->blue;
			case 'hex': return $this->getHex(true);
			case 'rgb': return $this->getArray();
		}
		$trace = debug_backtrace();
		trigger_error('Undefined property: ' . __CLASS__ . '::$' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
		return null;
	}

	/**
	 * set magic method.
	 *
	 * @param string $name The name of the variable to set.
	 * @param mixed $value The value to set the variable to.
	 */
	// Magic setter for setting RGB or HEX properties.
	public function __set($name, $value): void {
		switch ($name) {
			case 'red': $this->red = self::fixRgbValue($value); return;
			case 'green': $this->green = self::fixRgbValue($value); return;
			case 'blue': $this->blue = self::fixRgbValue($value); return;
			case 'hex': $this->setHex($value); return;
		}
		$trace = debug_backtrace();
		trigger_error('Undefined property: ' . __CLASS__ . '::$' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
	}

	/**
	 * toString magic method.
	 *
	 * @return string Returns the HEX code that represents the colour.
	 */	// Magic method to convert the object to a string, returning the HEX value with a hash.
	public function __toString(): string {
		return $this->getHex(true);
	}
}