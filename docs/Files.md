# JW3B\Helpful\Files
## Methods

| Name | Description |
|------|-------------|
|[check_file](#filescheck_file)|Puts a number before the filename if it exists.|
|[deleteDir](#filesdeletedir)|Deletes a directory and its contents.|
|[make_yr_directory](#filesmake_yr_directory)|Creates a directory structure based on the current year and month.|
|[mk_dir_writable](#filesmk_dir_writable)|Creates a writable directory.|
|[reArrayFiles](#filesrearrayfiles)|Re-arranges files array for image uploads.|
|[removeEmptySubfolders](#filesremoveemptysubfolders)|Removes empty subfolders.|
|[tree](#filestree)|Reads all files and folders in a directory.|
|[zip](#fileszip)|Zips a directory or file.|




### Files::check_file
**Description**

```php
public static check_file (string $dir, string $name)
```

Puts a number before the filename if it exists.

**Parameters**

* `(string) $dir`
: Directory path.* `(string) $name`
: Filename.
**Return Values**

`string`

> The modified filename if exists.


<hr />


### Files::deleteDir
**Description**

```php
public static deleteDir (string $dir, bool $rec)
```

Deletes a directory and its contents.

**Parameters**

* `(string) $dir`
: Directory to delete.* `(bool) $rec`
: Whether to delete recursively.
**Return Values**

`bool`

> True if successful.


**Throws Exceptions**


`\RuntimeException`
> if unable to delete.

<hr />


### Files::make_yr_directory
**Description**

```php
public static make_yr_directory (string $destination)
```

Creates a directory structure based on the current year and month.

**Parameters**

* `(string) $destination`
: Base directory.
**Return Values**

`string`

> Path to the created directory.


<hr />


### Files::mk_dir_writable
**Description**

```php
public static mk_dir_writable (string $dir)
```

Creates a writable directory.

**Parameters**

* `(string) $dir`
: Directory to create.
**Return Values**

`bool`

> True if writable, false otherwise.


**Throws Exceptions**


`\RuntimeException`
> if unable to create directory.

<hr />


### Files::reArrayFiles
**Description**

```php
public static reArrayFiles (array $file_post)
```

Re-arranges files array for image uploads.
$file_ary = reArrayFiles($_FILES['file']);  
foreach ($file_ary as $file) {  
	 print 'File Name: '.$file['name'];  
	 print 'File Type: '.$file['type'];  
	 print 'File Size: '.$file['size'];  
}
**Parameters**

* `(array) $file_post`
: $_FILES array.
**Return Values**

`array`

> Re-arranged files.


<hr />


### Files::removeEmptySubfolders
**Description**

```php
public static removeEmptySubfolders (string $path)
```

Removes empty subfolders.

**Parameters**

* `(string) $path`
: Path to check.
**Return Values**

`void`


<hr />


### Files::tree
**Description**

```php
public static tree (string $path, string $match)
```

Reads all files and folders in a directory.

**Parameters**

* `(string) $path`
: Path without the trailing slash.* `(string) $match`
: Pattern to match files.
**Return Values**

`array`

> List of files and directories.


<hr />


### Files::zip
**Description**

```php
public zip (string $source, string $destination)
```

Zips a directory or file.
Source: http://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php  
zip('/folder/to/compress/', './compressed.zip');
**Parameters**

* `(string) $source`
: Source directory or file.* `(string) $destination`
: Destination zip file.
**Return Values**

`bool`

> True if successful.


<hr />

