# JW3B\Helpful\Str
Some of these functions have been influenced by Laravels Str class
## Methods

| Name | Description |
|------|-------------|
|[camel](#strcamel)|Convert a value to camel case.|
|[clean_url](#strclean_url)|Clean a URL string.|
|[e](#stre)|Clean a text string.|
|[form_element_name](#strform_element_name)|Generate a form element name from a string.|
|[fromBase64](#strfrombase64)|Decode the given Base64 encoded string.|
|[headline](#strheadline)|Convert various string formats to a capitalized headline.|
|[kebab](#strkebab)|Convert a camelCase string to kebab-case.|
|[lcfirst](#strlcfirst)|Make a string's first character lowercase.|
|[length](#strlength)|Return the length of the given string.|
|[limit](#strlimit)|Limit the number of characters in a string.|
|[lower](#strlower)|Convert the given string to lower-case.|
|[ltrim](#strltrim)|Remove all whitespace from the beginning of a string.|
|[p](#strp)|Print a variable in a readable format.|
|[parse_my_url](#strparse_my_url)|Parse the current URL into an array of segments.|
|[randomString](#strrandomstring)|Generate a random string.|
|[removePound](#strremovepound)|Remove pound signs and dashes from a string.|
|[rtrim](#strrtrim)|Remove all whitespace from the end of a string.|
|[snake](#strsnake)|Convert a string to snake case.|
|[studly](#strstudly)|Convert a value to studly caps case.|
|[substr](#strsubstr)|Returns the portion of the string specified by the start and length parameters.|
|[swap](#strswap)|Swap keywords in a string according to a mapping array.|
|[title](#strtitle)|Convert the given string to proper case.|
|[toBase64](#strtobase64)|Convert the given string to Base64 encoding.|
|[trim](#strtrim)|Remove all whitespace from both ends of a string.|
|[ucfirst](#strucfirst)|Make a string's first character uppercase.|
|[ucsplit](#strucsplit)|Split a string into pieces by uppercase characters.|
|[upper](#strupper)|Convert the given string to upper-case.|
|[wordWrap](#strwordwrap)|Wrap a string to a given number of characters using a specified line break.|




### Str::camel
**Description**

```php
public static camel (string $value)
```

Convert a value to camel case.

**Parameters**

* `(string) $value`

**Return Values**

`string`




<hr />


### Str::clean_url
**Description**

```php
public static clean_url (string $str)
```

Clean a URL string.

**Parameters**

* `(string) $str`
: The string to clean.
**Return Values**

`string|null`

> The cleaned URL.


<hr />


### Str::e
**Description**

```php
public static e (string $str, bool $nl2br)
```

Clean a text string.

**Parameters**

* `(string) $str`
: The string to clean.* `(bool) $nl2br`
: Convert newlines to <br> tags.
**Return Values**

`string`

> The cleaned text.


<hr />


### Str::form_element_name
**Description**

```php
public static form_element_name (string $str)
```

Generate a form element name from a string.

**Parameters**

* `(string) $str`
: The string to convert.
**Return Values**

`string`

> The form element name.


<hr />


### Str::fromBase64
**Description**

```php
public static fromBase64 (string $string, bool $strict)
```

Decode the given Base64 encoded string.

**Parameters**

* `(string) $string`
* `(bool) $strict`

**Return Values**

`string|false`




<hr />


### Str::headline
**Description**

```php
public static headline (string $string)
```

Convert various string formats to a capitalized headline.

**Parameters**

* `(string) $string`
: The input string.
**Return Values**

`string`

> The headline formatted string.


<hr />


### Str::kebab
**Description**

```php
public static kebab (string $string)
```

Convert a camelCase string to kebab-case.

**Parameters**

* `(string) $string`
: The camelCase string.
**Return Values**

`string`

> The kebab-case string.


<hr />


### Str::lcfirst
**Description**

```php
public static lcfirst (string $string)
```

Make a string's first character lowercase.

**Parameters**

* `(string) $string`

**Return Values**

`string`




<hr />


### Str::length
**Description**

```php
public static length (string $value, string|null $encoding)
```

Return the length of the given string.

**Parameters**

* `(string) $value`
* `(string|null) $encoding`

**Return Values**

`int`




<hr />


### Str::limit
**Description**

```php
public static limit (string $value, int $limit, string $end, bool $preserveWords)
```

Limit the number of characters in a string.

**Parameters**

* `(string) $value`
* `(int) $limit`
* `(string) $end`
* `(bool) $preserveWords`

**Return Values**

`string`




<hr />


### Str::lower
**Description**

```php
public static lower (string $value)
```

Convert the given string to lower-case.

**Parameters**

* `(string) $value`

**Return Values**

`string`




<hr />


### Str::ltrim
**Description**

```php
public static ltrim (string $value, string|null $charlist)
```

Remove all whitespace from the beginning of a string.

**Parameters**

* `(string) $value`
* `(string|null) $charlist`

**Return Values**

`string`




<hr />


### Str::p
**Description**

```php
public static p (mixed $t)
```

Print a variable in a readable format.

**Parameters**

* `(mixed) $t`
: The variable to print.
**Return Values**

`string`

> The formatted variable.


<hr />


### Str::parse_my_url
**Description**

```php
public static parse_my_url (void)
```

Parse the current URL into an array of segments.

**Parameters**

`This function has no parameters.`

**Return Values**

`array`

> The URL segments.


<hr />


### Str::randomString
**Description**

```php
public static randomString (int $length, bool $lowercase, bool $uppercase, bool $number)
```

Generate a random string.

**Parameters**

* `(int) $length`
: Length of the string to generate.* `(bool) $lowercase`
: Include lowercase letters.* `(bool) $uppercase`
: Include uppercase letters.* `(bool) $number`
: Include numbers.
**Return Values**

`string`

> The generated random string.


<hr />


### Str::removePound
**Description**

```php
public static removePound (string $tt)
```

Remove pound signs and dashes from a string.

**Parameters**

* `(string) $tt`
: The string to modify.
**Return Values**

`string`

> The modified string.


<hr />


### Str::rtrim
**Description**

```php
public static rtrim (string $value, string|null $charlist)
```

Remove all whitespace from the end of a string.

**Parameters**

* `(string) $value`
* `(string|null) $charlist`

**Return Values**

`string`




<hr />


### Str::snake
**Description**

```php
public static snake (string $value, string $delimiter)
```

Convert a string to snake case.

**Parameters**

* `(string) $value`
* `(string) $delimiter`

**Return Values**

`string`




<hr />


### Str::studly
**Description**

```php
public static studly (string $value)
```

Convert a value to studly caps case.

**Parameters**

* `(string) $value`

**Return Values**

`string`




<hr />


### Str::substr
**Description**

```php
public static substr (string $string, int $start, int|null $length, string $encoding)
```

Returns the portion of the string specified by the start and length parameters.

**Parameters**

* `(string) $string`
* `(int) $start`
* `(int|null) $length`
* `(string) $encoding`

**Return Values**

`string`




<hr />


### Str::swap
**Description**

```php
public static swap (array $replacements, string $string)
```

Swap keywords in a string according to a mapping array.

**Parameters**

* `(array) $replacements`
: An associative array of replacements.* `(string) $string`
: The original string.
**Return Values**

`string`

> The string with replacements.


<hr />


### Str::title
**Description**

```php
public static title (string $value)
```

Convert the given string to proper case.

**Parameters**

* `(string) $value`

**Return Values**

`string`




<hr />


### Str::toBase64
**Description**

```php
public static toBase64 (string $string)
```

Convert the given string to Base64 encoding.

**Parameters**

* `(string) $string`

**Return Values**

`string`




<hr />


### Str::trim
**Description**

```php
public static trim (string $value, string|null $charlist)
```

Remove all whitespace from both ends of a string.

**Parameters**

* `(string) $value`
* `(string|null) $charlist`

**Return Values**

`string`




<hr />


### Str::ucfirst
**Description**

```php
public static ucfirst (string $string)
```

Make a string's first character uppercase.

**Parameters**

* `(string) $string`

**Return Values**

`string`




<hr />


### Str::ucsplit
**Description**

```php
public static ucsplit (string $string)
```

Split a string into pieces by uppercase characters.

**Parameters**

* `(string) $string`

**Return Values**

`string[]`




<hr />


### Str::upper
**Description**

```php
public static upper (string $value)
```

Convert the given string to upper-case.

**Parameters**

* `(string) $value`

**Return Values**

`string`




<hr />


### Str::wordWrap
**Description**

```php
public static wordWrap (string $text, int $characters, string $break)
```

Wrap a string to a given number of characters using a specified line break.

**Parameters**

* `(string) $text`
: The input string.* `(int) $characters`
: The max number of characters per line.* `(string) $break`
: The line break delimiter.
**Return Values**

`string`

> The word-wrapped string.


<hr />

