# JW3B\Helpful\Str

## Methods

| Name | Description |
|------|-------------|
|[arrayToObject](#strarraytoobject)|Convert an array to an object.|
|[clean_url](#strclean_url)|Clean a URL string.|
|[e](#stre)|Clean a text string.|
|[form_element_name](#strform_element_name)|Generate a form element name from a string.|
|[mail2](#strmail2)|Send an email.|
|[objectToArray](#strobjecttoarray)|Convert an object to an array.|
|[p](#strp)|Print a variable in a readable format.|
|[parse_my_url](#strparse_my_url)|Parse the current URL into an array of segments.|
|[random_string](#strrandom_string)|Generate a random string.|
|[removePound](#strremovepound)|Remove pound signs and dashes from a string.|
|[sq](#strsq)|Calculate the price per square foot.|




### Str::arrayToObject

**Description**

```php
public static arrayToObject (mixed $d)
```

Convert an array to an object.



**Parameters**

* `(mixed) $d`
: The array to convert.

**Return Values**

`object`

> The converted object.


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
: The string to clean.
* `(bool) $nl2br`
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


### Str::mail2

**Description**

```php
public static mail2 (string $to, string $from, string $subject, string $message, array $header)
```

Send an email.



**Parameters**

* `(string) $to`
: The recipient's email address.
* `(string) $from`
: Senders email address.
* `(string) $subject`
: The subject of the email.
* `(string) $message`
: The email message.
* `(array) $header`
: Additional headers.

**Return Values**

`bool`

> True if the email was sent successfully, false otherwise.


<hr />


### Str::objectToArray

**Description**

```php
public static objectToArray (mixed $d)
```

Convert an object to an array.

? credits to
! https://www.if-not-true-then-false.com/2009/php-tip-convert-stdclass-object-to-multidimensional-array-and-convert-multidimensional-array-to-stdclass-object/

**Parameters**

* `(mixed) $d`
: The object to convert.

**Return Values**

`mixed`

> The converted array.


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


### Str::random_string

**Description**

```php
public static random_string (int $length, bool $lowercase, bool $uppercase, bool $number)
```

Generate a random string.



**Parameters**

* `(int) $length`
: Length of the string to generate.
* `(bool) $lowercase`
: Include lowercase letters.
* `(bool) $uppercase`
: Include uppercase letters.
* `(bool) $number`
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


### Str::sq

**Description**

```php
public static sq (float $w, float $h, float $p)
```

Calculate the price per square foot.



**Parameters**

* `(float) $w`
: Width.
* `(float) $h`
: Height.
* `(float) $p`
: Price.

**Return Values**

`string`

> The calculated price.


<hr />
