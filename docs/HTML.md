# JW3B\Helpful\HTML  







## Methods

| Name | Description |
|------|-------------|
|[breadcrumb](#htmlbreadcrumb)|Generates a breadcrumb navigation.|
|[browse](#htmlbrowse)|Generates pagination links based on current page and total items.|
|[pagination](#htmlpagination)|Generates a pagination HTML structure.|
|[setUpLinks](#htmlsetuplinks)|Sets up links from a comma-separated list of tags.|
|[svg_img](#htmlsvg_img)|Generates an SVG image with a specified width, height, and text.|
|[tagCloud](#htmltagcloud)|Generates a tag cloud from an associative array of tags and their frequencies.|




### HTML::breadcrumb  

**Description**

```php
public static breadcrumb (array $pgs, array $right, string $add_class)
```

Generates a breadcrumb navigation. 

 

**Parameters**

* `(array) $pgs`
: Array of page links and titles.  
* `(array) $right`
: Array of right-aligned page links.  
* `(string) $add_class`
: Additional CSS classes for styling.  

**Return Values**

`string`




<hr />


### HTML::browse  

**Description**

```php
public static browse (int $pageNum, int $totalPerPage, int $howMany, string $b4page, string $afterPage, string $hideLast, array $extra)
```

Generates pagination links based on current page and total items. 

 

**Parameters**

* `(int) $pageNum`
: Current page number.  
* `(int) $totalPerPage`
: Total items per page.  
* `(int) $howMany`
: Total number of items.  
* `(string) $b4page`
: Base URL before the page number.  
* `(string) $afterPage`
: URL suffix after the page number.  
* `(string) $hideLast`
: Option to hide the last page link.  
* `(array) $extra`
: Additional parameters for pagination.  

**Return Values**

`string`

> HTML string of pagination links.


<hr />


### HTML::pagination  

**Description**

```php
public pagination (int $item_count, int $limit, int $cur_page, string $link)
```

Generates a pagination HTML structure. 

 

**Parameters**

* `(int) $item_count`
: The total number of items.  
* `(int) $limit`
: The number of items per page.  
* `(int) $cur_page`
: The current page number.  
* `(string) $link`
: The URL pattern for pagination links.  

**Return Values**

`string|null`

> The generated HTML for pagination, or null if there are no pages to display.


<hr />


### HTML::setUpLinks  

**Description**

```php
public setUpLinks (string $tags, string $b4Link, string $afterLink, string $sep)
```

Sets up links from a comma-separated list of tags. 

 

**Parameters**

* `(string) $tags`
: Comma-separated list of tags.  
* `(string) $b4Link`
: Base URL before the tag.  
* `(string) $afterLink`
: URL suffix after the tag.  
* `(string) $sep`
: Separator used to split the tags.  

**Return Values**

`string`

> HTML string of links.


<hr />


### HTML::svg_img  

**Description**

```php
public static svg_img (int $width, int $height, string $text)
```

Generates an SVG image with a specified width, height, and text. 

 

**Parameters**

* `(int) $width`
: Width of the SVG image.  
* `(int) $height`
: Height of the SVG image.  
* `(string) $text`
: Text to display in the SVG.  

**Return Values**

`string`

> HTML string of the SVG image.


<hr />


### HTML::tagCloud  

**Description**

```php
public tagCloud (array $tags, string $b4Link, string $afterLink)
```

Generates a tag cloud from an associative array of tags and their frequencies. 

 

**Parameters**

* `(array) $tags`
: Associative array of tags and their frequency counts.  
* `(string) $b4Link`
: Base URL before the tag.  
* `(string) $afterLink`
: URL suffix after the tag.  

**Return Values**

`string`

> HTML string of the tag cloud or a message if no tags are found.


<hr />

