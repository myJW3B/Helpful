# JW3B\Helpful\Color
PHP Color Class
An simple colour class for PHP.
Note: in documentation the 'colour' spelling is intentional.
## Implements:
Stringable
## Methods

| Name | Description |
|------|-------------|
|[__construct](#color__construct)|Class constructor.|
|[__get](#color__get)|get magic method.|
|[__set](#color__set)|set magic method.|
|[__toString](#color__tostring)|toString magic method.|
|[getArray](#colorgetarray)|Get the red, green and blue values of the colour as an array.|
|[getHex](#colorgethex)|Get the HEX code that represents the colour.|
|[hexToRgb](#colorhextorgb)|Convert a HEX code into RGB.|
|[mix](#colormix)|Mix two colours together.|
|[modify](#colormodify)|Modify the colour's red, green and blue values.|
|[randomise](#colorrandomise)|Randomise red, green and blue values of the colour.|
|[range](#colorrange)|Calculate and return a range of colours between a start and end colour.|
|[rgbToHex](#colorrgbtohex)|Convert red, green and blue values to a HEX code.|
|[set](#colorset)|Set the colour's red, green and blue values // Sets the RGB values.|
|[setHex](#colorsethex)|Set the red, green and blue values of the colour with a HEX code.|




### Color::__construct
**Description**

```php
public __construct (int $red, int $green, int $blue)
```

Class constructor.
// Constructor to initialize the RGB values.
**Parameters**

* `(int) $red`
: [optional] The red value of the colour (between 0 and 255). Default value is 0.* `(int) $green`
: [optional] The green value of the colour (between 0 and 255). Default value is 0.* `(int) $blue`
: [optional] The blue value of the colour (between 0 and 255). Default value is 0.
**Return Values**

`void`


<hr />


### Color::__get
**Description**

```php
public __get (string $name)
```

get magic method.
// Magic getter for accessing RGB or HEX properties.
**Parameters**

* `(string) $name`
: The name of the variable to get.
**Return Values**

`mixed`

> Returns the value of the requested variable.


<hr />


### Color::__set
**Description**

```php
public __set (string $name, mixed $value)
```

set magic method.
// Magic setter for setting RGB or HEX properties.
**Parameters**

* `(string) $name`
: The name of the variable to set.* `(mixed) $value`
: The value to set the variable to.
**Return Values**

`void`


<hr />


### Color::__toString
**Description**

```php
public __toString (void)
```

toString magic method.
// Magic method to convert the object to a string, returning the HEX value with a hash.
**Parameters**

`This function has no parameters.`

**Return Values**

`string`

> Returns the HEX code that represents the colour.


<hr />


### Color::getArray
**Description**

```php
public getArray (void)
```

Get the red, green and blue values of the colour as an array.
Returns the RGB values as an array.
**Parameters**

`This function has no parameters.`

**Return Values**

`array`

> Returns an associative array of values. The array will have 'red', 'green' and 'blue' keys.


<hr />


### Color::getHex
**Description**

```php
public getHex (bool $hash)
```

Get the HEX code that represents the colour.
// Returns the HEX value of the color. Optionally includes the hash (#).
**Parameters**

* `(bool) $hash`
: Whether to prepend the HEX code with a '#' character. Default value is FALSE.
**Return Values**

`string`

> Returns the HEX code.


<hr />


### Color::hexToRgb
**Description**

```php
public static hexToRgb (string $hex)
```

Convert a HEX code into RGB.

**Parameters**

* `(string) $hex`
: The HEX code to convert.
**Return Values**

`array`

> Returns an associative array of values. The array will have 'red', 'green' and 'blue' keys.


<hr />


### Color::mix
**Description**

```php
public static mix (\Color|string $color1, \Color|string $color2)
```

Mix two colours together.
Mixes two colors and returns the resulting color.
**Parameters**

* `(\Color|string) $color1`
: The first colour. This can be a Color object or a HEX code as a string.* `(\Color|string) $color2`
: The second colour. This can be a Color object or a HEX code as a string.
**Return Values**

`\Color`

> Returns the result of the mix as a new Color object.


<hr />


### Color::modify
**Description**

```php
public modify (int $red, int $green, int $blue)
```

Modify the colour's red, green and blue values.
// Modifies the RGB values by adding the provided values to the existing ones.
**Parameters**

* `(int) $red`
: [optional] The amount to modify the red value of the colour (between -255 and 255). Default value is 0.* `(int) $green`
: [optional] The amount to modify the green value of the colour (between -255 and 255). Default value is 0.* `(int) $blue`
: [optional] The amount to modify the blue value of the colour (between -255 and 255). Default value is 0.
**Return Values**

`void`


<hr />


### Color::randomise
**Description**

```php
public randomise (void)
```

Randomise red, green and blue values of the colour.
// Randomizes the RGB values.
**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Color::range
**Description**

```php
public static range (\Color|string $start, \Color|string $end, int $steps)
```

Calculate and return a range of colours between a start and end colour.
Generates a gradient of colors between two colors over a defined number of steps.
**Parameters**

* `(\Color|string) $start`
: The start colour. This can be a Color object or a HEX code as a string.* `(\Color|string) $end`
: The end colour. This can be a Color object or a HEX code as a string.* `(int) $steps`
: The number of colours to return (including start and end colours).
**Return Values**

`mixed`

> Returns an array of Color objects.


<hr />


### Color::rgbToHex
**Description**

```php
public static rgbToHex (mixed $red, mixed $green, mixed $blue)
```

Convert red, green and blue values to a HEX code.

**Parameters**

* `(mixed) $red`
: The red value of the colour (between 0 and 255).* `(mixed) $green`
: The green value of the colour (between 0 and 255).* `(mixed) $blue`
: The blue value of the colour (between 0 and 255).
**Return Values**

`string`

> Returns the HEX code representing the values given.


<hr />


### Color::set
**Description**

```php
public set (int $red, int $green, int $blue)
```

Set the colour's red, green and blue values // Sets the RGB values.

**Parameters**

* `(int) $red`
: [optional] The red value of the colour (between 0 and 255). Default value is 0.* `(int) $green`
: [optional] The green value of the colour (between 0 and 255). Default value is 0.* `(int) $blue`
: [optional] The blue value of the colour (between 0 and 255). Default value is 0.
**Return Values**

`void`


<hr />


### Color::setHex
**Description**

```php
public setHex (string $hex)
```

Set the red, green and blue values of the colour with a HEX code.
// Sets the RGB values from a HEX color code.
**Parameters**

* `(string) $hex`
: The HEX code to set. This must be 3 or 6 characters in length and can optionally start with a '#'.
**Return Values**

`bool`

> Returns TRUE on success.


<hr />

