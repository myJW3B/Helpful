# JW3B\Helpful\SQL  







## Methods

| Name | Description |
|------|-------------|
|[decimal](#sqldecimal)|Format a decimal number for USA currency.|
|[format](#sqlformat)|Format a value based on the specified format type.|




### SQL::decimal  

**Description**

```php
public static decimal (string|float|int $str, int $length, int $after)
```

Format a decimal number for USA currency. 

 

**Parameters**

* `(string|float|int) $str`
: The number to format.  
* `(int) $length`
: The maximum length of the formatted number.  
* `(int) $after`
: Number of digits after the decimal point.  

**Return Values**

`string|array`

> The formatted number or an error message.


<hr />


### SQL::format  

**Description**

```php
public static format (string $what, string $val)
```

Format a value based on the specified format type. 

 

**Parameters**

* `(string) $what`
: The format type (e.g., 'datetime', 'mysql-phone', 'display-time', 'phone').  
* `(string) $val`
: The value to format.  

**Return Values**

`string`

> The formatted value.


<hr />

