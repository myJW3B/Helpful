# JW3B\Helpful\Images
## Methods

| Name | Description |
|------|-------------|
|[get_large_img](#imagesget_large_img)|Get the large version of an image.|
|[get_mime_type](#imagesget_mime_type)|Get the MIME type of a file.|
|[resize_image](#imagesresize_image)|Resize an image using ImageMagick.|
|[resize_uploaded_image](#imagesresize_uploaded_image)|Resize and upload an image.|
|[set_im](#imagesset_im)|Set the ImageMagick command.|
|[webpImage](#imageswebpimage)|Convert an image to webp using GD.|




### Images::get_large_img
**Description**

```php
public static get_large_img (string $img)
```

Get the large version of an image.

**Parameters**

* `(string) $img`
: The path to the image.
**Return Values**

`string`

> The path to the large image.


<hr />


### Images::get_mime_type
**Description**

```php
public static get_mime_type (array $file)
```

Get the MIME type of a file.

**Parameters**

* `(array) $file`
: The file information.
**Return Values**

`string|array`

> The MIME type or an error.


<hr />


### Images::resize_image
**Description**

```php
public resize_image (string $dir, string $filename, array $sizes, array $make_webp, string $remove_from_beginning)
```

Resize an image using ImageMagick.

**Parameters**

* `(string) $dir`
: The directory the file is in.* `(string) $filename`
: The filename.* `(array) $sizes`
: The sizes to resize to.* `(array) $make_webp`
: Options for converting to webp.* `(string) $remove_from_beginning`
: Path to remove from the beginning of the file path.
**Return Values**

`array`

> The paths to the resized images.


<hr />


### Images::resize_uploaded_image
**Description**

```php
public resize_uploaded_image (array $file, string $dir, array $opts)
```

Resize and upload an image.

**Parameters**

* `(array) $file`
: The file information (e.g., $_FILES['input-name']).* `(string) $dir`
: The directory to upload to.* `(array) $opts`
: Options for resizing and conversion.
**Return Values**

`string|array`

> The path to the resized images or an error message.


<hr />


### Images::set_im
**Description**

```php
public set_im (string $val)
```

Set the ImageMagick command.

**Parameters**

* `(string) $val`
: The ImageMagick command.
**Return Values**

`$this`




<hr />


### Images::webpImage
**Description**

```php
public static webpImage (string $source, int $quality, bool $removeOld)
```

Convert an image to webp using GD.

**Parameters**

* `(string) $source`
: The path to the original image.* `(int) $quality`
: The quality of the webp image (0-100).* `(bool) $removeOld`
: Whether to remove the original image.
**Return Values**

`string|bool`

> The path to the webp image.


<hr />

