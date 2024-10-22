# Helpful
Some helpful classes for html, sql and some useful tools for everyday php.

# JW3B\Helpful
Newly added [Ary](Helpful/Ary.php) class not comiled for docs yet.

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

## [SQL](docs/SQL.md) 
| Name                              | Description                                        |
| --------------------------------- | -------------------------------------------------- |
| [decimal](docs/SQL.md#sqldecimal) | Format a decimal number for USA currency.          |
| [format](docs/SQL.md#sqlformat)   | Format a value based on the specified format type. |

## [Str](docs/Str.md) 
| Name                                                  | Description                                      |
| ----------------------------------------------------- | ------------------------------------------------ |
| [arrayToObject](docs/Str.md#strarraytoobject)         | Convert an array to an object.                   |
| [clean_url](docs/Str.md#strclean_url)                 | Clean a URL string.                              |
| [e](docs/Str.md#stre)                                 | Clean a text string.                             |
| [form_element_name](docs/Str.md#strform_element_name) | Generate a form element name from a string.      |
| [mail2](docs/Str.md#strmail2)                         | Send an email.                                   |
| [objectToArray](docs/Str.md#strobjecttoarray)         | Convert an object to an array.                   |
| [p](docs/Str.md#strp)                                 | Print a variable in a readable format.           |
| [parse_my_url](docs/Str.md#strparse_my_url)           | Parse the current URL into an array of segments. |
| [random_string](docs/Str.md#strrandom_string)         | Generate a random string.                        |
| [removePound](docs/Str.md#strremovepound)             | Remove pound signs and dashes from a string.     |
| [sq](docs/Str.md#strsq)                               | Calculate the price per square foot.             |

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
