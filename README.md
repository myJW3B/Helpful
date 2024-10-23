# JW3B\Helpful
* [Ary](docs/Ary.md)
* [Color](docs/Color.md)
* [Files](docs/Files.md)
* [HTML](docs/HTML.md)
* [Images](docs/Images.md)
* [Mail](docs/Mail.md)
* [Number](docs/Number.md)
* [SQL](docs/SQL.md)
* [Str](docs/Str.md)


## [Ary](docs/Ary.md) <small> Array</small>
| Name | Description |
|------|-------------|
|[arrayToObject](docs/Ary.md#aryarraytoobject)|Convert an array to an object.|
|[flop_vals](docs/Ary.md#aryflop_vals)|Preserving the keys and flop the values in reverse order.|
|[objectToArray](docs/Ary.md#aryobjecttoarray)|Convert an object to an array.|

## [Files](docs/Files.md)
| Name                                                              | Description                                                        |
| ----------------------------------------------------------------- | ------------------------------------------------------------------ |
| [check_file](docs/Files.md#filescheck_file)                       | Puts a number before the filename if it exists.                    |
| [deleteDir](docs/Files.md#filesdeletedir)                         | Deletes a directory and its contents.                              |
| [make_yr_directory](docs/Files.md#filesmake_yr_directory)         | Creates a directory structure based on the current year and month. |
| [mk_dir_writable](docs/Files.md#filesmk_dir_writable)             | Creates a writable directory.                                      |
| [reArrayFiles](docs/Files.md#filesrearrayfiles)                   | Re-arranges files array for image uploads.                         |
| [removeEmptySubfolders](docs/Files.md#filesremoveemptysubfolders) | Removes empty subfolders.                                          |
| [tree](docs/Files.md#filestree)                                   | Reads all files and folders in a directory.                        |
| [zip](docs/Files.md#fileszip)                                     | Zips a directory or file.                                          |

## [HTML](docs/HTML.md)
| Name                                      | Description                                                                    |
| ----------------------------------------- | ------------------------------------------------------------------------------ |
| [breadcrumb](docs/HTML.md#htmlbreadcrumb) | Generates a breadcrumb navigation.                                             |
| [browse](docs/HTML.md#htmlbrowse)         | Generates pagination links based on current page and total items.              |
| [pagination](docs/HTML.md#htmlpagination) | Generates a pagination HTML structure.                                         |
| [setUpLinks](docs/HTML.md#htmlsetuplinks) | Sets up links from a comma-separated list of tags.                             |
| [svg_img](docs/HTML.md#htmlsvg_img)       | Generates an SVG image with a specified width, height, and text.               |
| [tagCloud](docs/HTML.md#htmltagcloud)     | Generates a tag cloud from an associative array of tags and their frequencies. |

## [Images](docs/Images.md)
| Name                                                                | Description                        |
| ------------------------------------------------------------------- | ---------------------------------- |
| [get_large_img](docs/Images.md#imagesget_large_img)                 | Get the large version of an image. |
| [get_mime_type](docs/Images.md#imagesget_mime_type)                 | Get the MIME type of a file.       |
| [resize_image](docs/Images.md#imagesresize_image)                   | Resize an image using ImageMagick. |
| [resize_uploaded_image](docs/Images.md#imagesresize_uploaded_image) | Resize and upload an image.        |
| [set_im](docs/Images.md#imagesset_im)                               | Set the ImageMagick command.       |
| [webpImage](docs/Images.md#imageswebpimage)                         | Convert an image to webp using GD. |

## [Mail](docs/Mail.md)
| Name | Description |
|------|-------------|
|[send](docs/Mail.md#mailsend)|Send an email.|

## [Number](docs/Number.md)
| Name | Description |
|------|-------------|
|[numberToWord](docs/Number.md#numbernumbertoword)|Convert a number to its word representation.|
|[sq](docs/Number.md#numbersq)|Calculate the price per square foot.|

## [SQL](docs/SQL.md)
| Name                              | Description                                        |
| --------------------------------- | -------------------------------------------------- |
| [decimal](docs/SQL.md#sqldecimal) | Format a decimal number for USA currency.          |
| [format](docs/SQL.md#sqlformat)   | Format a value based on the specified format type. |

## [Str](docs/Str.md)
> Some functions are heavily influenced by Laravel's [illuminate\support\Str](https://github.com/illuminate/support/blob/master/Str.php) Class

| Name | Description |
|------|-------------|
|[camel](docs/Str.md#strcamel)|Convert a value to camel case.|
|[clean_url](docs/Str.md#strclean_url)|Clean a URL string.|
|[e](docs/Str.md#stre)|Clean a text string.|
|[form_element_name](docs/Str.md#strform_element_name)|Generate a form element name from a string.|
|[fromBase64](docs/Str.md#strfrombase64)|Decode the given Base64 encoded string.|
|[headline](docs/Str.md#strheadline)|Convert various string formats to a capitalized headline.|
|[kebab](docs/Str.md#strkebab)|Convert a camelCase string to kebab-case.|
|[lcfirst](docs/Str.md#strlcfirst)|Make a string's first character lowercase.|
|[length](docs/Str.md#strlength)|Return the length of the given string.|
|[limit](docs/Str.md#strlimit)|Limit the number of characters in a string.|
|[lower](docs/Str.md#strlower)|Convert the given string to lower-case.|
|[ltrim](docs/Str.md#strltrim)|Remove all whitespace from the beginning of a string.|
|[p](docs/Str.md#strp)|Print a variable in a readable format.|
|[parse_my_url](docs/Str.md#strparse_my_url)|Parse the current URL into an array of segments.|
|[randomString](docs/Str.md#strrandomstring)|Generate a random string.|
|[removePound](docs/Str.md#strremovepound)|Remove pound signs and dashes from a string.|
|[rtrim](docs/Str.md#strrtrim)|Remove all whitespace from the end of a string.|
|[snake](docs/Str.md#strsnake)|Convert a string to snake case.|
|[studly](docs/Str.md#strstudly)|Convert a value to studly caps case.|
|[substr](docs/Str.md#strsubstr)|Returns the portion of the string specified by the start and length parameters.|
|[swap](docs/Str.md#strswap)|Swap keywords in a string according to a mapping array.|
|[title](docs/Str.md#strtitle)|Convert the given string to proper case.|
|[toBase64](docs/Str.md#strtobase64)|Convert the given string to Base64 encoding.|
|[trim](docs/Str.md#strtrim)|Remove all whitespace from both ends of a string.|
|[ucfirst](docs/Str.md#strucfirst)|Make a string's first character uppercase.|
|[ucsplit](docs/Str.md#strucsplit)|Split a string into pieces by uppercase characters.|
|[upper](docs/Str.md#strupper)|Convert the given string to upper-case.|
|[wordWrap](docs/Str.md#strwordwrap)|Wrap a string to a given number of characters using a specified line break.|


## [Color](docs/Color.md)
> Modified and updated to PHP 8 from https://gist.github.com/425464 (c) Rowan Manning

| Name                                          | Description                                                             |
| --------------------------------------------- | ----------------------------------------------------------------------- |
| [__construct](docs/Color.md#color__construct) | Class constructor.                                                      |
| [__get](docs/Color.md#color__get)             | get magic method.                                                       |
| [__set](docs/Color.md#color__set)             | set magic method.                                                       |
| [__toString](docs/Color.md#color__tostring)   | toString magic method.                                                  |
| [getArray](docs/Color.md#colorgetarray)       | Get the red, green and blue values of the colour as an array.           |
| [getHex](docs/Color.md#colorgethex)           | Get the HEX code that represents the colour.                            |
| [hexToRgb](docs/Color.md#colorhextorgb)       | Convert a HEX code into RGB.                                            |
| [mix](docs/Color.md#colormix)                 | Mix two colours together.                                               |
| [modify](docs/Color.md#colormodify)           | Modify the colour's red, green and blue values.                         |
| [randomise](docs/Color.md#colorrandomise)     | Randomise red, green and blue values of the colour.                     |
| [range](docs/Color.md#colorrange)             | Calculate and return a range of colours between a start and end colour. |
| [rgbToHex](docs/Color.md#colorrgbtohex)       | Convert red, green and blue values to a HEX code.                       |
| [set](docs/Color.md#colorset)                 | Set the colour's red, green and blue values // Sets the RGB values.     |
| [setHex](docs/Color.md#colorsethex)           | Set the red, green and blue values of the colour with a HEX code.       |
